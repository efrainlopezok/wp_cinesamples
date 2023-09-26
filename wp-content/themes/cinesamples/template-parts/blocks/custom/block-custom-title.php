<?php
/**
 * Block Name: Custom Title
 *
 * This is the template that displays the Custom Title
 */

$custom_c_align  = get_field('custom_c_align') ? get_field('custom_c_align') : 'left';
$custom_c_color_text  = get_field('custom_c_color_text') ? get_field('custom_c_color_text') : 'black';
$custom_c_short_title  = get_field('custom_c_short_title') ? '<h5>'.get_field('custom_c_short_title').'</h5>' : '';
$custom_c_title  = get_field('custom_c_title') ? '<h3 class="f-color-'.$custom_c_color_text.'">'.get_field('custom_c_title').'</h3>' : '';
$custom_c_content  = get_field('custom_c_content') ? '<div class="f-color-'.$custom_c_color_text.'">'.get_field('custom_c_content').'</div>' : '';

$full_size = get_field('full_size_content') ? 'col-md-12' : 'col-md-5';
$side_by_side = get_field('side_by_side') ? get_field('side_by_side') : '';
// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
$id = 'block-item-' . $block['id'];

?>
<div id="<?php echo $id; ?>" class="custom-title <?php echo $full_size.' '.$align_class ?>">
    <header class="block-title text-<?php echo $custom_c_align?> <?php echo 'f-color-'.$custom_c_color_text?>">
    	<?php
    	if ($side_by_side) {
    		?>
    		<div class="row">
    			<div class="col-md-5">
    				<?php echo $custom_c_short_title?>
        			<?php echo $custom_c_title?>
    			</div>
    			<div class="col-md-7">
    				<h5>&nbsp;</h5>
    				<?php echo $custom_c_content?>
    			</div>
    		</div>
    		<?php
    	}else{
    		?>
    		<?php echo $custom_c_short_title?>
	        <?php echo $custom_c_title?>
	        <?php echo $custom_c_content?>
	        <?php
    	}
    	?>
    </header>
</div>
<?php
