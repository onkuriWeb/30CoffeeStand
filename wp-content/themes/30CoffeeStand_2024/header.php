<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <?php wp_head(); ?>
  </head>
  <body>
    <header class="l-header<?php if(is_front_page()) { echo ' l-header--front js-front-header'; }?>">
      <h1 class="l-header__logo"><a href="<?php echo home_url(); ?>"><img src="<?php imgPath();?>/common/header_logo.svg" alt="@30 coffee stand"></a></h1>
      <button aria-label="メニューを開く" class="l-header__button js-header-button"><span class="l-header__button-line"></span></button>
      <?php get_template_part('template-parts/header', 'inner'); ?>
    </header>