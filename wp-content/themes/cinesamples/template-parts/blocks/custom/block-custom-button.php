<?php
/**
 * Block Name: Custom Button
 *
 * This is the template that displays the custom button block
 */


$text = get_field( 'c_b_text' )? get_field( 'c_b_text' ) : 'Button Text';
$position = get_field( 'c_b_position' )? get_field( 'c_b_position' ) : 'left';
$url = get_field( 'c_b_url' )? get_field( 'c_b_url' ) : 'javascript:;';
$type = get_field( 'c_b_type' )? get_field( 'c_b_type' ) : 'btn';

$btn_types = ['default' => '', 'transparent' => 'btn-transparent'];

$class = 'btn ';
if( isset( $btn_types[ $type ] ) ) {
    $class .= $btn_types[ $type ];
}


?>
<div class="block-c-button block-cb-<?php echo $position; ?>">
    <a class="<?php echo $class; ?>" href="<?php echo $url; ?>" title="<?php echo $text; ?>"><?php echo $text; ?></a>
</div>