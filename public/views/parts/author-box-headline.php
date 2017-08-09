<?php

/**
 * HTML template part.
 *
 * Author box headline markup.
 *
 * @author     Amitzy
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/public/views/parts
 * @since      1.3.5
 * @version    1.3.5
 */
?>

<?php if ( isset( $settings['show_headline'] ) and !empty( $settings['show_headline'] ) and $settings['show_headline'] == 1  ) : ?>
<div class="molongui-author-box-item molongui-author-box-headline">
    <h3 class="text-size-<?php echo $settings['headline_size']; ?> text-align-<?php echo $settings['headline_align']; ?> text-style-<?php echo $settings['headline_style']; ?>" style="color: <?php echo $settings['headline_color']; ?>">
        <?php echo ( $settings['headline'] ? $settings['headline'] : __( 'About the author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ); ?>
    </h3>
</div>
<?php endif; ?>