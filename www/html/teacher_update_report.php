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

$student_list = get_student_list($db);

$history_id = get_post('history_id');
$student_id = get_post('student');
$month = get_post('month');
$day = get_post('day');
$period = get_post('period');
$comment = get_post('comment');
$date = date('Y') . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

$report_before_update = get_report_before_update($db, $history_id);

include_once VIEW_PATH . 'teacher_update_report_view.php';