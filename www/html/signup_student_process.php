<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

header('X-FRAME-OPTIONS: DENY');
session_start();

if(is_valid_csrf_token(get_post('csrf_token')) === false){
  redirect_to(LOGOUT_URL);
}

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGOUT_URL);
}

$name_kanji = get_post('name_kanji');
$name_hiragana = get_post('name_hiragana');
$login_id = get_post('login_id');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

try{
  $result = regist_student($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana);
  if( $result === false){
    set_error('生徒登録に失敗しました。');
    redirect_to(SIGNUP_STUDENT_URL);
  }
}catch(PDOException $e){
  set_error('生徒登録に失敗しました。');
  redirect_to(SIGNUP_STUDENT_URL);
}

set_message('生徒登録が完了しました。');

redirect_to(ADMIN_URL);