<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'calendar.php';
require_once MODEL_PATH . 'timetable.php';
require_once MODEL_PATH . 'option.php';

session_start();

if(is_logined() === false){
  redirect_to('login.php');
}

$db = get_db_connect();

$user = get_login_user($db);

date_default_timezone_set('Asia/Tokyo');

$ym = get_get('ym');
if($ym === '') {
  $ym = date('Y-m');
}

$today = get_today();

$timestamp = get_timestamp($ym);

$calendar_title = get_calendar_title($timestamp);

$prev_month = get_prev_month($timestamp);
$next_month = get_next_month($timestamp);
$last_day = get_last_day($timestamp);

$calendar = get_calendar($last_day, $timestamp);

$get_days = get_post('days');

if(get_post('student_scheduled_submit')){
  if(regist_month_scheduled($db, $ym, $user['user_id'], $get_days)){
    set_message('登塾可能日を送信しました。');
  } else{
    set_error('送信に失敗しました。');
  }
}

if(get_post('student_scheduled_delete_submit')){
  if(delete_month_scheduled($db, $user['user_id'], $ym)){
    set_message('登塾可能日を削除しました。');
  } else{
    set_error('送信に失敗しました。');
  }
}

$option = get_option($db);

$month_student_scheduled = get_month_scheduled($db, $sql, $user['user_id'], $ym . '-01');

$days_checked_checkbox = get_checked_checkbox($month_student_scheduled, $option['period']);

$admin_check_student_calendar = get_admin_check_student_calendar($db, $user['user_id']);

include_once VIEW_PATH . 'student_view.php';