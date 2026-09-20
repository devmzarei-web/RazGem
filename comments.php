<?php
/**
 * The template for displaying comments (100% Farsi Translation & Custom Callback)
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area-editorial">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf( 'یک دیدگاه برای این مقاله ثبت شده است' );
            } else {
                printf( '%1$s دیدگاه برای این مقاله ثبت شده است', number_format_i18n( $comment_count ) );
            }
            ?>
        </h2>

        <ul class="comment-list">
            <?php
            // Using our custom Farsi callback function from functions.php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'razgem_custom_comment_format'
            ) );
            ?>
        </ul>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments">ثبت دیدگاه برای این مقاله بسته شده است.</p>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $user = wp_get_current_user();
    
    $comments_args = array(
        'title_reply'          => 'نظرات خود را با ما در میان بگذارید',
        'title_reply_to'       => 'پاسخ به %s',
        'cancel_reply_link'    => 'لغو پاسخ',
        'label_submit'         => 'ثبت دیدگاه',
        'class_submit'         => 'submit btn-primary',
        'comment_notes_before' => '<p class="comment-notes">نشانی ایمیل شما منتشر نخواهد شد. بخش‌های موردنیاز علامت‌گذاری شده‌اند <span class="required">*</span></p>',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">متن دیدگاه <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" required="required"></textarea></p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><label for="author">نام شما <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required="required" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">آدرس ایمیل <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required="required" /></p>',
            'url'    => '',
        ),
        'logged_in_as'         => '<p class="logged-in-as">شما با حساب کاربری <a href="'.admin_url('profile.php').'"><b>' . $user->display_name . '</b></a> وارد شده‌اید. <a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '" style="color:#d35400;">(خروج از حساب؟)</a></p>',
    );
    
    comment_form( $comments_args );
    ?>

</div>