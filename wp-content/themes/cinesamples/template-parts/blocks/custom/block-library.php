<?php

/**
 * Block Name: Library
 *
 * This is the template that displays the Library block
 */

$is_all_cats = get_field( 'lib_all_categories' )? get_field( 'lib_all_categories' ) : 'yes';
$terms = get_field( 'lib_categories' )? get_field( 'lib_categories' ) : [];

if( 'yes' == $is_all_cats || empty( $terms ) ) {
    $terms = get_terms( 'video-cat'  );
}

$first_term = null;

?>
<div class="block-library">
    <div class="filter-section">
        <div class="filter-nav">
            <ul>
                <?php foreach( $terms as $term ): 
                    $class = is_null( $first_term )? 'active' : '';
                    $first_term = is_null( $first_term )? $term : $first_term;
                ?>
                <li class="<?php echo $class; ?>" data-slug="<?php echo $term->slug; ?>" ><a href=""><?php echo $term->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php 
        global $post;
        $args = array(
            'post_type' => 'video',
            'per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'video-cat',
                    'field'    => 'slug',
                    'terms'    => $first_term->slug,
                ),
            ),
        );
        $query = new WP_Query( $args );
        ?>
        <div class="filter-results">
            <div class="row desktop">
                <?php 
                if( $query->have_posts() ): ?>
                <?php while( $query->have_posts() ):  $query->the_post(); 
                    $thumb_img = get_the_post_thumbnail();
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="item-preview">
                        <picture>
                            <?php if( $thumb_img ):
                                echo $thumb_img;
                            else :
                            ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/preview-1.jpg" alt=";">
                            <?php endif; ?>
                            <?php $video_url = (get_field( 'video_url',$post->ID )) ? get_field( 'video_url',$post->ID ) : ""; ?>
                            <?php
                            $id_popup = substr(strrchr($video_url, "="), 1);

                            if( $video_url ) {
                                $video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
                                $video_url .= '?autoplay=1';
                            }
                            ?>
                            <a href="#popup_<?php echo $id_popup;  ?>" class="play-btn open-video-popup"></a>
                        </picture>
                    </div>
                    <div class="modal-popup modal-video mfp-hide" id="popup_<?php echo $id_popup ?>" data-url="<?php echo $video_url; ?>">
                    <header class="block-title">
                        <?php $video_description = (get_field( 'video_description',$post->ID )) ? get_field( 'video_description',$post->ID ) : ""; ?>
                        <?php if( $video_description ): ?>           
                        <p><?php echo $video_description; ?></p>
                        <?php endif; ?>
                    </header>
                    <div class="video-wrap">
                        <iframe width="100%" height="315" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                   
                </div>

                <?php endwhile; ?>
                <?php 
                wp_reset_postdata();
                endif; ?>
            </div>
    
            <div class="row mobile">
                <?php 
                if( $query->have_posts() ): ?>
                <?php while( $query->have_posts() ):  $query->the_post(); 
                    $thumb_img = get_the_post_thumbnail();
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="item-preview">
                        <picture>
                            <?php if( $thumb_img ):
                                echo $thumb_img;
                            else :
                            ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/preview-1.jpg" alt="">
                            <?php endif; ?>
                            <?php $video_url = (get_field( 'video_url',$post->ID )) ? get_field( 'video_url',$post->ID ) : ""; ?>
                            <?php
                            $id_popup = substr(strrchr($video_url, "="), 1);

                            if( $video_url ) {
                                $video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
                                $video_url .= '?autoplay=1';
                            }
                            ?>
                            <a href="#popup_<?php echo $id_popup;  ?>" class="play-btn open-video-popup"></a>
                        </picture>
                    </div>
                    <div class="modal-popup modal-video mfp-hide" id="popup_<?php echo $id_popup ?>" data-url="<?php echo $video_url; ?>">
                    <header class="block-title">
                        <?php $video_description = (get_field( 'video_description',$post->ID )) ? get_field( 'video_description',$post->ID ) : ""; ?>
                        <?php if( $video_description ): ?>           
                        <p><?php echo $video_description; ?></p>
                        <?php endif; ?>
                    </header>
                    <div class="video-wrap">
                        <iframe width="100%" height="315" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                   
                </div>

                <?php endwhile; ?>
                <?php 
                wp_reset_postdata();
                endif; ?>
            </div>

            <div class="arrow-nav mobile">
                <div class="btn-slick-prev"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-back.png" alt=""></div>
                <div class="btn-slick-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-next.png" alt=""></div>
            </div>

        </div>
    </div>
</div>