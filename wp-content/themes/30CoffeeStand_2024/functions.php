<?php

// ======================== 基本設定 ========================
// add files
function add_link_files()
{

  // CSSの読み込み
  wp_enqueue_style(
    'style',
    get_template_directory_uri() . '/css/style.css',
    array('font'),
    date('ymdHis', filemtime(get_template_directory() . '/css/style.css'))
  );

  // JavaScriptの読み込み
  wp_enqueue_script(
    'script',
    get_template_directory_uri() . '/js/script.min.js',
    array('jquery'),
    date('ymdHis', filemtime(get_template_directory() . '/js/script.min.js')),
    true
  );
  if(is_front_page()) {
    wp_enqueue_script(
      'front',
      get_template_directory_uri() . '/js/front.min.js',
      array('script'),
      date('ymdHis', filemtime(get_template_directory() . '/js/front.min.js')),
      true
    );
  }

  // font
  wp_enqueue_style(
    'font',
    'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500;700&display=swap',
    array(),
  );
}
add_action('wp_enqueue_scripts', 'add_link_files');


// ======================== 投稿の設定 ========================

// eyecatch
add_theme_support('post-thumbnails');

// 通常投稿
function Change_menulabel()
{
  global $menu;
  global $submenu;
  $name = 'お知らせ';
  $menu[5][0] = $name;
  $submenu['edit.php'][5][0] = $name . '一覧';
  $submenu['edit.php'][10][0] = '新規' . $name . '投稿';
}
function Change_objectlabel()
{
  global $wp_post_types;
  $name = 'お知らせ';
  $labels = &$wp_post_types['post']->labels;
  $labels->name = $name;
  $labels->singular_name = $name;
  $labels->add_new = _x('追加', $name);
  $labels->add_new_item = $name . 'の新規追加';
  $labels->edit_item = $name . 'の編集';
  $labels->new_item = '新規' . $name;
  $labels->view_item = $name . 'を表示';
  $labels->search_items = $name . 'を検索';
  $labels->not_found = $name . 'が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');

// archive
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; //任意のスラッグ名
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// permalink
function add_article_post_permalink( $permalink ) {
  $permalink = '/news' . $permalink;
  return $permalink;
}
add_filter( 'pre_post_link', 'add_article_post_permalink' );
function add_article_post_rewrite_rules( $post_rewrite ) {
  $return_rule = array();
  foreach ( $post_rewrite as $regex => $rewrite ) {
    $return_rule['news/' . $regex] = $rewrite;
  }
  return $return_rule;
}
add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );

// カスタム投稿
function create_post_type()
{
  // メニュー
  register_post_type(
    'menu',
    array(
      'label' => 'メニュー',
      'labels' => array(
        'all_items' => 'メニュー一覧'
      ),
      'public' => true,
      'has_archive' => false,
      'show_in_rest' => false,
      'menu_icon' => 'dashicons-book',
      'menu_position' => 6,
      'supports' => array(
        'title',
        // 'editor',
        'thumbnail',
        'revisions',
      ),
    )
  );
}
add_action('init', 'create_post_type');
// 詳細ページなし
add_filter('menu_rewrite_rules', '__return_empty_array');
// カテゴリ
register_taxonomy(
  'menu-cat',   //カスタムタクソノミー名
  'menu',   //このタクソノミーが使われる投稿タイプ
  array(
    'label' => 'カテゴリー',  //カスタムタクソノミーのラベル
    'labels' => array(
      'popular_items' => 'よく使うカテゴリー',
      'edit_item' => 'カテゴリーを編集',
      'add_new_item' => '新規カテゴリーを追加',
      'search_items' => 'カテゴリーを検索'
    ),
    'public' => true,  // 管理画面及びサイト上に公開
    'description' => 'カテゴリーの説明文です。',  //説明文
    'hierarchical' => true,  //カテゴリー形式
    'show_in_rest' => false  //Gutenberg で表示
  )
);
// カテゴリを管理画面の一覧に表示
function my_custom_column($columns)
{
  $columns['menu-cat'] = 'カテゴリ';
  return $columns;
}
add_filter('manage_menu_posts_columns', 'my_custom_column');

function my_custom_column_id($column_name, $id)
{
  $terms = get_the_terms($id, $column_name);
  if ($terms && !is_wp_error($terms)) {
    $menu_terms = array(); //変数名は任意
    foreach ($terms as $term) {
      $menu_terms[] = $term->name;
    }
    echo join(", ", $menu_terms);
  }
}
add_action('manage_menu_posts_custom_column', 'my_custom_column_id', 10, 2);

// 説明文で並び替え
function taxonomy_orderby_description( $orderby, $args ) {

	if ( $args['orderby'] == 'description' ) {
		$orderby = 'tt.description';
	}
	return $orderby;
}
add_filter( 'get_terms_orderby', 'taxonomy_orderby_description', 10, 2 );

// 最大表示数設定
function change_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() )
      return;
  if ( $query->is_archive()  ) {
      $query->set( 'posts_per_page', '1' );
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );

// ======================== function ========================
// breadcrumbs
function breadcrumbs($class = null)
{

  // 全ページ共通部分
  echo
  '<ol class="l-page-header__breadcrumb ' . $class . '">' .
    '<li class="l-page-header__breadcrumb-item"><a href="' . home_url() . '">ホーム</a></li>';

  // 固定ページ（page-○○.php）
  global $post;
  if (is_page() && $post->post_parent) {
    echo
    '<li class="l-page-header__breadcrumb-item"><a href="' . get_page_link($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>' .
      '<li class="l-page-header__breadcrumb-item">' . get_the_title() . '</li>';
  } elseif (is_page()) {
    echo
    '<li class="l-page-header__breadcrumb-item">' . get_the_title() . '</li>';
  }

  // お知らせ
  elseif (is_archive()) {
    echo
    '<li class="l-page-header__breadcrumb-item">お知らせ</li>';
  }

  // single
  elseif (is_single()) {
    echo
    '<li class="l-page-header__breadcrumb-item"><a href="'.home_url().'/news/">お知らせ</a></li>';
    echo
    '<li class="l-page-header__breadcrumb-item">' . get_the_title() . '</li>';
  }

  // 全ページ共通部分
  echo
  '</ol>';
}

// pagination
function pagination() {
  the_posts_pagination(
    array(
      'mid_size'      => 1, // 現在ページの左右に表示するページ番号の数
      'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
      'prev_text'     => __( '<span class="p-archive-pagination__arrow p-archive-pagination__arrow--prev c-arrow-square c-arrow-square--white"><img src="'.get_template_directory_uri().'/img/common/arrow.svg" alt="前のページへ"></span>'), // 「前へ」リンクのテキスト
      'next_text'     => __( '<span class="p-archive-pagination__arrow p-archive-pagination__arrow--next c-arrow-square c-arrow-square--white"><img src="'.get_template_directory_uri().'/img/common/arrow.svg" alt="次のページへ"></span>'), // 「次へ」リンクのテキスト
      'type'          => 'list', // 戻り値の指定 (plain/list)
    )
  );
}

// 画像ディレクトリ
function imgPath()
{
  echo get_template_directory_uri() . '/img';
}


//リクエストURLがローカルIPアドレスの場合のみ置換
if($_SERVER['SERVER_NAME'] == '192.168.0.9'){
  //置換処理をする関数を作成
  function ag2_localhost_to_ipv4_callback($buffer){
    $local_URI = 'http://localhost';
    $ipv4_URI = 'http://192.168.0.9';
    return str_replace($local_URI, $ipv4_URI, $buffer);
  }
  //ヘッダーが読み込まれたらバッファリングして出力時に関数をコール
  add_action('get_header', function(){ob_start('ag2_localhost_to_ipv4_callback');}, 1);
  //フッターまで読み込まれたらバッファリングを完了して出力する
  add_action('wp_footer', function(){ob_end_flush();}, 99999);
}
if($_SERVER['SERVER_NAME'] == '192.168.11.2'){
  //置換処理をする関数を作成
  function ag2_localhost_to_ipv4_callback($buffer){
    $local_URI = 'http://localhost';
    $ipv4_URI = 'http://192.168.11.2';
    return str_replace($local_URI, $ipv4_URI, $buffer);
  }
  //ヘッダーが読み込まれたらバッファリングして出力時に関数をコール
  add_action('get_header', function(){ob_start('ag2_localhost_to_ipv4_callback');}, 1);
  //フッターまで読み込まれたらバッファリングを完了して出力する
  add_action('wp_footer', function(){ob_end_flush();}, 99999);
}
