<?php

/**
 * Block Name: Slider Categories
 *
 * This is the template that displays the Slider Categories
 */

$is_floating = get_field( 'floating_bottom_slider' )? get_field( 'floating_bottom_slider' ) : 0;
$float_class = ($is_floating == '1')? 'floating-btm' : '';

$terms = get_terms(['taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0]) ? get_terms(['taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0]) : '';
$align_class = $block['align'] ? 'align' . $block['align'] : '';
$id = 'block-item-' . $block['id'];
if ($terms != '') :
?>
    <div id="<?php echo $id; ?>" class="block-boxes <?php echo $align_class . '' . $blk_services_move_to_up . " {$float_class}"; ?>">
        <div class="block-inner">
            <div class="slide-product-cat row">
                <?php foreach ($terms as $term) :
                        $title = $term->name;
                        $term_id = $term->term_id;
                        $thumbnail_id  = (int) get_term_meta( $term->term_id, 'thumbnail_id', true );
                        if( $thumbnail_id > 0 ) {
                            $term_img  = wp_get_attachment_url( $thumbnail_id );
                            $img_html = 'style="background-image: url(' . $term_img . ');"';
                        } else {
                            $img_html = 'style="background-color: #000;"';
                        }
    
                ?>
                    <div class="box-product-cat" <?php echo $img_html?>>
                        <h3><?php echo $title?></h3>
                    </div>
                   

                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
endif;
