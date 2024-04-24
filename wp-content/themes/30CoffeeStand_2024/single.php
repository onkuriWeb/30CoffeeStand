<?php get_header();?>
<div class="l-page-header p-single-header">
  <div class="l-page-header__inner">
    <p class="p-single-header__date">
      <time datetime="<?php the_time('Y-m-d');?>">
        <?php the_time('Y/m/d'); ?>
      </time>
    </p>
    <h1 class="l-page-header__title"><?php the_title(); ?></h1>
    <?php breadcrumbs();?>
  </div>
</div>
<div class="p-single-content">
  <?php the_content();?>
</div>
<a class="p-single-button" href="<?php echo home_url(); ?>/news/"><span class="p-single-button__inner"><span class="p-single-button__text p-single-button__text--01">一覧に戻る</span><span class="p-single-button__text p-single-button__text--02">一覧に戻る</span></span></a>
<?php get_footer();?>