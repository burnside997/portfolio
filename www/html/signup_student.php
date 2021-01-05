<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

header('X-FRAME-OPTIONS: DENY');
session_start();

$token = get_csrf_token();

if(is_logined() === false){
  redirect_to(LOGOUT_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGOUT_URL);
}

include_once VIEW_PATH . '/signup_student_view.php';