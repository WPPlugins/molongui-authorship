<?php

/**
 * Provide a public-facing view for the plugin.
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @author     Amitzy
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/public/views
 * @since      1.0.0
 * @version    1.3.5
 */
?>

<!-- MOLONGUI AUTHORSHIP PLUGIN <?php echo MOLONGUI_AUTHORSHIP_VERSION ?> -->
<!-- <?php echo "https:" . MOLONGUI_AUTHORSHIP_WEB ?> -->
<div id="mab-<?php echo $random_id; ?>"
     class="molongui-author-box"
     data-author-type="<?php echo $author['type']; ?>"
     itemscope itemtype="https://schema.org/Person"
     style="<?php echo ( ( isset( $settings['box_width'] ) and !empty( $settings['box_width'] ) ) ? 'width: ' . $settings['box_width'] . '%;' : '' );?>
            <?php echo ( ( isset( $settings['box_margin'] ) and !empty( $settings['box_margin'] ) ) ? 'margin: ' . $settings['box_margin'] . 'px auto;' : '' );?>">

    <div class="molongui-author-box-container
	            mabc-shadow-<?php echo ( ( isset( $settings['box_shadow'] ) and !empty( $settings['box_shadow'] ) ) ? $settings['box_shadow'] : 'left' );?>
				mabc-border-<?php echo ( ( isset( $settings['box_border'] ) and !empty( $settings['box_border'] ) ) ? $settings['box_border'] : 'none' );?>
				mabc-bckg-<?php echo ( ( isset( $settings['box_background'] ) and !empty( $settings['box_background'] ) ) ? 'coloured' : 'none' );?>"
         style="<?php echo ( ( isset( $settings['box_border_color'] ) and !empty( $settings['box_border_color'] ) ) ? 'border-color: ' . $settings['box_border_color'] . ';' : '' );?>
         <?php echo ( ( isset( $settings['box_background'] ) and !empty( $settings['box_background'] ) ) ? 'background-color: ' . $settings['box_background'] . ';' : '' );?>">

        <!-- Author headline -->
        <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-headline.php' ); ?>

        <!-- Author picture -->
        <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-image.php' ); ?>

        <!-- Author social -->
        <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-socialmedia.php' ); ?>

        <!-- Author data -->
        <div class="molongui-author-box-item molongui-author-box-data">

            <!-- Author name -->
            <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-title.php' ); ?>

            <!-- Author metadata -->
            <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-meta.php' ); ?>

            <!-- Author bio -->
            <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-bio.php' ); ?>

            <!-- Author related posts -->
            <?php include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/parts/author-box-related.php' ); ?>

        </div><!-- End of .molongui-author-box-data -->

    </div><!-- End of .molongui-author-box-container -->

</div><!-- End of .molongui-author-box -->