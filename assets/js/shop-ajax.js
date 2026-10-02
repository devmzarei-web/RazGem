document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. Mobile Drawer Toggle ---
    const filterBtn = document.querySelector('.shop-mobile-filter-btn');
    const sidebar = document.getElementById('shopSidebar');
    const closeBtn = document.querySelector('.shop-sidebar-close');
    const backdrop = document.querySelector('.drawer-backdrop');

    function openDrawer() {
        sidebar.classList.add('is-open');
        backdrop.classList.add('is-active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeDrawer() {
        sidebar.classList.remove('is-open');
        backdrop.classList.remove('is-active');
        document.body.style.overflow = '';
    }

    if (filterBtn) {
        filterBtn.addEventListener('click', openDrawer);
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', closeDrawer);
    }
    if (backdrop) {
        backdrop.addEventListener('click', closeDrawer);
    }

    // --- 2. AJAX Filtering ---
    const ajaxContainer = document.getElementById('shop-ajax-container');
    
    function fetchShopData(url) {
        // Optional: Add a loading state class
        if (ajaxContainer) {
            ajaxContainer.style.opacity = '0.5';
        }

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Replace Product Grid
                const newContainer = doc.getElementById('shop-ajax-container');
                if (newContainer && ajaxContainer) {
                    ajaxContainer.innerHTML = newContainer.innerHTML;
                    ajaxContainer.style.opacity = '1';
                }

                // Replace Sidebar Widgets (so current-cat updates)
                const newSidebar = doc.getElementById('shopSidebar');
                if (newSidebar && sidebar) {
                    // Update innerHTML but preserve the mobile header
                    const stickyContent = newSidebar.querySelector('.shop-sidebar-sticky');
                    const oldStickyContent = sidebar.querySelector('.shop-sidebar-sticky');
                    if (stickyContent && oldStickyContent) {
                        oldStickyContent.innerHTML = stickyContent.innerHTML;
                    }
                }

                // Update URL without reload
                window.history.pushState({ path: url }, '', url);
                
                // Re-bind sidebar links if they were replaced
                bindAjaxLinks();
            })
            .catch(error => {
                console.error('AJAX Filter Error:', error);
                // Fallback to standard navigation on error
                window.location.href = url;
            });
    }

    function bindAjaxLinks() {
        // Bind to category links in the sidebar
        const filterLinks = document.querySelectorAll('.coastal-widget-list a, .woocommerce-pagination a');
        
        filterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                if (url) {
                    fetchShopData(url);
                    if (window.innerWidth < 992) {
                        closeDrawer(); // Close drawer on mobile after selection
                    }
                }
            });
        });

        // If using a price filter form, intercept its submit
        const filterForms = document.querySelectorAll('.woocommerce-widget-layered-nav form, .widget_price_filter form');
        filterForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const url = new URL(this.action);
                const formData = new FormData(this);
                formData.forEach((value, key) => {
                    url.searchParams.set(key, value);
                });
                fetchShopData(url.toString());
                if (window.innerWidth < 992) {
                    closeDrawer();
                }
            });
        });
    }

    // Initial binding
    bindAjaxLinks();

    // Handle back/forward browser buttons
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.path) {
            fetchShopData(e.state.path);
        } else {
            window.location.reload();
        }
    });

});
