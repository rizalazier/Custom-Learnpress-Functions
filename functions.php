<?php
/**
 * thim functions and definitions
 *
 * @package thim
 */

define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THIM_THEME_VERSION', '4.3.6' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
/**
 * Translation ready
 */

load_theme_textdomain( 'eduma', get_template_directory() . '/languages' );

function thim_eduma_get_current_url() {
	$schema = is_ssl() ? 'https://' : 'http://';

	return $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

if ( ! function_exists( 'thim_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'eduma' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'eduma', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'eduma' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		/* Add WooCommerce support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'thim-core' );

		add_theme_support( 'eduma-demo-data' );
		add_theme_support( 'thim-full-widgets' );
 		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio'
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Editor color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Primary Color', 'eduma' ),
				'slug'  => 'primary',
				'color' => get_theme_mod( 'thim_body_primary_color', '#ffb606' ),
			),
			array(
				'name'  => esc_html__( 'Title Color', 'eduma' ),
				'slug'  => 'title',
				'color' => get_theme_mod( 'thim_font_title_color', '#333' ),
			),
			array(
				'name'  => esc_html__( 'Sub Title Color', 'eduma' ),
				'slug'  => 'sub-title',
				'color' => '#999',
			),
			array(
				'name'  => esc_html__( 'Border Color', 'eduma' ),
				'slug'  => 'border-input',
				'color' => '#ddd',
			),
		) );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'eduma' ),
					'shortName' => __( 'S', 'eduma' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'eduma' ),
					'shortName' => __( 'M', 'eduma' ),
					'size'      => 15,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'eduma' ),
					'shortName' => __( 'L', 'eduma' ),
					'size'      => 28,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'eduma' ),
					'shortName' => __( 'XL', 'eduma' ),
					'size'      => 36,
					'slug'      => 'huge',
				),
			)
		);

	}
endif; // thim_setup
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'thim_widgets_inits' ) ) {
	function thim_widgets_inits() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'eduma' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Right Sidebar', 'eduma' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Toolbar', 'eduma' ),
			'id'            => 'toolbar',
			'description'   => esc_html__( 'Toolbar Header', 'eduma' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Menu Right', 'eduma' ),
			'id'            => 'menu_right',
			'description'   => esc_html__( 'Menu Right', 'eduma' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		) );
		if ( 'header_v2' == get_theme_mod( 'thim_header_style', 'header_v1' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Menu Top', 'eduma' ),
					'id'            => 'menu_top',
					'description'   => esc_html__( 'Menu top only display with header version 2', 'eduma' ),
					'before_widget' => '<li id="%1$s" class="widget %2$s">',
					'after_widget'  => '</li>',
					'before_title'  => '<h4>',
					'after_title'   => '</h4>',
				)
			);
		}

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Top', 'eduma' ),
			'id'            => 'footer_top',
			'description'   => esc_html__( 'Footer Top Sidebar', 'eduma' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s footer_bottom_widget">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'eduma' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Footer Sidebar', 'eduma' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		if ( 'new-1' != get_theme_mod( 'thim_layout_content_page', 'normal' ) || 'header_v4' != get_theme_mod( 'thim_header_style', 'header_v1' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Bottom', 'eduma' ),
				'id'            => 'footer_bottom',
				'description'   => esc_html__( 'Footer Bottom Sidebar', 'eduma' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_bottom_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}

		register_sidebar( array(
			'name'          => esc_html__( 'Copyright', 'eduma' ),
			'id'            => 'copyright',
			'description'   => esc_html__( 'Copyright', 'eduma' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Shop', 'eduma' ),
				'id'            => 'sidebar_shop',
				'description'   => esc_html__( 'Sidebar Shop', 'eduma' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}

		if ( class_exists( 'LearnPress' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Courses', 'eduma' ),
				'id'            => 'sidebar_courses',
				'description'   => esc_html__( 'Sidebar Courses', 'eduma' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}

		if ( class_exists( 'TP_Event' ) || class_exists( 'WPEMS' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Events', 'eduma' ),
				'id'            => 'sidebar_events',
				'description'   => esc_html__( 'Sidebar Events', 'eduma' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}
		if ( 'header_v3' == get_theme_mod( 'thim_header_style', 'header_v1' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Header', 'eduma' ),
					'id'            => 'header',
					'description'   => esc_html__( 'Sidebar display on header version 3', 'eduma' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s footer_bottom_widget">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				)
			);
		}
		/**
		 * Feature create sidebar in wp-admin.
		 * Do not remove this.
		 */
		$sidebars = apply_filters( 'thim_core_list_sidebar', array() );
		if ( count( $sidebars ) > 0 ) {
			foreach ( $sidebars as $sidebar ) {
				$new_sidebar = array(
					'name'          => $sidebar['name'],
					'id'            => $sidebar['id'],
					'description'   => esc_html__( 'Custom widgets area.', 'eduma' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s footer_bottom_widget">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				);

				register_sidebar( $new_sidebar );
			}
		}
	}
}

add_action( 'widgets_init', 'thim_widgets_inits' );

/**
 * Enqueue styles.
 */
// remove font-awesome in elementor
add_action( 'elementor/frontend/after_register_styles', function () {
	foreach ( [ 'solid', 'regular', 'brands' ] as $style ) {
		wp_deregister_style( 'elementor-icons-fa-' . $style );
		wp_deregister_style( 'font-awesome' );
	}
}, 20 );

if ( ! function_exists( 'thim_styles' ) ) {
	function thim_styles() {
		$v_rand = uniqid();
		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style( 'font-awesome', THIM_URI . 'assets/css/all.min.css', array(), THIM_THEME_VERSION );
		wp_enqueue_style( 'font-v4-shims', THIM_URI . 'assets/css/v4-shims.min.css', array(), THIM_THEME_VERSION );
		wp_enqueue_style( 'ionicons', THIM_URI . 'assets/css/ionicons.min.css' );
		wp_enqueue_style( 'font-pe-icon-7', THIM_URI . 'assets/css/font-pe-icon-7.css' );
		wp_enqueue_style( 'flaticon', THIM_URI . 'assets/css/flaticon.css' );
		wp_enqueue_style( 'thim-linearicons-font', THIM_URI . 'assets/css/linearicons.css' );
        wp_enqueue_style( 'line-awesome', THIM_URI . 'assets/css/libs/line-awesome-icon/line-awesome.min.css', array(), THIM_THEME_VERSION );

		// if ( get_theme_mod( 'thim_layout_content_page', 'normal' ) == 'new-1' ) {
		// 	wp_enqueue_style( 'thim-linearicons-font' );
		// }

		//Load style for page builder Visual Composer
		$page_builder = get_theme_mod( 'thim_page_builder_chosen', '' );
		if ( $page_builder === 'visual_composer' ) {
			wp_enqueue_style( 'thim-custom-vc', THIM_URI . 'assets/css/custom-vc.css', array(), THIM_THEME_VERSION );
		} else if ( $page_builder == 'elementor' ) {
			wp_enqueue_style( 'thim-custom-el', THIM_URI . 'assets/css/custom-el.css', array(), THIM_THEME_VERSION );
		}
		if ( defined( 'THIM_DEBUG' ) ) {
			wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), $v_rand );
		} else {
			wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_THEME_VERSION );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'thim-rtl', THIM_URI . 'rtl.css', array(), THIM_THEME_VERSION );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'thim_styles', 1001 );

/**
 * Enqueue scripts.
 */
if ( ! function_exists( 'thim_scripts' ) ) {
	function thim_scripts() {
		$v_rand = uniqid();
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// New script update
		wp_register_script( 'thim-content-slider', THIM_URI . 'assets/js/thim-content-slider.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'flexslider', THIM_URI . 'assets/js/jquery.flexslider-min.js', array( 'jquery' ), THIM_THEME_VERSION, true );

		wp_register_script( 'magnific-popup', THIM_URI . 'assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'variations', THIM_URI . 'assets/js/variations-form.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'mb-commingsoon', THIM_URI . 'assets/js/mb-commingsoon.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'isotope', THIM_URI . 'assets/js/isotope.pkgd.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'thim_simple_slider', THIM_URI . 'assets/js/thim_simple_slider.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		// show dashicons when not login
		wp_enqueue_style( 'dashicons' );

		wp_enqueue_script( 'thim-main', THIM_URI . 'assets/js/main.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );

		wp_register_script( 'waypoints', THIM_URI . 'assets/js/jquery.waypoints.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_register_script( 'thim-CountTo', THIM_URI . 'assets/js/jquery.countTo.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );

		if ( get_theme_mod( 'thim_smooth_scroll', true ) ) {
			wp_enqueue_script( 'thim-smooth-scroll', THIM_URI . 'assets/js/smooth_scroll.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		}

		if ( defined( 'THIM_DEBUG' ) ) {
			wp_enqueue_script( 'thim-custom-script', THIM_URI . 'assets/js/custom-script-v2.js', array( 'jquery' ), $v_rand, true );
			wp_enqueue_script( 'thim-scripts', THIM_URI . 'assets/js/thim-scripts.js', array( 'jquery' ), $v_rand, true );
		} else {
			wp_enqueue_script( 'thim-custom-script', THIM_URI . 'assets/js/custom-script-v2.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
			wp_enqueue_script( 'thim-scripts', THIM_URI . 'assets/js/thim-scripts.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		}

		// Localize the script with new data
		wp_localize_script( 'thim-custom-script', 'thim_js_translate', array(
			'login'    => esc_attr__( 'Username', 'eduma' ),
			'password' => esc_attr__( 'Password', 'eduma' ),
			'close'    => esc_html__( 'Close', 'eduma' ),
		) );

		if ( get_post_type() == 'portfolio' && ( is_category() || is_archive() || is_singular( 'portfolio' ) ) ) {
			wp_enqueue_script( 'thim-portfolio-appear', THIM_URI . 'assets/js/jquery.appear.min.js', array( 'jquery' ), THIM_THEME_VERSION, true );
			wp_enqueue_script( 'thim-portfolio-widget', THIM_URI . 'assets/js/portfolio.min.js', array(
				'jquery',
				'isotope',
			), THIM_THEME_VERSION, true );
		}

		wp_dequeue_script( 'framework-bootstrap' );
		wp_dequeue_script( 'bootstrap' );
//		wp_dequeue_script( 'thim-flexslider' );

		// Remove some scripts LearnPress
		wp_dequeue_style( 'lpr-print-rate-css' );
		wp_dequeue_style( 'tipsy' );
		wp_dequeue_style( 'certificate' );
		wp_dequeue_style( 'fib' );
		wp_dequeue_style( 'sorting-choice' );
		wp_dequeue_style( 'course-wishlist-style' );
		wp_dequeue_script( 'tipsy' );
		wp_dequeue_script( 'lpr-print-rate-js' );
		wp_dequeue_script( 'course-wishlist-script' );
		wp_dequeue_script( 'course-review' );
		wp_dequeue_style( 'course-review' );
		wp_dequeue_style( 'learn-press-pmpro-style' );
		wp_dequeue_style( 'learn-press-jalerts' );

		if ( ! is_single( 'lpr_course' ) && ! is_single( 'lpr_quiz' ) ) {
			wp_dequeue_script( 'sorting-choice' );
			wp_deregister_script( 'block-ui' );
		}

		if ( is_front_page() ) {

			wp_dequeue_script( 'webfont' );
			wp_dequeue_script( 'fabric-js' );
			wp_dequeue_script( 'certificate' );

			wp_dequeue_script( 'thim-event-countdown-plugin-js' );
			wp_dequeue_script( 'thim-event-countdown-js' );
			wp_dequeue_script( 'tp-event-auth' );
		}

		//Plugin tp-event
		wp_dequeue_style( 'thim-event' );
		wp_dequeue_style( 'tp-event-auth' );
		wp_dequeue_script( 'thim-event-owl-carousel-js' );
		wp_dequeue_script( 'tp-event-site-js-events.js' );
		wp_dequeue_style( 'thim-event-countdown-css' );
		wp_dequeue_style( 'thim-event-owl-carousel-css' );
		wp_dequeue_style( 'tp-event-fronted-css' );
		wp_dequeue_style( 'tp-event-owl-carousel-css' );
		wp_dequeue_style( 'tp-event-magnific-popup-css' );

		wp_dequeue_style( 'mo_openid_admin_settings_style' );
		wp_dequeue_style( 'mo_openid_admin_settings_phone_style' );
		//wp_dequeue_style( 'mo-wp-bootstrap-social' );
		wp_dequeue_style( 'mo-wp-bootstrap-main' );
		wp_dequeue_style( 'mo-wp-font-awesome' );

		//Woocommerce
		wp_dequeue_script( 'jquery-cookie' );

		//Miniorange-login
		wp_dequeue_script( 'js-cookie-script' );
		wp_dequeue_script( 'mo-social-login-script' );

		if ( ! thim_use_bbpress() ) {
			wp_dequeue_style( 'bbp-default' );
			wp_dequeue_script( 'bbpress-editor' );
		}


		//LearnPress 2.0
		wp_dequeue_style( 'owl_carousel_css' );
		wp_dequeue_style( 'learn-press-coming-soon-course' );
		wp_dequeue_script( 'learn-press-jquery-mb-coming-soon' );

		if ( get_post_type() != 'tp_event' && ! is_single() ) {
			wp_dequeue_script( 'wpems-magnific-popup-js' );
			wp_dequeue_style( 'wpems-magnific-popup-css' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'thim_scripts', 1000 );

function thim_custom_admin_scripts() {
	wp_enqueue_script( 'thim-admin-custom-script', THIM_URI . 'assets/js/admin-custom-script.js', array( 'jquery' ), uniqid(), true );
	wp_enqueue_style( 'thim-admin-theme-style', THIM_URI . 'assets/css/thim-admin.css', array(), THIM_THEME_VERSION );

	wp_enqueue_style( 'thim-admin-font-icon7', THIM_URI . 'assets/css/font-pe-icon-7.css', array(), THIM_THEME_VERSION );
	wp_enqueue_style( 'thim-admin-font-flaticon', THIM_URI . 'assets/css/flaticon.css', array(), THIM_THEME_VERSION );
	wp_register_style( 'thim-admin-ionicons', THIM_URI . 'assets/css/ionicons.min.css', array(), THIM_THEME_VERSION );

	$thim_mod                 = get_theme_mods();
	$thim_page_builder_chosen = ! empty( $thim_mod['thim_page_builder_chosen'] ) ? $thim_mod['thim_page_builder_chosen'] : '';
	wp_localize_script( 'thim-admin-custom-script', 'thim_theme_mods', array(
		'thim_page_builder_chosen' => $thim_page_builder_chosen,
	) );
}

add_action( 'admin_enqueue_scripts', 'thim_custom_admin_scripts' );

// Require library
//require THIM_DIR . 'inc/libs/theme-wrapper.php';
//require THIM_DIR . 'inc/libs/aq_resizer.php';
require THIM_DIR . 'inc/libs/down_image_size.php';

// Custom functions.
require get_template_directory() . '/inc/custom-functions.php';

include_once THIM_DIR . '/inc/register-functions.php';

/**
 * Custom template tags for this theme.
 */
require THIM_DIR . 'inc/template-tags.php';


if ( class_exists( 'WooCommerce' ) ) {
	require THIM_DIR . 'woocommerce/woocommerce.php';
}

if ( class_exists( 'BuddyPress' ) ) {
	require THIM_DIR . 'buddypress/bp-custom.php';
}

//logo
require_once THIM_DIR . 'inc/header/logo.php';

//custom logo mobile
require_once THIM_DIR . 'inc/header/logo-mobile.php';

// Remove references to SiteOrigin Premium
add_filter( 'siteorigin_premium_upgrade_teaser', '__return_false' );

//For use thim-core
require_once THIM_DIR . 'inc/thim-core-function.php';

require_once THIM_DIR . 'inc/upgrade.php';


add_filter( 'thim_register_multiple_variants', 'thim_register_multiple_variants' );

if ( ! function_exists( 'thim_register_multiple_variants' ) ) {
	function thim_register_multiple_variants() {
		// multiple variants want to add
		if ( ! empty( get_theme_mod( 'thim_multiple_variants_fonts', true ) ) ) {
			return get_theme_mod( 'thim_multiple_variants_fonts' );
		} else {
			return;
		}
	}
}


/*CUSTOM FUNCTIONS BY DEVELOPER*/
add_action('fluentform_before_insert_submission', 'map_data', 10, 3);
function map_data($insertData, $data, $form)
{
	$UserId = $insertData['user_id'];
	$PostId = $data['__fluent_form_embded_post_id'];
	$InputRadio = $data['input_radio'];
	preg_match_all('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $InputRadio, $match);
	$linkArr = array($match[0]);
	$getLink = array($linkArr[0]);
	$link = array($getLink[0][0]);
	$link1 = array($getLink[0][1]);
	$link2 = array($getLink[0][2]);
	$link3 = array($getLink[0][3]);
	$desc = str_replace($link[0],"",$InputRadio);
	$desc = str_replace($link1[0],"",$desc);
	$desc = str_replace($link2[0],"",$desc);
	$desc = str_replace($link3[0],"",$desc);
	
	$pattern = "/[|]/";
	$str = preg_split($pattern, $desc);
	
	global $wpdb;
	if($link1[0] == null)
	{
		$table = $wpdb->prefix.'schedule_table';
		$dataTable = array(		
    		'user_id' => $UserId,
    		'post_id' => $PostId,
			'schedule' => $link[0],
			'description' => $str[0],
			'trainer' => $str[1]
		);
		$wpdb->insert($table,$dataTable);
	}
	elseif($link2[0] == null)
	{ 
		$table = $wpdb->prefix.'schedule_table';
		$dataTable = array(		
    		'user_id' => $UserId,
    		'post_id' => $PostId,
			'schedule' => $link[0],
			'link_1' => $link1[0],
			'description' => $str[0],
			'trainer' => $str[1]
		);
		$wpdb->insert($table,$dataTable);
	}
	elseif($link3[0] == null)
	{
		$table = $wpdb->prefix.'schedule_table';
		$dataTable = array(		
    		'user_id' => $UserId,
    		'post_id' => $PostId,
			'schedule' => $link[0],
			'link_1' => $link1[0],
			'link_2' => $link2[0],
			'description' => $str[0],
			'trainer' => $str[1]
		);
		$wpdb->insert($table,$dataTable);
	}
	else{
		$table = $wpdb->prefix.'schedule_table';
		$dataTable = array(		
    		'user_id' => $UserId,
    		'post_id' => $PostId,
			'schedule' => $link[0],
			'link_1' => $link1[0],
			'link_2' => $link2[0],
			'link_3' => $link3[0],
			'description' => $str[0],
			'trainer' => $str[1]
		);
		$wpdb->insert($table,$dataTable);
	}
	
	return;
}


/**
 * Add a custom field (in an order) to the emails
 */
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
	$schedule_user_id = $order->get_user_id();
	$product_id;
	foreach ( $order->get_items() as $item_id => $item ) {
   		$product_id = $item->get_product_id();
	}
	
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}schedule_table WHERE user_id = '{$schedule_user_id}' AND post_id = '{$product_id}' AND created_at = (SELECT MAX(created_at) FROM {$wpdb->prefix}schedule_table WHERE user_id = '{$schedule_user_id}' AND post_id = '{$product_id}' )", OBJECT );
	$val = $results[0];
	
    $fields['billing_meeting_schedule'] = array(
        'label' => __( '<h2 style="color:#96588a; margin-bottom:8px;">Tanggal Meeting' ),
         'value' => __( "&nbsp;&nbsp;&nbsp;<strong>{$val->description}</strong><br>
		 &nbsp;&nbsp;&nbsp;<strong>{$val->trainer}</strong><br>
		 </h2><br>
		 <h2 style='color:#96588a; margin-bottom:8px;'>Link :</h2>
		 <ul style='padding-left: 0px; margin-top: 0px;'>
		 	<li><a href='{$val->schedule}' target='_blank' style='color:black;'>{$val->schedule}</a></li>
			<li><a href='{$val->link_1}' target='_blank' style='color:black;'>{$val->link_1}</a></li>
			<li><a href='{$val->link_2}' target='_blank' style='color:black;'>{$val->link_2}</a></li>
		 </ul>
		 " ),
    );
	
    return $fields;
}

/*PHP to JS Logger*/
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

/*FIND LESSON FROM VOUCHER CODE*/
add_action( 'wpforms_process_entry_save', 'wpf_dev_process_test_adi', 10, 4 );
function wpf_dev_process_test_adi( $fields, $entry, $form_id, $form_data ) {

	console_log($entry['fields'][1]);
	$input_voucher = $entry['fields'][1];
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_title = '{$input_voucher}'", OBJECT );
	$coupon_id_arr = $results[0];
	$coupon_id = $coupon_id_arr->ID;
	console_log($coupon_id);
	$testing = get_post_meta($coupon_id, 'product_ids');
	console_log($testing[0]);
	$url_course = get_permalink($testing[0]);
	console_log($url_course);
	wp_redirect($url_course);
}


/**
* Format WordPress User's "Display Name" to Full Name on Login
* ------------------------------------------------------------------------------
*/

add_action( 'wp_login', 'wpse_9326315_format_user_display_name_on_login' );

function wpse_9326315_format_user_display_name_on_login( $username ) {
    $user = get_user_by( 'login', $username );

    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );

    $full_name = trim( $first_name . ' ' . $last_name );

    if ( ! empty( $full_name ) && ( $user->data->display_name != $full_name ) ) {
        $userdata = array(
            'ID' => $user->ID,
            'display_name' => $full_name,
        );

        wp_update_user( $userdata );
    }
}
