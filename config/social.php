<?php

/**
 * List of available social networks.
 *
 * This file holds all the social networks the plugin handles.
 *
 * IMPORTANT: When adding/removing social networks, the following files must be edited accordingly:
 *
 *      includes/class-plugin-activator.php
 *      admin/class-plugin-admin.php
 *      config/admin-settings.php
 *      .assets/public/less/fontello.less
 *      .assets/premium/public/less/molongui-authorship-premium.less
 *
 * This file is read like:
 *
 *      $config = include dirname( plugin_dir_path( __FILE__ ) ) . "/config/social.php";
 *
 * @author     Amitzy
 * @category   Plugin
 * @package    Molongui_Authorship
 * @subpackage Molongui_Authorship/config
 * @since      1.3.5
 * @version    1.3.6
 */

// Deny direct access to this file
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Parameters explanation.
 *
 * 'id' => array(   Social network id.
 *    'name'        Human readable social network name.
 *    'url'         Social network profile page URL.
 *    'username'    Where the username is placed into the social network profile page URL.
 *    'premium'     Whether it is a premium feature.
 * ),
 */

return array(
    'facebook' => array(
        'name'     => 'Facebook',
        'url'      => 'https://www.facebook.com/your_username',
        'color'    => '#3B5998',
        'premium'  => false,
    ),
    'twitter' => array(
        'name'     => 'Twitter',
        'url'      => 'https://www.twitter.com/your_username',
        'color'    => '#1DA1F2',
        'premium'  => false,
    ),
    'linkedin' => array(
        'name'     => 'Linkedin',
        'url'      => 'https://www.linkedin.com/pub/your_username',
        'color'    => '#0077B5',
        'premium'  => true,
    ),
    'googleplus' => array(
        'name'     => 'Google+',
        'url'      => 'https://plus.google.com/+your_username',
        'color'    => '#DC4E41',
        'premium'  => false,
    ),
    'youtube' => array(
        'name'     => 'Youtube',
        'url'      => 'https://www.youtube.com/user/your_username',
        'color'    => '#CD201F',
        'premium'  => false,
    ),
    'pinterest' => array(
        'name'     => 'Pinterest',
        'url'      => 'https://www.pinterest.com/your_username',
        'color'    => '#BD081C',
        'premium'  => false,
    ),
    'tumblr' => array(
        'name'     => 'Tumblr',
        'url'      => 'https://your_username.tumblr.com',
        'color'    => '#36465D',
        'premium'  => false,
    ),
    'instagram' => array(
        'name'     => 'Instagram',
        'url'      => 'https://instagram.com/your_username',
        'color'    => '#E4405F',
        'premium'  => false,
    ),
    'slideshare' => array(
        'name'     => 'Slideshare',
        'url'      => 'https://www.slideshare.net/your_username',
        'color'    => '#f7941e',
        'premium'  => true,
    ),
    'xing' => array(
        'name'     => 'Xing',
        'url'      => 'https://www.xing.com/profile/your_username',
        'color'    => '#005A5F',
        'premium'  => true,
    ),
    'renren' => array(
        'name'     => 'Renren',
        'url'      => 'https://www.renren.com/your_username',
        'color'    => '#005EAC',
        'premium'  => false,
    ),
    'vk' => array(
        'name'     => 'Vk',
        'url'      => 'https://www.vk.com/your_username',
        'color'    => '#6383A8',
        'premium'  => false,
    ),
    'flickr' => array(
        'name'     => 'Flickr',
        'url'      => 'https://www.flickr.com/photos/your_username',
        'color'    => '#0063DC',
        'premium'  => false,
    ),
    'vine' => array(
        'name'     => 'Vine',
        'url'      => 'https://vine.co/your_username',
        'color'    => '#11B48A',
        'premium'  => false,
    ),
    'meetup' => array(
        'name'     => 'Meetup',
        'url'      => 'https://www.meetup.com/your_username',
        'color'    => '#E2373C',
        'premium'  => false,
    ),
    'weibo' => array(
        'name'     => 'Sina Weibo',
        'url'      => 'https://www.weibo.com/your_username',
        'color'    => '#E6162D',
        'premium'  => false,
    ),
    'deviantart' => array(
        'name'     => 'DeviantArt',
        'url'      => 'https://your_username.deviantart.com',
        'color'    => '#05CC47',
        'premium'  => false,
    ),
    'stumbleupon' => array(
        'name'     => 'StumbleUpon',
        'url'      => 'https://stumbleupon.com/stumbler/your_username',
        'color'    => '#EB4924',
        'premium'  => false,
    ),
    'myspace' => array(
        'name'     => 'Myspace',
        'url'      => 'https://myspace.com/your_username',
        'color'    => '#030303',
        'premium'  => false,
    ),
    'yelp' => array(
        'name'     => 'Yelp',
        'url'      => 'https://www.yelp.com/biz/your_username',
        'color'    => '#C41200',
        'premium'  => true,
    ),
    'mixi' => array(
        'name'     => 'Mixi',
        'url'      => 'https://mixi.jp/view_community.pl?id=your_username',
        'color'    => '#E0C074',
        'premium'  => false,
    ),
    'soundcloud' => array(
        'name'     => 'SoundCloud',
        'url'      => 'https://soundcloud.com/your_username',
        'color'    => '#FF3300',
        'premium'  => false,
    ),
    'lastfm' => array(
        'name'     => 'Last.fm',
        'url'      => 'https://www.last.fm/user/your_username',
        'color'    => '#D51007',
        'premium'  => false,
    ),
    'foursquare' => array(
        'name'     => 'Foursquare',
        'url'      => 'https://foursquare.com/your_username',
        'color'    => '#F94877',
        'premium'  => false,
    ),
    'spotify' => array(
        'name'     => 'Spotify',
        'url'      => 'https://play.spotify.com/user/your_username',
        'color'    => '#1ED760',
        'premium'  => false,
    ),
    'vimeo' => array(
        'name'     => 'Vimeo',
        'url'      => 'https://vimeo.com/your_username',
        'color'    => '#1AB7EA',
        'premium'  => false,
    ),
    'dailymotion' => array(
        'name'     => 'Dailymotion',
        'url'      => 'https://www.dailymotion.com/your_username',
        'color'    => '#0066DC',
        'premium'  => false,
    ),
    'reddit' => array(
        'name'     => 'Reddit',
        'url'      => 'https://www.reddit.com/user/your_username',
        'color'    => '#FF4500',
        'premium'  => false,
    ),
    'skype' => array(
        'name'     => 'Skype',
        'url'      => 'skype:your_username?call',
        'color'    => '#00AFF0',
        'premium'  => false,
    ),
    'periscope' => array(
        'name'     => 'Periscope',
        'url'      => 'https://www.pscp.tv/your_username',
        'color'    => '#40A4C4',
        'premium'  => false,
    ),
    'askfm' => array(
        'name'     => 'ASKfm',
        'url'      => 'https://ask.fm/your_username',
        'color'    => '#DB3552',
        'premium'  => false,
    ),
    'livejournal' => array(
        'name'     => 'Live Journal',
        'url'      => 'https://your_username.livejournal.com',
        'color'    => '#00B0EA',
        'premium'  => false,
    ),
    'blogger' => array(
        'name'     => 'Blogger',
        'url'      => '',
        'color'    => '#F38936',
        'premium'  => false,
    ),
    'taringa' => array(
        'name'     => 'Taringa!',
        'url'      => 'https://www.taringa.net/your_username',
        'color'    => '#005dab',
        'premium'  => false,
    ),
    'odnoklassniki' => array(
        'name'     => 'Odnoklassniki',
        'url'      => 'https://ok.ru/your_username',
        'color'    => '#F4731C',
        'premium'  => false,
    ),
    'bebee' => array(
        'name'     => 'beBee',
        'url'      => 'https://www.bebee.com/profile/your_username',
        'color'    => '#f28f16',
        'premium'  => true,
    ),
    'livestream' => array(
        'name'     => 'Livestream',
        'url'      => 'https://livestream.com/accounts/your_username',
        'color'    => '#cf202e',
        'premium'  => false,
    ),
    'slides' => array(
        'name'     => 'Slides',
        'url'      => 'https://slides.com/your_username',
        'color'    => '#E4637C',
        'premium'  => false,
    ),
    'quora' => array(
        'name'     => 'Quora',
        'url'      => 'https://quora.com/profile/your_username',
        'color'    => '#B92B27',
        'premium'  => false,
    ),
    'tinder' => array(
        'name'     => 'Tinder',
        'url'      => '',
        'color'    => '#FE5268',
        'premium'  => false,
    ),
    'plurk' => array(
        'name'     => 'Plurk',
        'url'      => 'http://www.plurk.com/your_username',
        'color'    => '#FF6B6B',
        'premium'  => false,
    ),
    'reverbnation' => array(
        'name'     => 'Reverbnation',
        'url'      => 'https://www.reverbnation.com/your_username',
        'color'    => '#E43526',
        'premium'  => true,
    ),
    'buzzfeed' => array(
        'name'     => 'BuzzFeed',
        'url'      => 'https://www.buzzfeed.com/your_username',
        'color'    => '#EE3322',
        'premium'  => false,
    ),
    'everplaces' => array(
        'name'     => 'Everplaces',
        'url'      => 'https://everplaces.com/your_username',
        'color'    => '#FA4B32',
        'premium'  => false,
    ),
    'patreon' => array(
        'name'     => 'Patreon',
        'url'      => 'https://www.patreon.com/your_username',
        'color'    => '#E6461A',
        'premium'  => true,
    ),
    'eventbrite' => array(
        'name'     => 'Eventbrite',
        'url'      => 'https://www.eventbrite.es/o/your_username',
        'color'    => '#F6682F',
        'premium'  => true,
    ),
    'etsy' => array(
        'name'     => 'Etsy',
        'url'      => 'https://www.etsy.com/shop/your_username',
        'color'    => '#F45800',
        'premium'  => true,
    ),
    'viadeo' => array(
        'name'     => 'Viadeo',
        'url'      => 'https://viadeo.com/profile/your_username',
        'color'    => '#F88D2D',
        'premium'  => true,
    ),
    'goodreads' => array(
        'name'     => 'Goodreads',
        'url'      => 'https://www.goodreads.com/user/show/your_username',
        'color'    => '#663300',
        'premium'  => false,
    ),
    'whatsapp' => array(
        'name'     => 'WhatsApp',
        'url'      => 'https://chat.whatsapp.com/your_group_chat_id',
        'color'    => '#25D366',
        'premium'  => false,
    ),
    'telegram' => array(
        'name'     => 'Telegram',
        'url'      => 'https://t.me/joinchat/your_channel_id',
        'color'    => '#2CA5E0',
        'premium'  => false,
    ),
    'draugiemlv' => array(
        'name'     => 'Draugiem.lv',
        'url'      => 'https://www.draugiem.lv/your_username',
        'color'    => '#FF6600',
        'premium'  => false,
    ),
    'spreaker' => array(
        'name'     => 'Spreaker',
        'url'      => 'https://www.spreaker.com/user/your_username',
        'color'    => '#F5C300',
        'premium'  => false,
    ),
    'glassdoor' => array(
        'name'     => 'Glassdoor',
        'url'      => 'https://www.glassdoor.com/Overview/your_username',
        'color'    => '#7CB228',
        'premium'  => true,
    ),
    'houzz' => array(
        'name'     => 'Houzz',
        'url'      => 'https://www.houzz.es/pro/your_username',
        'color'    => '#7AC142',
        'premium'  => false,
    ),
    'tripadvisor' => array(
        'name'     => 'TripAdvisor',
        'url'      => 'https://www.tripadvisor.es/members/your_username',
        'color'    => '#589442',
        'premium'  => false,
    ),
    'upwork' => array(
        'name'     => 'Upwork',
        'url'      => 'https://www.upwork.com/o/profiles/users/your_username',
        'color'    => '#6FDA44',
        'premium'  => false,
    ),
    'gumtree' => array(
        'name'     => 'Gumtree',
        'url'      => 'https://www.gumtree.com/sellerads/your_username',
        'color'    => '#72EF36',
        'premium'  => false,
    ),
    'speakerdeck' => array(
        'name'     => 'Speaker Deck',
        'url'      => 'https://speakerdeck.com/your_username',
        'color'    => '#339966',
        'premium'  => false,
    ),
    'medium' => array(
        'name'     => 'Medium',
        'url'      => 'https://medium.com/your_username',
        'color'    => '#00AB6B',
        'premium'  => false,
    ),
    'runkeeper' => array(
        'name'     => 'Runkeeper',
        'url'      => 'https://runkeeper.com/user/your_username',
        'color'    => '#31a4d9',
        'premium'  => false,
    ),
    'deezer' => array(
        'name'     => 'Deezer',
        'url'      => 'http://www.deezer.com/profile/your_username',
        'color'    => '#2DC9D7',
        'premium'  => false,
    ),
    'bandcamp' => array(
        'name'     => 'Bandcamp',
        'url'      => 'https://your_username.bandcamp.com/',
        'username' => 'before',
        'color'    => '#408294',
        'premium'  => false,
    ),
    'kaggle' => array(
        'name'     => 'Kaggle',
        'url'      => 'https://www.kaggle.com/your_username',
        'color'    => '#20BEFF',
        'premium'  => false,
    ),
    'superuser' => array(
        'name'     => 'superuser',
        'url'      => 'https://superuser.com/users/your_username',
        'color'    => '#2EACE3',
        'premium'  => false,
    ),
    'teespring' => array(
        'name'     => 'Teespring',
        'url'      => 'https://teespring.com/stores/your_shop_id',
        'color'    => '#39ACE6',
        'premium'  => true,
    ),
    '500px' => array(
        'name'     => '500px',
        'url'      => 'https://500px.com/your_username',
        'color'    => '#0099E5',
        'premium'  => false,
    ),
    'storify' => array(
        'name'     => 'Storify',
        'url'      => 'https://storify.com/your_username',
        'color'    => '#3A98D9',
        'premium'  => false,
    ),
    'coderwall' => array(
        'name'     => 'Coderwall',
        'url'      => 'https://coderwall.com/your_username',
        'color'    => '#3E8DCC',
        'premium'  => false,
    ),
    'jsfiddle' => array(
        'name'     => 'JSFiddle',
        'url'      => 'https://jsfiddle.net/user/your_username',
        'color'    => '#4679a4',
        'premium'  => false,
    ),
    'ifixit' => array(
        'name'     => 'IfixIT',
        'url'      => 'https://www.ifixit.com/User/your_username',
        'color'    => '#0071CE',
        'premium'  => false,
    ),
    'mixcloud' => array(
        'name'     => 'Mixcloud',
        'url'      => 'https://www.mixcloud.com/your_username',
        'color'    => '#314359',
        'premium'  => false,
    ),
    'toptal' => array(
        'name'     => 'TopTal',
        'url'      => 'https://www.toptal.com/resume/your_username',
        'color'    => '#3863A0',
        'premium'  => true,
    ),
    'designernews' => array(
        'name'     => 'Designer News',
        'url'      => 'https://www.designernews.co/users/your_username',
        'color'    => '#2D72D9',
        'premium'  => false,
    ),
    'behance' => array(
        'name'     => 'Behance',
        'url'      => 'https://www.behance.net/your_username',
        'color'    => '#1769FF',
        'premium'  => true,
    ),
    'twitch' => array(
        'name'     => 'Twitch',
        'url'      => 'https://www.twitch.tv/your_username',
        'color'    => '#6441A5',
        'premium'  => false,
    ),
    'readthedocs' => array(
        'name'     => 'Read the Docs',
        'url'      => 'https://readthedocs.org/profiles/your_username',
        'color'    => '#8CA1AF',
        'premium'  => false,
    ),
    'coursera' => array(
        'name'     => 'Coursera',
        'url'      => 'https://www.coursera.org/instructor/your_username',
        'color'    => '#757575',
        'premium'  => false,
    ),
    'googleplay' => array(
        'name'     => 'Google Play',
        'url'      => 'https://play.google.com/store/apps/dev?id=your_username',
        'color'    => '#607D8B',
        'premium'  => false,
    ),
    'styleshare' => array(
        'name'     => 'StyleShare',
        'url'      => 'https://www.stylesha.re/collections/your_username',
        'color'    => '#231F20',
        'premium'  => false,
    ),
    'github' => array(
        'name'     => 'GitHub',
        'url'      => 'https://github.com/your_username',
        'color'    => '#181717',
        'premium'  => false,
    ),
    'wikipedia' => array(
        'name'     => 'Wikipedia',
        'url'      => 'https://wikipedia.org/wiki/your_profile',
        'color'    => '#000000',
        'premium'  => false,
    ),
    'ello' => array(
        'name'     => 'Ello',
        'url'      => 'https://ello.co/',
        'username' => 'after',
        'color'    => '#000000',
        'premium'  => false,
    ),
    'stitcher' => array(
        'name'     => 'Stitcher',
        'url'      => 'https://www.stitcher.com/podcast/your_username',
        'color'    => '#000000',
        'premium'  => false,
    ),
    'codepen' => array(
        'name'     => 'CodePen',
        'url'      => 'http://codepen.io/your_username',
        'color'    => '#000000',
        'premium'  => false,
    ),
    'stackoverflow' => array(
        'name'     => 'Stack Overlfow',
        'url'      => 'https://stackoverflow.com/users/your_username',
        'color'    => '#FE7A16',
        'premium'  => false,
    ),
    'itunes' => array(
        'name'     => 'iTunes',
        'url'      => '',
        'color'    => '#333333',
        'premium'  => true,
    ),/*
    'uplike' => array(
        'name'     => 'Uplike',
        'url'      => 'uplike.com/your_username',
        'color'    => '#674CA9',
        'premium'  => false,
    ),
    'amazon' => array(
        'name'     => 'Amazon',
        'url'      => 'https://www.amazon.com/your_shop_id',
        'color'    => '#FF9900',
        'premium'  => true,
    ),
    'ebay' => array(
        'name'     => 'eBay',
        'url'      => 'https://www.ebay.com/usr/your_shop_id',
        'color'    => '#E53238',
        'premium'  => true,
    ),
    'tuenti' => array(
        'name'     => 'Tuenti',
        'url'      => 'https://comunidad.tuenti.es/members/your_username',
        'color'    => '#2b2d30',
        'premium'  => false,
    ),
    '' => array(
        'name'     => '',
        'url'      => '',
        'color'    => '#',
        'premium'  => false,
    ),*/
);