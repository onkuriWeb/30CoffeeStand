<?php

// ======================== 基本設定 ========================
// add files
function add_link_files() {

  // CSSの読み込み
  wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css', array());

  // JavaScriptの読み込み
  wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.min.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'add_link_files' );

// eyecatch
add_theme_support('post-thumbnails');


// ======================== function ========================
// breadcrumbs
function breadcrumbs($class) {
  
	// 全ページ共通部分
  echo
  '<ol class="l-page-header__breadcrumb '.$class.'">'.
    '<li class="l-page-header__breadcrumb-item"><a href="'.home_url().'">ホーム</a></li>';
  
	// 固定ページ（page-○○.php）
  global $post;
	if(is_page() && $post->post_parent){
    echo
    '<li class="l-page-header__breadcrumb-item"><a href="'.get_page_link($post->post_parent).'">'.get_the_title($post->post_parent).'</a></li>'.
    '<li class="l-page-header__breadcrumb-item">'.get_the_title().'</li>';
  }
	elseif(is_page()){
    echo
    '<li class="l-page-header__breadcrumb-item">'.get_the_title().'</li>';
	}

  // single
	elseif(is_single()){
    echo
    '<li class="l-page-header__breadcrumb-item">'.get_the_title().'</li>';
	}
  
	// 404（404.php）
	if(is_404()){
    echo
    '<li class="l-page-header__breadcrumb-item">'.get_the_title().'</li>';
	}
  
	// 全ページ共通部分
	echo
  '</ol>';
  
}