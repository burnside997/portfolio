<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if(is_valid_csrf_token(get_post('csrf_token')) === false){
  redirect_to(LOGOUT_URL);
}

if(is_logined() === true){
  redirect_to(LOGOUT_URL);
}

$login_id = get_post('login_id');
$password = get_post('password');

$db = get_db_connect();

$user = login_as($db, $login_id, $password);

if($user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');

if($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
if($user['type'] === USER_TYPE_TEACHER){
  redirect_to(TEACHER_URL);
}
if($user['type'] === USER_TYPE_STUDENT){
  redirect_to(STUDENT_URL);
}
