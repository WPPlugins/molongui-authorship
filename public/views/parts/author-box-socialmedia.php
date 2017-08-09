<?php

/**
 * HTML template part.
 *
 * Author box social media icons markup.
 *
 * @author     Amitzy
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/public/views/parts
 * @since      1.2.17
 * @version    1.3.5
 */

// Load available social networks.
$social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );
$continue        = false;

// Check there is any social network to show.
foreach ( $social_networks as $id => $social_network )
{
    if ( isset( $author[$id] ) and !empty( $author[$id] ) )
    {
        $continue = true;
        break; // There is at least one social network to show, no need to keep looking.
    }
}

if ( ( isset( $settings['show_icons'] ) and !empty( $settings['show_icons'] ) and $settings['show_icons'] == 1 ) and $continue )
{
	// Get social icon style.
	if ( isset( $settings['icons_style'] ) )
	{
		$ico_style = $settings['icons_style']; if ( $ico_style && $ico_style != 'default' ) $ico_style = '-' . $ico_style; elseif ( $ico_style == 'default' ) $ico_style = '';
	}

	// Get social icon size.
	if ( isset( $settings['icons_size'] ) ) $ico_size = $settings['icons_size'];
	else $ico_size = 'normal';

	// Get social icon color.
	$ico_color = '';
	if ( isset( $settings['icons_color'] ) && $settings['icons_color'] != 'inherit' )
	{
		switch ( $settings['icons_style'] )
		{
			case 'squared':
			case 'circled':

				$ico_color = 'border-color: ' . $settings['icons_color'] . '; background-color: ' . $settings['icons_color'] . ';';

			break;

			case 'boxed':

				$ico_color = 'border-color: ' . $settings['icons_color'] . '; color: ' . $settings['icons_color'] . ';';

			break;

			case 'branded':
			case 'branded-squared-reverse':
			case 'branded-circled-reverse':
			case 'branded-boxed':

				$ico_color = '';    // do nothing

			break;

			case 'branded-squared':
			case 'branded-circled':

				$ico_color = 'background-color: ' . $settings['icons_color'];

			break;

			case 'default':
			default:

				$ico_color = 'color: ' . $settings['icons_color'] . ';';

			break;
		}
	}

    // Show social network icon.
	echo '<div class="molongui-author-box-item molongui-author-box-social">';
        foreach ( $social_networks as $id => $social_network )
        {
           if ( isset( $author[$id] ) and !empty( $author[$id] ) ) echo '<div class="molongui-author-box-social-icon"><a href="'.esc_url( $author[$id] ).'" class="icon-container'.$ico_style.' icon-container-'.$id.' text-size-'.$ico_size.'" style="'.$ico_color.'" target="_blank"><i class="molongui-authorship-icon-'.$id.'"></i></a></div>';
        }
    echo '</div>';
}