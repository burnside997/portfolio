<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'timetable.php';
require_once MODEL_PATH . 'option.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$token = get_csrf_token();

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGOUT_URL);
}

$today = date('Y-m-d');

$today_timetable = get_today_timetable($db, $today);

$determined_timetable = get_determined_timetable($db);

$option = get_option($db);

include_once VIEW_PATH . '/admin_view.php';