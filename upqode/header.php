<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Upqode
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
    </head>
<body <?php body_class(); ?> >
<!-- MAIN_WRAPPER -->

<?php
wp_body_open();

get_template_part( 'template-parts/theme-header' ); ?>