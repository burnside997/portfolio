<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_today(){
  $today = date('Y-m-j');
  return $today;
}

function get_timestamp($ym){
  $timestamp = strtotime($ym . '-01');
  if ($timestamp === false) {
      $ym = date('Y-m');
      $timestamp = strtotime($ym . '-01');
  }
  return $timestamp;
}

function get_calendar_title($timestamp){
  $calendar_title = date('Y年n月', $timestamp);
  return $calendar_title;
}

function get_prev_month($timestamp){
  $prev_month = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
  return $prev_month;
}

function get_next_month($timestamp){
  $next_month = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
  return $next_month;
}

function get_last_day($timestamp){
  $last_day = date('t', $timestamp);
  return $last_day;
}

function get_calendar($last_day, $timestamp){
  $calendar = [];
  $j = 0;
 
  // 月末日までループ
  for($i = 1; $i <= $last_day ; $i++){
      // 曜日を取得 日曜日0 土曜日6
      $week = date('w', mktime(0, 0, 0, date('m', $timestamp), $i, date('Y', $timestamp)));
   
      // 1日の場合
      if($i === 1){
        // 1日目の曜日までをループ
        //2020年12月の場合空の値(日,月)を2つセット
        for($s = 1; $s <= $week; $s++){
            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
        }
      }
   
      // 配列に日付をセット
      $calendar[$j]['day'] = $i;
      $j++;
   
      // 月末日の場合
      if ($i == $last_day) {
          // 月末日から残りをループ
          for ($e = 1; $e <= 6 - $week; $e++) {
              // 後半に空文字をセット
              $calendar[$j]['day'] = '';
              $j++;
          }
      }
  }
  return $calendar;
}

function get_vartical_calendar($last_day, $timestamp){
  $calendar = [];
  $week = ['日', '月', '火', '水', '木', '金', '土'];
  for($i=1; $i <= $last_day; $i++){
    $calendar[$i]['day'] = $i;
    $calendar[$i]['week'] = date('w', mktime(0, 0, 0, date('m', $timestamp), $i, date('Y', $timestamp)));
    $calendar[$i]['week_str'] = $week[$calendar[$i]['week']%7];
  }
  return $calendar;
}

// カレンダー入力-------------------------------------------------------------------------------------------

function insert_scheduled_period($db, $ym, $day, $user_id, $period){
  $ymd = $ym . '-' . $day;
  $sql = "
    INSERT INTO
      scheduled(user_id, scheduled_work_date, period)
    VALUES
      (?, ?, ?);
  ";
  return execute_query($db, $sql, array($user_id, $ymd, $period));
}

function insert_month_scheduled_period($db, $ym, $user_id, $days){
  $flag = true;
  foreach((array)$days as $period => $days){
    foreach((array)$days as $day){
      if(insert_scheduled_period($db, $ym, $day, $user_id, $period) === false){
        $flag = false;
      }
    }
  }
  return $flag;
}

function regist_month_scheduled($db, $ym, $user_id, $days){
  if($days === ''){
    set_error('出勤可能日を入力してください。');
    return false;
  }
  return insert_month_scheduled_period($db, $ym, $user_id, $days);
}

//カレンダー削除-------------------------------------------------------------------
function delete_month_scheduled($db, $user_id, $ym){
  $ymd = $ym . '-01';
  $sql = "
  DELETE FROM
    scheduled
  WHERE
    user_id = ?
  AND
    DATE_FORMAT(scheduled_work_date, '%Y%m') = DATE_FORMAT(?, '%Y%m')
";

return execute_query($db, $sql, array($user_id, $ymd));
}

// カレンダー表示------------------------------------------------------------------------------

function get_month_scheduled($db, $sql, $user_id, $date){
  $sql = "
    SELECT
      user_id,
      DAY(scheduled_work_date),
      period
    FROM
      scheduled
    WHERE
      user_id=?
    AND
     DATE_FORMAT(scheduled_work_date, '%Y%m') = DATE_FORMAT(?, '%Y%m')
    ;
  ";
  return fetch_all_query($db, $sql, $params = array($user_id, $date));
}

function get_checked_checkbox($month_scheduled, $number_periods){
  foreach($month_scheduled as $day){
    for($i=0;$i<=$number_periods;$i++){
      if($day['period'] === $i){
        $days[$i][] = $day['DAY(scheduled_work_date)'];
      }
    }
  }
  return $days;
}






