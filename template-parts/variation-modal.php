<?php
/**
 * RazGem In-Place Lightweight Variation Pop-Out Modal
 *
 * @package RazGem
 * @version 2.1.0
 */
defined( 'ABSPATH' ) || exit;
?>
<div id="razgemVariationModal" class="razgem-variation-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="razgemModalTitle">
    <div class="variation-modal-backdrop" id="razgemModalBackdrop"></div>
    <div class="variation-modal-dialog pebble-surface">
        <button type="button" class="variation-modal-close" id="razgemModalClose" aria-label="بستن پنجره">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <div class="variation-modal-header">
            <img src="" alt="" class="modal-product-img" id="razgemModalImg">
            <div class="modal-product-info">
                <h3 class="modal-product-title" id="razgemModalTitle"></h3>
                <div class="modal-product-price" id="razgemModalPrice"></div>
            </div>
        </div>
        <div class="variation-modal-body">
            <div class="variation-field">
                <label class="variation-label" id="razgemModalAttrLabel">انتخاب گزینه:</label>
                <div class="variation-pills-wrap" id="razgemModalPills">
                    <!-- Populated dynamically by JavaScript -->
                </div>
            </div>
            <div class="variation-qty-row">
                <span class="qty-label">تعداد:</span>
                <div class="qty-stepper">
                    <button type="button" class="qty-btn qty-minus" aria-label="کاهش تعداد">-</button>
                    <input type="number" id="razgemModalQty" value="1" min="1" max="10" readonly>
                    <button type="button" class="qty-btn qty-plus" aria-label="افزایش تعداد">+</button>
                </div>
            </div>
        </div>
        <div class="variation-modal-footer">
            <button type="button" class="btn-coastal-slate btn-fly-trigger btn-submit-variation-cart" id="razgemModalAddToCart">
                <span class="btn-icon">🛒</span>
                <span class="btn-text">افزودن به سبد خرید</span>
            </button>
        </div>
    </div>
</div>
