<?php get_header();?>
<header class="p-front-header">
  <h1 class="p-front-header__logo"><img src="<?php imgPath();?>/common/logo.svg" alt="@30 coffee stand"></h1>
  <?php
  $args = ['class' => 'p-front-header'];
  get_template_part('template-parts/header', 'inner', $args); ?>
</header>
<?php
//////////////////////////////// Main visual ////////////////////////////////
?>
<div class="p-front-mainvisual">
  <h1 class="p-front-mainvisual__copy">
    <div class="p-front-mainvisual__copy-inner">
      <span class="p-front-mainvisual__line">飯塚の素敵な夜を</span>
      <span class="p-front-mainvisual__line">月のように優しく照らす</span>
      <span class="p-front-mainvisual__line">あなたを労うコーヒースタンド</span>
    </div>
  </h1>
  <div class="p-front-mainvisual__image">
    <picture>
      <source media="(min-width: 768px)" srcset="<?php imgPath(); ?>/page/front/main_l.webp" type="image/webp">
      <img src="<?php imgPath(); ?>/page/front/main.webp">
    </picture>
  </div>
</div>
<?php
//////////////////////////////// News ////////////////////////////////
?>
<div id="news" class="p-front-news">
  <section class="p-front-news__inner">
    <h2 class="p-front-news__heading c-heading">
      <span class="c-heading__text">お知らせ</span>
      <span class="c-heading__en"><img src="<?php imgPath();?>/page/front/news_title.svg" alt="News"></span>
    </h2>
    <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
      );
      $the_query = new WP_Query($args);
    ?>
    <ul class="p-front-news__list">
    <?php if ($the_query->have_posts()): ?>
      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <li class="p-front-news__item">
          <a class="p-front-news__link" href="<?php the_permalink(); ?>">
            <span class="p-front-news__date">
              <time datetime="<?php the_time('Y-m-d');?>">
                <?php the_time('Y/m/d'); ?>
              </time>
            </span>
            <span class="p-front-news__title"><?php the_title();?></span>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
    <?php else: ?>
      <p class="p-front-news__empty">お知らせはまだ投稿されていません。</p>
    </ul>
    <?php endif; wp_reset_postdata(); ?>
    <div class="p-front-news__day">
      <h3 class="p-front-news__term">営業日カレンダー</h3>
      <div class="p-front-news__calendar"></div>
    </div>
  </section>
</div>
<?php
//////////////////////////////// About ////////////////////////////////
?>
<div id="about" class="p-front-about">
  <div class="p-front-about__inner">
    <div class="p-front-about__image">
      <img src="<?php imgPath(); ?>/page/front/about.svg" alt="@30 coffee stand ロゴ">
    </div>
    <div class="p-front-about__text">
      <p class="p-front-about__line">@30 coffee standは2023年8月に飯塚にオープンした<br class="p-front-about__break">テイクアウト型の夜コーヒーの専門店です。</p>
      <p class="p-front-about__line">これから仕事に向かったり、<br>
      仕事帰りのスイッチをオフにする瞬間、<br>
      休憩中にほっと一息。</p>
      <p class="p-front-about__line">飯塚の素敵な夜で時間を過ごす方達を月のように優しく照らし、労いたい。<br>
      そんな想いが込められています。</p>
      <p class="p-front-about__line">Coffee  standとはテイクアウトをメインとしてコーヒーを提供する専門店という意味を持っています。</p>
      <p class="p-front-about__line">経験を持つバリスタが本格コーヒーから、ラテ、お酒（アルコール）入りのコーヒー、<br class="p-front-about__break">フラッペまで幅広いメニューを揃えています。</p>
    </div>
  </div>
</div>
<?php
//////////////////////////////// Menu ////////////////////////////////
?>
<section id="menu" class="p-front-menu">
  <h2 class="p-front-menu__heading c-heading c-heading--center">
    <span class="c-heading__text">メニュー</span>
    <span class="c-heading__en"><img src="<?php imgPath();?>/page/front/menu_title.svg" alt="Menu"></span>
  </h2>
  <div class="p-front-menu__inner">
    <nav class="p-front-menu__nav">
      <ul class="p-front-menu__nav-list">
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#seasonal">期間限定</a>
        </li>
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#coffee">コーヒー</a>
        </li>
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#latte">ラテ</a>
        </li>
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#frappe">フラッペ</a>
        </li>
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#special">スペシャル</a>
        </li>
        <li class="p-front-menu__nav-item">
          <a class="p-front-menu__nav-link" href="#alcohol">お酒コーヒー</a>
        </li>
      </ul>
    </nav>
    <div class="p-front-menu__all">
      <?php
        $tax_name = 'menu-cat';
        $posttype_name = 'menu';
        $terms = get_terms($tax_name,
          array(
            'parent' => 0,
            'orderby' => 'description'
          ));
        foreach ( $terms as $term ):

          $args = array(
            'post_type' => $posttype_name,
            'order' => 'ASC',
            'tax_query' => array(
              array(
                'taxonomy' => $tax_name,
                'field'    => 'slug',
                'terms'    => $term->slug,
                'order' => 'ASC'
              ),
            ),
          );
          $the_query = new WP_Query( $args );
      if ($the_query->have_posts()):
      // ターム名 start
      ?>
      <div id="<?php echo $term->slug; ?>">
        <div class="p-front-menu__info">
          <h2 class="p-front-menu__category p-front-menu__category--<?php
            echo $term->slug;
            
            if(get_field('note', $tax_name."_".$term->term_id)) {
              echo ' p-front-menu__category--has-note';
            };
          ?>"><?php echo $term->name; ?></h2>
          <?php
          if(get_field('note', $tax_name."_".$term->term_id)) {
            echo
            '<p class="p-front-menu__note">'.get_field('note', $tax_name."_".$term->term_id).'</p>';
          }; ?>
          <span class="p-front-menu__tax">価格は税込です。</span>
        </div>
        <?php
        // ターム名 end
        ?>
        <ul class="p-front-menu__list p-front-menu__list--<?php echo $term->slug; ?>">
          <?php while ($the_query->have_posts()) : $the_query->the_post();
          // 記事表示 start
          ?>
          <li class="p-front-menu__item">
            <div class="p-front-menu__image">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="p-front-menu__item-info">
              <p class="p-front-menu__name"><?php the_title() ?></p>
              <p class="p-front-menu__price-list">
                <?php
                if(get_field('price')['sSize'] && get_field('price')['mSize']) {
                  echo
                  '<span class="p-front-menu__price-item p-front-menu__price-item--small"><span class="p-front-menu__price-yen">¥</span><span class="p-front-menu__price">'.get_field('price')['sSize'].'</span></span>'.
                  '<span class="p-front-menu__price-item p-front-menu__price-item--medium"><span class="p-front-menu__price-yen">¥</span><span class="p-front-menu__price">'.get_field('price')['mSize'].'</span></span>';
                } else {
                  echo '<span class="p-front-menu__price-item p-front-menu__price-item--only"><span class="p-front-menu__price-yen">¥</span><span class="p-front-menu__price">'.get_field('price')['sSize'].get_field('price')['mSize'].'</span></span>';
                };
                ?>
              </p>
            </div>
          </li>
          <?php
          // 記事表示 end
          endwhile; ?>
        </ul>
        <?php if($term->slug == 'coffee' || $term->slug == 'latte' || $term->slug == 'frappe' || $term->slug == 'special' || $term->slug == 'alcohol'): ?>
        <p class="p-front-menu__to-top"><a href="#menu">メニュートップに戻る</a></p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php
//////////////////////////////// Access ////////////////////////////////
?>
<section id="access" class="p-front-access">
  <div class="p-front-access__image">
    <picture>
      <source media="(min-width: 768px)" srcset="<?php imgPath(); ?>/page/front/access_l.webp" type="image/webp">
      <img src="<?php imgPath(); ?>/page/front/access.webp">
    </picture>
  </div>
  <div class="p-front-access__content">
    <h2 class="p-front-access__heading c-heading">
      <span class="c-heading__text">営業時間・アクセス</span>
      <span class="c-heading__en"><img src="<?php imgPath();?>/page/front/access_title.svg" alt="Access"></span>
    </h2>
    <p class="p-front-access__intro"><span class="p-front-access__intro-min">@30 coffee stand は<br>2023年8月にオープンした、<wbr>テイクアウト型の</span><span class="p-front-access__intro--bold">夜コーヒー専門店</span>です。</p>
    <dl class="p-front-access__info">
      <dt class="p-front-access__term">営業時間</dt>
      <dt class="p-front-access__description">19:00 ~ 24:00</dt>
      <dt class="p-front-access__term">定休日</dt>
      <dt class="p-front-access__description">毎週日曜日<br>臨時休業などについては、<a href="https://www.instagram.com/30.coffee.stand/" target="_blank">Instagram</a>の情報をご覧ください</dt>
      <dt class="p-front-access__term">住所</dt>
      <dt class="p-front-access__description p-front-access__description--address">福岡県飯塚市本町5-4<a class="p-front-access__to-map" href="https://maps.app.goo.gl/6tJvJTdYCoqeHcpS7" target="_blank">Googleマップで見る</a></dt>
    </dl>
    <div class="p-front-access__map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d687.7426853820418!2d130.68700923956865!3d33.639250182357515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35417e3a17a89a7d%3A0xb17721c2d55030ed!2z44CSODIwLTAwNDIg56aP5bKh55yM6aOv5aGa5biC5pys55S677yV4oiS77yU!5e0!3m2!1sja!2sjp!4v1713850500507!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>
<?php
//////////////////////////////// Goods ////////////////////////////////
?>
<section id="goods" class="p-front-goods">
  <h2 class="p-front-goods__heading c-heading c-heading--center c-heading--white">
    <span class="c-heading__text">@30 coffee stand グッズ</span>
    <span class="c-heading__en"><img src="<?php imgPath();?>/page/front/goods_title.svg" alt="Original Goods"></span>
  </h2>
  <div class="p-front-goods__item">
    <div class="p-front-goods__image">
      <picture>
        <source media="(min-width: 768px)" srcset="<?php imgPath(); ?>/page/front/goods_item01_l.webp" type="image/webp">
        <img src="<?php imgPath(); ?>/page/front/goods_item01.webp">
      </picture>
    </div>
    <div class="p-front-goods__content">
      <p class="p-front-goods__title">オリジナルタンブラー</p>
      <p class="p-front-goods__price">¥<span class="p-front-goods__price-num">2,400</span>（税込）</p>
      <p class="p-front-goods__intro">タンブラーを持参いただくと、全商品が<span class="p-front-goods__intro-bold">¥50引き</span>となります。</p>
      <dl class="p-front-goods__info">
        <dt class="p-front-goods__term">容量</dt>
        <dt class="p-front-goods__description">480ml</dt>
        <dt class="p-front-goods__term">サイズ</dt>
        <dt class="p-front-goods__description">Φ92×H176mm</dt>
        <dt class="p-front-goods__term">材質</dt>
        <dt class="p-front-goods__description">PP、バンブーファイバー　他</dt>
      </dl>
      <a class="p-front-goods__button" href="https://shop.30-coffee-stand.com/2024/02/09/01/" target="_blank"><span class="p-front-goods__button-inner"><span class="p-front-goods__button-text p-front-goods__button-text--01">購入する</span><span class="p-front-goods__button-text p-front-goods__button-text--02">購入する</span></span></a>
    </div>
  </div>
</section>
<?php
//////////////////////////////// Instagram ////////////////////////////////
?>
<section class="p-front-instagram">
  <h2 class="p-front-instagram__heading"><img src="<?php imgPath();?>/page/front/instagram_title.svg" alt="Instagram"></h2>
  <div class="p-front-instagram__inner">
    <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
  </div>
</section>
<?php
//////////////////////////////// Gallery ////////////////////////////////
?>
<div class="p-front-gallery">
  <img class="p-front-gallery__item p-front-gallery__item--01" src="<?php imgPath(); ?>/page/front/gallery.webp" alt="">
  <img class="p-front-gallery__item p-front-gallery__item--02" src="<?php imgPath(); ?>/page/front/gallery.webp" alt="">
</div>
<?php get_footer();?>