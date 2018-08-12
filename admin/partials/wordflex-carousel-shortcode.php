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

/**
 * Load Admin page Metabox arguments
 */
require_once 'wordflex-carousel-shortcode-arg.php';

/**
 * Carousel Shortcode
 */
add_shortcode( 'wordflex-carousel', function( $attr, $content = '' ) {
    
    $attr = shortcode_atts( 
        array( 
            'id' => get_the_ID()
        ), $attr );

    // Get current carousel post ID
    $id = esc_attr($attr['id']);
    $prefix  = 'cmb_';
    $entries = get_post_meta( $id, $prefix . 'carousel_group', true );
    $slides  = count((array)$entries);

    $interval = Wordflex_Carousel_Public::option( $prefix . 'carousel_interval' );  

    $slide_effect = Wordflex_Carousel_Public::option( $prefix . 'carousel_transition' );
    
    ob_start();
    ?>

    <!-- Start Bootstrap carousel -->
    <div id="bs_carousel" class="carousel slide <?php echo $slide_effect ?> mb-5" data-ride="carousel" <?php echo $interval ? 'data-interval="' . $interval . '"' : '' ?>>
        <?php if( $slides > 1 && Wordflex_Carousel_Public::option( $prefix . 'carousel_dots' ) === 'yes' ) : ?>
            <ol class="carousel-indicators d-none d-md-flex">
                <?php for($i = 0; $i < $slides; $i++) { ?>
                <li data-target="#bs_carousel" data-slide-to="<?php echo $i ?>" class="<?php echo ($i === 0) ? 'active' : '' ?>"></li>
                <?php } ?>
            </ol>
        <?php endif; ?>
        <div class="carousel-inner" role="listbox">

            <?php foreach((array)$entries as $key => $entry) :

                $img = $title = $content = $color = $text_align = $overlay = $overlay_color = $btn_txt = $btn_url = $btn_style = $btn_outline = '';
                $heading_animation = $content_animation = $btn_animation = '';


                $height = Wordflex_Carousel_Public::option( $prefix . 'carousel_height' );
                $text_align = get_post_meta( $id, $prefix . 'carousel_text_align', true );

                if ( isset( $entry[ 'carousel_img' ] ) ) 
                    $img = $entry[ 'carousel_img' ];

                if ( isset( $entry[ 'carousel_heading' ] ) )
                    $title = $entry[ 'carousel_heading' ];
                
                if ( isset( $entry[ 'carousel_content_color' ] ) )
                    $color = $entry[ 'carousel_content_color' ];
                
                if ( isset( $entry[ 'carousel_text_align' ] ) )
                    $text_align = $entry[ 'carousel_text_align' ];
                
                if ( isset( $entry[ 'carousel_overlay' ] ) )
                    $overlay = $entry[ 'carousel_overlay' ];
                
                if ( isset( $entry[ 'carousel_overlay_color' ] ) )
                    $overlay_color = $entry[ 'carousel_overlay_color' ];

                if ( isset( $entry[ 'carousel_content' ] ) )
                    $content = $entry[ 'carousel_content' ];

                if ( isset( $entry[ 'carousel_button_text' ] ) )
                    $btn_txt = $entry[ 'carousel_button_text' ];

                if ( isset( $entry[ 'carousel_button_url' ] ) )
                    $btn_url = $entry[ 'carousel_button_url' ];

                if ( isset( $entry[ 'carousel_button_style' ] ) )
                    $btn_style = $entry[ 'carousel_button_style' ];

                if ( isset( $entry[ 'carousel_button_outline' ] ) )
                    $btn_outline = $entry[ 'carousel_button_outline' ];

                if ( isset( $entry[ 'heading_animation' ] ) )
                    $heading_animation = $entry[ 'heading_animation' ];

                if ( isset( $entry[ 'content_animation' ] ) )
                    $content_animation = $entry[ 'content_animation' ];

                if ( isset( $entry[ 'btn_animation' ] ) )
                    $btn_animation = $entry[ 'btn_animation' ];

                ?>
                <!-- Start Carousel item -->
                <div class="carousel-item <?php echo $text_align ?> <?php echo ( $key === 0 ) ? 'active' : '' ?>" style="background-image: url('<?php echo $img ?>'); <?php echo ($height) ? 'height: ' . $height . 'px;' : '' ?>">
                
                <?php if($overlay === 'yes') 

                echo '<div class="carousel-overlay" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background:' . $overlay_color . '"></div>';
                ?>
                
                    <div class="container">
                        <div class="carousel-content" <?php echo ($color) ? 'style="color:' . $color . '"': '' ?>>

                            <?php 
                            $headerAnimation = ($heading_animation) ? 'data-animation="animated ' . $heading_animation . '"' : '';
                            $contentAnimation = ($content_animation) ? 'data-animation="animated ' . $content_animation . '"' : '';
                            $btnAnimation = ($btn_animation) ? 'data-animation="animated ' . $btn_animation . '"' : '';

                            if( !empty( $title ) ) echo '<h1 class="display-3 carousel-heading" ' . $headerAnimation . '>' . $title . '</h1>';
                            if( !empty( $content ) ) echo '<p class="lead carousel-text" ' . $contentAnimation . '>' . $content . '</p>'; 
                            
                            $button_style = ($btn_style) ? 'btn-' . $btn_style . '' : '';

                            if(!empty( $btn_outline ) ) $button_style = 'btn-' . $btn_outline . '-' . $btn_style . '';
                            if(!empty( $btn_txt ) ) echo '<p class="carousel-btn"><a class="btn btn-lg ' . $button_style . ' carousel-btn" href="' . $btn_url . '" role="button" ' . $btnAnimation . '>' . $btn_txt . '</a></p>';  
                            ?>

                        </div>
                    </div>
                </div> 
                <!-- End Carousel item -->
            <?php endforeach; ?> 
        </div>
        <!-- carousel-inner -->
        <?php if( $slides > 1  && Wordflex_Carousel_Public::option( $prefix . 'carousel_arrow' ) === 'yes' ) : ?>
            <a class="carousel-control-prev" href="#bs_carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_html__('Previous', 'wordflex') ?></span>
            </a>
            <a class="carousel-control-next" href="#bs_carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_html__('Next', 'wordflex') ?></span>
            </a>
        <?php endif; ?>
    </div>
    <!-- End Bootstrap carousel -->
    <?php
    return ob_get_clean();
});