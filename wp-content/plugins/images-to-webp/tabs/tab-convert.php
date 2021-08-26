<?php

global $disabled_folders, $wp_content;
$disabled_folders = apply_filters( 'iwt_disabled_folders', $this->disabled_folders );
$wp_content = $this->get_wp_content_dir();

function dir_tree( $dir ){
	global $disabled_folders, $wp_content;
	$dir = str_replace( '\\', '/', $dir );
	echo '<ul>';
	if( $files = scandir( $dir ) ){
		foreach( $files as $sub ){
			if( $sub != '.' && $sub != '..' ){
				if( is_dir( $dir . '/' . $sub ) ){
					if( str_replace( $disabled_folders, '', $dir . '/' . $sub . '/' ) != $dir . '/' . $sub . '/' ){
						echo '<li data-jstree=\'{"disabled":true}\'>' . $sub . '</li>';
					}else{
						$id = explode( '/' . $wp_content . '/', $dir . '/' . $sub );
						echo '<li id="' . $id[1] . '">' . $sub;
						dir_tree( $dir . '/' . $sub );
						echo '</li>';
					}
				}
			}
		}
	}
	echo '</ul>';
}

?>
<div class="below-h2 updated"><p><?php _e( 'This operation will NOT alter your original images.', 'images-to-webp' ) ?></p></div>
<div id="transparency_status_message" class="below-h2 error" style="display:none"><p><span></span></p></div>

<div id="hide-on-convert">
	<h3><?php _e( 'Select folders you want to scan for images and convert them to WebP:', 'images-to-webp' ) ?></h3>
	<div id="jstree">
		<?php dir_tree( dirname( plugin_dir_path( dirname( __DIR__ ) ) ) ) ?>
	</div>
	<br>
	<button type="button" class="button button-primary convert-missing-images"><?php _e( 'Find and convert MISSING images', 'images-to-webp' ) ?></button>
	&emsp;
	<button type="button" class="button button-primary convert-all-images"><?php _e( 'Find and convert ALL images', 'images-to-webp' ) ?></button>
</div>

<div id="show-on-convert"></div>