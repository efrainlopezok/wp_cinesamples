<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// adding custom fields

add_action( 'woocommerce_before_add_to_cart_button', 'cfwc_display_custom_field' );
function cfwc_display_custom_field(){
	$product = wc_get_product(get_the_ID());
	echo '<table class="table-more-dsc">';
		echo '<tr><th>Version</th><td>2.3</td></tr>';
		echo '<tr><th>Compatibility</th><td>Works with the FREE version of Kontakt<br>5.6.8+</td></tr>';
	echo '</table>';
	echo '<p class="price custom-bottom-price">'.$product->get_price_html().'</p>';
}

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	
		?>
		<div class="top-product-content">
			<div class="cont-prod-wrap">
			<?php
			do_action( 'woocommerce_before_single_product_summary' );

	        $terms = get_the_terms ( get_the_ID(), 'product_cat' );

	        foreach ( $terms as $term ) {
	        	$term_link = '<a href="'.get_term_link( $term ).'">'.$term->name.'</a>';
	        }

	        $terms2 = get_the_terms( get_the_ID(), 'serie' );
	        if ($terms2) {
	        	foreach ( $terms2 as $serie ) {
		        	$serie_link = '<span class="separator"><i class="fa fa-chevron-right"></i></span><a href="'.get_term_link( $serie ).'">'.$serie->name.'</a>';
		        }
	        }

			?>

			<div class="summary entry-summary">
				<div class="custom-cat-serie">
					<?php echo $term_link.$serie_link; ?>
				</div>
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
			</div>
		</div>

		<?php
		if(!$product->is_type( 'bundle' )){
		?>

		<!-- Content Large Description -->
		<div class="large-product-description section-sp">
			<div class="wrap">
				<h4>Description</h4>
				<p><?php echo get_field('large_description'); ?></p>
			</div>
		</div>
		<!-- End Content Large Description -->


		<!-- Check Bundles Container -->
		<?php
		$args = array( 
            'post_type' => 'product',               
            'showposts' => -1, 
            'tax_query'=> array(
			    array(
			        'taxonomy' => 'product_type',
			        'field'    => 'slug',
			        'terms'    => 'bundle', 
			    ),
			),
        );

 		$loop = new WP_Query( $args );
 		while ( $loop->have_posts() ) : $loop->the_post(); ?>

		    <a href="<?php echo get_permalink( $loop->post->ID ) ?>">
		        <?php the_title(); ?>
		    </a>

		<?php endwhile; wp_reset_query();
		?>
		<!-- End Check Bundles Container -->


		<!-- Content Demo Videos -->
		<div class="large-product-videos section-sp">
			<div class="wrap">
				<h4><?php echo get_field('demo_videos_small_title') ?></h4>
				<h2><?php echo get_field('demo_videos_title') ?></h2>
				<p><?php echo get_field('demo_videos_description') ?></p>
				<?php
				$videos = get_field('videos') ? get_field('videos') : '';
				if ($videos) {
					?>
					<div class="videos-carousel">
						<?php
						foreach ( $videos as $video ) :

							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $video ), 'full' );
							?>
							<div class="c-video-p" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%),url(<?php echo $image[0] ?>);">
								<h4><?php echo get_the_title($video); ?></h4>
								<?php echo get_field('video_description', $video); ?>
							</div>
							<?php
						endforeach;
						?>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('.videos-carousel').slick({
								dots: false,
								infinite: false,
								speed: 300,
								slidesToShow: 1,
								slidesToScroll: 1,
								arrows: false,
								responsive: [
								{
								  breakpoint: 1024,
								  settings: {
								    slidesToShow:1,
								    arrows: false,
								    slidesToScroll: 1,
								    infinite: false,
								    dots: false
								  }
								},
								{
								  breakpoint: 600,
								  settings: {
								  	arrows: false,
								    slidesToShow: 1,
								    slidesToScroll: 1
								  }
								},
								{
								  breakpoint: 480,
								  settings: {
								  	arrows: false,
								    slidesToShow: 1,
								    slidesToScroll: 1
								  }
								}
								]
							});
						});
					</script>
					<?php
				}
				?>
			</div>
		</div>
		<!-- End Content Demo Videos -->

		<!-- Content Demo Samples -->
		<div class="content-demo-samples section-sp">
			<div class="wrap">
				<div class="row">
					<div class="col-md-5">
						<h4><?php echo get_field('product_demo_sample_small_title'); ?></h4>
						<h2><?php echo get_field('product_demo_sample_title'); ?></h2>
						<?php echo get_field('product_demo_sample_description'); ?>
					</div>
					<div class="col-md-7">
						<?php
						$samples = get_field('samples') ? get_field('samples') : '';
						if ($samples) {
							$counter = 0;
							while ( have_rows('samples') ) : the_row();
								$counter++;
								?>
								<div class="sample-item">
									<span class="number"><?php echo $counter; ?></span>
									<span class="dsc"><strong><?php echo get_sub_field('sample_title'); ?></strong><br><?php echo get_sub_field('sample_description'); ?></span>
									<a href="#" class="link-sample"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/play-button.png"></a>
								</div>
								<?php
							endwhile;
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content Demo Samples -->

		<!-- Content Product -->
		<div class="single-p-container section-sp">
			<div class="wrap">
			<?php echo do_shortcode(apply_filters( 'the_content', get_the_content(get_the_ID()) )); ?>
			</div>
		</div>
		<!-- End Content Product -->

		<!-- Content Patch List -->
		<div class="single-patch-list section-sp">
			<div class="wrap">
				<div class="row">
					<div class="col-md-5">
						<h2><?php echo get_field('product_patch_list_title'); ?></h2>
						<p><?php echo get_field('product_patch_list_description'); ?></p>
					</div>
					<div class="col-md-7">
						<div class="patch-list">
							<div class="pl-left">
								<?php
								$pll = get_field('patch_list_left') ? get_field('patch_list_left') : '';
								if ($pll) {
									while ( have_rows('patch_list_left') ) : the_row();
										?>
										<div class="patch-item">
											<span class="number"><?php echo get_sub_field('number'); ?></span>
											<span class="dsc"><?php echo get_sub_field('pl_content'); ?></span>
										</div>
										<?php
									endwhile;
								}
								?>
							</div>
							<div class="pl-right">
								<?php
								$plr = get_field('patch_list_right') ? get_field('patch_list_right') : '';
								if ($plr) {
									while ( have_rows('patch_list_right') ) : the_row();
										?>
										<div class="patch-item">
											<span class="number"><?php echo get_sub_field('number'); ?></span>
											<span class="dsc"><?php echo get_sub_field('pl_content'); ?></span>
										</div>
										<?php
									endwhile;
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content Patch List -->

		<!-- Tech Specs -->
		<div class="single-tech-specs section-sp">
			<div class="wrap">
				<div class="row">
					<div class="col-md-5">
						<h5>TEch</h5>
						<h2>Specs</h2>
					</div>
					<div class="col-md-7">
						<?php echo get_field('tech_specs_content'); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- End Tech Specs -->

		<!-- Credits -->
		<div class="single-credits section-sp">
			<div class="wrap">
				<div class="row">
					<div class="col-md-5">
						<h5>Credits</h5>
						<h2><?php echo get_field('product_credits_title'); ?></h2>
						<p><?php echo get_field('product_credits_description'); ?></p>
					</div>
					<div class="col-md-7">
						<table>
							<tbody>
								<?php
								if (get_field('produced_by')) {
									?>
									<tr>
										<th>Produced by</th>
										<td><?php echo get_field('produced_by'); ?></td>
									</tr>
									<?php
								}
								if (get_field('project_director')) {
									?>
									<tr>
										<th>Project Director</th>
										<td><?php echo get_field('project_director'); ?></td>
									</tr>
									<?php
								}
								if (get_field('scripted_by')) {
									?>
									<tr>
										<th>Scripted by</th>
										<td><?php echo get_field('scripted_by'); ?></td>
									</tr>
									<?php
								}
								if (get_field('recording_engineer')) {
									?>
									<tr>
										<th>Recording Engineer</th>
										<td><?php echo get_field('recording_engineer'); ?></td>
									</tr>
									<?php
								}
								if (get_field('mix_engineer')) {
									?>
									<tr>
										<th>Mix Engineer</th>
										<td><?php echo get_field('mix_engineer'); ?></td>
									</tr>
									<?php
								}
								if (get_field('editors')) {
									?>
									<tr>
										<th>Editors</th>
										<td><?php echo get_field('editors'); ?></td>
									</tr>
									<?php
								}
								if (get_field('quality_assurance')) {
									?>
									<tr>
										<th>Quality Assurance</th>
										<td><?php echo get_field('quality_assurance'); ?></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- End Credits -->
		<?php
	}else{
		/* Bundle Product Content */
		$bundled_items = $product->get_bundled_items();
		?>
		<div class="buldled-list-items">
			<div class="wrap">
				<h4 class="text-center">Libraries included in the bundle <div class="navigation"><button class="carousel-nav carousel-prev"><i class="fa fa-chevron-left"></i></button><button class="carousel-nav carousel-next"><i class="fa fa-chevron-right"></i></button></div></h4>
			<?php
	        if ( $bundled_items ) {
	        	?>
	        	<div class="list-bundles">
	        	<?php
	            foreach ( $bundled_items as $bundled_item_id => $bundled_item ) {
	                $buldled_id = $bundled_item->get_product_id();
	                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $buldled_id ), 'full' );
	                ?>
	                <div class="bundle-item" style="background:#0e2c37 url(<?php echo $image[0] ?>);">
	                	<div class="toggle-view-p-content">
	                		<a href="#" class="view-product" p-id="<?php echo $buldled_id; ?>">Expand <span></span></a>
	                	</div>
	                </div>
	                <?php
	            }
	            ?>
	        	</div>
	        	<div class="mobile-navigation-buld">
	        		<button class="carousel-nav carousel-prev"><i class="fa fa-chevron-left"></i></button><button class="carousel-nav carousel-next"><i class="fa fa-chevron-right"></i></button>
	        	</div>
	        	<script type="text/javascript">
	        		jQuery(document).ready(function(){
	        			jQuery('.list-bundles').slick({
							dots: false,
							infinite: true,
							speed: 300,
							slidesToShow: 3,
							slidesToScroll: 1,
							arrows: false,
							responsive: [
							{
							  breakpoint: 600,
							  settings: {
							  	arrows: false,
							    slidesToShow: 2,
							    slidesToScroll: 1
							  }
							},
							{
							  breakpoint: 480,
							  settings: {
							  	arrows: false,
							    slidesToShow: 1,
							    slidesToScroll: 1
							  }
							}
							]
						});
						jQuery('.carousel-prev').click(function(e){
							e.preventDefault();
							jQuery('.list-bundles').slick('slickPrev');
						} );
						jQuery('.carousel-next').click(function(e){
							e.preventDefault();
							jQuery('.list-bundles').slick('slickNext');
						});
						jQuery('.bundle-item .toggle-view-p-content a.view-product').on('click', function(e){
							e.preventDefault();
							jQuery('.bundle-item').addClass('disabled');
							jQuery('.bundle-item').removeClass('current');
							var current = jQuery(this).parent().parent();
							var product_id = jQuery(this).attr('p-id');
							jQuery.ajax({
					            url: '<?php echo admin_url('admin-ajax.php'); ?>',
					            type: 'post',
					            data: {
					                'action': 'detail_product',
					                'product_id': product_id,
					            },
					            success: function(response) {
					                current.addClass('current');
					                current.removeClass('disabled');
					                jQuery('.result-cproduct-det').html('<a class="close-dsc">×</a>' + response);
					            },
					            error: function(errorThrown) {
					                alert(errorThrown);
					            }
					        });
						});
						jQuery('.result-cproduct-det a.close-dsc').live('click', function(e){
							e.preventDefault();
							jQuery('.bundle-item').removeClass('disabled');
							jQuery('.bundle-item').removeClass('current');
							jQuery('.result-cproduct-det').html('');
						});
	        		});
	        	</script>
	            <?php
	        }
	        ?>
        	</div>
        </div>
        <div class="result-cproduct-det"></div>
        <?php
		/* End Bundle Product Content */
	}
	

	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>



</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
