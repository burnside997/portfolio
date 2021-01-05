<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'calendar.php';
require_once MODEL_PATH . 'timetable.php';
require_once MODEL_PATH . 'option.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();

if(is_logined() === false){
  redirect_to(LOGOUT_URL);
}

$token = get_csrf_token();

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGOUT_URL);
}

date_default_timezone_set('Asia/Tokyo');

$ym = get_get('ym');
if($ym === ''){
  $ym = date('Y-m');
}

$today = get_today();

$timestamp = get_timestamp($ym);

$calendar_title = get_calendar_title($timestamp);

$prev_month = get_prev_month($timestamp);
$next_month = get_next_month($timestamp);
$last_day = get_last_day($timestamp);

$verticel_calendar = get_vartical_calendar($last_day, $timestamp);

$option = get_option($db);

$teacher_in_scheduled = get_teacher_in_scheduled($db);
$student_in_scheduled = get_student_in_scheduled($db);

$timetable = get_timetable($db);

$check_timetable_period_and_booth_and_date = get_check_timetable_period_and_booth_date($timetable, $option['period'], $option['booth']);

$determined_timetable = get_determined_timetable($db);

include_once VIEW_PATH . '/admin_timetable_view.php';