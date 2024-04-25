<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/icon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri();?>/icon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri();?>/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <?php wp_head(); ?>
  </head>
  <body>
    <header class="l-header<?php if(is_front_page()) { echo ' l-header--front js-front-header'; }?>">
      <h1 class="l-header__logo"><a href="<?php echo home_url(); ?>"><img src="<?php imgPath();?>/common/header_logo.svg" alt="@30 coffee stand"></a></h1>
      <button aria-label="メニューを開く" class="l-header__button js-header-button"><span class="l-header__button-line"></span></button>
      <?php get_template_part('template-parts/header', 'inner'); ?>
    </header>