<?php

/**
 * HTML template part.
 *
 * Author box image markup.
 *
 * @author     Amitzy
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/public/views/parts
 * @since      1.2.17
 * @version    1.3.5
 */
?>

<?php if ( $author['img'] ) : ?>
	<div class="molongui-author-box-item molongui-author-box-image">
		<?php if ( is_premium() and !empty( $author['url'] ) ) echo '<a href="' . esc_url( $author['url'] ) .'" itemprop="url">'; ?>
		<?php echo $author['img']; ?>
		<?php if ( is_premium() and !empty( $author['url'] ) ) echo '</a>'; ?>
	</div>
<?php endif; ?>