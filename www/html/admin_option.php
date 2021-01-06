<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'option.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGOUT_URL);
}

$period = get_post('period');
$booth = get_post('booth');

if(get_post('period_submit')){
  if(update_option_period($db, $period) === true){
  set_message('時限数を設定しました。');
  }else{
    set_error('時限数の設定に失敗しました。');
  }
}

if(get_post('booth_submit')){
  if(update_option_booth($db, $booth) === true){
    set_message('ブース数を設定しました。');
  }else{
    set_error('ブース数の設定に失敗しました。');
  }
}

$option = get_option($db);

include_once VIEW_PATH . '/admin_option_view.php';