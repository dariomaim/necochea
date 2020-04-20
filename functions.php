<?php
/**
 * necochea functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package necochea
 */

if ( ! function_exists( 'necochea_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function necochea_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on necochea, use a find and replace
		 * to change 'necochea' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'necochea', get_template_directory() . '/languages' );


		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'custom-background', array(
			'default-color' => '#ffffff',
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => false,
		) );
		# If you edit this update _wp.scss too
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => __('Brick', 'necochea'),
				'slug' => 'brick',
				'color' => '#825A58'
			),
			array(
				'name' => __('Baby Pink', 'necochea'),
				'slug' => 'baby-pink',
				'color' => '#E0BAC0'
			),
			array(
				'name' => __('Ecru', 'necochea'),
				'slug' => 'ecru',
				'color' => '#E1D9D3'
			),
			array(
				'name' => __('Peach', 'necochea'),
				'slug' => 'peach',
				'color' => '#E6AA88'
			),
			array(
				'name' => __('Sky Blue', 'necochea'),
				'slug' => 'sky-blue',
				'color' => '#BADCE0'
			),
			array(
				'name' => __('Green', 'necochea'),
				'slug' => 'green',
				'color' => '#81AE8A'
			),
			array(
				'name' => __('Olive', 'necochea'),
				'slug' => 'olive',
				'color' => '#959686'
			),
			array(
				'name' => __('Dark Green', 'necochea'),
				'slug' => 'dark-green',
				'color' => '#113118'
			),
			array(
				'name' => __('Dark Blue', 'necochea'),
				'slug' => 'dark-blue',
				'color' => '#283D5D'
			),
			array(
				'name' => __('Light Gray', 'necochea'),
				'slug' => 'light-gray',
				'color' => '#eaeaea'
			),
			array(
				'name' => __('Dark Gray', 'necochea'),
				'slug' => 'dark-gray',
				'color' => '#222222'
			)
		) );

		register_nav_menus( array(
			'header-menu' => esc_html__( 'Primary', 'necochea' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'necochea_setup' );

if ( ! function_exists( 'necochea_init' ) ) :
	function necochea_init() {
		remove_filter( 'the_content', array( 'Syn_Config', 'the_content' ) , 30 );
	}
endif;
add_action( 'init', 'necochea_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function necochea_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'necochea_content_width', 640 );
}
add_action( 'after_setup_theme', 'necochea_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function necochea_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'necochea' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Widgets for the footer section.', 'necochea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Intro', 'necochea' ),
		'id'            => 'sidebar-intro',
		'description'   => esc_html__( 'Widgets for the intro section.', 'necochea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'necochea_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function necochea_scripts() {
	wp_enqueue_style( 'necochea-style', get_stylesheet_uri() );
	wp_enqueue_style( 'necochea-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,800&display=fallback', false );

	wp_enqueue_script( 'necochea-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'scroll', get_template_directory_uri() . '/js/scroll.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'necochea_scripts' );

/**
 * wp_body_open back-compat
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
