<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if (is_valid_csrf_token(get_post('csrf_token')) === false){
  redirect_to(LOGOUT_URL);
}

if(is_logined() === false){
  redirect_to('login.php');
}

$db = get_db_connect();

$user = get_login_user($db);

$student_list = get_student_list($db);

$student_id = get_post('student');
$month = get_post('month');
$day = get_post('day');
$period = get_post('period');
$comment = get_post('comment');

$date = date('Y') . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

if(get_post('submit_report')){
  if(insert_teacher_report($db, $user['user_id'], $student_id, $month, $day, $date, $period, $comment) === true){
    set_message('送信しました。');
  }else{
    set_error('送信に失敗しました。');
  }
}

redirect_to('teacher_report.php');