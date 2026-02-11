<?php
/* Custom Colors: Baskerville */

//Background
add_color_rule( 'bg', '#f1f1f1', array(
	//No Contrast
	array( 'body,
		.infinite-container', 'background-color' ),

	array( '.posts .post-meta', 'background-color', 0.1 ),

	array( '.comment-inner', 'background-color', 0.2 ),
) );

add_color_rule( 'txt', '#2b3542', array(

	// No Contrast
	array( '.comment-edit-link,
	 		.comment-reply-link,
		.comment-form input[type="text"]:focus,
		.comment-form input[type="email"]:focus,
		.comment-form input[type="url"]:focus,
		.comment-form textarea:focus,
		div#respond textarea:focus,
		.form-submit #submit,
		.posts-navigation a,
		#infinite-handle span,
		.wrapper .search-field:focus,
		.author-info .author-links a', 'background-color' ),

	array( '.posts-navigation a:hover,
		.posts-navigation a:focus,
		#infinite-handle span:hover,
		#infinite-handle span:focus', 'background-color', '-1.0' ),

	array( '.bg-dark,
		.bg-graphite', 'background-color', '#eeeeee', 14 ),

	// menu and dropdowns
	array( '.main-navigation ul ul li', 'background-color', '#eeeeee', 12 ),
	array( '.main-navigation ul li > ul:before', 'border-bottom-color', '#eeeeee', 12 ),

	array( '.main-navigation ul ul ul li', 'background-color', '#eeeeee', 10 ),

	array( '.main-navigation ul ul ul ul li,
		.main-navigation ul ul ul ul ul li', 'background-color', '#eeeeee', 8 ),

	// footer search
	array( '.footer .widget_search .search-field', 'background-color', '#eeeeee', 16 ),

	array( '.footer .search-field:focus', 'background-color', '#eeeeee', 8 ),

	array( '.footer .widget',
		'border-top-color', '-2.0' ),

	// Tag cloud - sidebar
	array( '.tagcloud a,
	.widget_tag_cloud a,
	.wp_widget_tag_cloud a', 'background-color', '#ffffff', 3 ),

	// Contrast
	array( '.single .post-meta-container', 'background-color', '#ffffff', 1.8 ),

	array( '.posts .format-aside .post-content,
		.posts .format-link .post-content,
		.posts .format-quote .post-content,
		.posts .format-status .post-content,
		.post .mejs-container.mejs-audio,
		.page .mejs-container.mejs-audio', 'background-color', '#ffffff', 2 ),

	array( '.post-content input[type="submit"],
		.post-content input[type="reset"],
		.post-content input[type="button"],
		.widget-content input[type="submit"],
		.widget-content input[type="reset"],
		.widget-content input[type="button"],
		.post-content pre', 'background-color', '#ffffff', 3 ),


	array( '.post-header .post-title,
		.post-header .post-title a,
		.single .format-quote .post-content blockquote > *,
		.comments-title,
		.comment-author .fn,
		.comment-author .fn a,
		.pingbacks-title,
		.comment-reply-title', 'color', '#ffffff', 3 ),

	array( '.page-title', 'color', 'bg' ),

	array( '.post .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-total,
		.page .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-total,
		.post .sticky-post', 'background-color', '-1.0' ),

	array( '.post .sticky-post:after', 'border-left-color', '-1.0' ),
	array( '.post .sticky-post:after', 'border-right-color', '-1.0' ),

	array( '.post .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,
		.page .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,
		.post .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-loaded,
		.page .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-loaded', 'background-color', '-2.0' ),

) );

add_color_rule( 'link', '#13c4a5', array(

	// No Contrast
	array( '.post-content fieldset legend,
		.widget-content fieldset legend,
		.comment.bypostauthor:after,
		.comment-edit-link:hover,
		.comment-edit-link:focus,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.pingbacklist .pingback a:hover,
		.pingbacklist .pingback a:focus,
		.form-submit #submit:hover,
		.form-submit #submit:focus,
		.author-link:hover:before,
		.author-link:focus:before,
		.author-info .author-links a:hover,
		.author-info .author-links a:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.widget_tag_cloud a:hover,
		.widget_tag_cloud a:focus,
		.wp_widget_tag_cloud a:hover,
		.wp_widget_tag_cloud a:focus,
		.footer .tagcloud a:hover,
		.footer .tagcloud a:focus,
		.footer .widget_tag_cloud a:hover,
		.footer .widget_tag_cloud a:focus,
		.footer .wp_widget_tag_cloud a:hover,
		.footer .wp_widget_tag_cloud a:focus,
		.post-content input[type="submit"]:hover,
		.post-content input[type="submit"]:focus,
		.post-content input[type="reset"]:hover,
		.post-content input[type="reset"]:focus,
		.post-content input[type="button"]:hover,
		.post-content input[type="button"]:focus,
		.widget-content input[type="submit"]:hover,
		.widget-content input[type="submit"]:focus,
		.widget-content input[type="reset"]:hover,
		.widget-content input[type="reset"]:focus,
		.widget-content input[type="button"]:hover,
		.widget-content input[type="button"]:focus', 'background-color' ),

	array( '.post .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
		.page .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
		.post .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-current,
		.page .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-current', 'background-color', 'txt', 2 ),

	array( '.entry-author:after', 'border-left-color', 'txt', 1 ),
	array( '.entry-author:after', 'border-right-color', 'txt', 1 ),
	array( '.entry-author:before', 'background-color', 'txt', 1 ),

	//Contrast - against white
	array( 'body a,
		body a:hover,
		body a:focus,
		.post-header .post-title a:hover,
		.post-header .post-title a:focus,
		.posts .post-meta a:hover,
		.posts .post-meta a:focus,
		.comment-author .fn a:hover,
		.comment-author .fn a:focus,
		.author-info h4 a:hover,
		.author-info h4 a:focus,
		#content #menu_widget a,
		#wp-calendar a,
		.widget-content ul li:before,
		.error404 .widget_recent_entries li:before,
		.widget_flickr #flickr_badge_uber_wrapper a:hover,
		.widget_flickr #flickr_badge_uber_wrapper a:link,
		.widget_flickr #flickr_badge_uber_wrapper a:active,
		.widget_flickr #flickr_badge_uber_wrapper a:visited,
		#infinite-footer .blog-info a:hover', 'color', '#ffffff' ),

	array( '.posts .format-link .link-header h2 a, .author-link, .author-link:hover', 'color', 'txt' ),

	array( '.site-title a:hover,
            .site-title a:focus,
            .jetpack-social-navigation a:hover,
            .jetpack-social-navigation a:focus', 'color', '#555555', 4 ),

	array( '.posts .post-meta a', 'color', '#ffffff', 3 ),

	// Contrast against footer background
	array( 'body .footer a,
		.footer #wp-calendar a', 'color', '#000000' ),

) );

add_color_rule( 'extra', '#ffffff', array(

	// Contrast
	array( '.posts-navigation a,
		.post .mejs-container.mejs-audio .mejs-controls .mejs-playpause-button button:before,
		.page .mejs-container.mejs-audio .mejs-controls .mejs-playpause-button button:before,
		.post .mejs-container.mejs-audio .mejs-controls .mejs-volume-button button:before,
		.page .mejs-container.mejs-audio .mejs-controls .mejs-volume-button button:before,
		.post .mejs-container.mejs-audio .mejs-controls .mejs-mute button:before,
		.page .mejs-container.mejs-audio .mejs-controls .mejs-mute button:before,
		.post .mejs-container.mejs-audio .mejs-controls .mejs-unmute button:before,
		.page .mejs-container.mejs-audio .mejs-controls .mejs-unmute button:before,
		.nav-next a:hover,
		.nav-previous a:hover,
		.nav-next a:focus,
		.nav-previous a:focus,
		.post-edit-link:hover,
		.post-edit-link:focus,
		.single .post-meta p a:hover,
		.single .post-meta p a:focus,
		.author-title,
		.author-bio,
		.author-info .author-links a', 'color', 'txt' ),

	array( '.single .post-meta p,
		.single .post-meta p a,
		.single .post-meta time,
		.single .post-meta > a,
		.post-navigation a,
		.entry-author .author-bio,
		.author-link:before,
		.entry-author .author-title,
		.post .sticky-post i.fa,
		.page-title', 'color', 'txt', 0.7 ),

	array( '.footer .widget-content,
		.footer #wp-calendar,
		.footer #wp-calendar thead,
		.footer #wp-calendar tfoot a', 'color', 0.6 ),

	array( '.author-link:hover:before,
		.author-link:focus:before,
		.author-info .author-links a:hover,
		.author-info .author-links a:focus,
		.comment.bypostauthor:after,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.widget_tag_cloud a:hover,
		.widget_tag_cloud a:focus,
		.wp_widget_tag_cloud a:hover,
		.wp_widget_tag_cloud a:focus,
		.footer .tagcloud a:hover,
		.footer .tagcloud a:focus,
		.footer .widget_tag_cloud a:hover,
		.footer .widget_tag_cloud a:focus,
		.footer .wp_widget_tag_cloud a:hover,
		.footer .wp_widget_tag_cloud a:focus,
		.comment-edit-link:hover:before,
		.comment-edit-link:focus:before,
		.comment-reply-link:hover:before,
		.comment-reply-link:focus:before', 'color', 'link' ),

	array( '.footer .tagcloud a,
		.footer .widget_tag_cloud a,
		.footer .wp_widget_tag_cloud a', 'color', '#333333' ),

	array( '.double-bounce1,
		.double-bounce2', 'background-color', 'bg' ),
) );


add_color_rule( 'fg1', '#ffffff', array(

) );

add_color_rule( 'fg2', '#ffffff', array(

) );


//Extra CSS
function baskerville_extra_css() { ?>

	.header-search-block .search-field::-webkit-input-placeholder {
		color: rgba(255,255,255,0.7);
	}

	.header-search-block .search-field:-moz-placeholder {
		color: rgba(255,255,255,0.7);
	}

	.header-search-block .search-field::-moz-placeholder {
		color: rgba(255,255,255,0.7);
	}

	.header-search-block .search-field:-ms-input-placeholder {
		color: rgba(255,255,255,0.7);
	}

	.main-navigation li > a,
	.main-navigation ul ul a,
	.main-navigation ul ul ul a,
	.main-navigation ul ul ul ul a,
	.main-navigation ul ul ul ul ul a {
		color: rgba(255,255,255,0.6);
	}

	.main-navigation li:before {
		color: rgba(255,255,255,0.3);
	}

	.main-navigation .has-children > a:after,
	.main-navigation .menu-item-has-children > a:after,
	.main-navigation .page_item_has_children > a:after {
		border-top-color: rgba(255,255,255,0.6);
	}

	.single .post-meta-container:before,
	.author-links a {
		background-color: rgba(255,255,255,0.2);
	}

	.posts .format-status .post-content p {
		text-shadow: rgba(0,0,0,0.3);
	}

	.nav-next a:hover,
	.nav-previous a:hover,
	.nav-next a:focus,
	.nav-previous a:focus,
	.post-edit-link:hover,
	.post-edit-link:focus,
	.single .post-meta p a:hover,
	.single .post-meta p a:focus {
		opacity: 0.6;
	}

	.footer .tagcloud a,
	.footer .widget_tag_cloud a,
	.footer .wp_widget_tag_cloud a {
		background-color: rgba(255,255,255,0.1);
	}

	.footer #wp-calendar thead th {
		border-color: rgba(255,255,255,0.2);
	}

	.rtl #infinite-handle span {
		border: 0;
	}

	#infinite-handle span button {
		background-color: transparent;
	}

	@media (max-width: 700px) {
		.single .post-meta {
			background-color: rgba(255,255,255,0.2);
		}
	}

<?php }
add_theme_support( 'custom_colors_extra_css', 'baskerville_extra_css' );

add_color_palette( array(
	'#353432',
	'#4e4d4a',
	'#56b2cb',
) );

add_color_palette( array(
	'#cccccc',
	'#574067',
	'#f06060'
) );

add_color_palette( array(
	'#5b7b89',
	'#1e2c30',
	'#ba2f1d'
) );

add_color_palette( array(
	'#dddddd',
	'#c33b6d',
	'#939393'
) );

add_color_palette( array(
	'#f1f1f2',
	'#5ec9c5',
	'#369f93'
) );

add_color_palette( array(
	'#d9d6c8',
	'#444444',
	'#cb6b6b'
) );
