<nav class="l-header__inner js-header-nav<?php if (isset($args['class'])) {
    echo ' ' . $args['class'] . '__inner';
  } ?>">
  <h1 class="l-header__inner-logo"><img src="<?php imgPath();?>/common/header_logo.svg" alt="@30 coffee stand"></h1>
  <ul class="l-header__list<?php if (isset($args['class'])) {
      echo ' ' . $args['class'] . '__list';
    } ?>">
    <li class="l-header__item<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__item';
      } ?>">
      <a class="l-header__link<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link';
      } ?>" href="<?php echo home_url(); ?>#about"><span class="l-header__link-inner<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link-inner';
      } ?>"><span class="l-header__link-text l-header__link-text--01">@30 coffee standとは</span><span class="l-header__link-text l-header__link-text--02">@30 coffee standとは</span></span></a>
    </li>
    <li class="l-header__item<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__item';
      } ?>">
      <a class="l-header__link<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link';
      } ?>" href="<?php echo home_url(); ?>#menu"><span class="l-header__link-inner<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link-inner';
      } ?>"><span class="l-header__link-text l-header__link-text--01">メニュー</span><span class="l-header__link-text l-header__link-text--02">メニュー</span></span></a>
    </li>
    <li class="l-header__item<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__item';
      } ?>">
      <a class="l-header__link<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link';
      } ?>" href="<?php echo home_url(); ?>#access"><span class="l-header__link-inner<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link-inner';
      } ?>"><span class="l-header__link-text l-header__link-text--01">基本情報・アクセス</span><span class="l-header__link-text l-header__link-text--02">基本情報・アクセス</span></span></a>
    </li>
    <li class="l-header__item<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__item';
      } ?>">
      <a class="l-header__link<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link';
      } ?>" href="<?php echo home_url(); ?>#goods"><span class="l-header__link-inner<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link-inner';
      } ?>"><span class="l-header__link-text l-header__link-text--01">グッズ</span><span class="l-header__link-text l-header__link-text--02">グッズ</span></span></a>
    </li>
    <li class="l-header__item<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__item';
      } ?>">
      <a class="l-header__link<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link';
      } ?>" href="https://www.instagram.com/30.coffee.stand/" target="_blank"><span class="l-header__link-inner<?php if (isset($args['class'])) {
        echo ' ' . $args['class'] . '__link-inner';
      } ?>"><span class="l-header__link-text l-header__link-text--01">Instagram</span><span class="l-header__link-text l-header__link-text--02">Instagram</span></span></a>
    </li>
  </ul>
</nav>