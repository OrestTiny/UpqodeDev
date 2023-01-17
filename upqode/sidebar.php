<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Upqode
 */

if ( ! is_active_sidebar( 'upqode-sidebar' ) ) {
	return;
}
?>

<div class="col-12 col-lg-4">
    <div class="upqode-blog--sidebar">
		<?php dynamic_sidebar( 'upqode-sidebar' ); ?>
    </div>
</div>

