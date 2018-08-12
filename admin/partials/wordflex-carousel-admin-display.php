<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Option page info
 * add html before cmb2 output
 */
function WordFlex_Carousel_admin_page( $cmb_id, $object_id, $object_type, $cmb ) {
    // Only output above the _yourprefix_demo_metabox metabox.
    if ( 'wordflex_carousel_options_page' !== $cmb_id )
        return;
    ?>

    <!-- Start carousel main content -->
    <div class="wf-container">
        <div class="wf-main">
            <p class="lead"><?php _e('WordFlex Carousel is a light weighted slider plugin based on Bootstrap 4 Carousel with awesome extended features.', 'wordflex-carousel') ?></p>

            <p><?php _e('Please note that this plugins requires <a href="https://getbootstrap.com/">Bootstrap 4</a> and <a href="https://daneden.github.io/animate.css/">Animate.css</a> to work properly. The plugin include these libraries disabled by default because your Theme may have them already. If not, you can enable them from the plugin options below.', 'wordflex') ?></p>
            <hr class="my-2">
            <h2 class="inside-heading p-0"><?php _e('Features', 'wordflex') ?></h2>
            <ul class="wf-list">
                <li><?php _e( ' - Fully Responsive', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Built With Bootstrap 4.', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Option to customize your content animation', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Option to enable / disable button navigation, arrow navigation', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Option to add overlay color.', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Add multiple carousels in your posts/pages and as many as you need.', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Easy to use with simple user interface.', 'wordflex-carousel' ) ?></li>
                <li><?php _e( ' - Browsers support: Chrome v65, Firefox v59, Safari v11, Edge v15, Opera v50, Chrome Android and Safari on iOs.', 'wordflex-carousel' ) ?></li>
            </ul>
        </div>
        <!-- End carousel main content -->
        <!-- Start carousel side content -->
        <aside class="wf-side">
            <div class="sidebar-element">
                <span class="dashicons dashicons-admin-home"></span>
                <a class="no-underline" target="_blank" title="Plugin Homepage" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-carousel' ); ?>"><?php _e('Plugin Homepage', 'wordflex-carousel');?></a>
            </div>
            <div class="sidebar-element">
                <span class="dashicons dashicons-flag"></span>
                <a class="no-underline" target="_blank" title="Issue tracker" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-carousel/issues' ); ?>"><?php _e('Report issue', 'wordflex-carousel');?></a>
            </div>
            <div class="sidebar-element">
                <span class="dashicons dashicons-heart"></span>
                <span><?php _e('Credits:', 'wordflex-carousel') ?></span>
                <a class="no-underline" target="_blank" title="Jarallax" href="<?php echo esc_url('http://getbootstrap.com/') ?>"><?php _e('Bootstrap, ') ?> </a></li>
                <a class="no-underline" target="_blank" title="CMB2" href="<?php echo esc_url('https://github.com/CMB2/CMB2') ?>"><?php echo esc_html('CMB2') ?></a>
            </div>
            <hr>
            <div class="sidebar-element">
                <?php _e( 'If you like to support me please consider a <a href="' . esc_url( 'https://www.paypal.me/awran5' ) . '">' . esc_html( 'Donation' ) . '</a> to help me cover the costs and keep non-profit work.', 'wordflex-carousel') ?>
            </div>
            <hr>
            <div class="sidebar-element">
                &copy; <?php echo date('Y'); ?><a class="no-underline" target="_blank" href="<?php echo esc_url( 'https://github.com/awran5/' ); ?>" title="Awran5" target="_blank"><?php echo esc_html(' Awran5') ?></a>
            </div>
        </aside>
        <!-- End carousel side content -->
    </div>
    <?php
}
add_action( 'cmb2_before_form', 'WordFlex_Carousel_admin_page', 10, 4 );


/**
 * Register admin Meta boxes callback
 */
function WordFlex_Carousel_admin_metabox() {
    add_meta_box( 
        'wc_admin_main', 
        __('How to use?', 'wordflex-carousel' ), 
        'WordFlex_Carousel_main_display', 
        'wordflex-carousel', 
        'normal', 
        'high' 
    );
    add_meta_box( 
        'wc_admin_side', 
        __( 'Need help?', 'wordflex-carousel' ), 
        'WordFlex_Carousel_author_display', 
        'wordflex-carousel', 
        'side', 
        'high' 
    );
}

/**
 * Main admin area
 */
function WordFlex_Carousel_main_display() { 
    ?>
    <!-- Start carousel content -->
    <div class="wf-main">
        <p><?php _e('To display the WordFlex Carousel, simply fill this form below and add the following shortcode to your post/page.', 'wordflex-carousel') ?>
        </p>
        <div class="copy-to-clipboard">
            <input class="shortcode-input" type="text" value='[wordflex-carousel id="<?php echo get_the_ID() ?>"]' readonly>
            <span class="copy"><a href="#" class="copy"><?php _e( 'Copy', 'wordflex-carousel' ); ?></a></span>
            <span class="copied"><?php _e( 'Copied!', 'wordflex-carousel' ); ?></span>
        </div>
        <p><?php _e('Please note that this shortcode will always refers to this page and the parameter ID - which is dynamically generated - is refers to this page ID, and so, you can create as many pages as you need with your desired settings and save them for later edit/use.', 'wordflex-carousel') ?></p>
        <p><?php _e('For more info, see the plugin <a href="' . admin_url() . 'edit.php?post_type=wordflex-carousel&page=wordflex_carousel_options' . '">option page</a>', 'wordflex-carousel') ?></p>
    </div>
    <!-- End carousel content -->
    <?php
}

/**
 * Side admin area
 */
function WordFlex_Carousel_author_display() {
    ?>
    <!-- Start carousel sidebar -->
    <aside class="wf-side">
        <div class="sidebar-element">
            <span class="dashicons dashicons-admin-home"></span>
            <a class="no-underline" target="_blank" title="Plugin Homepage" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-carousel' ); ?>"><?php _e('Plugin Homepage', 'wordflex-carousel');?></a>
        </div>
        <div class="sidebar-element">
            <span class="dashicons dashicons-flag"></span>
            <a class="no-underline" target="_blank" title="Issue tracker" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-carousel/issues' ); ?>"><?php _e('Report issue', 'wordflex-carousel');?></a>
        </div>
        <div class="sidebar-element">
            <span class="dashicons dashicons-heart"></span>
            <span><?php _e('Credits:', 'wordflex-carousel') ?></span>
            <a class="no-underline" target="_blank" title="Jarallax" href="<?php echo esc_url('http://getbootstrap.com/') ?>"><?php _e('Bootstrap, ') ?> </a></li>
            <a class="no-underline" target="_blank" title="CMB2" href="<?php echo esc_url('https://github.com/CMB2/CMB2') ?>"><?php echo esc_html('CMB2') ?></a>
        </div>
        <hr>
        <div class="sidebar-element">
            <?php _e( 'If like to Support me Please consider a <a href="' . esc_url( 'https://www.paypal.me/awran5' ) . '">' . esc_html( 'Donation' ) . '</a> to help me cover the costs and keep non-profit work.', 'wordflex-carousel') ?>
        </div>
        <hr>
        <div class="sidebar-element">
            &copy; <?php echo date('Y'); ?><a class="no-underline" target="_blank" href="<?php echo esc_url( 'https://github.com/awran5/' ); ?>" title="Awran5" target="_blank"><?php echo esc_html(' Awran5') ?></a>
        </div>
    </aside>

    <!-- End carousel sidebar -->
    <?php 
}