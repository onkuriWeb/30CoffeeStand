<?php get_header();?>
<div class="l-page-header">
  <div class="l-page-header__inner">
    <h1 class="l-page-header__title">お知らせ</h1>
    <?php breadcrumbs();?>
  </div>
</div>
<div class="p-archive-list">
  <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 10,
      'paged' => $paged
    );
    $the_query = new WP_Query($args);
  ?>
  <ul class="p-archive-list__list">
  <?php if ($the_query->have_posts()): ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <li class="p-archive-list__item">
        <a class="p-archive-list__link" href="<?php the_permalink(); ?>">
          <span class="p-archive-list__date">
            <time datetime="<?php the_time('Y-m-d');?>">
              <?php the_time('Y/m/d'); ?>
            </time>
          </span>
          <span class="p-archive-list__title"><?php the_title();?></span>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
  <?php else: ?>
    <p class="p-archive-list__empty">お知らせはまだ投稿されていません。</p>
  </ul>
  <?php endif; wp_reset_postdata(); ?>
  <div class="p-archive-pagination">
    <?php pagination(); ?>
  </div>
</div>
<?php get_footer();?>