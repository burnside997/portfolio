<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

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

if(get_post('update_report')){
  if(update_report($db, $student_id, $month, $day, $date, $period, $comment, $history_id) === true){
    set_message('修正しました。');
  }else{
    set_error('修正に失敗しました。');
    redirect_to('teacher_update_report.php');
  }
}

redirect_to('teacher_history.php');