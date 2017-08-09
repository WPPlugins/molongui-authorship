<?php

namespace Molongui\Authorship\Includes;

use WP_Query; /* https://roots.io/upping-php-requirements-in-your-wordpress-themes-and-plugins/ */

/**
 * The Guest Author Class.
 *
 * @author     Amitzy
 * @category   Plugin
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/admin/classes
 * @since      1.0.0
 * @version    1.3.5
 */
class Guest_Author
{
	/**
	 * Hook into the appropriate actions when the class is constructed.
	 *
	 * @access   public
	 * @since    1.0.0
	 * @version  1.2.17
	 */
	public function __construct()
	{

	}


	/**
	 * Add columns to the list shown on the Manage {molongui_guestauthor} Posts screen.
	 *
	 * @see      https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$post_type_posts_columns
	 *
	 * @param    array      $columns    An array of column name => label.
	 * @return   array      $columns    Modified array of column name => label.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.2
	 */
	public function add_list_columns( $columns )
	{
		// Unset some default columns to display them in a different position
		unset( $columns['title'] );
		unset( $columns['date'] );
		unset( $columns['thumbnail'] );

		return array_merge($columns,
		                   array('guestAuthorPic'  => __( 'Photo', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'title'		   => __( 'Name', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'guestAuthorJob'  => __( 'Job position', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'guestAuthorCia'  => __( 'Company', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'guestAuthorMail' => __( 'e-mail', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'guestAuthorUrl'  => __( 'Url', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                         'date'            => __( 'Date' ),
		                         'guestAuthorId'   => __( 'ID', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		                   )
		);
	}


	/**
	 * Fill out custom author column shown on the Manage Posts/Pages screen.
	 *
	 * @see      https://codex.wordpress.org/Plugin_API/Action_Reference/manage_$post_type_posts_custom_column
	 *
	 * @param    array      $column     An array of column name => label.
	 * @param    int        $ID         Post ID.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.2
	 */
	public function fill_list_columns( $column, $ID )
	{
		if ( $column == 'guestAuthorId' )   echo $ID;
		if ( $column == 'guestAuthorPic' )  echo get_the_post_thumbnail( $ID, array( 60, 60) );
		if ( $column == 'guestAuthorJob' )  echo get_post_meta( $ID, '_molongui_guest_author_job', true );
		if ( $column == 'guestAuthorCia' )  echo get_post_meta( $ID, '_molongui_guest_author_company', true );
		if ( $column == 'guestAuthorMail' ) echo get_post_meta( $ID, '_molongui_guest_author_mail', true );
		if ( $column == 'guestAuthorUrl' )  echo '<a href="' . get_post_meta( $ID, '_molongui_guest_author_link', true ) . '">' . get_post_meta( $ID, '_molongui_guest_author_link', true ) . '</a>';
	}


	/**
	 * Register "Guest Author" custom post-type.
	 *
	 * This functions registers a new post-type called "molongui_guestauthor".
	 * This post-type holds guest authors specific data.
	 *
	 * CPT menu item is placed as per user preference. Default is as a new top level menu.
	 *
	 * @see      https://codex.wordpress.org/Function_Reference/register_post_type
	 *           https://tommcfarlin.com/add-custom-post-type-to-menu/
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.0
	 */
	public function register_guest_author_posttype()
	{
		// Get plugin settings
		$settings = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );

		$labels = array(
			'name'					=> _x( 'Guest authors', 'post type general name', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'singular_name'			=> _x( 'Guest author', 'post type singular name', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'menu_name'				=> __( 'Guest authors', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'name_admin_bar'		=> __( 'Guest authors', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'all_items'				=> __( 'All Guest authors', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'add_new'				=> _x( 'Add New', 'molongui_guestauthor', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'add_new_item'			=> __( 'Add New Guest author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'edit_item'				=> __( 'Edit Guest author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'new_item'				=> __( 'New Guest author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'view_item'				=> __( 'View Guest author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'search_items'			=> __( 'Search Guest authors', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'not_found'				=> __( 'No guest authors found', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'not_found_in_trash'	=> __( 'No guest authors found in the Trash', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
			'parent_item_colon'		=> '',
		);

		$args = array(
			'labels'				=> $labels,
			'description'			=> 'Holds our guest author and guest authors specific data',
			'public'				=> true,
			'exclude_from_search'	=> false,
			'publicly_queryable'	=> false,
			'show_ui'				=> true,
			'show_in_nav_menus'		=> true,
			'show_in_menu'          => ( ( isset( $settings['admin_menu_level'] ) and $settings['admin_menu_level'] != 'true' ) ? $settings['admin_menu_level'] : true ),
			'show_in_admin_bar '	=> true,
			'menu_position'			=> 5, // 5 = Below posts
			'menu_icon'				=> 'dashicons-id',
			'supports'		 		=> array( 'title', 'editor', 'thumbnail' ),
			'register_meta_box_cb'	=> '',
			'has_archive'			=> true,
			'rewrite'				=> array('slug' => 'guest-author'),
		);

		register_post_type( 'molongui_guestauthor', $args );

		// DEBUG: Uncomment below lines to debug on deployment
		// print_r( register_post_type( 'molongui_guest_author', $args ) ); exit;
	}


	/**
	 * Change title placeholder for "guest author" custom post-type.
	 *
	 * @access   public
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function change_default_title( $title )
	{
		global $current_screen;

		if ( 'molongui_guestauthor' == $current_screen->post_type ) $title = __( 'Enter guest author name here', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN );

		return $title;
	}


	/**
	 * Remove media buttons from "guest author" custom post-type.
	 *
	 * @access   public
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function remove_media_buttons()
	{
		global $current_screen;

		if( 'molongui_guestauthor' == $current_screen->post_type ) remove_action( 'media_buttons', 'media_buttons' );
	}


	/**
	 * Modify author column shown on the Manage Posts/Pages screen.
	 *
	 * @see      https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns
	 * @see      https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_pages_columns
	 *
	 * @param    array      $columns    An array of column name => label.
	 * @return   array      $columns    Modified array of column name => label.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function change_author_column( $columns )
	{
		global $post;

		$post_type  = get_post_type( $post );
		$post_types = array( 'post', 'page' );

		// Modify author column only at Manage Posts screen
		if ( in_array( $post_type, $post_types ))
		{
			// Remove default author column from the columns list
			unset( $columns['author'] );

			// Add new author column in the same place where default was (after title)
			$new_columns = array();
			foreach ( $columns as $key => $column )
			{
				$new_columns[$key] = $column;
				if ( $key == 'title' ) $new_columns['realAuthor'] = __( 'Author' );
			}

			return $new_columns;
		}
		else
		{
			return $columns;
		}
	}


	/**
	 * Fill out custom author column shown on the Manage Posts/Pages screen.
	 *
	 * @see      https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
	 *
	 * @param    string     $column     Column name.
	 * @param    int        $ID         Post ID.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.0
	 */
	function fill_author_column( $column, $ID )
	{
		if ( $column == 'realAuthor' )
		{
			// Get Guest Author ID if one is set
			$guest = get_post_meta( $ID, '_molongui_guest_author', true );
			if ( isset( $guest ) && $guest == 1 )
			{
				$author_id = get_post_meta( $ID, '_molongui_guest_author_id', true );
				echo '<a href="' . admin_url() . 'post.php?post=' . $author_id . '&action=edit">' . get_the_title( $author_id ) . '</a>';
			}
			// If it is not guest author, get the registered author
			else
			{
				$post = get_post( $ID );
				echo '<a href="' . admin_url() . 'user-edit.php?user_id=' . $post->post_author . '">' . get_the_author() . '</a>';
			}
		}
	}


	/**
	 * Remove default "Author" meta box.
	 *
	 * Removes the "Author" meta box from post's and page's edit page.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @version 1.2.2
	 */
	public function remove_author_metabox()
	{
		remove_meta_box('authordiv', 'post', 'normal');
		remove_meta_box('authordiv', 'page', 'normal');
	}


	/**
	 * Adds the meta box container.
	 *
	 * @see     https://codex.wordpress.org/Function_Reference/add_meta_box
	 * @access  public
	 * @since   1.0.0
	 * @version 1.2.4
	 */
	public function add_meta_boxes( $post_type )
	{
		// Limit meta box to certain post types
		$post_types = array('post', 'page');

		// Add author meta box to "post" and "page" post-types
		if ( in_array( $post_type, $post_types ))
		{
			add_meta_box(
				'authorboxdiv'
				,__( 'Author' )
				,array( $this, 'render_author_meta_box_content' )
				,$post_type
				,'side'
				,'high'
			);

			// Add selector to choose whether to show authorship box or not
			add_meta_box(
				'showboxdiv'
				,__( 'Authorship box' )
				,array( $this, 'render_showbox_meta_box_content' )
				,$post_type
				,'side'
				,'high'
			);
		}

		// Add custom meta boxes to "Guest Author" custom post-type
		if ( in_array( $post_type, array('molongui_guestauthor') ))
		{
			// Add job profile meta box
			add_meta_box(
				'authorjobdiv'
				,__( 'Job profile', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN )
				,array( $this, 'render_job_meta_box_content' )
				,$post_type
				,'side'
				,'core'
			);

			// Add social media meta box
			add_meta_box(
				'authorsocialdiv'
				,__( 'Social Media', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN )
				,array( $this, 'render_social_meta_box_content' )
				,$post_type
				,'normal'
				,'high'
			);
		}
	}


	/**
	 * Render Author Meta Box content.
	 *
	 * @param    WP_Post    $post  The post object.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.4
	 */
	public function render_author_meta_box_content( $post )
	{
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'molongui_authorship', 'molongui_authorship_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$guest = get_post_meta( $post->ID, '_molongui_guest_author', true );

		// Add some js.
		?><script type="text/javascript">
			function showAuthorContent()
			{
				// Get DOM elements.
				var radios     = document.getElementsByName("guest-author");
				var registered = document.getElementById("registered_author_data");
				var guest      = document.getElementById("guest_author_data");

				// Show content based on selection.
				if ( radios[0].checked )
				{
					registered.style.display = 'block';
					registered.className     = "";
					guest.style.display      = 'none';
				}
				if ( radios[1].checked )
				{
					registered.style.display = 'none';
					guest.style.display      = 'block';
					guest.className          = "";
				}
			}
		</script><?php

		// Display the form, loading stored values if available.
		?>
		<div class="molongui-metabox">
			<p class="molongui-description"><?php _e( 'As author, you can choose between a registered user and a guest author:', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></p>
			<div class="molongui-field">
				<label for="registered-author">
					<input type="radio" name="guest-author" id="registered-author" value="0" onclick="showAuthorContent()" <?php if ( $guest != 1 ) echo 'checked'; ?>>
					<span class="registered-author"><?php _e( 'Registered author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></span>
				</label>
			</div>
			<div class="molongui-field">
				<label for="guest-author">
					<input type="radio" name="guest-author" id="guest-author" value="1" onclick="showAuthorContent()" <?php if ( $guest == 1 ) echo 'checked'; ?>>
					<span class="guest-author"><?php _e( 'Guest author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></span>
				</label>
			</div>
			<div class="molongui-field">
				<div id="registered_author_data" class="<?php echo ( $guest != 0 ? 'hidden' : '' ); ?>">
					<?php
					echo '<label class="screen-reader-text" for="post_author_override">' . __('Author') . '</label>';
					wp_dropdown_users( array(
						                   'who' => 'authors',
						                   'name' => 'post_author_override',
						                   'selected' => !empty($post->ID) ? $post->post_author : get_current_user_id(),
						                   'include_selected' => true
					                   ) );
					?>
				</div>
				<div id="guest_author_data" class="<?php echo ( $guest != 1 ? 'hidden' : '' ); ?>">
					<?php echo $this->get_guest_authors(); ?>
				</div>
			</div>
		</div>
		<?php
	}


	/**
	 * Render selector to choose to show the authorship box or not.
	 *
	 * @param    WP_Post    $post  The post object.
	 * @access   public
	 * @since    1.1.0
	 * @version  1.3.4
	 */
	public function render_showbox_meta_box_content( $post )
	{
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'molongui_authorship', 'molongui_authorship_nonce' );

		// Get plugin options.
		$settings = get_option( MOLONGUI_AUTHORSHIP_BOX_SETTINGS );

		// Get current screen.
		$screen = get_current_screen();

		// Use get_post_meta to retrieve an existing value from the database.
		$author_box_display = get_post_meta( $post->ID, '_molongui_author_box_display', true );

		// If no existing value, set default as global configuration defines.
		if ( empty( $author_box_display ) )
		{
			switch( $settings['display'] )
			{
				case '0':

					$author_box_display = 'hide';

				break;

				case '1':

					$author_box_display = 'show';

				break;

				case 'posts':

					if ( $screen->post_type == 'post' ) $author_box_display = 'show';
					else $author_box_display = 'hide';

				break;

				case 'pages':

					if ( $screen->post_type == 'page' ) $author_box_display = 'show';
					else $author_box_display = 'hide';

				break;
			}
		}

		// Display the form, loading stored values if available.
		?>
		<div class="molongui-metabox">
			<p class="molongui-description"><?php _e( 'Show the authorship box for this post?', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></p>
			<div class="molongui-field">
				<select name="_molongui_author_box_display">
					<option value="show" <?php selected( $author_box_display, 'show' ); ?>><?php _e( 'Show', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></option>
					<option value="hide" <?php selected( $author_box_display, 'hide' ); ?>><?php _e( 'Hide', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></option>
				</select>
			</div>
		</div>
		<?php
	}


	/**
	 * Render job profile meta box content.
	 *
	 * @param    WP_Post    $post  The post object.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.0
	 */
	public function render_job_meta_box_content( $post )
	{
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'molongui_authorship', 'molongui_authorship_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$guest_author_mail         = get_post_meta( $post->ID, '_molongui_guest_author_mail', true );
		$guest_author_show_mail    = get_post_meta( $post->ID, '_molongui_guest_author_show_mail', true );
		$guest_author_link         = get_post_meta( $post->ID, '_molongui_guest_author_link', true );
		$guest_author_job          = get_post_meta( $post->ID, '_molongui_guest_author_job', true );
		$guest_author_company      = get_post_meta( $post->ID, '_molongui_guest_author_company', true );
		$guest_author_company_link = get_post_meta( $post->ID, '_molongui_guest_author_company_link', true );

		// Display the form, loading stored values if available.
		echo '<div class="molongui-metabox">';
			//echo '<div class="molongui-note">' . __( 'Empty fields are not displayed in the front-end.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</div>';
			echo '<div class="molongui-field">';
				echo '<label class="title" for="_molongui_guest_author_link">' . __( 'Profile link', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label>';
				echo '<i class="tip molongui-authorship-icon-tip molongui-help-tip" data-tip="' . __( 'URL the author name will link to. Leave blank to disable link feature.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></i>';
				echo '<div class="input-wrap"><input type="text" placeholder="' . __( '//www.example.com/', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '" id="_molongui_guest_author_link" name="_molongui_guest_author_link" value="' . ( $guest_author_link ? $guest_author_link : '' ) . '" class="text"></div>';
			echo '</div>';
			echo '<div class="molongui-field">';
				echo '<label class="title" for="_molongui_guest_author_mail">' . __( 'Email address', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label>';
				echo '<i class="tip molongui-authorship-icon-tip molongui-help-tip" data-tip="' . __( 'Used to retrieve author\'s Gravatar if it exists. This field is not displayed in the front-end unless checkbox below is checked.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></i>';
				echo '<div class="input-wrap"><input type="text" id="_molongui_guest_author_mail" name="_molongui_guest_author_mail" value="' . ( $guest_author_mail ? $guest_author_mail : '' ) . '" class="text" placeholder="' . __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></div>';
				echo '<div class="input-wrap"><input type="checkbox" id="_molongui_guest_author_show_mail" name="_molongui_guest_author_show_mail" value="yes"' . ( $guest_author_show_mail == 'yes' ? 'checked=checked' : '' ) . '><label class="checkbox-label" for="_molongui_guest_author_show_mail">' . __( 'Display email in the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label></div>';
			echo '</div>';
			echo '<div class="molongui-field">';
				echo '<label class="title" for="_molongui_guest_author_job">' . __( 'Job title', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label>';
				echo '<i class="tip molongui-authorship-icon-tip molongui-help-tip" data-tip="' . __( 'Name used to describe what the author does for a business or another enterprise. Leave blank to prevent to display this field in the front-end.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></i>';
				echo '<div class="input-wrap"><input type="text" id="_molongui_guest_author_job" name="_molongui_guest_author_job" value="' . ( $guest_author_job ? $guest_author_job : '' ) . '" class="text" placeholder="' . __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></div>';
			echo '</div>';
			echo '<div class="molongui-field">';
				echo '<label class="title" for="_molongui_guest_author_company">' . __( 'Company', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label>';
				echo '<i class="tip molongui-authorship-icon-tip molongui-help-tip" data-tip="' . __( 'The name of the company the author works for. Leave blank to prevent to display this field in the front-end.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></i>';
				echo '<div class="input-wrap"><input type="text" id="_molongui_guest_author_company" name="_molongui_guest_author_company" value="' . ( $guest_author_company ? $guest_author_company : '' ) . '" class="text" placeholder="' . __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></div>';
			echo '</div>';
			echo '<div class="molongui-field">';
				echo '<label class="title" for="_molongui_guest_author_company_link">' . __( 'Company link', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '</label>';
				echo '<i class="tip molongui-authorship-icon-tip molongui-help-tip" data-tip="' . __( 'URL the company name will link to. Leave blank to disable link feature.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></i>';
				echo '<div class="input-wrap"><input type="text" id="_molongui_guest_author_company_link" name="_molongui_guest_author_company_link" value="' . ( $guest_author_company_link ? $guest_author_company_link : '' ) . '" class="text" placeholder="' . __( '//www.example.com/', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '"></div>';
			echo '</div>';
		echo '</div>';
	}


	/**
	 * Render social media meta box content.
	 *
	 * @param    WP_Post    $post  The post object.
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.5
	 */
	public function render_social_meta_box_content( $post )
	{
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'molongui_authorship', 'molongui_authorship_nonce' );

		// Get plugin config settings.
		$main_settings   = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );
		$box_settings    = get_option( MOLONGUI_AUTHORSHIP_BOX_SETTINGS );
		$string_settings = get_option( MOLONGUI_AUTHORSHIP_STRING_SETTINGS );
		$settings        = array_merge( $main_settings, $box_settings, $string_settings );
        $social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );

        // Display the form, loading stored values if available.
        echo '<div class="molongui molongui-metabox">';

            foreach ( $social_networks as $id => $social_network )
            {
                $social_networks[$id]['value'] = get_post_meta( $post->ID, '_molongui_guest_author_'.$id, true );

                if ( isset( $settings['show_'.$id] ) && $settings['show_'.$id] == 1 )
                {
                    echo '<div class="molongui-field">';
                        echo '<label class="title" for="_molongui_guest_author_'.$id.'">' . $social_networks[$id]['name'];
                            if ( !is_premium() and $social_network['premium'] ) echo '<a href="' . MOLONGUI_AUTHORSHIP_WEB . '" target="_blank">' . '<i class="molongui-authorship-icon-star molongui-help-tip molongui-premium-setting" data-tip="' . $this->premium_option_tip() . '"></i>' . '</a>';
                        echo '</label>';
                        if ( !is_premium() and $social_network['premium'] )
                        {
                            echo '<div class="input-wrap"><input type="text" disabled placeholder="' . __( 'Premium feature', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) . '" id="_molongui_guest_author_'.$id.'" name="_molongui_guest_author_'.$id.'" value="" class="text"></div>';
                        }
                        else
                        {
                            echo '<div class="input-wrap"><input type="text" placeholder="' . $social_networks[$id]['url'] . '" id="_molongui_guest_author_'.$id.'" name="_molongui_guest_author_'.$id.'" value="' . ( $social_networks[$id]['value'] ? $social_networks[$id]['value'] : '' ) . '" class="text"></div>';
                        }
                    echo '</div>';
                }
            }

        echo '</div>';
	}


	/**
	 *
	 */
	public function premium_option_tip()
	{
		return sprintf( __( '%sPremium feature%s. You are using the free version of this plugin. Consider purchasing the Premium Version to enable this feature.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ), '<strong>', '</strong>' );
	}


	/**
	 * Get a list of guest authors.
	 *
	 * @see     https://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
	 *
	 * @param   boolean         $dropdown   Whether to get an object or an html dropdown list.
	 * @return  object or html
	 * @access  private
	 * @since   1.0.0
	 * @version 1.3.0
	 */
	public function get_guest_authors( $dropdown = true )
	{
		// Get post
		global $post;

		// Query guest authors
		$args   = array( 'post_type' => 'molongui_guestauthor', 'posts_per_page' => -1 );
		$guests = new WP_Query( $args );

		// Check output format
		if ( !$dropdown ) return $guests;

		// Get current post guest author (if any)
		$guest_author = get_post_meta( $post->ID, '_molongui_guest_author_id', true );

		// Mount html markup
		$output = '';
		if( $guests->have_posts() )
		{
			$output .= '<select name="_molongui_guest_author_id">';
			foreach( $guests->posts as $guest )
			{
				$output .= '<option value="' . $guest->ID . '"' . ( $guest_author == $guest->ID ? 'selected' : '' ) . '>' . $guest->post_title . '</option>';
			}
			$output .= '</select>';
		}

		return ( $output );
	}


	/**
	 * Save the meta when the post is saved.
	 *
	 * @param    int    $post_id  The ID of the post being saved.
	 * @return   void
	 * @access   public
	 * @since    1.0.0
	 * @version  1.3.5
	 */
	public function save( $post_id )
	{
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( !isset( $_POST['molongui_authorship_nonce'] ) ) return $post_id;
		$nonce = $_POST['molongui_authorship_nonce'];

		// Verify that the nonce is valid.
		if ( !wp_verify_nonce( $nonce, 'molongui_authorship' ) ) return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) return $post_id;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
		}

		// OK, its safe for us to save the data now.

		global $current_screen;
        $social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );

		if( 'molongui_guestauthor' == $current_screen->post_type )
		{
			// Update data.
			update_post_meta( $post_id, '_molongui_guest_author_mail', sanitize_text_field( $_POST['_molongui_guest_author_mail'] ) );
			update_post_meta( $post_id, '_molongui_guest_author_show_mail', sanitize_text_field( $_POST['_molongui_guest_author_show_mail'] ) );
			update_post_meta( $post_id, '_molongui_guest_author_link', sanitize_text_field( $_POST['_molongui_guest_author_link'] ) );
			update_post_meta( $post_id, '_molongui_guest_author_job', sanitize_text_field( $_POST['_molongui_guest_author_job'] ) );
			update_post_meta( $post_id, '_molongui_guest_author_company', sanitize_text_field( $_POST['_molongui_guest_author_company'] ) );
			update_post_meta( $post_id, '_molongui_guest_author_company_link', sanitize_text_field( $_POST['_molongui_guest_author_company_link'] ) );

            foreach ( $social_networks as $id => $social_network )
            {
                if ( isset( $_POST['_molongui_guest_author_'.$id] ) ) update_post_meta( $post_id, '_molongui_guest_author_'.$id, sanitize_text_field( $_POST['_molongui_guest_author_'.$id] ) );
            }
        }
		else
		{
			// Update data.
			update_post_meta( $post_id, '_molongui_guest_author', $_POST['guest-author'] );						    // Guest author?
			if ( $_POST['guest-author'] == 0 ) delete_post_meta( $post_id, '_molongui_guest_author_id' );		    // Guest author ID
			else update_post_meta( $post_id, '_molongui_guest_author_id', $_POST['_molongui_guest_author_id'] );	// Guest author ID
			update_post_meta( $post_id, '_molongui_author_box_display', $_POST['_molongui_author_box_display'] );	// Show author box?
		}

	}


	/**
	 * Get author data.
	 *
	 * @param   int     $author_id      The ID of the author to get data from.
	 * @param   string  $author_type    The type of author: {guest | registered}.
	 * @param   array   $settings       The plugin settings.
	 * @return  array   $author         The author data.
	 * @access  public
	 * @since   1.2.14
	 * @version 1.3.5
	 */
	public function get_author_data ( $author_id, $author_type, $settings = array() )
	{
        // Load available social networks.
        $social_networks = include( MOLONGUI_AUTHORSHIP_DIR . "/config/social.php" );

        // Load settings if none given.
        if ( !isset( $settings ) or empty( $settings ) )
        {
            $main_settings   = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );
            $box_settings    = get_option( MOLONGUI_AUTHORSHIP_BOX_SETTINGS );
            $string_settings = get_option( MOLONGUI_AUTHORSHIP_STRING_SETTINGS );
            $settings        = array_merge( $main_settings, $box_settings, $string_settings );
        }

		// Get author data.
		if ( $author_type == 'guest' )
        {
            // Prepare archive page URI slug.
            $uri_slug = ( ( isset( $settings['guest_archive_permalink']) and !empty( $settings['guest_archive_permalink'] ) ) ? '/' . $settings['guest_archive_permalink'] : '' ) .
                        ( ( isset( $settings['guest_archive_slug']) and !empty( $settings['guest_archive_slug'] ) ) ? '/' . $settings['guest_archive_slug'] : '/author' );

            // Guest author.
            $author_post            = get_post( $author_id );
            $author['id']           = $author_id;
            $author['name']         = $author_post->post_title;
            $author['slug']         = $author_post->post_name;
            $author['mail']         = get_post_meta( $author_id, '_molongui_guest_author_mail', true );
            $author['show_mail']    = get_post_meta( $author_id, '_molongui_guest_author_show_mail', true );
            $author['link']         = get_post_meta( $author_id, '_molongui_guest_author_link', true );
            $author['url']          = ( $settings['enable_guest_archive'] ? home_url( $uri_slug.'/'.$author['slug'] ) : '' );
            $author['img']          = ( has_post_thumbnail($author_id) ? get_the_post_thumbnail($author_id, "thumbnail", array('class' => 'mabt-radius-' . $settings['img_style'] . ' mabt-border-' . $settings['img_border'], 'style' => 'border-color:' . $settings['img_border_color'] . ';', 'itemprop' => 'image')) : '' );
            $author['job']          = get_post_meta( $author_id, '_molongui_guest_author_job', true ) ;
            $author['company']      = get_post_meta( $author_id, '_molongui_guest_author_company', true );
            $author['company_link'] = get_post_meta( $author_id, '_molongui_guest_author_company_link', true );
            $author['bio']          = $author_post->post_content;
            $author['type']         = 'guest-author';
            foreach ( $social_networks as $id => $social_network )
            {
                $author[$id] = get_post_meta( $author_id, '_molongui_guest_author_'.$id, true );
            }
        }
		else
		{
			// Registered author.
			$author_post            = get_user_by( 'id', $author_id );
            $author['id']           = $author_id;
			$author['name']         = $author_post->display_name;
			$author['slug']         = $author_post->user_nicename;
			$author['mail']         = $author_post->user_email;
			$author['show_mail']    = get_user_meta( $author_id, 'molongui_author_show_mail', true );
			$author['link']         = get_user_meta( $author_id, 'molongui_author_link', true );
			$author['url']          = ( $settings[ 'enable_guest_archive' ] ? get_author_posts_url( $author_id, $author_post->user_nicename ) : '' );
			$author['img']          = ( get_the_author_meta( 'molongui_author_image_id', $author_id ) ? wp_get_attachment_image( get_user_meta( $author_id, 'molongui_author_image_id', true ), "thumbnail", false, array( 'class' => 'mabt-radius-'.$settings[ 'img_style' ].' mabt-border-'.$settings[ 'img_border' ], 'style' => 'border-color:'.$settings[ 'img_border_color' ].';', 'itemprop' => 'image' ) ) : "" );
			$author['job']          = get_user_meta( $author_id, 'molongui_author_job', true );
			$author['company']      = get_user_meta( $author_id, 'molongui_author_company', true );
			$author['company_link'] = get_user_meta( $author_id, 'molongui_author_company_link', true );
			$author['bio']          = get_user_meta( $author_id, 'molongui_author_bio', true );
			$author['type']         = 'wp-user';
            foreach ( $social_networks as $id => $social_network )
            {
                $author[$id] = get_user_meta( $author_id, 'molongui_author_'.$id, true );
            }
		}

		// Handle author profile image if none set.
		if( empty( $author['img'] ) && !empty( $author['mail'] ) )
		{
			if ( $settings[ 'img_default' ] == 'acronym' )
			{
				// Generate "initials" image.
				$author['img'] = $this->get_author_acronym( $author['name'], $settings );
			}
			else
			{
				// Try to load the associated Gravatar.
				// @see https://codex.wordpress.org/Function_Reference/get_avatar
				$author['img'] = get_avatar( $author['mail'], '150', $settings[ 'img_default' ], false, array( 'class' => 'mabt-radius-'.$settings[ 'img_style' ].' mabt-border-'.$settings[ 'img_border' ], 'style' => 'border-color:'.$settings[ 'img_border_color' ].';', 'itemprop' => 'image' ) );
			}
		}

		// Return data.
		return $author;
	}


	/**
	 * Get author acronym.
	 *
	 * @param   string  $name       The author name.
	 * @param   array   $settings   Plugin settings.
	 * @return  string  $acronym    The author acronym.
	 * @access  public
	 * @since   1.3.0
	 * @version 1.3.5
	 */
	public function get_author_acronym ( $name, $settings )
	{
		// Get the acronym.
		$acronym = $this->get_acronym( $name );

		// Return styled acronym.
		$html  = '';
		$html .= '<div class="mabt-radius-' . $settings[ 'img_style' ] . ' acronym-container" style="background:' . $settings[ 'acronym_bg_color' ] . '; color:' . $settings[ 'acronym_text_color' ] . ';">';
		$html .= '<div class="molongui-vertical-aligned">';
		$html .= $acronym;
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}


	/**
	 * Get the acronym of the given string.
	 *
	 * @param   string  $words      The string.
	 * @param   int     $length     The maximum length of the acronym.
	 * @return  string  $acronym    The acronym.
	 * @access  public
	 * @since   1.3.0
	 * @version 1.3.0
	 */
	public function get_acronym ( $words, $length = 3 )
	{
		$acronym = '';
		foreach ( explode( ' ', $words ) as $word ) $acronym .= mb_substr( $word, 0, 1, 'utf-8' );

		return strtoupper( mb_substr( $acronym, 0, $length ) );
	}


	/**
	 * Get author posts.
	 *
	 * @see     http://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * @param   int     $author_id      The ID of the author to get data from.
	 * @param   string  $author_type    The type of author: {guest | registered}.
	 * @param   array   $settings       The plugin settings.
	 * @param   boolean $get_all        Whether to limit the query or not.
	 * @return  array   $posts          The author posts.
	 * @access  public
	 * @since   1.2.17
	 * @version 1.3.0
	 */
	public function get_author_posts ( $author_id, $author_type, $settings, $get_all = false )
	{
		// Adjust query
		if ( $author_type == 'guest' )
		{
			// Guest author
			$args = array(
				'post_type'      => 'post',
				'orderby'        => $settings[ 'related_order_by' ],
				'order'          => $settings[ 'related_order' ],
				'posts_per_page' => ( $get_all ? '-1' : $settings[ 'related_items' ] ),
				'meta_query'     => array(
					array(
						'key'    => '_molongui_guest_author',
						'value'  => '1',
					),
					array(
						'key'    => '_molongui_guest_author_id',
						'value'  => $author_id,
					),
				),
			);
		}
		else
		{
			// Registered author
			$args = array(
				'post_type'      => 'post',
				'author'         => $author_id,
				'orderby'        => $settings[ 'related_order_by' ],
				'order'          => $settings[ 'related_order' ],
				'posts_per_page' => ( $get_all ? '-1' : $settings[ 'related_items' ] ),
				'meta_query'     => array(
					'relation'    => 'OR',
					array(
						'key'     => '_molongui_guest_author',
						'compare' => 'NOT EXISTS',
					),
					array(
						'relation'     => 'AND',
						array(
							'key'      => '_molongui_guest_author',
							'compare'  => 'EXISTS',
						),
						array(
							'key'      => '_molongui_guest_author',
							'value'    => '0',
							'compare'  => '==',
						),
					),
				),
			);
		}

		// Get data
		$data = new WP_Query( $args );

		// Prepare data
		foreach ( $data->posts as $post )
		{
			$posts[] = $post;
		}

		// Return data
		if ( !empty( $posts ) ) return $posts;
		else return;
	}


	/**
	 * Return authorship box HTML markup to the calling JS.
	 *
	 * This function is called via AJAX (admin/js/).
	 *
	 * @access  public
	 * @since   1.3.0
	 * @version 1.3.5
	 */
	public function authorship_box_preview()
	{
		// Check security (If nonce is invalid, die).
		check_ajax_referer( 'myajax-js-nonce', 'security', true );

		if ( is_admin() and isset( $_POST ) )
		{
			// Parse settings.
			foreach ( $_POST['form'] as $input )
			{
				if ( strpos( $input['name'], 'molongui_authorship_box' ) !== false )
				{
					$new_key = str_replace( "molongui_authorship_box", "", $input['name'] );
					$new_key = substr($new_key, 1, -1);
					$box_settings[ $new_key ] = $input['value'];
				}
			}

			// Load other settings and merge them all.
			$main_settings   = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );
			$string_settings = get_option( MOLONGUI_AUTHORSHIP_STRING_SETTINGS );
			$settings        = array_merge( $main_settings, $box_settings, $string_settings );

			// Demo data.
			$random_id = substr( number_format(time() * mt_rand(), 0, '', ''), 0, 10 );
			$author = array(
				'name'         => 'Author name',
				'link'         => '#',
				'img'          => '<img class="mabt-radius-'.$settings['img_style'].' mabt-border-'.$settings[ 'img_border' ].'"style="border-color:'.$settings[ 'img_border_color' ].';" height="150" width="150" src="'.MOLONGUI_AUTHORSHIP_URL.'/admin/img/preview_author_img.png">',
				'job'          => 'Writer',
				'company'      => 'Daily Mail',
				'company_link' => '#',
				'web'          => '#',
                'facebook'     => '#',
				'twitter'      => '#',
				'youtube'      => '#',
				'vine'         => '#',
				'bio'          => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque risus augue, lacinia feugiat eros eu, fermentum elementum turpis. Aenean vel porta neque. In eget quam pulvinar justo blandit bibendum ac id leo. Duis volutpat sit amet est non porta. Fusce interdum ante sed metus venenatis porta.',
			);
			for ($i = 1; $i <= $settings['related_items']; $i++)
			{
				$author_posts[] = (object) array(
					'ID'         => '#',
					'post_title' => 'Related article '.$i,
				);
			}

			// Set preview flag.
			$is_preview = true;

			// Mount preview.
			ob_start();
			if ( !isset( $settings['layout'] ) or
			     empty( $settings['layout'] ) or
			     $settings['layout'] == 'default' )
			{
				include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/html-default-author-box.php' );
			}
			elseif ( $settings['layout'] == 'tabbed' )
			{
				include( MOLONGUI_AUTHORSHIP_DIR . '/public/views/html-tabbed-author-box.php' );
			}
			elseif ( is_premium() )
			{
				include( MOLONGUI_AUTHORSHIP_DIR . '/premium/public/views/html-' . $settings['layout'] . '-author-box.php' );
			}

			// Return markup to JS.
			echo ob_get_clean();
		}

		// Avoid 'admin-ajax.php' to append the value outputted with a "0".
		wp_die();
	}


	/**
	 * Add preview button to 'box' settings tab.
	 *
	 * The result of this function is hooked into the 'render_page_settings' function.
	 *
	 * @access  public
	 * @param   string  $current_tab    Current tab of the settings page.
	 * @since   1.3.0
	 * @version 1.3.5
	 */
	public function add_preview_button( $current_tab )
	{
		if ( $current_tab == 'box' )
		{
			?>
			<!-- Preview button -->
			<div class="molongui-modal-preview-button">
				<button id="molongui-authorship-box-preview-button" class="molongui-authorship-icon-preview"><?php _e( 'Preview', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></button>
			</div>

			<!-- Author box preview -->
			<div id="molongui-modal-preview" class="molongui-modal-preview">
				<div id="molongui-authorship-box-preview" class="modal-content">
					<div class="modal-header">
						<h2><?php _e( 'Preview', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></h2>
						<p>
							<span><?php _e( 'Note', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?></span>
							<?php _e( 'Your theme may probably change how typography, colors and sizes are displayed in this preview.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ); ?>
						</p>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button id="molongui-authorship-box-preview-close" class="molongui-modal-preview-close" tabindex="2">Close</button>
					</div>
				</div>
			</div>
		<?php
		}
	}

    /**
     * Returns a list of all authors.
     *
     * @see     https://codex.wordpress.org/Function_Reference/get_users
     *          https://codex.wordpress.org/Roles_and_Capabilities
     *
     * @access  public
     * @param   string  $type       Type of author to retrieve {all | registered | guest}.
     * @param   string  $order      Designates the ascending or descending order of the 'orderby' parameter {asc | desc}. Defaults to 'asc'.
     * @param   string  $orderby    Sort retrieved authors by parameter: {name | mail | job | company}. Defaults to 'name'.
     * @return  array   $authors    Authors list.
     * @since   1.3.5
     * @version 1.3.5
     */
    public function get_authors( $type = 'all', $order = 'asc', $orderby = 'name' )
    {
        // Variables.
        $authors = array();

        // Load plugin settings.
        $main_settings   = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );
        $box_settings    = get_option( MOLONGUI_AUTHORSHIP_BOX_SETTINGS );
        $string_settings = get_option( MOLONGUI_AUTHORSHIP_STRING_SETTINGS );
        $settings        = array_merge( $main_settings, $box_settings, $string_settings );

        // Get registered users with post edition capabilities.
        if ( $type == 'all' or $type == 'registered' )
        {
            $args = array(
                'role__not_in' => array( 'subscriber' ),
            );
            $wp_users = get_users( $args ); // Array of WP_User objects.

            // Parse data from registered users.
            foreach ( $wp_users as $wp_user )
            {
                $authors[] = $this->get_author_data( $wp_user->ID, 'registered', $settings );
            }
        }

        // Get guest authors.
        if ( $type == 'all' or $type == 'guest' )
        {
            $guests = $this->get_guest_authors(false); // Array of stdClass objects.

            // Parse data from registered users.
            foreach ($guests->posts as $guest)
            {
                $authors[] = $this->get_author_data( $guest->ID, 'guest', $settings );
            }
        }

        // Sort data.
        // @see http://stackoverflow.com/a/2477524
        // @see http://stackoverflow.com/a/2477532
        usort( $authors, function ( $a, $b ) use( $orderby )
        {
            return strcmp( $a[$orderby], $b[$orderby] );
        });

        // Reverse data order.
        if ( $order == 'desc' ) $authors = array_reverse( $authors );

        // Return data.
        return $authors;
    }
}