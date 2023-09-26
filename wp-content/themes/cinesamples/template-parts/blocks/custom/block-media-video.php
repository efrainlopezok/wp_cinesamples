<?php

/**
 * Block Name: Media Video
 *
 * This is the template that displays the media video block
 */

$bg_img  = get_field('video_background') ? get_field('video_background') : [];
$description  = get_field('video_description') ? get_field('video_description') : '';
$video_url = get_field('video_url') ? get_field('video_url') : '';
$vid = uniqid();

if( empty($bg_img) ) {
    $bg_img = [
        'url'=> get_stylesheet_directory_uri() . '/images/video-bg.jpg',
        'title' => 'video background'
    ];
}

if( $video_url ) {
    $video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
    $video_url .= '?autoplay=1';
}
?>
<div class="block-media-video" id="<?php echo $vid; ?>">
    <picture>
        <img src="<?php echo $bg_img['url'] ?>" alt="<?php echo $bg_img['title'] ?>">
        <a href="#popup_<?php echo $vid ?>"  class="play-btn open-video-popup"></a>
    </picture>
    <?php if( $description ): ?>
    <p><?php echo $description; ?></p>
    <?php endif; ?>
</div>
<div class="modal-popup modal-video mfp-hide" id="popup_<?php echo $vid ?>" data-url="<?php echo $video_url; ?>">
    <header class="block-title">
        <?php if( $description ): ?>           
        <h3 class="f-color-black"><?php echo $description; ?></h3>
        <?php endif; ?>
    </header>
    <div class="video-wrap">
        <iframe width="100%" height="315" frameborder="0" allowfullscreen></iframe>
    </div>
</div>