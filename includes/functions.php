<?php

/**
 * The functions file of the plugin.
 *
 * @author     Amitzy
 * @category   Molongui
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/premium/includes
 * @since      1.2.12
 * @version    1.3.6
 */


/**
 * Overwrite of the WP core function 'get_user_by' located in 'wp-includes/pluggable.php' in order
 * to enhance themes compatibility.
 *
 * There are many themes not using 'the_author' template tag to display the author name. They use
 * the 'get_user_by' WP core function to get author data. As "guest authors" are not WP users, the
 * function would collect data about the user who posted the guest post, not data about the guest
 * author. To display guest author information, 'get_user_by' function is overridden (only on the
 * frontend).
 *
 * @see		    https://codex.wordpress.org/Function_Reference/get_user_by
 * @see		    https://core.trac.wordpress.org/browser/tags/4.4.1/src/wp-includes/pluggable.php#L149
 * @see         https://codex.wordpress.org/Function_Reference/is_admin
 * @see         http://wordpress.stackexchange.com/a/70677
 * @see         http://wp-time.com/wordpress-if-login-page/
 * @see         http://wordpress.stackexchange.com/questions/70676/how-to-check-if-i-am-in-admin-ajax-php
 *
 * @param		string          $field The field to retrieve the user with. id | ID | slug | email | login.
 * @param		int|string      $value A value for $field. A user ID, slug, email address, or login name.
 * @return      WP_User|false	WP_User object on success, false on failure.
 * @since		1.2.12
 * @version     1.3.6
 */
if ( !function_exists( 'get_user_by' ) )
{
	function get_user_by( $field, $value )
	{
        /**
         * Mimic the 'get_user_by()' function behaviour.
         *
         * If necessary, $user data will be altered later on.
         *
         * @since   1.2.12
         * @version 1.2.12
         */
		$userdata = WP_User::get_data_by( $field, $value );

		if ( !$userdata ) return false;

		$user = new WP_User;
		$user->init( $userdata );

        /**
         * NO $user data alteration wanted.
         *
         * [molongui_author_list] shortcode runs on the frontend to show a list of all authors (registered
         * and guest) so when this function is called from there, nothing should be altered.
         *
         * [molongui_author_list] shortcode calls 'get_authors()' function from the 'Guest_Author' class, which
         * calls 'get_author_data()' function which is the one that finally calls the 'get_user_by()' function.
         *
         * @since   1.3.5
         * @version 1.3.5
         */
        $db = debug_backtrace();
        if ( $db[1]['function'] == "get_author_data" and $db[1]['class'] == 'Molongui\Authorship\Includes\Guest_Author' ) return $user;

        /**
         * NO $user alteration wanted.
         *
         * [molongui_author_list] shortcode runs on the frontend to show a list of all authors (registered
         * and guest) so when 'get_author_posts_url()' function is called from there, nothing should be altered.
         *
         * [molongui_author_list] shortcode calls 'get_authors()' function from the 'Guest_Author' class, which
         * calls 'get_author_data()' function which is the one that finally calls the 'get_author_posts_url()' function
         * (there are intermediate calls, though).
         *
         * @since   1.3.5
         * @version 1.3.6
         */
        if ( isset( $db[3]['function'] ) and $db[3]['function'] == "get_author_data" and $db[3]['class'] == 'Molongui\Authorship\Includes\Guest_Author' ) return $user;

		global $pagenow;

        /**
         * $user data alteration wanted.
         *
         * If a guest post is being displayed on the frontend, override guest author display information.
         *
         * 'is_admin()' function returns false when trying to access wp-login.php so that have to be also
         * taken into account (thanks to @Trevor).
         *
         * @since   1.2.12
         * @version 1.3.5
         */
		if ( !is_admin()                                // No backend page.
		     && $pagenow !== 'wp-login.php'             // No login page.
		     && !defined( 'DOING_AJAX' )                // No ajax request.
			 //&& !wp_doing_ajax()                      // No ajax request (check for WP 4.7 and higher)
		)
		{
			if ( $guest = get_post_meta( get_the_ID(), '_molongui_guest_author_id', true ) )
			{
				$guest_data          = get_post( $guest );

				$user->ID            = $guest;
				$user->display_name  = $guest_data->post_title;
				$user->user_nicename = $guest_data->post_title;
				$user->user_url      = ( get_post_meta( $guest, '_molongui_guest_author_link', true ) ? get_post_meta( $guest, '_molongui_guest_author_link', true ) : '#' );

				/**
				 * Comments' gravatar is gotten by the 'get_avatar_data' function, which uses an email address to retrieve the profile image (gravatar).
				 * That function checks if the comment was made by a registered user, if so, tries to get the User Object and retrieve the associated email
				 * address from there. If an error occurs or the comment was not written by a registered user, then the email field from the Comment Object is
				 * retrieved.
				 *
				 * Being so, we must left untouched the 'user_email' field if the calling function is 'get_avatar_data', so, on guest posts, comments made by
				 * registered authors load the proper gravatar. If not, it would load the gravatar associated with the email address of the guest author.
				 *
				 * See https://developer.wordpress.org/reference/functions/get_avatar_data/
				 *     http://stackoverflow.com/questions/2110732/how-to-get-name-of-calling-function-method-in-php
				 *     http://php.net/manual/es/function.debug-backtrace.php
                 *
                 * @since   1.2.19
                 * @version 1.2.19
				 *
				 */
				//if ( debug_backtrace()[1]['function'] != "get_avatar_data" )  // Function array dereferencing only works on PHP >= 5.4 (https://wiki.php.net/rfc/functionarraydereferencing)
				$db = debug_backtrace();
				if ( $db[1]['function'] != "get_avatar_data" )
				{
					$user->user_email = ( get_post_meta( $guest, '_molongui_guest_author_mail', true ) ? get_post_meta( $guest, '_molongui_guest_author_mail', true ) : '' );
				}
			}
		}

		return $user;
	}
}

/**
 * Checks if a Virtual Page is being displayed.
 *
 * @return  boolean
 * @since   1.2.17
 * @version 1.2.18
 */
if ( !function_exists( 'is_virtualpage' ) )
{
	function is_virtualpage()
	{
		global $query;

		return ( ( isset( $query->is_virtual ) ? $query->is_virtual : false ) );
	}
}

/**
 * Filter guests posts from default author pages.
 *
 * Posts are authorized by a registered user, whether it is assigned a different author or not, so it is
 * required to remove those posts from the registered user author page.
 *
 * @see     http://wordpress.stackexchange.com/a/72126
 *          https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *          http://www.emenia.es/pre-get-posts-en-vez-de-query-posts-wordpress/
 *
 * @param   WP_Query    &$query     The WP_Query object.
 * @since   1.2.17
 * @version 1.2.20
 */
add_action( 'pre_get_posts', 'molongui_filter_guest_posts' );
function molongui_filter_guest_posts( &$query )
{
	// Do not affect admin screen queries or other than main query.
	if( is_admin() or !$query->is_main_query() ) return;

	// Modify main query to affect only "author" pages at the frontend.
	if ( $query->is_author() )//is_author() )
	{
		// Get original meta query
		$meta_query = $query->get( 'meta_query' );

		// Add our meta query to the original meta queries.
		$meta_query[] = array(
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
		);
		$query->set( 'meta_query', $meta_query );
	}
}

/**
 * Adds 'molongui_guestauthor' CPT to the search results.
 *
 * @param   $query
 * @since   1.3.6
 * @version 1.3.6
 */
add_action( 'pre_get_posts', 'add_guest_authors_to_search' );
function add_guest_authors_to_search( &$query )
{
    // Do not affect admin screen queries or other than main query.
    if( is_admin() or !$query->is_main_query() ) return;

    // Load plugin settings.
    $settings = get_option( MOLONGUI_AUTHORSHIP_MAIN_SETTINGS );

    // Modify main query to affect only "search" pages at the frontend.
    if ( $query->is_search and
         isset( $settings['include_guests_in_search']) and $settings['include_guests_in_search'] )
    {
        // Get searchable post types.
        $post_types = get_post_types( array( 'public' => true, 'exclude_from_search' => false), 'names' );

        // Add our CPT to the original set.
        $post_types[] = 'molongui_guestauthor';

        // Update query parameter.
        $query->set( 'post_type', $post_types );
    }
}