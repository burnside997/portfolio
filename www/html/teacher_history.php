<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if(empty(get_post('delete'))){
  $token = get_csrf_token();
}

if(is_logined() === false){
  redirect_to('login.php');
}

$db = get_db_connect();

$user = get_login_user($db);

$teacher_history = get_teacher_history($db, $user['user_id']);

include_once VIEW_PATH . 'teacher_history_view.php';