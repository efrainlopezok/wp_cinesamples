<?php

/**
 * Block Name: Videos Carousel
 *
 * This is the template that displays the videos carousel
 */

$is_floating = get_field( 'floating_bottom_slider' )? get_field( 'floating_bottom_slider' ) : 0;
$float_class = ($is_floating == '1')? 'floating-btm' : '';

$align_class = $block['align'] ? 'align' . $block['align'] : '';
$id = 'block-item-' . $block['id'];

?>
    <div id="<?php echo $id; ?>" class="block-videos-carousel <?php echo $align_class.' '.$float_class; ?>">
        <div class="block-inner">
            <div class="slide-videos">
                <?php
                $args = array(
                    'post_type' => 'video',
                    'showposts' => -1
                );
                $query = new WP_Query( $args );

                if( $query->have_posts() ):
                    while( $query->have_posts() ):  $query->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        $thumbnail = $image[0];
                        ?>
                        <div class="item-video" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%), url(<?php echo $thumbnail; ?>);">
                            <div class="content-videos">
                                <div class="play-icon"><i class="fas fa-caret-right"></i></div>
                                <div class="title-video">
                                    <h4><?php echo get_the_title(); ?></h4>
                                    <p><?php echo get_field('video_description'); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('.slide-videos').slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                });
            });
        </script>
    </div>
<?php

