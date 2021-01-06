<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'calendar.php';

function get_teacher_in_scheduled($db){
  $sql="
    SELECT
      scheduled.user_id,
      scheduled_work_date,
      scheduled.period,
      users.name_kanji
    FROM
      scheduled
    INNER JOIN
      users
    ON
      scheduled.user_id=users.user_id
    WHERE
      type=2;
  ";
  return fetch_all_query($db, $sql);
}

function get_student_in_scheduled($db){
  $sql="
    SELECT
      scheduled.user_id,
      scheduled_work_date,
      scheduled.period,
      users.name_kanji
    FROM
      scheduled
    INNER JOIN
      users
    ON
      scheduled.user_id=users.user_id
    WHERE
      type=3;
  ";
  return fetch_all_query($db, $sql);
}

//時間割作成---------------------------------------------------

function insert_timetable($db, $ym, $teacher_id, $student_id, $date, $period, $booth){
  $sql="
    INSERT INTO
      timetable(teacher_id, student_id, date, period, booth)
    VALUES
      (?, ?, ?, ?, ?);
  ";
  return execute_query($db, $sql, array($teacher_id, $student_id, $date, $period, $booth));
}

function insert_timetables($db, $ym, $teacher_id, $students_id, $date, $period, $booth){
  $flag = true;
  if($teacher_id === ''){
    set_error('講師を選択してください。');
    return false;
  }

  if($students_id[0] === ''){
    set_error('左から順に生徒を選択してください。');
    return false;
  }

  foreach($students_id as $student_id){
    if($student_id !== ''){
      if(insert_timetable($db, $ym, $teacher_id, $student_id, $date, $period, $booth) === false){
        $flag = false;
      }
    }
  }
  
  return $flag;
}

//時間割決定後---------------------------------------------

function get_timetable($db){
  $sql="
    SELECT
      teacher_id,
      student_id,
      date,
      period,
      booth
    FROM
      timetable;
  ";
  return fetch_all_query($db, $sql);
}

function get_determined_timetable($db){
  $sql="
  SELECT
    timetable.timetable_id,
    timetable.teacher_id,
    t.name_kanji as teacher_name,
    timetable.student_id,
    s.name_kanji as student_name,
    date,
    timetable.period,
    timetable.booth,
    timetable.date
  FROM 
    timetable
  JOIN users as t
  ON timetable.teacher_id = t.user_id
  JOIN users as s
  ON  timetable.student_id = s.user_id;
  ";
  return fetch_all_query($db, $sql);
}

function get_check_timetable_period_and_booth_date($timetable, $number_period, $number_booth){
  foreach($timetable as $day){
    for($i=1;$i<=$number_period;$i++){
      if($day['period'] === $i){
        for($k=1;$k<=$number_booth;$k++){
          if($day['booth'] === $k){
            $days[$i][$k][] = $day['date'];
          }
        }
      }
    }
  }
  return $days;
}


//admin時間割削除-----------------------------------------------------------
function delete_timetable($db, $teacher_id, $date, $period, $booth){
  $sql="
    DELETE FROM
      timetable
    WHERE
      teacher_id=?
    AND
      date=?
    AND
      period=?
    AND
      booth=?
    ;
  ";
  return execute_query($db, $sql, array($teacher_id, $date, $period, $booth));
}

// 本日の時間割-------------------------------------------------
function get_today_timetable($db, $today){
  $sql="
  SELECT
    timetable.timetable_id,
    timetable.teacher_id,
    t.name_kanji as teacher_name,
    timetable.student_id,
    s.name_kanji as student_name,
    date,
    timetable.period,
    timetable.date
  FROM 
    timetable
  JOIN 
    users as t
  ON 
    timetable.teacher_id = t.user_id
  JOIN 
    users as s
  ON  
    timetable.student_id = s.user_id
  WHERE
    date=?;
  ";
  return fetch_all_query($db, $sql, array($today));
}

//講師カレンダー表示

function get_admin_check_teacher_calendar($db, $teacher_id){
  $sql="
  SELECT
  timetable.timetable_id,
  timetable.teacher_id,
  t.name_kanji as teacher_name,
  timetable.student_id,
  s.name_kanji as student_name,
  DAY(date),
  timetable.date,
  timetable.period,
  timetable.booth
  FROM 
    timetable
  JOIN 
    users as t
  ON 
    timetable.teacher_id = t.user_id
  JOIN 
    users as s
  ON  
    timetable.student_id = s.user_id
  WHERE
   timetable.teacher_id=?;
  ";
  return fetch_all_query($db, $sql, array($teacher_id));
}

function get_admin_check_student_calendar($db, $student_id){
  $sql="
  SELECT
  timetable.timetable_id,
  timetable.teacher_id,
  t.name_kanji as teacher_name,
  timetable.student_id,
  s.name_kanji as student_name,
  DAY(date),
  timetable.date,
  timetable.period,
  timetable.booth
  FROM 
    timetable
  JOIN 
    users as t
  ON 
    timetable.teacher_id = t.user_id
  JOIN 
    users as s
  ON  
    timetable.student_id = s.user_id
  WHERE
   timetable.student_id=?;
  ";
  return fetch_all_query($db, $sql, array($student_id));
}
