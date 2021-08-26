<?php

add_action( 'after_setup_theme', 'ascendant_child_theme_setup' );

function ascendant_child_theme_setup() {

	$theme = wp_get_theme();
	if ( $theme->Template == 'allegiant_pro' ) {
		add_filter('body_class', 'ascendant_body_class');
	}

    // Remove parent font
	remove_action('wp_head', 'cpotheme_styling_fonts', 20 );
	remove_action('wp_head', 'cpotheme_styling_custom', 20);

	remove_filter('cpotheme_background_args', 'cpotheme_background_args');
	add_filter('cpotheme_background_args', 'ascendant_child_background_args');

}

function ascendant_body_class( $classes ){
	$classes[] = 'allegiant_pro_template';
	return $classes;
}

//Add public stylesheets
if(!function_exists('ascendant_child_add_styles')){
	add_action('wp_enqueue_scripts', 'ascendant_child_add_styles' );
	function ascendant_child_add_styles(){

		$parent_style = 'cpotheme-main'; 
 		wp_enqueue_style( 'ascendant-google-font', '//fonts.googleapis.com/css?family=Lato:400,700|Raleway:300,400,500,700,800,900' );
	    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	    wp_enqueue_style( 'ascendant-style',
	        get_stylesheet_uri(),
	        array( $parent_style, 'cpotheme-base' ),
	        wp_get_theme()->get('Version')
	    );

	}
}

if(!function_exists('ascendant_child_add_fontawesome')){
	add_action('wp_enqueue_scripts', 'ascendant_child_add_fontawesome',11);
	function ascendant_child_add_fontawesome(){

		wp_enqueue_style('cpotheme-fontawesome');

	}
}

if(!function_exists('ascendant_child_background_args')){
	function ascendant_child_background_args($data){ 
		$data = array(
		'default-color' => 'fff',
		'default-image' => get_stylesheet_directory_uri().'/images/background.jpg',
		'default-repeat' => 'no-repeat',
		'default-position-x' => 'center',
		'default-attachment' => 'fixed',
		'wp-head-callback' => 'ascendant_custom_background_cb'
		);
		return $data;
	}
}

add_filter( 'cpotheme_customizer_controls', 'ascendant_add_customizer_fields', 11 );
function ascendant_add_customizer_fields( $data ){

	$data['transparent_header'] = array(
		'label' => __('Transparent Header', 'ascendant'),
		'description' => __('Your header will be transparent.', 'ascendant'),
		'section' => 'cpotheme_layout_home',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'default' => '1');

	//Typography
	if ( isset($data['type_headings']) ) {
		$data['type_headings']['default'] = 'Raleway';
	}
	if ( isset($data['type_nav']) ) {
		$data['type_nav']['default'] = 'Raleway';
	}
	if ( isset($data['type_body']) ) {
		$data['type_body']['default'] = 'Lato';
	}
	if ( isset($data['primary_color']) ) {
		$data['primary_color']['default'] = '#70b85d';
	}
	if ( isset($data['type_headings_color']) ) {
		$data['type_headings_color']['default'] = '#18253c';
	}
	if ( isset($data['type_widgets_color']) ) {
		$data['type_widgets_color']['default'] = '#18253c';
	}
	if ( isset($data['type_nav_color']) ) {
		$data['type_nav_color']['default'] = '#18253c';
	}
	if ( isset($data['type_link_color']) ) {
		$data['type_link_color']['default'] = '#70b85d';
	}
	if ( isset($data['type_body_color']) ) {
		$data['type_body_color']['default'] = '#8c9597';
	}

	if ( isset($data['postpage_dates']) ) {
		$data['postpage_dates']['default'] = false;
	}
	if ( isset($data['postpage_authors']) ) {
		$data['postpage_authors']['default'] = false;
	}
	if ( isset($data['postpage_comments']) ) {
		$data['postpage_comments']['default'] = false;
	}
	if ( isset($data['postpage_categories']) ) {
		$data['postpage_categories']['default'] = false;
	}
	if ( isset($data['postpage_tags']) ) {
		$data['postpage_tags']['default'] = false;
	}
	if ( isset($data['home_tagline_content']) ) {
		$data['home_tagline_content']['sanitize'] = 'wp_kses_post';
	}

	return $data;

}

// Pro Typographi
add_filter('cpotheme_font_headings', 'ascendant_cpotheme_font_headings');
add_filter('cpotheme_font_menu', 'ascendant_cpotheme_font_menu');
add_filter('cpotheme_font_body', 'ascendant_cpotheme_font_body');

function ascendant_cpotheme_font_headings() {
	$option_list = get_option('cpotheme_settings', false);
	if ( isset($option_list['type_headings']) ) {
		return $option_list['type_headings'];
	}else{
		return "Raleway";
	}
}

function ascendant_cpotheme_font_menu() {
	$option_list = get_option('cpotheme_settings', false);
	if ( isset($option_list['type_nav']) ) {
		return $option_list['type_nav'];
	}else{
		return "Raleway";
	}
}

function ascendant_cpotheme_font_body() {
	$option_list = get_option('cpotheme_settings', false);
	if ( isset($option_list['type_body']) ) {
		return $option_list['type_body'];
	}else{
		return "Lato";
	}
}

add_action('wp_head', 'ascendant_cpotheme_styling_custom', 20);
function ascendant_cpotheme_styling_custom(){
	$primary_color = cpotheme_get_option('primary_color'); ?>
	<style type="text/css">
		<?php if($primary_color != ''){ ?>
		html body .button, 
		html body .button:link, 
		html body .button:visited,
		.menu-portfolio .current-cat a,
		.pagination .current,
		html body input[type=submit] { background: <?php echo esc_attr($primary_color); ?>; }
		html body .button:hover,
		html body input[type=submit]:hover { color:#fff; background:<?php echo esc_attr($primary_color); ?>; }
		.menu-main .current_page_ancestor > a,
		.menu-main .current-menu-item > a,
		.features a.feature-image, .team .team-member-description { color:<?php echo esc_attr($primary_color); ?>; }
		<?php } ?>
    </style>
	<?php
}

if(!function_exists('cpotheme_logo')){
	function cpotheme_logo($width = 0, $height = 0){
		$output = '<div id="logo" class="logo">';
		if(cpotheme_get_option('general_texttitle') == 0){
			if( cpotheme_get_option('general_logo') ){
				$logo_width = cpotheme_get_option('general_logo_width');
				$logo_url = esc_url(cpotheme_get_option('general_logo'));
				if($logo_width != '') { $logo_width = ' style="width:'.absint($logo_width).'px;"'; }
				$output .= '<a class="site-logo" href="'.esc_url(home_url()).'"><img src="'.$logo_url.'" alt="'.esc_attr(get_bloginfo('name')).'"'.$logo_width.'/></a>';
			}else{
				$output .= '<span class="title site-title"><a href="'.esc_url(home_url()).'">'.esc_html(get_bloginfo('name')).'</a></span>';
			}
		}
		
		$classes = '';
		if(cpotheme_get_option('general_texttitle') == 0) { $classes = ' hidden'; }
		if(!is_front_page()){
			$output .= '<span class="title site-title'.esc_attr($classes).'"><a href="'.esc_url(home_url()).'">'.esc_html(get_bloginfo('name')).'</a></span>';
		}else{
			$output .= '<h1 class="title site-title '.esc_attr($classes).'"><a href="'.esc_url(home_url()).'">'.esc_html(get_bloginfo('name')).'</a></h1>';
		}
		
		$output .= '</div>';
		echo $output;
	}
}

if(!function_exists('cpotheme_postpage_title')){
	function cpotheme_postpage_title(){
		if(!is_singular('post')){
			echo '<h2 class="post-title">';
			echo '<a href="'.esc_url(get_permalink(get_the_ID())).'" title="'.sprintf(esc_attr__('Go to %s', 'ascendant'), the_title_attribute('echo=0')).'" rel="bookmark">';
			if ( is_sticky() ) {
				echo '<span style="font-family:fontawesome"></span>';
			}
			the_title();
			echo '</a>';
			echo '</h2>';
		}
	}
}

// Custom Background
function ascendant_custom_background_cb() {
	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );
	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();
	if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
		$color = false;
	}
	if ( ! $background && ! $color ) {
		if ( is_customize_preview() ) {
			echo '<style type="text/css" id="custom-background-css"></style>';
		}
		return;
	}
	$background_color = $color ? "background-color: #".esc_attr($color).";" : '';
	$style = '';
	if ( $background ) {
		$image = ' background-image: url("' . esc_url_raw( $background ) . '");';
		// Background Position.
		$position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		$position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
		if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
			$position_x = 'left';
		}
		if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
			$position_y = 'top';
		}
		$position = " background-position: ".esc_attr($position_x)." ".esc_attr($position_y).";";
		// Background Size.
		$size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
		if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
			$size = 'auto';
		}
		$size = " background-size: ".esc_attr($size).";";
		// Background Repeat.
		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
			$repeat = 'repeat';
		}
		$repeat = " background-repeat: ".esc_attr($repeat).";";
		// Background Scroll.
		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		if ( 'fixed' !== $attachment ) {
			$attachment = 'scroll';
		}
		$attachment = " background-attachment: ".esc_attr($attachment).";";
		$style .= $image . $position . $size . $repeat . $attachment;
	}
?>
<style type="text/css" id="custom-background-css">
body.custom-background { <?php echo trim( $style ); ?> }
body.custom-background #main, 
body.custom-background #features,
body.custom-background #testimonials,
body.custom-background #clients,
body.custom-background #portfolio { <?php echo trim( $background_color ); ?> }
</style>
<?php
}