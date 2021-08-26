<?php 

$footer_columns = cpotheme_get_option('layout_subfooter_columns');
if($footer_columns == '') $footer_columns = 3;

$check = false;

for($count = 1; $count <= $footer_columns; $count++){
	if ( is_active_sidebar('footer-widgets-'.$count) ) {
		$check = true;
		break;
	}
}

if ( $check ) { ?>
	<section id="subfooter" class="subfooter secondary-color-bg dark">
		<div class="container">
			<?php do_action('cpotheme_subfooter'); ?>
		</div>
	</section>
<?php } ?>