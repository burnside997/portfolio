<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'calendar.php';
require_once MODEL_PATH . 'timetable.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if (is_valid_csrf_token(get_post('csrf_token')) === false){
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

$teacher_id = get_post('teacher');
$student_id = get_post('student');
$date = get_post('date');
$period = get_post('period');
$booth = get_post('booth');

if(get_post('timetable_submit')){
  if(insert_timetables($db, $ym, $teacher_id, $student_id, $date, $period, $booth)){
    set_message('決定しました。');
  }else{
    set_error('決定に失敗しました。');
  }
}

redirect_to('admin_timetable.php');