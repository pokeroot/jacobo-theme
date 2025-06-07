<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-100 text-gray-900'); ?>>
<div id="page" class="min-h-screen flex flex-col">
    <?php // Aquí podría ir un futuro header global del dashboard ?>
    <main id="content" class="flex-grow">
