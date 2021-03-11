<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	}

	// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///                                                     Code Section
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/* * * * * * * * * * * * *
 * || ADDING CATEGORY || *
 * * * * * * * * * * * * */
add_action("wp_ajax_EZ_add_category_of_menu", "EZ_add_category_of_menu");

//add_action("wp_ajax_nopriv_EZ_add_category_of_menu", "EZ_add_category_of_menu");

function EZ_add_category_of_menu() {
    echo json_encode(array('Status' => true, 'MSG' => 'Category added successfully', 'Request' => $_REQUEST));

    wp_insert_term($_REQUEST['category-name'], 'product_cat', array(
        'description' => $_REQUEST['category-description'],
        'parent' => 0, // optional
    ));

    exit;
}

/* * * * * * * * * * * * * *
 * || UPDATING CATEGORY || *
 * * * * * * * * * * * * * */
add_action("wp_ajax_EZ_update_category_of_menu", "EZ_update_category_of_menu");

function EZ_update_category_of_menu() {

    $term = get_term($_REQUEST['term_id']);
    $args = array(
        'name' => $_REQUEST['name'],
        'description' => $_REQUEST['description']
    );

    $response = wp_update_term($term->term_id, $term->taxonomy, $args);

    echo json_encode(array('Status' => true, 'MSG' => 'Category updated successfully'));
    exit;
}

/* * * * * * * * * * * * * *
 * || LISTING CATEGORIES ||*
 * * * * * * * * * * * * * */

add_action("wp_ajax_EZ_get_categories_of_menu", "EZ_get_categories_of_menu");

function EZ_get_categories_of_menu() {
    ob_start();
    $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
    $category_options_list = "<option value=''> SELECT </option>";
    ?>
    <?php
    foreach ($product_categories as $category) {
        $category_options_list .= "<option value='$category->name'>$category->name</option>";
        ?>
        <li class="pt-1 pb-1 clearfix">
            <form id="form_<?= $category->term_id; ?>">


                <div class="shown headingdiv" id="info-<?= $category->term_id; ?>">
                    <div class="float-left"> <i class="fa fa-bars"></i> &nbsp;<?= $category->name; ?></div>  
                    &nbsp;
                    <div class="float-right">
                        <a href="javascript:void(0)" class="edit"><i class="fa fa-pencil"></i></a>&nbsp;
                        <a href="javascript:void(0)" onclick="ez_delete_category(this)" class="delete_category" data-id="<?= $category->term_id; ?>" data-name="<?= $category->name; ?>">
                            <i class="fa fa-trash-alt red"></i>
                        </a>
                    </div>
                </div>

                <div class="form contentdiv" id="detail-<?= $category->term_id; ?>" style="display:none">
                    <input name="term_id" type="hidden" value="<?= $category->term_id; ?>" />
                    <div class="field-holder">
                        <a class="float-right red contentcross" type="button"><i class="fa fa-times"></i></a>
                    </div>
                    <div class="field-holder">
                        <div class="mt-2 mb-1"><label for="name">Category</label></div>
                        <input type="text" name="name" class="form-field" placeholder="<?= isset($category->name) ? $category->name : 'Menu Category title'; ?>" value="<?= isset($category->name) ? $category->name : ''; ?>"/>
                    </div>
                    <div class="field-holder">
                        <div class="mt-2 mb-1"><label for="description">Description</label></div>
                        <textarea class="form-field" name="description" placeholder="<?= isset($category->description) ? $category->description : 'Menu category description'; ?>"><?= isset($category->description) ? $category->description : ''; ?></textarea>
                    </div>
                    <div class="field-holder">
                        <button type="button" onclick="ez_update_category(this)" class="btn btn-success float-right ez_update_category" data-id="<?= $category->term_id; ?>"><i class="fa fa-check"></i> Update Category </button>
                    </div>
                </div>


            </form>
        </li>
    <?php } ?>
    <script>
        jQuery(function () {
            jQuery('.headingdiv').off('click').on('click', function () {
                jQuery(this).closest('form').find('.contentdiv').toggle('slow');
            });
            jQuery('.contentcross').off('click').on('click', function () {
                jQuery(this).closest('form').find('.contentdiv').hide('slow');
            });
        });
    </script>
    <?php
    $html = ob_get_clean();
    echo json_encode(array('Status' => true, 'MSG' => 'ok', 'SHtml' => $html, 'category_options_list' => $category_options_list));
    exit;
}

/* * * * * * * * * * * * * *
 * ||DELETING A CATEGORY ||*
 * * * * * * * * * * * * * */
add_action("wp_ajax_EZ_delete_category_of_menu", "EZ_delete_category_of_menu");

function EZ_delete_category_of_menu() {
//    print_r($_REQUEST);    die();
    $term = get_term($_REQUEST['id']);

    wp_delete_term($term->term_id, $term->taxonomy);
//   wp_delete_category($term ->term_id);
    $msg = "Deleted from the menu";
    echo json_encode(array('Status' => true, 'MSG' => $msg, 'SHtml' => $html));
    exit();
}

/* * * * * * * * * * * * * * * * * * * * * *
 * || LISTING CATEGORIES WITH MENU ITEMS|| *
 * * * * * * * * * * * * * * * * * * * * * */

add_action("wp_ajax_EZ_get_categories_with_menu_items", "EZ_get_categories_with_menu_items");

function EZ_get_categories_with_menu_items() {
    ob_start();
    $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
    ?>
    <?php foreach ($product_categories as $category): ?>
        <?php
        $args = array('post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $category->name);
        $loop = new WP_Query($args);
        ?>
        <div class="row parent_row">
            <div class="parent_category col-md-12 <?= $category->name; ?>">
                <div class="float-left"><i class="fa fa-bars"></i> &nbsp;<?= $category->name; ?></div>
                <div class="float-right" title="Expand"><i class="fa fa-plus red"></i></div>
            </div> 
            <?php
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
//                echo '<pre>'; //print_r($loop);
                $nutrition_info_array = get_post_meta(get_the_ID(), 'nutritional_information', true);
                $product = wc_get_product($loop->post->ID);
                $img = $product->get_image('full');
                ?>
                <div class="col-md-12 mb-3 child-post child-of-<?= $category->name; ?> child-of-<?= $category->term_id; ?>" style="display:none;">
                    <div class="clearfix">&nbsp;</div>
                    <!--<pre><?php // print_r($loop);                 ?></pre>-->
                    <div class="row ml-0 mr-0 middle-items">
                        <div class="col-md-1"><i class="fa fa-bars"></i></div>
                        <div class="col-md-2"><?= $img ?></div>
                        <div class="col-md-5"><?= $loop->post->post_title; ?><br/><div class="product-information"><?= $loop->post->post_excerpt; ?></div></div>
                        <div class="col-md-2 price-container">   <?php
                            $price_arr = get_post_meta(get_the_ID(), '_price', false);
                            $price = $price_arr['0'];
                            ?>
                            <p><?php
                                //echo $price;//
                                echo wc_price($price);
                                ?></p></div>
                        <!--<div class="col-md-1"></div>-->
                        <div class="col-md-2 menu-item-controls">
                            <a href="javascript:void(0)" class="float-right open-menu-item-edit-form" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="float-right delete-menu-item" data-id="<?= get_the_ID(); ?>" data-name="<?= $loop->post->post_title; ?>" onclick="ez_delete_menu_item(this)"  title="Remove"><i class="fa fa-times red"></i></a>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0 middle-items edit-menu-item-form-container" style="display:none;">
                        <div class="col-md-12">
                            <form class="form edit-menu-item-form">
                                <div class="field-holder mb-3">
                                    <a class="close-menu-item-form float-right red" id="" type="button" title="Close"><i class="fa fa-times"></i></a>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="restaurant-menu">Restaurant Menu</label></div>
                                            <select type="text" name="restaurant_menu" class="form-field required edit_menu_cate_list" id="">
                                                <?php foreach ($product_categories as $cate): ?>
                                                    <option value="<?= $cate->name; ?>" <?= ($category->name == $cate->name) ? 'selected' : ''; ?>><?= $cate->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ml-0 mr-0">
                                    <div class="col-md-4">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="post_title_<?= get_the_ID(); ?>">Title</label></div>
                                            <input type="text" name="post_title" class="form-field required" id="post_title_<?= get_the_ID(); ?>" placeholder="Menu item title" value="<?= $loop->post->post_title; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="_price_<?= get_the_ID(); ?>">Price</label></div>
                                            <input type="text" name="_price" class="form-field required" id="_price_<?= get_the_ID(); ?>" placeholder="Menu item price" value="<?php echo strip_tags($price); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="food_image_<?= get_the_ID(); ?>">Food Image</label></div>
                                            <input type="file" name="food_image" class="form-field required food_image" id="food_image_<?= get_the_ID(); ?>" onchange="document.getElementById('preview_img_edit_<?= get_the_ID(); ?>').src = window.URL.createObjectURL(this.files[0])"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1">&nbsp;</div>
                                            <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" class="img-fluid img-thumbnail" id="preview_img_edit_<?= get_the_ID(); ?>"/> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row ml-0 mr-0">
                                    <div class="col-md-12">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label>Nutritional Information</label></div>
                                            <div class="nutritional_info_container">
                                                <?php $nutritional_info_icons = array('Bnana', 'Egg', 'Chilli', 'Onion', 'Garlic', 'Tomato', 'Lettuce', 'Lactose', 'NoSugar', 'LowFat', 'Milk', 'Fish', 'Beef', 'Mutton', 'Chicken', 'Gluten'); ?>
                                                <?php foreach ($nutritional_info_icons as $nutrition_item): ?>
                                                    <div><?= $nutrition_item; ?>
                                                        <input type="checkbox" name="nutritional_information[]" id="<?= $nutrition_item; ?>" value="<?= $nutrition_item; ?>" class="required nutritional_info_check" title="Contains <?= $nutrition_item; ?>" <?= (in_array($nutrition_item, $nutrition_info_array) ? 'checked' : ''); ?>/>
                                                        <!--<img src="<?= $nutrition_item_icon_url; ?>" class="nutritional_info_icon"/>-->
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>                                          
                                </div>

                                <div class="row ml-0 mr-0">
                                    <div class="col-md-12">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="product-description_<?= get_the_ID(); ?>">Description</label></div>
                                            <textarea class="form-field required" name="excerpt" id="excerpt_<?= get_the_ID(); ?>" placeholder="Menu category description"><?= $loop->post->post_excerpt; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="post_id" value="<?= get_the_ID(); ?>"/>
                                <div id="extras_<?= get_the_ID(); ?>" class="extras row">
                                    <?php
                                    $menu_item_extras = get_post_meta(get_the_ID(), 'menu_item_extra');
                                    if (!empty($menu_item_extras)) {
//                                    echo '<pre>';  //print_r($menu_item_extras); 
//                                    echo '<hr>';

                                        foreach ($menu_item_extras as $menu_item_extra) {
                                            $n = 1001;
                                            foreach ($menu_item_extra as $item_extra):
//                                            echo $n;
//                                          echo ($item_extra['heading'][0].'<br>-').$item_extra['type'][0].'<br>-'.$item_extra['req'][0];
                                                ?>


                                                <div class="extra_item col-md-11 ml-auto mr-auto">
                                                    <div class="ribbon"><span>Extra</span></div>
                                                    <div class="field-holder mb-3 remove_extra">
                                                        <a onclick="ez_remove_extra_item(this)" class="float-right red" id="close-menu-item-form" type="button" title="Remove">
                                                            <i class="fa fa-times-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="row ml-0 mr-0">
                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="heading_menu_item_extra_">Heading</label></div>
                                                                <input type="text" name="menu_item_extra[<?= $n ?>][heading][]" class="form-field" placeholder="Heading" value="<?= $item_extra['heading'][0]; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="type_menu_item_extra_">Extra Type</label></div>
                                                                <select type="text" name="menu_item_extra[<?= $n ?>][type][]" class="form-field" value="<?= $item_extra['type'][0]; ?>">
                                                                    <option value="single">Single</option>
                                                                    <option value="multiple">Multiple</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="heading_menu_item_required_extra_">Required</label></div>
                                                                <input type="text" name="menu_item_extra[<?= $n ?>][req][]" class="form-field" placeholder="Required?" value="<?= $item_extra['req'][0]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    /* echo count($item_extra['sub_title']); */ for ($index = 0; $index <= count($item_extra['sub_title']) - 1; $index++):
//                                                 echo 'Sub Item : '.$item_extra['sub_title'][$index].'-'.$item_extra['sub_price'][$index].'<br>';
                                                        ?>

                                                        <div class="row ml-0 mr-0 extra_sub">
                            <?php //$sub = rand(0, 50000);   ?>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label for="title_menu_item_extra_">Title</label></div>
                                                                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_title][]" class="form-field extra_sub_title" placeholder="Title" value="<?= $item_extra['sub_title'][$index]; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label for="price_menu_item_extra_">Price</label></div>
                                                                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_price][]" class="form-field extra_sub_price" placeholder="Price" value="<?= $item_extra['sub_price'][$index]; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label>&nbsp;</label></div>
                                                                    <button type="button" class="btn btn-outline-dark" id="" onclick="ez_add_extra_item_sub(this)" title="Add more"><i class="fa fa-plus"></i></button> 
                                                                    <button type="button" class="btn btn-outline-dark" id="" onclick="ez_remove_extra_item_sub(this)" title="Remove this"><i class="fa fa-minus"></i></button>                                                    
                                                                </div>
                                                            </div>
                                                        </div><?php endfor; ?>

                                                </div><?php $n++;
                    endforeach;
                    ?>

                                            <?php
                                        }//ends main foreach
                                    }
                                    ?>    
                                </div>
                                <div class="row ml-0 mr-0">
                                    <div class="col-md-6">
                                        <div class="field-holder">
                                            <button onclick="ez_add_menu_extras(this)" id="update_menu_item_extra_<?= get_the_ID(); ?>" class="btn btn-info float-left add_extra" type="button"><i class="fa fa-plus-square"></i> Add Menu Item Extra</button>
                                        </div>     
                                    </div>   
                                    <div class="col-md-6">
                                        <div class="field-holder">
                                            <button onclick="ez_update_menu_item(this)" id="update_menu_item_<?= get_the_ID(); ?>" data-id="<?= get_the_ID(); ?>" class="btn btn-success float-right" type="button"><i class="fa fa-check"></i> Update Menu Item</button>
                                        </div>     
                                    </div>     
                                </div>

                            </form>
                            <div class="clearfix">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </div>    
    <?php endforeach; ?>
    <script>
        jQuery(function () {
            jQuery('.parent_category').off('click').on('click', function () {
                jQuery(this).closest('.row').find('.child-post').toggle('slow');
            });
            //EDIT MENU ITEM FORM TOGGLE
            jQuery('.open-menu-item-edit-form').off('click').on('click', function () {
                console.log('open');
                jQuery(this).closest('.child-post').find('.edit-menu-item-form-container').toggle('slow');
            });
            jQuery('.close-menu-item-form').off('click').on('click', function () {
                console.log('close');
                jQuery(this).closest('.child-post').find('.edit-menu-item-form-container').hide('slow');
            });
        });
    </script>
    <?php
    $html = ob_get_clean();
    echo json_encode(array('Status' => true, 'MSG' => 'ok', 'SHtml' => $html));
    exit;
}

/* * * * * * * * * * * * *
 * || ADDING MENU ITEM || *
 * * * * * * * * * * * * */
add_action("wp_ajax_EZ_add_menu_item", "EZ_add_menu_item");

//add_action("wp_ajax_nopriv_EZ_add_category_of_menu", "EZ_add_category_of_menu");

function EZ_add_menu_item() {
//    echo '<pre>'; print_r($_REQUEST); die();

    $current_user = wp_get_current_user();

    $post = array(
        'post_author' => $current_user->ID,
        'post_content' => $_REQUEST['excerpt'],
        'post_excerpt' => $_REQUEST['excerpt'],
        'post_status' => "publish",
        'post_title' => $_REQUEST['post_title'],
        'post_parent' => '',
        'post_type' => "product",
    );

//Create post
    $post_id = wp_insert_post($post, $wp_error);
    if ($post_id) {
        $attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
//        print_r($attach_id ); die();
        add_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
//     print_r($post_id ); die();
//print_r($attach_id );exit();
    wp_set_object_terms($post_id, $_REQUEST['restaurant_menu'], 'product_cat');
    wp_set_object_terms($post_id, 'simple', 'product_type');
//wp_set_object_terms( $post_id, $_REQUEST['excerpt'], 'post_excerpt');

    update_post_meta($post_id, '_visibility', 'visible');
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, 'total_sales', '0');
    update_post_meta($post_id, '_downloadable', 'no');
    update_post_meta($post_id, '_virtual', 'no');
    update_post_meta($post_id, '_regular_price', $_REQUEST['_price']);
//    update_post_meta($post_id, '_sale_price', $_REQUEST['_regular_price']);
    update_post_meta($post_id, '_purchase_note', "");
    update_post_meta($post_id, '_featured', "no");
    update_post_meta($post_id, '_weight', "");
    update_post_meta($post_id, '_length', "");
    update_post_meta($post_id, '_width', "");
    update_post_meta($post_id, '_height', "");
    update_post_meta($post_id, '_sku', "");
    update_post_meta($post_id, '_product_attributes', array());
    update_post_meta($post_id, '_sale_price_dates_from', "");
    update_post_meta($post_id, '_sale_price_dates_to', "");
    update_post_meta($post_id, '_price', $_REQUEST['_price']);
    update_post_meta($post_id, '_sold_individually', "");
    update_post_meta($post_id, '_manage_stock', "no");
    update_post_meta($post_id, '_backorders', "no");
    update_post_meta($post_id, '_stock', "");
    update_post_meta($post_id, '_thumbnail_id', $attach_id);
    update_post_meta($post_id, 'nutritional_information', $_REQUEST['nutritional_information']);
    update_post_meta($post_id, 'menu_item_extra', $_REQUEST['menu_item_extra']);
    wc_delete_product_transients($post_id);

    ////////|||=====IMAGE UPLOAD======|||\\\\\\\\

    $uploaddir = wp_upload_dir();
    $file = $_FILES["file"]["name"];
    $uploadfile = $uploaddir['path'] . '/' . basename($file);

    move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile);
    $filename = basename($uploadfile);

    $wp_filetype = wp_check_filetype(basename($filename), null);

    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit',
        'menu_order' => $_i + 1000
    );
    $attach_id = wp_insert_attachment($attachment, $uploadfile);
//    print_r($attach_id);
//    die();
    set_post_thumbnail($post_id, $attach_id);

    echo json_encode(array('Status' => true, 'MSG' => 'Menu item added.', 'Request' => $_REQUEST));

    exit;
}

/* * * * * * * * * * * * * *
 * ||DELETING A MENU ITEM ||*
 * * * * * * * * * * * * * */
add_action("wp_ajax_EZ_delete_menu_item", "EZ_delete_menu_item");

function EZ_delete_menu_item() {
//    print_r($_REQUEST);    die();
    $the_id = $_REQUEST['id'];
    wp_delete_post($the_id);
//   wp_delete_category($term ->term_id);
    $msg = "Deleted menu item " . $_REQUEST['name'];
    echo json_encode(array('Status' => true, 'MSG' => $msg, 'SHtml' => $html));
    exit();
}

/* * * * * * * * * * * * * * *
 * ||UPDATING A MENU ITEM || *
 * * * * * * * * * * * * * * */

add_action("wp_ajax_EZ_update_menu_item", "EZ_update_menu_item");

function EZ_update_menu_item() {
    $current_user = wp_get_current_user();
//    print_r($_REQUEST);
//    echo ' <br>' ;
//    print_r($_FILES);
//    exit();
    $post = array(
//        'post_author' => $current_user->ID,
        'post_content' => $_REQUEST['excerpt'],
        'post_excerpt' => $_REQUEST['excerpt'],
        'post_status' => "publish",
        'post_title' => $_REQUEST['post_title'],
        'post_parent' => '',
        'post_author' => $post_author,
        'post_type' => "product",
        'ID' => $_REQUEST['post_id'],
        'post_category' => $_REQUEST['restaurant_menu']
    );

//update post
    $post_id = wp_update_post($post, $wp_error);
//    print_r($post_id ); die();
    if ($post_id) {
//        $attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
//        print_r($attach_id ); die();
//        update_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
//print_r($attach_id );exit();
    wp_set_object_terms($post_id, $_REQUEST['restaurant_menu'], 'product_cat');
    wp_set_object_terms($post_id, 'simple', 'product_type');
//wp_set_object_terms( $post_id, $_REQUEST['excerpt'], 'post_excerpt');
    wc_delete_product_transients($post_id);
    update_post_meta($post_id, '_visibility', 'visible');
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, 'total_sales', '0');
    update_post_meta($post_id, '_downloadable', 'no');
    update_post_meta($post_id, '_virtual', 'no');
    update_post_meta($post_id, '_regular_price', $_REQUEST['_price']);
//    update_post_meta($post_id, '_sale_price', $_REQUEST['_regular_price']);
    update_post_meta($post_id, '_purchase_note', "");
    update_post_meta($post_id, '_featured', "no");
    update_post_meta($post_id, '_weight', "");
    update_post_meta($post_id, '_length', "");
    update_post_meta($post_id, '_width', "");
    update_post_meta($post_id, '_height', "");
    update_post_meta($post_id, '_sku', "");
    update_post_meta($post_id, '_product_attributes', array());
    update_post_meta($post_id, '_sale_price_dates_from', "");
    update_post_meta($post_id, '_sale_price_dates_to', "");
    update_post_meta($post_id, '_price', $_REQUEST['_price']);
    update_post_meta($post_id, '_sold_individually', "");
    update_post_meta($post_id, '_manage_stock', "no");
    update_post_meta($post_id, '_backorders', "no");
    update_post_meta($post_id, '_stock', "");
//    update_post_meta($post_id, '_thumbnail_id', $attach_id);
    update_post_meta($post_id, 'nutritional_information', $_REQUEST['nutritional_information']);
    if ($_REQUEST['menu_item_extra'] != "") {
        update_post_meta($post_id, 'menu_item_extra', $_REQUEST['menu_item_extra']);
    }
    ////////|||=====UPDATE IMAGE UPLOAD======|||\\\\\\\\
    if ($_FILES["file"]["name"] != "" && $_FILES["file"]["name"] != "undefined") {
        $uploaddir = wp_upload_dir();
        $file = $_FILES["file"]["name"];
//     print_r($_FILES); die();
        $uploadfile = $uploaddir['path'] . '/' . basename($file);

        move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile);
        $filename = basename($uploadfile);

        $wp_filetype = wp_check_filetype(basename($filename), null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit',
            'menu_order' => $_i + 1000
        );
// print_r($attachment ); //die();
        $attach_id = wp_insert_attachment($attachment, $uploadfile);
//    $attach_id = wp_update_attachment_metadata($attachment, $uploadfile);
//        print_r($attach_id ); die();
        set_post_thumbnail($post_id, $attach_id);
        update_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
    echo json_encode(array('Status' => true, 'MSG' => 'Menu item updated.', 'Request' => $_REQUEST));
    exit;
}

/* * * * * * * * * * * * * * * *
 * || ADDING MENU ITEM EXRAS ||*
 * * * * * * * * * * * * * * * */

add_action("wp_ajax_EZ_get_menu_item_extra", "EZ_get_menu_item_extra");

function EZ_get_menu_item_extra() {
//    print_r($_REQUEST);    exit();
    ob_start();
    $n = $_REQUEST['index_num'];
    ?>
    <div class="extra_item col-md-11 ml-auto mr-auto">
        <div class="ribbon"><span>Extra</span></div>
        <div class="field-holder mb-3 remove_extra">
            <a onclick="ez_remove_extra_item(this)" class="float-right red" id="close-menu-item-form" type="button" title="Remove"><i class="fa fa-times-circle"></i></a>
        </div>
        <div class="row ml-0 mr-0">
            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label for="heading_menu_item_extra_">Heading</label></div>
                    <input type="text" name="menu_item_extra[<?= $n ?>][heading][]" class="form-field" placeholder="Heading" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label for="type_menu_item_extra_">Extra Type</label></div>
                    <select type="text" name="menu_item_extra[<?= $n ?>][type][]" class="form-field">
                        <option value="single">Single</option>
                        <option value="multiple">Multiple</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label for="heading_menu_item_required_extra_">Required</label></div>
                    <input type="text" name="menu_item_extra[<?= $n ?>][req][]" class="form-field" placeholder="Required?" />
                </div>
            </div>
        </div>

        <div class="row ml-0 mr-0 extra_sub">
    <?php //$sub = rand(0, 50000);   ?>
            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label for="title_menu_item_extra_">Title</label></div>
                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_title][]" class="form-field extra_sub_title" placeholder="Title" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label for="price_menu_item_extra_">Price</label></div>
                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_price][]" class="form-field extra_sub_price" placeholder="Price" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="field-holder item_extras">
                    <div class="mt-2 mb-1"><label>&nbsp;</label></div>
                    <button type="button" class="btn btn-outline-dark" id="" onclick="ez_add_extra_item_sub(this)" title="Add more"><i class="fa fa-plus"></i></button> 
                    <button type="button" class="btn btn-outline-dark" id="" onclick="ez_remove_extra_item_sub(this)" title="Remove this"><i class="fa fa-minus"></i></button>                                                    
                </div>
            </div>
        </div>
    </div> 
    <?php
    $html = ob_get_clean();
    echo json_encode(array('Status' => true, 'MSG' => 'Menu item extra added successfully', 'SHtml' => $html, 'category_options_list' => $category_options_list));
    exit;
}

