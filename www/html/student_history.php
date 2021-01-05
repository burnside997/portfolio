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

$student_history = get_student_history($db, $user['user_id']);

include_once VIEW_PATH . 'student_history_view.php';