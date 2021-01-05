<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();


if(is_logined() === false){
  redirect_to('login.php');
}

$db = get_db_connect();

$user = get_login_user($db);

$history_id = get_post('history_id');

if(get_post('delete')){
  if (is_valid_csrf_token(get_post('csrf_token')) === false){
    redirect_to(LOGOUT_URL);
  }
  delete_report($db, $history_id);
  set_message('削除しました。');
}

redirect_to('teacher_history.php');