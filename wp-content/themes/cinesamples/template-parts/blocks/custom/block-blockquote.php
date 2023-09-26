<?php

/**
 * Block Name: Blockquote
 *
 * This is the template that displays the media video block
 */

$blockquote_image  = get_field('blockquote_image') ? get_field('blockquote_image') : [];
$blockquote_content  = get_field('blockquote_content') ? get_field('blockquote_content') : '';
$author_blockquote  = get_field('author_blockquote') ? get_field('author_blockquote') : '';


?>
<div class="sec-blockquote" >
    <picture>
        <img src="<?php echo $blockquote_image['url'] ?>" alt="<?php echo $blockquote_image['title'] ?>">
    </picture>
    <?php if( $blockquote_content ): ?>
        <blockquote>
            <?php echo $blockquote_content; ?>
            <?php if( $author_blockquote ): ?>
            <p>
            <span><?php echo $author_blockquote; ?></span>
            </p>
            <?php endif; ?>
        </blockquote >
    <?php endif; ?>
    
</div>
