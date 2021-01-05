<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// teacher_report-----------------------------------------

function insert_teacher_report($db, $teacher_id, $student_id, $month, $day, $date, $period, $comment){
  if(validate_item($month, $day, $period, $student_id, $comment) === false){
    return false;
  }
  $sql = "
    INSERT INTO
      history(teacher_id, student_id, date, period, comment)
    VALUES
      (?, ?, ?, ?, ?)
    ;
  ";
  return execute_query($db, $sql, array($teacher_id, $student_id, $date, $period, $comment));
}

function is_valid_month($month){
  if($month>=1 && $month<=12){
    $flag = true;
  }else{
    set_error('月を選択してください。');
    $flag = false;
  }
  return $flag;
}

function is_valid_day($day){
  if($day>=1 && $day<=31){
    $flag = true;
  }else{
    set_error('日を選択してください。');
    $flag = false;
  }
  return $flag;
}

function is_valid_period($period){
  if($period>=1 && $period<=5){
    $flag = true;
  }else{
    set_error('時限を選択してください。');
    $flag = false;
  }
  return $flag;
}

function is_valid_select_student($student_id){
  $flag = true;
  if($student_id === ''){
    set_error('生徒を選択してください。');
    $flag = false;
  }
  return $flag;
}

function is_valid_comment($comment){
  $flag = true;
  if($comment === ''){
    set_error('コメントを入力してください。');
    $flag = false;
  }
  return $flag;
}

function validate_item($month, $day, $period, $student_id, $comment){
  $is_valid_month = is_valid_month($month);
  $is_valid_day = is_valid_day($day);
  $is_valid_period = is_valid_period($period);
  $is_valid_select_student = is_valid_select_student($student_id);
  $is_valid_comment = is_valid_comment($comment);

  return $is_valid_month
    && $is_valid_day
    && $is_valid_period
    && $is_valid_select_student
    && $is_valid_comment;
}

//指導履歴----------------------------------------

function get_teacher_history($db, $teacher_id){
  $sql="
    SELECT
      history.history_id,
      history.student_id,
      users.name_kanji as student_name,
      history.date,
      history.period,
      history.comment
    FROM
      history
    JOIN
      users
    ON
      history.student_id=users.user_id
    WHERE
      teacher_id=?
    ORDER BY
      date desc;
    ";
  return fetch_all_query($db, $sql, array($teacher_id));
}

function get_student_history($db, $student_id){
  $sql="
    SELECT
      history.history_id,
      history.teacher_id,
      users.name_kanji as teacher_name,
      history.date,
      history.period,
      history.comment
    FROM
      history
    JOIN
      users
    ON
      history.teacher_id=users.user_id
    WHERE
      student_id=?
    ORDER BY
      date desc;
    ";
  return fetch_all_query($db, $sql, array($student_id));
}

//--------------------------------------------------------

function delete_report($db, $history_id){
  $sql="
    DELETE FROM
      history
    WHERE
      history_id=?;
    ";
return execute_query($db, $sql, array($history_id));
}

function get_report_before_update($db, $history_id){
  $sql="
    SELECT
      history_id,
      teacher_id,
      student_id,
      date,
      MONTH(date),
      DAY(date),
      period,
      comment
    FROM
      history
    WHERE
      history_id=?;
    ";
  return fetch_query($db, $sql, array($history_id));
}

function update_report($db, $student_id, $month, $day, $date, $period, $comment, $history_id){
  if(validate_item($month, $day, $period, $student_id, $comment) === false){
    return false;
  }
  $sql="
    UPDATE 
      history
    SET    
      student_id=?,
      date=?,
      period=?,
      comment=?
    WHERE  
      history_id=?;
    ";
  return execute_query($db, $sql, array($student_id, $date, $period, $comment, $history_id));
}
