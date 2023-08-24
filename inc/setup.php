<?php
/**
 * Main setup options
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_setup' ) ) {

	/**
	 * Default theme setup on after_setup_theme hook.
	 *
	 * @return void
	 */
	function aesthetix_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'aesthetix', get_template_directory() . '/languages' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary menu', 'aesthetix' ),
		) );

		// Set the content width in pixels, based on the theme's design and stylesheet.
		$GLOBALS['content_width'] = apply_filters( 'aesthetix_content_width', 960 );

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup for search form, comment form, and comments.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

		// Add support post formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'aesthetix_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 180,
			'width'       => 270,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Добавляем поддержку кастом header.
		add_theme_support( 'custom-header', apply_filters( 'aesthetix_custom_header_args', array(
			'default-image'      => '',
			'default-text-color' => '000000',
			'width'              => 1920,
			'height'             => 500,
			'flex-width'         => true,
			'flex-height'        => true,
		) ) );

		// Gutenberg Embeds.
		add_theme_support( 'responsive-embeds' ); 

		// Добавляем поддержку шорткодов в виджетах.
		add_filter( 'widget_text', 'do_shortcode' );

		// Убираем пустые теги.
		remove_filter( 'the_excerpt', 'wpautop' );
		remove_filter( 'the_content', 'wpautop' );
		// add_filter( 'the_content', 'wpautop', 12 );

		// Убираем meta generator.
		add_filter( 'the_generator', '__return_empty_string' );
		remove_action( 'wp_head', 'wp_generator' );

		// Отключение embed.js
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		// Удаляем фиды.
		remove_action( 'wp_head', 'feed_links', 2 ); // Ссылки основных фидов (записи, комментарии, лента новостей).
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Ссылки на доп. фиды (на рубрики, теги, таксономии).

		// Удаляем RSD, WLW ссылки, на главную, предыдущую, первую запись.
		remove_action( 'wp_head', 'rsd_link' ); // Ссылка для блог-клиентов.
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Ссылка используемая Windows Live Writer.
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Ссылка на следующий и предыдущий пост.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'index_rel_link' ); // Ссылка на главную.
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Ссылка на первый пост.
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Ссылка на родительскую страницу.
		remove_action( 'wp_head', 'wp_resource_hints', 2 ); // Удаляем dns-prefetch.

		// Отключаем emoji.
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Добавляем троеточие в excerpt.
		add_filter( 'excerpt_more', function( $more ) {
			return '...';
		});

		// Переписываем email в нижний регистр.
		add_filter( 'sanitize_email', function( $email ) {
			return strtolower( $email );
		});

		// Удаляем "Рубрика: ", "Метка: " и т.д. из заголовка архива.
		add_filter( 'get_the_archive_title', function( $title ) {
			$title = wp_strip_all_tags( $title ); // удаляем лишний span.
			return preg_replace( '~^[^:]+: ~', '', $title );
		} );

		// Убираем ссылку на https://ru.wordpress.org/ в авторизации.
		add_filter( 'login_headerurl', function( $login_header_url ) {
			return home_url(); // Или любой другой адрес.
		} );
	}
}
add_action( 'after_setup_theme', 'aesthetix_setup' );

if ( ! function_exists( 'aesthetix_enqueue_scripts' ) ) {

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	function aesthetix_enqueue_scripts() {

		// Enqueue only one font if they are the same.
		if ( get_aesthetix_options( 'root_primary_font' ) === get_aesthetix_options( 'root_secondary_font' ) ) {
			wp_enqueue_style( 'primary-font', '//fonts.googleapis.com/css2?family=' . str_replace( '\'', '', str_replace( ' ', '+', get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_primary_font' ) ) ) ) . ':wght@400;700&display=swap', array(), '1.0.0' );
		} else {
			wp_enqueue_style( 'primary-font', '//fonts.googleapis.com/css2?family=' . str_replace( '\'', '', str_replace( ' ', '+', get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_primary_font' ) ) ) ) . ':wght@400;700&display=swap', array(), '1.0.0' );
			wp_enqueue_style( 'secondary-font', '//fonts.googleapis.com/css2?family=' . str_replace( '\'', '', str_replace( ' ', '+', get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_secondary_font' ) ) ) ) . ':wght@400;700&display=swap', array(), '1.0.0' );
		}

		// Bootstrap grid.
		wp_enqueue_style( 'bootstrap-grid', get_theme_file_uri( '/assets/css/bootstrap-grid.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/bootstrap-grid.min.css' ) ) );

		// Icons.
		wp_enqueue_style( 'icons', get_theme_file_uri( '/assets/css/icons.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/icons.min.css' ) ) );

		// Основные стили. Компиляция галпом. Могут быть переопределены в дочерней.
		wp_enqueue_style( 'common-styles', get_theme_file_uri( '/assets/css/common.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/common.min.css' ) ) );

		$root_string = '';
		foreach ( get_aesthetix_customizer_roots() as $key => $root_value ) {
			$root_string .= '--' . $key . ': ' . $root_value . ';';
		}

		wp_add_inline_style( 'common-styles', ':root {' . esc_attr( $root_string ) . '}' );

		// Основные скрипты. Компиляция галпом. Могут быть переопределены в дочерней.
		wp_enqueue_script( 'common-scripts', get_theme_file_uri( '/assets/js/common.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/assets/js/common.min.js' ) ), true );

		// Комментарии.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Отключаем глобальные стили для гутенберга, если пользователь не залогинен.
		if ( ! is_user_logged_in() ) {
			wp_dequeue_style( 'global-styles' );
		}

		// Magnific.
		wp_register_style( 'magnific-styles', get_theme_file_uri( '/assets/libs/magnific-popup/magnific-popup.min.css' ), array(), filemtime( get_theme_file_path( '/assets/libs/magnific-popup/magnific-popup.min.css' ) ) );
		wp_register_script( 'magnific-scripts', get_theme_file_uri( '/assets/libs/magnific-popup/jquery.magnific-popup.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/assets/libs/magnific-popup/jquery.magnific-popup.min.js' ) ), true );

		$magnific_gallery_init = 'jQuery(function($) {
			$(".popup-gallery").each(function() {
				$(this).magnificPopup({
					delegate: "a",
					type: "image",
					gallery: {
						enabled:true
					},
					closeOnContentClick: true,
					mainClass: "mfp-with-zoom",
					zoom: {
						enabled: true,
						duration: 200,
						easing: "ease-in-out",
					},
					preload: [0, 2],
				})
			});
		});';

		// wp_add_inline_script( 'magnific-scripts', minify_js( $magnific_gallery_init ) );

		// Swiper.
		wp_register_style( 'swiper-styles', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' );
		wp_register_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array( 'jquery' ) );

		// Slick.
		wp_register_style( 'slick-styles', get_theme_file_uri( '/assets/css/slick.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/slick.min.css' ) ) );
		wp_register_script( 'slick-scripts', get_theme_file_uri( '/assets/libs/slick/slick.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/assets/libs/slick/slick.min.js' ) ), true );

		// Register feedback form scripts.
/*		wp_register_script( 'feedback-handler', get_theme_file_uri( '/assets/js/feedback-handler.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/assets/js/feedback-handler.min.js' ) ), true );
		wp_localize_script( 
			'feedback-handler',
			'feedback_handler_obj',
			array(
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'feedback-handler-nonce' ),
			)
		);*/

		// Register comment form scripts.
/*		wp_register_script( 'comments-handler', get_theme_file_uri( '/assets/js/comments-handler.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/assets/js/comments-handler.min.js' ) ), true );
		wp_localize_script( 
			'comments-handler',
			'comments_handler_obj',
			array(
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'comments-handler-nonce' ),
			)
		);*/
	}
}
add_action( 'wp_enqueue_scripts', 'aesthetix_enqueue_scripts' );

if ( ! function_exists( 'aesthetix_widgets_init' ) ) {

	/**
	 * Register widget area.
	 *
	 * @return void
	 */
	function aesthetix_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar left', 'aesthetix' ),
			'id'            => 'sidebar',
			'description'   => __( 'Add widgets in left sidebar', 'aesthetix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Sidebar right', 'aesthetix' ),
			'id'            => 'sidebar-right',
			'description'   => __( 'Add widgets in right sidebar', 'aesthetix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) {
			register_sidebar( array(
				'name'          => __( 'Header top bar left', 'aesthetix' ),
				'id'            => 'sidebar-top-left',
				'description'   => __( 'Header top sidebar left', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Header top bar right', 'aesthetix' ),
				'id'            => 'sidebar-top-right',
				'description'   => __( 'Header top sidebar right', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) {
			register_sidebar( array(
				'name'          => __( 'Footer top bar left', 'aesthetix' ),
				'id'            => 'sidebar-footer-top-left',
				'description'   => __( 'Footer top sidebar left', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer top bar right', 'aesthetix' ),
				'id'            => 'sidebar-footer-top-right',
				'description'   => __( 'Footer top sidebar right', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) {
			register_sidebar( array(
				'name'          => __( 'Footer bottom bar left', 'aesthetix' ),
				'id'            => 'sidebar-footer-bottom-left',
				'description'   => __( 'Footer bottom sidebar left', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer bottom bar right', 'aesthetix' ),
				'id'            => 'sidebar-footer-bottom-right',
				'description'   => __( 'Footer bottom sidebar right', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		if ( in_array( get_aesthetix_options( 'general_footer_type' ), array( 'footer-simple', 'footer-three-columns', 'footer-four-columns' ), true ) ) {
			register_sidebar( array(
				'name'          => __( 'First footer sidebar', 'aesthetix' ),
				'id'            => 'sidebar-footer-one',
				'description'   => __( 'First footer sidebar', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Second footer sidebar', 'aesthetix' ),
				'id'            => 'sidebar-footer-two',
				'description'   => __( 'Second footer sidebar', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		if ( in_array( get_aesthetix_options( 'general_footer_type' ), array( 'footer-three-columns', 'footer-four-columns' ), true ) ) {
			register_sidebar( array(
				'name'          => __( 'Third footer sidebar', 'aesthetix' ),
				'id'            => 'sidebar-footer-three',
				'description'   => __( 'Third footer sidebar', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			register_sidebar( array(
				'name'          => __( 'Fourth footer sidebar', 'aesthetix' ),
				'id'            => 'sidebar-footer-four',
				'description'   => __( 'Fourth footer sidebar', 'aesthetix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}
}
add_action( 'widgets_init', 'aesthetix_widgets_init' );