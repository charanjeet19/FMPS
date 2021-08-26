<?php
 /* 
 Template Name: Products 
 */
 ?>
 <?php get_header(); ?>


<?php get_template_part( 'template-parts/element', 'page-header' ); ?>

<?php 
$mscore = $_GET['mscore'];
$dscore = $_GET['dscore'];

 if ($dscore > 89) {
	$dproduct_id = 0;
    }
    else if ($dscore > 79) {
        $dproduct_id = 4011;
    }
    else if ($dscore > 69) {
        $dproduct_id = 4012;
    }
    else if ($dscore > 59) {
        $dproduct_id = 4013;
    }
    else {
        $dproduct_id = 4014;
    } 

 if ($mscore > 89) {
	$mproduct_id = 0;
    }
    else if ($mscore > 79) {
        $mproduct_id = 4015;
    }
    else if ($mscore > 69) {
        $mproduct_id = 4016;
    }
    else if ($mscore > 59) {
        $mproduct_id = 4017;
    }
    else {
        $mproduct_id = 4018;
    }
	if($dproduct_id != 0){
	$dproduct = wc_get_product( $dproduct_id );
	}
	if($mproduct_id != 0){
	$mproduct = wc_get_product( $mproduct_id );
	}
?>
<div id="main" class="main">
	<div class="container">
	<table>
	<tr>
	<td><b>Device</b></td><td><b>Score</b></td><td><b>Price</b></td><td><b>Fix</b></td>
	</tr>
	<tr>
	<td>Desktop</td><td><?php echo $dscore; ?></td><td><?php if(!empty($dproduct)){ echo '$'.$dproduct->get_price();} else { echo 'Desktop is good'; } ?></td><td><?php if(!empty($dproduct)){ ?><a href="?add-to-cart=<?php echo $dproduct_id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $dproduct_id; ?>" data-product_sku="" aria-label="Add “Desktop” to your cart" rel="nofollow">Add to cart</a><?php } ?></td>
	</tr>
	<tr>
	<td>Mobile</td><td><?php echo $mscore; ?></td><td><?php if(!empty($mproduct)){ echo '$'.$mproduct->get_price();} else { echo 'Mobile is good'; } ?></td><td><?php if(!empty($mproduct)){ ?><a href="?add-to-cart=<?php echo $mproduct_id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $mproduct_id; ?>" data-product_sku="" aria-label="Add “Mobile” to your cart" rel="nofollow">Add to cart</a><?php } ?></td>
	</tr>
	<?php if($dproduct_id !=0 && $mproduct_id !=0){ ?>
	<tr>
	<td>Desktop+Mobile</td><td></td><td><?php echo '$'.($dproduct->get_price()+$mproduct->get_price()-50); ?></td><td><?php if(!empty($mproduct)){ ?><a href="cart?multiple-item-to-cart=<?php echo $dproduct_id; ?>|<?php echo $mproduct_id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="4018" data-product_sku="" aria-label="Add “Mobile” to your cart" rel="nofollow">Add to cart Both</a><?php } ?></td>
	</tr>
	<?php } ?>
	</table>
	 
	
	<?php
			if ( have_posts() ) {
				while ( have_posts() ) :
					the_post();
				?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			endwhile;
			};
?>


</div>
</div>






<?php get_footer(); ?>

