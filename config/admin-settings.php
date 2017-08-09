<?php

/**
 * Admin settings.
 *
 * This file contains all the plugin configurable settings.
 *
 * This file must be loaded like:
 *      include( MOLONGUI_PLUGIN_NAME_DIR . '/config/admin-settings.php' );
 *
 * Actually, it is the '$tabs' array that holds all the configurable settings
 * as well as all the tabs the settings page has. Its structure is:
 *
 * array(
 *  'key'      => 'db_key',
 *  'slug'     => 'tab_uri_slug',
 *  'label'    => 'Tab label',
 *  'callback' => function,
 *  'sections' => array(
 *          array(
 *              'id'       => 'section_id',
 *              'label'    => 'Section label',
 *              'desc'     => 'Section description',
 *              'callback' => 'render_description',
 *              'fields'   => array(
 *                  array(
 *                      'id'          => 'field_name_id',
 *                      'label'       => 'Field label',
 *                      'desc'        => 'Field description',
 *                      'tip'         => 'Field tip',
 *                      'premium'     => 'Field premium notice tip,
 *                      'type'        => 'text',
 *                      'placeholder' => 'Field placeholder',
 *                  ),
 *              ),
 *          ),
 *          array(
 *              'id'       => 'section_id',
 *              'label'    => 'Section label',
 *              'callback' => 'render_page',
 *              'cb_args'  => 'path_to_the_view_to_render',
 *          ),
 *   )
 * )
 *
 * where 'type' of field can be: {text | textarea | select | radio | checkbox | checkboxes | colorpicker | button}:
 *
 *  array(
 *      'id'          => 'field_name_id',
 *      'label'       => __( 'Field label', 'text_domain' ),
 *      'desc'        => __( 'Field description', 'text_domain' ),
 *      'tip'         => __( 'Helping tip', text_domain ),
 *      'premium'     => $this->premium_setting_tip(),
 *      'type'        => 'text',
 *      'placeholder' => 'Field placeholder',
 *      'icon'        => array(
 *          'position' => 'right',
 *          'type'     => 'status',
 *      ),
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => 'Field tip',
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'textarea',
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'select',
 *      'options' => array(
 *          array(
 *              'id'    => 'select_option_1_id',
 *              'label' => __( 'Select option 1 label', 'text_domain' ),
 *              'value' => 'select_option_1_value',
 *          ),
 *          array(
 *              'id'    => 'select_option_2_id',
 *              'label' => __( 'Select option 2 label', 'text_domain' ),
 *              'value' => 'select_option_2_value',
 *          ),
 *      ),
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'radio',
 *      'options' => array(
 *          array(
 *              'id'    => 'radio_option_1_id',
 *              'label' => __( 'Radio option 1 label', 'text_domain' ),
 *              'value' => 'radio_option_1_value',
 *          ),
 *          array(
 *              'id'    => 'radio_option_2_id',
 *              'label' => __( 'Radio option 2 label', 'text_domain' ),
 *              'value' => 'radio_option_2_value',
 *          ),
 *      ),
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'checkbox',
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'type'    => 'checkboxes',
 *      'options' => array(
 *          array(
 *              'id'    => 'checkbox_option_1_id',
 *              'label' => __( 'Checkbox option 1 label', 'text_domain' ),
 *          ),
 *          array(
 *              'id'    => 'checkbox_option_2_id',
 *              'label' => __( 'Checkbox option 2 label', 'text_domain' ),
 *          ),
 *      ),
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', 'text_domain' ),
 *      'desc'    => __( 'Field description', 'text_domain' ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'colorpicker',
 *  ),
 *
 *  array(
 *      'id'      => 'field_name_id',
 *      'label'   => __( 'Field label', text_domain ),
 *      'desc'    => __( 'Field description', text_domain ),
 *      'tip'     => __( 'Helping tip', text_domain ),
 *      'premium' => $this->premium_setting_tip(),
 *      'type'    => 'button',
 *      'args'    => array(
 *          'id'    => 'button_id',
 *          'label' => __( 'Button label', text_domain ),
 *          'class' => 'button_class1 button_class2 ...',
 *       ),
 *  ),
 *
 * @since      1.3.0
 * @version    1.3.5
 */

$slug        = 'molongui_authorship';
$default_tab = 'main';
$tabs        = array
(
	array
	(
		'key'      => $slug . '_main',
		'slug'     => 'main',
		'label'    => __( 'Main', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => array( $this, 'validate_main_tab' ),
		'sections' => array
		(
			array
			(
				'id'       => 'related_posts',
				'label'    => __( 'Related posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'show_related',
						'label'   => __( 'Show related posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to show "related posts" link on the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'related_order_by',
						'label'   => __( 'Order by', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The criteria to sort related posts.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'title',
								'label' => __( 'Title', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'title',
							),
							array
							(
								'id'    => 'date',
								'label' => __( 'Date', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'date',
							),
							array
							(
								'id'    => 'modified',
								'label' => __( 'Modified', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'modified',
							),
							array
							(
								'id'    => 'comment_count',
								'label' => __( 'Comment count', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'comment_count',
							),
							array
							(
								'id'    => 'rand',
								'label' => __( 'Random order', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'rand',
							),
						),
					),
					array
					(
						'id'      => 'related_order',
						'label'   => __( 'Order', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The order to sort related posts.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'asc',
								'label' => __( 'Ascending order', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'asc',
							),
							array
							(
								'id'    => 'desc',
								'label' => __( 'Descending order', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'desc',
							),
						),
					),
					array
					(
						'id'      => 'related_items',
						'label'   => __( 'Number of posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Amount of related posts to show in the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => '2',
								'label' => __( '2', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '2',
							),
							array
							(
								'id'    => '3',
								'label' => __( '3', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '3',
							),
							array
							(
								'id'    => '4',
								'label' => __( '4', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '4',
							),
							array
							(
								'id'    => '5',
								'label' => __( '5', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '5',
							),
							array
							(
								'id'    => '6',
								'label' => __( '6', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '6',
							),
							array
							(
								'id'    => '7',
								'label' => __( '7', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '7',
							),
							array
							(
								'id'    => '8',
								'label' => __( '8', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '8',
							),
						),
					),
				),
			),
			array
			(
				'id'       => 'guest_archives',
				'label'    => __( 'Guest author archive pages', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'enable_guest_archive',
						'label'   => __( 'Enable guest archive', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to enable the use of guest author archive pages. Disabling this option, author name link is disabled.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'          => 'guest_archive_permalink',
						'label'       => __( 'Permalink', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'         => __( 'Permastruct to add after your installation URI and before the slug set below.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium'     => $this->premium_setting_tip(),
						'placeholder' => '',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'guest_archive_slug',
						'label'       => __( 'Slug', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'         => __( 'Part of the permalink that identifies your author archive page.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium'     => $this->premium_setting_tip(),
						'placeholder' => 'author',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'guest_archive_tmpl',
						'label'       => __( 'Template', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'         => __( 'Template to be used by guest author archive pages.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium'     => $this->premium_setting_tip(),
						'placeholder' => 'template_name.php',
						'type'        => 'text',
					),
				),
			),
			array
			(
				'id'       => 'social_networks',
				'label'    => __( 'Social networks', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'show',
						'label'   => __( 'Social networks', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'There are many social networking websites out there and this plugin allows you to link to the most popular. Not to glut the edit page, choose the ones you want to be able to configure.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'checkboxes',
						'options' => array
						(
                            array
                            (
                                'id'    => 'facebook',
                                'label' => 'Facebook',
                            ),
							array
							(
								'id'    => 'twitter',
								'label' => 'Twitter',
							),
							array
							(
								'id'    => 'linkedin',
								'label' => 'Linkedin',
							),
							array
							(
								'id'    => 'googleplus',
								'label' => 'Google+',
							),
							array
							(
								'id'    => 'youtube',
								'label' => 'Youtube',
							),
							array
							(
								'id'    => 'pinterest',
								'label' => 'Pinterest',
							),
							array
							(
								'id'    => 'tumblr',
								'label' => 'Tumblr',
							),
							array
							(
								'id'    => 'instagram',
								'label' => 'Instagram',
							),
							array
							(
								'id'    => 'slideshare',
								'label' => 'Slideshare',
							),
							array
							(
								'id'    => 'xing',
								'label' => 'Xing',
							),
							array
							(
								'id'    => 'renren',
								'label' => 'Renren',
							),
							array
							(
								'id'    => 'vk',
								'label' => 'Vk',
							),
							array
							(
								'id'    => 'flickr',
								'label' => 'Flickr',
							),
							array
							(
								'id'    => 'vine',
								'label' => 'Vine',
							),
							array
							(
								'id'    => 'meetup',
								'label' => 'Meetup',
							),
							array
							(
								'id'    => 'weibo',
								'label' => 'Sina Weibo',
							),
							array
							(
								'id'    => 'deviantart',
								'label' => 'Deviantart',
							),
							array
							(
								'id'    => 'stumbleupon',
								'label' => 'Stumbleupon',
							),
							array
							(
								'id'    => 'myspace',
								'label' => 'MySpace',
							),
							array
							(
								'id'    => 'yelp',
								'label' => 'Yelp',
							),
							array
							(
								'id'    => 'mixi',
								'label' => 'Mixi',
							),
							array
							(
								'id'    => 'soundcloud',
								'label' => 'SoundCloud',
							),
							array
							(
								'id'    => 'lastfm',
								'label' => 'Last.fm',
							),
							array
							(
								'id'    => 'foursquare',
								'label' => 'Foursquare',
							),
							array
							(
								'id'    => 'spotify',
								'label' => 'Spotify',
							),
							array
							(
								'id'    => 'vimeo',
								'label' => 'Vimeo',
							),
							array
							(
								'id'    => 'dailymotion',
								'label' => 'Dailymotion',
							),
							array
							(
								'id'    => 'reddit',
								'label' => 'Reddit',
							),
                            array
                            (
                                'id'    => 'skype',
                                'label' => 'Skype',
                            ),
                            array
                            (
                                'id'    => 'livejournal',
                                'label' => 'Live Journal',
                            ),
                            array
                            (
                                'id'    => 'taringa',
                                'label' => 'Taringa!',
                            ),
                            array
                            (
                                'id'    => 'odnoklassniki',
                                'label' => 'OK.ru',
                            ),
                            array
                            (
                                'id'    => 'askfm',
                                'label' => 'ASKfm',
                            ),
                            array
                            (
                                'id'    => 'bebee',
                                'label' => 'beBee',
                            ),
                            array
                            (
                                'id'    => 'goodreads',
                                'label' => 'Goodreads',
                            ),
                            array
                            (
                                'id'    => 'periscope',
                                'label' => 'Periscope',
                            ),
                            array
                            (
                                'id'    => 'telegram',
                                'label' => 'Telegram',
                            ),
                            array
                            (
                                'id'    => 'livestream',
                                'label' => 'Livestream',
                            ),
                            array
                            (
                                'id'    => 'styleshare',
                                'label' => 'StyleShare',
                            ),
                            array
                            (
                                'id'    => 'reverbnation',
                                'label' => 'Reverbnation',
                            ),
                            array
                            (
                                'id'    => 'everplaces',
                                'label' => 'Everplaces',
                            ),
                            array
                            (
                                'id'    => 'eventbrite',
                                'label' => 'Eventbrite',
                            ),
                            array
                            (
                                'id'    => 'draugiemlv',
                                'label' => 'Draugiem.lv',
                            ),
                            array
                            (
                                'id'    => 'blogger',
                                'label' => 'Blogger',
                            ),
                            array
                            (
                                'id'    => 'patreon',
                                'label' => 'Patreon',
                            ),
                            array
                            (
                                'id'    => 'plurk',
                                'label' => 'Plurk',
                            ),
                            array
                            (
                                'id'    => 'buzzfeed',
                                'label' => 'BuzzFeed',
                            ),
                            array
                            (
                                'id'    => 'slides',
                                'label' => 'Slides',
                            ),
                            array
                            (
                                'id'    => 'deezer',
                                'label' => 'Deezer',
                            ),
                            array
                            (
                                'id'    => 'spreaker',
                                'label' => 'Spreaker',
                            ),
                            array
                            (
                                'id'    => 'runkeeper',
                                'label' => 'Runkeeper',
                            ),
                            array
                            (
                                'id'    => 'medium',
                                'label' => 'Medium',
                            ),
                            array
                            (
                                'id'    => 'speakerdeck',
                                'label' => 'Speaker Deck',
                            ),
                            array
                            (
                                'id'    => 'teespring',
                                'label' => 'Teespring',
                            ),
                            array
                            (
                                'id'    => 'kaggle',
                                'label' => 'Kaggle',
                            ),
                            array
                            (
                                'id'    => 'houzz',
                                'label' => 'Houzz',
                            ),
                            array
                            (
                                'id'    => 'gumtree',
                                'label' => 'Gumtree',
                            ),
                            array
                            (
                                'id'    => 'upwork',
                                'label' => 'Upwork',
                            ),
                            array
                            (
                                'id'    => 'superuser',
                                'label' => 'SuperUser',
                            ),
                            array
                            (
                                'id'    => 'bandcamp',
                                'label' => 'Bandcamp',
                            ),
                            array
                            (
                                'id'    => 'glassdoor',
                                'label' => 'Glassdoor',
                            ),
                            array
                            (
                                'id'    => 'toptal',
                                'label' => 'TopTal',
                            ),
                            array
                            (
                                'id'    => 'ifixit',
                                'label' => 'I fix it',
                            ),
                            array
                            (
                                'id'    => 'stitcher',
                                'label' => 'Stitcher',
                            ),
                            array
                            (
                                'id'    => 'storify',
                                'label' => 'Storify',
                            ),
                            array
                            (
                                'id'    => 'readthedocs',
                                'label' => 'Read the docs',
                            ),
                            array
                            (
                                'id'    => 'ello',
                                'label' => 'Ello',
                            ),
                            array
                            (
                                'id'    => 'tinder',
                                'label' => 'Tinder',
                            ),
                            array
                            (
                                'id'    => 'github',
                                'label' => 'GitHub',
                            ),
                            array
                            (
                                'id'    => 'stackoverflow',
                                'label' => 'Stack Overflow',
                            ),
                            array
                            (
                                'id'    => 'jsfiddle',
                                'label' => 'JSFiddle',
                            ),
                            array
                            (
                                'id'    => 'twitch',
                                'label' => 'Twitch',
                            ),
                            array
                            (
                                'id'    => 'whatsapp',
                                'label' => 'WhatsApp',
                            ),
                            array
                            (
                                'id'    => 'tripadvisor',
                                'label' => 'Tripadvisor',
                            ),
                            array
                            (
                                'id'    => 'wikipedia',
                                'label' => 'Wikipedia',
                            ),
                            array
                            (
                                'id'    => '500px',
                                'label' => '500px',
                            ),
                            array
                            (
                                'id'    => 'mixcloud',
                                'label' => 'Mixcloud',
                            ),
                            array
                            (
                                'id'    => 'viadeo',
                                'label' => 'Viadeo',
                            ),
                            array
                            (
                                'id'    => 'quora',
                                'label' => 'Quora',
                            ),
                            array
                            (
                                'id'    => 'etsy',
                                'label' => 'Etsy',
                            ),
                            array
                            (
                                'id'    => 'codepen',
                                'label' => 'CodePen',
                            ),
                            array
                            (
                                'id'    => 'coderwall',
                                'label' => 'Coderwall',
                            ),
                            array
                            (
                                'id'    => 'behance',
                                'label' => 'Behance',
                            ),
                            array
                            (
                                'id'    => 'coursera',
                                'label' => 'Coursera',
                            ),
                            array
                            (
                                'id'    => 'googleplay',
                                'label' => 'Google Play',
                            ),
                            array
                            (
                                'id'    => 'itunes',
                                'label' => 'iTunes',
                            ),
						),
					),
				),
			),
            array
            (
                'id'       => 'search',
                'label'    => __( 'Search results', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                'callback' => 'render_description',
                'fields'   => array
                (
                    array
                    (
                        'id'      => 'include_guests_in_search',
                        'label'   => __( 'Include guest authors in search', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Whether to make guest authors searchable.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'yes',
                                'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '1',
                            ),
                            array
                            (
                                'id'    => 'no',
                                'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '0',
                            ),
                        ),
                    ),
                ),
            ),
            array
            (
                'id'       => 'shortcodes',
                'label'    => __( 'Shortcodes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                'callback' => 'render_description',
                'fields'   => array
                (
                    array
                    (
                        'id'      => 'enable_sc_text_widgets',
                        'label'   => __( 'Enable in text widgets', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Whether to enable the use of shortcodes in text widgets.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => $this->premium_setting_tip(),
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'yes',
                                'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '1',
                            ),
                            array
                            (
                                'id'    => 'no',
                                'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '0',
                            ),
                        ),
                    ),
                ),
            ),
			array
			(
				'id'       => 'metadata',
				'label'    => __( 'Metadata', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'add_opengraph_meta',
						'label'   => __( 'Open Graph', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to add Open Graph metadata for author details (useful for rich snippets).', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'add_google_meta',
						'label'   => __( 'Google Authorship', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to add Google Authorship metadata for author details (useful for rich snippets).', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'add_facebook_meta',
						'label'   => __( 'Facebook Authorship', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to add Facebook Authorship metadata for author details (useful for rich snippets).', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
				),
			),
			array
			(
				'id'       => 'admin_menu',
				'label'    => __( 'Admin menu', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'admin_menu_level',
						'label'   => __( 'Menu item', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Choose where to add the "Guest authors" link in the admin menu.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'top_level',
								'label' => __( 'Top level', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'true',
							),
							array
							(
								'id'    => 'users',
								'label' => __( 'Users', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'users.php',
							),
							array
							(
								'id'    => 'posts',
								'label' => __( 'Posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'edit.php',
							),
							array
							(
								'id'    => 'pages',
								'label' => __( 'Pages', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'edit.php?post_type=page',
							),
						),
					),
				),
			),
			array
			(
				'id'       => 'uninstalling',
				'label'    => __( 'Uninstalling', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'keep_config',
						'label'   => __( 'Keep configuration?', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to keep plugin configuration settings upon plugin uninstalling.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'keep_data',
						'label'   => __( 'Keep data?', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to keep plugin related data upon plugin uninstalling.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
				),
			),
		),
	),
	array
	(
		'key'      => $slug . '_box',
		'slug'     => 'box',
		'label'    => __( 'Author box', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => array( $this, 'validate_box_tab' ),
		'sections' => array
		(
			array
			(
				'id'       => 'display',
				'label'    => __( 'Display settings', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
//				'desc'     => __( 'Set display options that will apply by default to all posts. They can be changed for each post on its edit page.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'  => array
				(
					array
					(
						'id'      => 'display',
						'label'   => __( 'Show by default', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to show the authorship box by default. This setting is overridden by post configuration.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'all',
								'label' => __( 'Yes, on all posts and pages', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'posts',
								'label' => ( !is_premium() ? __( 'Only on posts [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Only on posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'posts',
							),
							array
							(
								'id'    => 'pages',
								'label' => ( !is_premium() ? __( 'Only on pages [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Only on pages', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'pages',
							),
							array
							(
								'id'    => 'none',
								'label' => __( 'No, let me choose where to display it', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'position',
						'label'   => __( 'Position', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to show the authorship box above or below post content.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'above',
								'label' => __( 'Above content', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'above',
							),
							array
							(
								'id'    => 'below',
								'label' => __( 'Below content', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'below',
							),
						),
					),
					array
					(
						'id'      => 'hide_if_no_bio',
						'label'   => __( 'Hide if no description', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to hide the author box if there is not biographical information to show.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'layout',
						'label'   => __( 'Layout', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The template to be used to render the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
                            array
                            (
                                'id'    => 'default',
                                'label' => __( 'Default', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'default',
                            ),
							array
							(
								'id'    => 'default-rtl',
								'label' => ( !is_premium() ? __( 'Default RTL [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Default RTL', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'default-rtl',
							),
							array
							(
								'id'    => 'tabbed',
								'label' => __( 'Tabbed', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'tabbed',
							),
							array
							(
								'id'    => 'ribbon',
								'label' => ( !is_premium() ? __( 'Ribbon [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Ribbon', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'ribbon',
							),
							array
							(
								'id'    => 'ribbon-rtl',
								'label' => ( !is_premium() ? __( 'Ribbon RTL [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Ribbon RTL', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'ribbon-rtl',
							),
						),
					),
                    array
                    (
                        'id'      => 'box_width',
                        'label'   => __( 'Width', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( 'Amount of space the author box can take. ', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Box width', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => '100',
                                'label' => __( '100%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '100',
                            ),
                            array
                            (
                                'id'    => '90',
                                'label' => __( '90%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '90',
                            ),
                            array
                            (
                                'id'    => '80',
                                'label' => __( '80%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '80',
                            ),
                            array
                            (
                                'id'    => '70',
                                'label' => __( '70%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '70',
                            ),
                            array
                            (
                                'id'    => '60',
                                'label' => __( '60%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '60',
                            ),
                            array
                            (
                                'id'    => '50',
                                'label' => __( '50%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '50',
                            ),
                            array
                            (
                                'id'    => '40',
                                'label' => __( '40%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '40',
                            ),
                            array
                            (
                                'id'    => '30',
                                'label' => __( '30%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '30',
                            ),
                            array
                            (
                                'id'    => '20',
                                'label' => __( '20%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '20',
                            ),
                            array
                            (
                                'id'    => '10',
                                'label' => __( '10%', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '10',
                            ),
                        ),
                    ),
                    array
                    (
                        'id'      => 'box_margin',
                        'label'   => __( 'Margin', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Space to add above and below the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => '0',
                                'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '0',
                            ),
                            array
                            (
                                'id'    => '10',
                                'label' => __( '10px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '10',
                            ),
                            array
                            (
                                'id'    => '20',
                                'label' => __( '20px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '20',
                            ),
                            array
                            (
                                'id'    => '30',
                                'label' => __( '30px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '30',
                            ),
                            array
                            (
                                'id'    => '40',
                                'label' => __( '40px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '40',
                            ),
                            array
                            (
                                'id'    => '50',
                                'label' => __( '50px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '50',
                            ),
                            array
                            (
                                'id'    => '60',
                                'label' => __( '60px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '60',
                            ),
                            array
                            (
                                'id'    => '80',
                                'label' => __( '80px', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '80',
                            ),
                        ),
                    ),
				),
			),
			array
			(
				'id'       => 'box_styling',
				'label'    => __( 'Box styling', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
//				'desc'     => __( 'Customize the author box by choosing the font-sizes, the layout, the social media icons and the colors that you like the most to make it fit the best with your site.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'box_shadow',
						'label'   => __( 'Shadow', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether and where to add a shadow to the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'left',
								'label' => __( 'Left', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'left',
							),
							array
							(
								'id'    => 'right',
								'label' => __( 'Right', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'right',
							),
							array
							(
								'id'    => 'none',
								'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'none',
							),
						),
					),
					array
					(
						'id'      => 'box_border',
						'label'   => __( 'Border', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Width of the border to add to the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'thin',
								'label' => __( 'Thin', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'thin',
							),
							array
							(
								'id'    => 'thick',
								'label' => __( 'Thick', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'thick',
							),
							array
							(
								'id'    => 'none',
								'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'none',
							),
						),
					),
					array
					(
						'id'      => 'box_border_color',
						'label'   => __( 'Border color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The border color of the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'box_background',
						'label'   => __( 'Background color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The background color of the author box.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'colorpicker',
					),
                    array
                    (
                        'id'      => 'show_headline',
                        'label'   => __( 'Show headline', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Whether to show a headline above the author data.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'yes',
                                'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '1',
                            ),
                            array
                            (
                                'id'    => 'no',
                                'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => '0',
                            ),
                        ),
                    ),
                    array
                    (
                        'id'      => 'headline_size',
                        'label'   => __( 'Headline font size', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Font size used to display the headline.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'biggest',
                                'label' => __( 'Biggest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'biggest',
                            ),
                            array
                            (
                                'id'    => 'bigger',
                                'label' => __( 'Bigger', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'bigger',
                            ),
                            array
                            (
                                'id'    => 'big',
                                'label' => __( 'Big', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'big',
                            ),
                            array
                            (
                                'id'    => 'normal',
                                'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'normal',
                            ),
                            array
                            (
                                'id'    => 'small',
                                'label' => __( 'Small', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'small',
                            ),
                            array
                            (
                                'id'    => 'smaller',
                                'label' => __( 'Smaller', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'smaller',
                            ),
                            array
                            (
                                'id'    => 'smallest',
                                'label' => __( 'Smallest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'smallest',
                            ),
                        ),
                    ),
                    array
                    (
                        'id'      => 'headline_color',
                        'label'   => __( 'Headline text color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Color used to display the headline.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => $this->premium_setting_tip(),
                        'type'    => 'colorpicker',
                    ),
                    array
                    (
                        'id'      => 'headline_align',
                        'label'   => __( 'Headline text alignment', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Text alignment to display the headline.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'justify',
                                'label' => __( 'Justify', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'justify',
                            ),
                            array
                            (
                                'id'    => 'center',
                                'label' => __( 'Center', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'center',
                            ),
                            array
                            (
                                'id'    => 'left',
                                'label' => __( 'Left', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'left',
                            ),
                            array
                            (
                                'id'    => 'right',
                                'label' => __( 'Right', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'right',
                            ),
                        ),
                    ),
                    array
                    (
                        'id'      => 'headline_style',
                        'label'   => __( 'Headline text style', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Text style to display the headline.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => $this->premium_setting_tip(),
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'normal',
                                'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'normal',
                            ),
                            array
                            (
                                'id'    => 'italics',
                                'label' => __( 'Italics', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'italics',
                            ),
                            array
                            (
                                'id'    => 'bold',
                                'label' => __( 'Bold', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'bold',
                            ),
                            array
                            (
                                'id'    => 'itbo',
                                'label' => __( 'Italics-Bold', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'itbo',
                            ),
                        ),
                    ),
					array
					(
						'id'      => 'img_style',
						'label'   => __( 'Image style', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether and how to shape the author profile image.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'rounded',
								'label' => __( 'Rounded', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'rounded',
							),
							array
							(
								'id'    => 'circled',
								'label' => __( 'Circled', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'circled',
							),
							array
							(
								'id'    => 'none',
								'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'none',
							),
						),
					),
                    array
                    (
                        'id'      => 'img_border',
                        'label'   => __( 'Image border', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Width of the border to add to the author profile image.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'select',
                        'options' => array
                        (
                            array
                            (
                                'id'    => 'none',
                                'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'none',
                            ),
                            array
                            (
                                'id'    => 'thin',
                                'label' => __( 'Thin', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'thin',
                            ),
                            array
                            (
                                'id'    => 'thick',
                                'label' => __( 'Thick', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'thick',
                            ),
                            array
                            (
                                'id'    => 'thicker',
                                'label' => __( 'Thicker', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'thicker',
                            ),
                            array
                            (
                                'id'    => 'thickest',
                                'label' => __( 'Thickest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'thickest',
                            ),
                        ),
                    ),
                    array
                    (
                        'id'      => 'img_border_color',
                        'label'   => __( 'Image border color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'tip'     => __( 'Image border color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'premium' => '',
                        'type'    => 'colorpicker',
                    ),
					array
					(
						'id'      => 'img_default',
						'label'   => __( 'Default image', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Image to show if none uploaded and no gravatar configured.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip( 'part' ),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'blank',
								'label' => __( 'Blank', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'blank',
							),
							array
							(
								'id'    => 'mm',
								'label' => __( 'Mistery man', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'mm',
							),
							array
							(
								'id'    => 'acronym',
								'label' => ( !is_premium() ? __( 'Author acronym [PREMIUM]', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) : __( 'Author acronym', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ) ),
								'value' => 'acronym',
							),
						),
					),
					array
					(
						'id'      => 'acronym_text_color',
						'label'   => __( 'Acronym text color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The color used to display the author name acronym.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'acronym_bg_color',
						'label'   => __( 'Acronym bg color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The color used to fill the author name acronym background.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'name_size',
						'label'   => __( 'Name font size', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Font size used to display the author name.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'biggest',
								'label' => __( 'Biggest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'biggest',
							),
							array
							(
								'id'    => 'bigger',
								'label' => __( 'Bigger', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'bigger',
							),
							array
							(
								'id'    => 'big',
								'label' => __( 'Big', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'big',
							),
							array
							(
								'id'    => 'normal',
								'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'normal',
							),
							array
							(
								'id'    => 'small',
								'label' => __( 'Small', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'small',
							),
							array
							(
								'id'    => 'smaller',
								'label' => __( 'Smaller', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smaller',
							),
							array
							(
								'id'    => 'smallest',
								'label' => __( 'Smallest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smallest',
							),
						),
					),
					array
					(
						'id'      => 'name_color',
						'label'   => __( 'Name color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Color used to display the author name.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'meta_size',
						'label'   => __( 'Meta font size', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Font size used to display the author metadata (job position, company...).', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'biggest',
								'label' => __( 'Biggest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'biggest',
							),
							array
							(
								'id'    => 'bigger',
								'label' => __( 'Bigger', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'bigger',
							),
							array
							(
								'id'    => 'big',
								'label' => __( 'Big', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'big',
							),
							array
							(
								'id'    => 'normal',
								'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'normal',
							),
							array
							(
								'id'    => 'small',
								'label' => __( 'Small', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'small',
							),
							array
							(
								'id'    => 'smaller',
								'label' => __( 'Smaller', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smaller',
							),
							array
							(
								'id'    => 'smallest',
								'label' => __( 'Smallest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smallest',
							),
						),
					),
					array
					(
						'id'      => 'meta_color',
						'label'   => __( 'Meta color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Color used to display the author metadata (job position, company...).', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'bio_size',
						'label'   => __( 'Bio font size', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Font size used to display the author bio.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'biggest',
								'label' => __( 'Biggest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'biggest',
							),
							array
							(
								'id'    => 'bigger',
								'label' => __( 'Bigger', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'bigger',
							),
							array
							(
								'id'    => 'big',
								'label' => __( 'Big', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'big',
							),
							array
							(
								'id'    => 'normal',
								'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'normal',
							),
							array
							(
								'id'    => 'small',
								'label' => __( 'Small', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'small',
							),
							array
							(
								'id'    => 'smaller',
								'label' => __( 'Smaller', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smaller',
							),
							array
							(
								'id'    => 'smallest',
								'label' => __( 'Smallest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smallest',
							),
						),
					),
					array
					(
						'id'      => 'bio_color',
						'label'   => __( 'Bio color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Color used to display the author bio.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'bio_align',
						'label'   => __( 'Bio text align', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Text alignment to display the author bio.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'justify',
								'label' => __( 'Justify', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'justify',
							),
							array
							(
								'id'    => 'left',
								'label' => __( 'Left', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'left',
							),
							array
							(
								'id'    => 'right',
								'label' => __( 'Right', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'right',
							),
                            array
                            (
                                'id'    => 'center',
                                'label' => __( 'Center', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                                'value' => 'center',
                            ),
						),
					),
					array
					(
						'id'      => 'bio_style',
						'label'   => __( 'Bio text style', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Text style to display the author bio.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'normal',
								'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'normal',
							),
							array
							(
								'id'    => 'italics',
								'label' => __( 'Italics', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'italics',
							),
							array
							(
								'id'    => 'bold',
								'label' => __( 'Bold', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'bold',
							),
							array
							(
								'id'    => 'itbo',
								'label' => __( 'Italics-Bold', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'itbo',
							),
						),
					),
					array
					(
						'id'      => 'show_icons',
						'label'   => __( 'Show social icons', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to show the social media icons.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'icons_size',
						'label'   => __( 'Social icons size', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The size of the social media icons.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => '',
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'biggest',
								'label' => __( 'Biggest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'biggest',
							),
							array
							(
								'id'    => 'bigger',
								'label' => __( 'Bigger', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'bigger',
							),
							array
							(
								'id'    => 'big',
								'label' => __( 'Big', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'big',
							),
							array
							(
								'id'    => 'normal',
								'label' => __( 'Normal', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'normal',
							),
							array
							(
								'id'    => 'small',
								'label' => __( 'Small', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'small',
							),
							array
							(
								'id'    => 'smaller',
								'label' => __( 'Smaller', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smaller',
							),
							array
							(
								'id'    => 'smallest',
								'label' => __( 'Smallest', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'smallest',
							),
						),
					),
					array
					(
						'id'      => 'icons_color',
						'label'   => __( 'Social icons color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Color used to display the social media icions.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'icons_style',
						'label'   => __( 'Social icons style', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The styling used to display the social media icons.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'default',
								'label' => __( 'Default', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'default',
							),
							array
							(
								'id'    => 'squared',
								'label' => __( 'Squared', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'squared',
							),
							array
							(
								'id'    => 'circled',
								'label' => __( 'Circled', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'circled',
							),
							array
							(
								'id'    => 'boxed',
								'label' => __( 'Boxed', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'boxed',
							),
							array
							(
								'id'    => 'branded',
								'label' => __( 'Branded', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded',
							),
							array
							(
								'id'    => 'branded-squared',
								'label' => __( 'Branded squared', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded-squared',
							),
							array
							(
								'id'    => 'branded-squared-reverse',
								'label' => __( 'Branded squared reverse', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded-squared-reverse',
							),
							array
							(
								'id'    => 'branded-circled',
								'label' => __( 'Branded circled', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded-circled',
							),
							array
							(
								'id'    => 'branded-circled-reverse',
								'label' => __( 'Branded circled reverse', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded-circled-reverse',
							),
							array
							(
								'id'    => 'branded-boxed',
								'label' => __( 'Branded boxed', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'branded-boxed',
							),
						),
					),
					array
					(
						'id'      => 'bottom_bg',
						'label'   => __( 'Bottom bg color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The color used to fill the background of the bottom section on a "ribbon" layout.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
					array
					(
						'id'      => 'bottom_border',
						'label'   => __( 'Bottom border', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Width of the border to add at the top of bottom section on a"ribbon" layout.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'thin',
								'label' => __( 'Thin', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'thin',
							),
							array
							(
								'id'    => 'thick',
								'label' => __( 'Thick', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'thick',
							),
							array
							(
								'id'    => 'none',
								'label' => __( 'None', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => 'none',
							),
						),
					),
					array
					(
						'id'      => 'bottom_border_color',
						'label'   => __( 'Bottom border color', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'The color of the border to add at the top of bottom section on a"ribbon" layout.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'premium' => $this->premium_setting_tip(),
						'type'    => 'colorpicker',
					),
				),
			),
		),
	),
	array
	(
		'key'      => $slug . '_strings',
		'slug'     => 'labels',
		'label'    => __( 'Labels', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => array( $this, 'validate_strings_tab' ),
		'sections' => array
		(
			array
			(
				'id'       => 'frontend_strings',
				'label'    => __( 'Frontend labels', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => __( 'Customize the text displayed on the frontend to your liking or your language.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_description',
				'fields'   => array
				(
                    array
                    (
                        'id'          => 'headline',
                        'label'       => __( 'Headline', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
                        'placeholder' => 'About the author',
                        'type'        => 'text',
                    ),
					array
					(
						'id'          => 'at',
						'label'       => __( 'at', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'at',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'web',
						'label'       => __( 'Website', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'Web',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'more_posts',
						'label'       => __( '+ posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => '+ posts',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'bio',
						'label'       => __( 'Bio', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'Bio',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'about_the_author',
						'label'       => __( 'About the author', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'About the author',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'related_posts',
						'label'       => __( 'Related posts', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'Related posts',
						'type'        => 'text',
					),
					array
					(
						'id'          => 'no_related_posts',
						'label'       => __( 'No related posts found', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => 'This author does not have any more posts.',
						'type'        => 'text',
					),
				),
			),
		),
	),
	array
	(
		'key'      => $slug . '_license',
		'slug'     => 'license',
		'label'    => __( 'License', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => array( $this, 'validate_license_tab' ),
		'sections' => array
		(
			array
			(
				'id'       => 'license_credentials',
				'label'    => __( 'Credentials', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => sprintf( __( 'Insert your license credentials to make the plugin work, you will find them by logging in %sto your account%s.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ), '<a href="https://molongui.amitzy.com/my-account/" target="_blank">', '</a>' ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'          => $this->config['db']['activation_key'],
						'label'       => __( 'License Key', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'         => __( 'The key we provided upon premium plugin purchase.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => '',
						'type'        => 'text',
						'icon'        => array
						(
							'position' => 'right',
							'type'     => 'status',
						),
					),
					array
					(
						'id'          => $this->config['db']['activation_email'],
						'label'       => __( 'License email', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'        => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'         => __( 'The email you used to purchase the premium license.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'placeholder' => '',
						'type'        => 'text',
						'icon'        => array
						(
							'position' => 'right',
							'type'     => 'status',
						),
					),
				),
			),
			array
			(
				'id'       => 'license_deactivation',
				'label'    => __( 'Deactivation', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'desc'     => sprintf( __( 'Choose whether to deactivate the licence key upon plugin deactivation. Deactivating the license releases it so it can be used on another website but also removes it from this one, so should you reactivate the plugin, you will need to set again your credentials. %sRegardless of the value of this setting, the license will be released when uninstalling the plugin.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ), '<br>' ),
				'callback' => 'render_description',
				'fields'   => array
				(
					array
					(
						'id'      => 'keep_license',
						'label'   => __( 'Keep on deactivation', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Whether to keep license credentials upon plugin deactivation.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'type'    => 'select',
						'options' => array
						(
							array
							(
								'id'    => 'yes',
								'label' => __( 'Yes', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '1',
							),
							array
							(
								'id'    => 'no',
								'label' => __( 'No', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
								'value' => '0',
							),
						),
					),
					array
					(
						'id'      => 'deactivate_license',
						'label'   => __( 'Deactivate license', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'desc'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'tip'     => __( 'Deactivates your premium license so you can use it on another installation.', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
						'type'    => 'button',
						'args'    => array
						(
							'id'    => 'deactivate_license_button',
							'label' => __( 'Deactivate now', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
							'class' => '',
						),
					),
				),
			),
		),
	),
	array
	(
		'key'      => $slug . '_support',
		'slug'     => 'support',
		'label'    => __( 'Support', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => '',
		'sections' => array
		(
			array
			(
				'id'       => 'section_support',
				'label'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_page',
				'cb_args'  => MOLONGUI_AUTHORSHIP_DIR . '/admin/views/html-admin-page-support.php',
			),
		),
	),
	array
	(
		'key'      => $slug . '_about',
		'slug'     => 'about',
		'label'    => __( 'About', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
		'callback' => '',
		'sections' => array
		(
			array
			(
				'id'       => 'section_about',
				'label'    => __( '', MOLONGUI_AUTHORSHIP_TEXT_DOMAIN ),
				'callback' => 'render_page',
				'cb_args'  => MOLONGUI_AUTHORSHIP_DIR . '/admin/views/html-admin-page-about.php',
			),
		),
	),
);