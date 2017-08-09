<?php

namespace Molongui\Authorship\Includes;

/**
 * The Class used to add custom fields to a Wordpress User Profile.
 *
 * @author     Amitzy
 * @category   Plugin
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/Includes
 * @since      1.0.0
 * @version    1.3.5
 */
class Custom_Profile
{
	/**
	 * Hook into the appropriate actions when the class is constructed.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	public function __construct()
	{

	}


	/**
	 * Adds an "id" column to the list shown on the "All users" screen.
	 *
	 * @see     https://rudrastyh.com/wordpress/get-user-id.html
	 *
	 * @access  public
	 * @param   array      $columns    An array of column name => label.
	 * @return  array      $columns    Modified array of column name => label.
	 * @since   1.3.2
	 * @version 1.3.2
	 */
	public function add_id_column( $columns )
	{
		return array_merge( $columns,
		                    array( 'user_id' => __( 'ID', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                   )
		);
	}

	/**
	 * Fills out custom "id" column added to the "All users" screen.
	 *
	 * @see     https://rudrastyh.com/wordpress/get-user-id.html
	 *
	 * @access  public
	 * @param   string  $value
	 * @param   array   $column     An array of column name => label.
	 * @param   int     $ID         Post ID.
	 * @return  string  $value
	 * @since   1.3.2
	 * @version 1.3.2
	 */
	public function fill_id_column( $value, $column, $ID )
	{
		if ( $column == 'user_id' ) return $ID;

		return $value;
	}

	/**
	 * Add author box fields form to a user profile.
	 *
	 * @param   array      $user    The Wordpress User.
	 * @return  mixed
	 * @access  public
	 * @since   1.0.0
	 * @version 1.3.5
	 */
	public function add_authorship_fields( $user )
	{
	//	if( !current_user_can( 'upload_files' ) ) return false;
		if ( !current_user_can( 'edit_user', $user->ID) ) return false;

		// Get plugin config settings.
		$settings = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );

		// Get stored data.
		$id       = get_the_author_meta( 'molongui_author_image_id',   $user->ID );
		$url      = get_the_author_meta( 'molongui_author_image_url',  $user->ID );
		$edit_url = get_the_author_meta( 'molongui_author_image_edit', $user->ID );

        // Load available social networks.
        $social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );

		?>

		<div id="molongui-author-box-container">

			<h3><?php _e( 'Molongui Authorship', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></h3>

			<table class="form-table">

				<?php if( current_user_can( 'upload_files' ) ) :

					if( !$id ) $btn_text = __( 'Upload New Image', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN );
					else $btn_text = __( 'Change Current Image', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN );

					// Enqueue the WordPress Media Uploader.
					wp_enqueue_media();
				?>
					<tr>
						<th><label for="molongui_author_image"><?php _e( 'Profile image', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
						<td>
							<!-- Outputs the image after save -->
							<div id="current_img">
								<?php if( $url ): ?>
								<img src="<?php echo esc_url( $url ); ?>" class="molongui_current_img">
								<div class="edit_options uploaded">
									<a class="remove_img"><span><?php _e( 'Remove', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></span></a>
									<a href="<?php echo $edit_url; ?>" class="edit_img" target="_blank"><span><?php _e( 'Edit', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></span></a>
								</div>
								<?php else : ?>
									<img src="<?php echo plugins_url( 'admin/img/placeholder.gif' ); ?>" class="molongui_current_img placeholder">
								<?php endif; ?>
							</div>

							<!-- Hold the value here of WPMU image -->
							<div id="molongui_image_upload">
								<input type="hidden" name="molongui_placeholder_meta" id="molongui_placeholder_meta" value="<?php echo plugins_url( 'custom-user-profile-photo/img/placeholder.gif' ); ?>" class="hidden" />
								<input type="hidden" name="molongui_author_image_id" id="molongui_author_image_id" value="<?php echo $id; ?>" class="hidden" />
								<input type="hidden" name="molongui_author_image_url" id="molongui_author_image_url" value="<?php echo esc_url_raw( $url ); ?>" class="hidden" />
								<input type="hidden" name="molongui_author_image_edit" id="molongui_author_image_edit" value="<?php echo $edit_url; ?>" class="hidden" />
								<input type='button' class="molongui_wpmu_button button-primary" value="<?php _e( $btn_text, MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?>" id="uploadimage"/><br />
							</div>
						</td>
					</tr>
				<?php else : ?>
					<tr>
						<th><label for="molongui_author_image"><?php _e( 'Profile image', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
						<td>
							<?php if( $url ): ?>
								<img src="<?php echo esc_url( $url ); ?>" class="molongui_current_img">
							<?php else : ?>
								<img src="<?php echo plugins_url( 'admin/img/placeholder.gif' ); ?>" class="molongui_current_img placeholder">
							<?php endif; ?>
							<div>
								<p class="description"><?php _e( 'You do not have permission to upload a profile picture. Please, contact the administrator of this site.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></p>
							</div>
						</td>
					</tr>
				<?php endif; ?>

				<tr>
					<th><label for="molongui_author_link"><?php _e( 'Profile link', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><input type="text" name="molongui_author_link" id="" value="<?php echo esc_attr( get_the_author_meta( 'molongui_author_link', $user->ID ) ); ?>" class="regular-text" placeholder="//www.example.com" /></td>
				</tr>

				<tr>
					<th><label for="molongui_author_job"><?php _e( 'Job title', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><input type="text" name="molongui_author_job" id="molongui_author_job" value="<?php echo esc_attr( get_the_author_meta( 'molongui_author_job', $user->ID ) ); ?>" class="regular-text" /></td>
				</tr>

				<tr>
					<th><label for="molongui_author_company"><?php _e( 'Company', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><input type="text" name="molongui_author_company" id="molongui_author_company" value="<?php echo esc_attr( get_the_author_meta( 'molongui_author_company', $user->ID ) ); ?>" class="regular-text" /></td>
				</tr>

				<tr>
					<th><label for="molongui_author_company_link"><?php _e( 'Company link', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><input type="text" name="molongui_author_company_link" id="molongui_author_company_link" value="<?php echo esc_attr( get_the_author_meta( 'molongui_author_company_link', $user->ID ) ); ?>" class="regular-text" placeholder="//www.example.com" /></td>
				</tr>

				<tr>
					<th><label for="molongui_author_show_mail"><?php _e( 'Email', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><input type="checkbox" name="molongui_author_show_mail" id="molongui_author_show_mail" value="yes" <?php echo ( get_the_author_meta( 'molongui_author_show_mail', $user->ID ) == 'yes' ? 'checked=checked' : '' ); ?>><label for="molongui_author_show_mail"><?php _e( 'Display email publicly in the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></td>
				</tr>

				<tr>
					<th><label for="molongui_author_bio"><?php _e( 'Biographical info', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></label></th>
					<td><textarea name="molongui_author_bio" id="molongui_author_bio" rows="5" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'molongui_author_bio', $user->ID ) ); ?></textarea></td>
				</tr>

                <?php
                foreach ( $social_networks as $id => $social_network )
                {
                    if ( isset( $settings['show_'.$id] ) && $settings['show_'.$id] == 1 )
                    {
                        echo '<tr>';
                            echo '<th><label for="molongui_author_'.$id.'">'.$social_networks[$id]['name'].' '.__( 'profile', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ).'</label></th>';
                            echo '<td>';
                                if ( !is_premium() and $social_network['premium'] )
                                {
                                    echo '<input disabled placeholder="'.__( 'Premium feature', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ).'" type="text" name="molongui_author_'.$id.'" id="molongui_author_'.$id.'" value="" class="regular-text" />';
							        echo '<span class="description"><span class="premium">'.__( 'Premium', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ).'</span>';
                                    printf( __( "This option is available only in the %spremium version%s of the plugin.", MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ), '<a href="' . MOLONGUI_AUTHORSHIP_WEB . '" target="_blank">', '</a>' );
                                    echo '</span>';
                                }
                                else
                                {
                                    echo '<input type="text" name="molongui_author_'.$id.'" id="molongui_author_'.$id.'" value="'.esc_attr( get_the_author_meta( 'molongui_author_'.$id, $user->ID ) ).'" class="regular-text" placeholder="'.$social_networks[$id]['url'].'" />';
                                }
                            echo '</td>';
				        echo '</tr>';
                    }
                }
                ?>
			</table><!-- end form-table -->

		</div> <!-- end #cupp_container -->

		<?php
	}


	/**
	 * Save added author box fields.
	 *
	 * @param   int     $user_id    The User ID.
	 * @return  mixed   false if no edit permissions
	 * @access  public
	 * @since   1.0.0
	 * @version 1.3.5
	 */
	function save_authorship_fields( $user_id )
	{
		if ( !current_user_can( 'edit_user', $user_id ) ) return false;

        // Load available social networks.
        $social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );

		// If current user can edit Users, save data.
		update_user_meta( $user_id, 'molongui_author_link', $_POST['molongui_author_link'] );
		update_user_meta( $user_id, 'molongui_author_job', $_POST['molongui_author_job'] );
		update_user_meta( $user_id, 'molongui_author_company', $_POST['molongui_author_company'] );
		update_user_meta( $user_id, 'molongui_author_company_link', $_POST['molongui_author_company_link'] );
		update_user_meta( $user_id, 'molongui_author_show_mail', $_POST['molongui_author_show_mail'] );
		update_user_meta( $user_id, 'molongui_author_bio', $_POST['molongui_author_bio'] );
        foreach ( $social_networks as $id => $social_network )
        {
            if ( isset( $_POST['molongui_author_'.$id] ) ) update_user_meta( $user_id, 'molongui_author_'.$id, sanitize_text_field( $_POST['molongui_author_'.$id] ) );
        }

		if ( !current_user_can( 'upload_files', $user_id ) ) return false;

		// If current user can upload files, save image data.
		update_user_meta( $user_id, 'molongui_author_image_id',   $_POST['molongui_author_image_id'] );
		update_user_meta( $user_id, 'molongui_author_image_url',  $_POST['molongui_author_image_url'] );
		update_user_meta( $user_id, 'molongui_author_image_edit', $_POST['molongui_author_image_edit'] );
	}


}