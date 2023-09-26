<?php
/**
 * Block Name: Tabs
 *
 * This is the template that displays the tabs
 */

$custom_tabs  = get_field('tabs') ? get_field('tabs') : '';

$align_class = $block['align'] ? 'align' . $block['align'] : '';
$id = 'block-item-' . $block['id'];


?>
<div id="<?php echo $id; ?>" class="custom-tabs <?php echo $align_class ?>">
    <div class="custom-tabs-content">
        <?php if($custom_tabs != ''):
        	$counter = 0;
        	$counter_content = 0;
        	?>
        	<div class="row">
        		<div class="col-md-4">
        			<div class="tabs-nav">
		        		<ul>
			            <?php foreach($custom_tabs as $item):
			            	$counter++;
			            	$class_first = ($counter == 1) ? 'active' : '';
			            	?>
			                <li class="nav-item <?php echo $class_first; ?>"><a href="#item-<?php echo $counter; ?>"><?php echo $item['item_link']; ?></a></li>
			            <?php endforeach;?>
		        		</ul>
		        	</div>
        		</div>
	        	<div class="col-md-8">
	        		<div class="tabs-content">
	        			<?php foreach($custom_tabs as $item):
			            	$counter_content++;
			            	$class_nfirst = ($counter_content == 1) ? 'active' : '';
			            	?>
			                <div class="content-item <?php echo $class_nfirst; ?>" id="item-<?php echo $counter_content; ?>"><?php echo do_shortcode($item['item_content']); ?></div>
			            <?php endforeach;?>
	        		</div>
	        	</div>
        	</div>
        <?php endif;?>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
        	jQuery('.tabs-nav li a').on('click', function(e){
        		e.preventDefault();
        		jQuery('.tabs-nav li').removeClass('active');
        		jQuery(this).parent().addClass('active');
        		var content_to_show = jQuery(this).attr('href');
        		jQuery('.tabs-content .content-item').removeClass('active');
        		jQuery(content_to_show).addClass('active');
        	});
        });
    </script>
</div>