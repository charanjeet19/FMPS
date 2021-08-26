<?php do_action( 'cpotheme_after_main' ); ?>

			<?php get_sidebar( 'footer' ); ?>

			<?php do_action( 'cpotheme_before_footer' ); ?>
			<footer id="footer" class="footer secondary-color-bg dark">
				<div class="container">
				<div class="footer-content">© Fix My Page Speed 2021.Design & Developed By <a href="https://afreshleaf.com">Afreshleaf</a>.</div>
					<?php //do_action( 'cpotheme_footer' ); ?>
				</div>
			</footer>
			<?php do_action( 'cpotheme_after_footer' ); ?>

			<div class="clear"></div>
		</div><!-- wrapper -->
		<?php do_action( 'cpotheme_after_wrapper' ); ?>
	</div><!-- outer -->
	<?php wp_footer(); ?>
</body>
</html>
