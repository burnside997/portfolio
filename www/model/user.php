<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_by_login_id($db, $login_id){
  $sql = "
    SELECT
      user_id, 
      login_id,
      password,
      name_kanji,
      name_hiragana,
      type
    FROM
      users
    WHERE
      login_id = ?
    LIMIT 1
  ";
  return fetch_query($db, $sql, array($login_id));
}

function login_as($db, $login_id, $password){
  $user = get_user_by_login_id($db, $login_id);
  if($user === false || $user['password'] !== $password){
    return false;
  }
  set_session('user_id', $user['user_id']);
  return $user;
}

function get_login_user($db){
  $login_user_id = get_session('user_id');
  return get_user($db, $login_user_id);
}

function get_user($db, $user_id){
  $sql = "
    SELECT
      user_id, 
      login_id,
      password,
      type
    FROM
      users
    WHERE
      user_id = ?;
  ";
  return fetch_query($db, $sql, array($user_id));
}

// signup-----------------------------------------------

function regist_teacher($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana) {
  if( is_valid_user($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana) === false){
    return false;
  }
  return insert_user($db, $login_id, $password, $name_kanji, $name_hiragana, USER_TYPE_TEACHER);
}

function regist_student($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana) {
  if( is_valid_user($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana) === false){
    return false;
  }
  return insert_user($db, $login_id, $password, $name_kanji, $name_hiragana, USER_TYPE_STUDENT);
}

function insert_user($db, $login_id, $password, $name_kanji, $name_hiragana, $type){
  $sql = "
    INSERT INTO
      users(login_id, password, name_kanji, name_hiragana, type)
    VALUES (?, ?, ?, ?, ?);
  ";
  return execute_query($db, $sql, array($login_id, $password, $name_kanji, $name_hiragana, $type));
}

// signupバリデーション-------------------------------------

function is_valid_name_kanji($name_kanji){
  $is_valid = true;
  if($name_kanji === ''){
    set_error('名前(漢字)を入力してください。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_name_hiragana($name_hiragana){
  $is_valid = true;
  if($name_hiragana === ''){
    set_error('なまえ(ひらがな)を入力してください。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_login_id($db, $login_id){
  $is_valid = true;
  if(is_valid_length($login_id, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX) === false){
    set_error('ログインIDは'. USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  if(is_alphanumeric($login_id) === false){
    set_error('ログインIDは半角英数字で入力してください。');
    $is_valid = false;
  }
  if($login_id === get_user_by_login_id($db, $login_id)['login_id']){
    set_error('このIDは既に使用されています。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_password($password, $password_confirmation){
  $is_valid = true;
  if(is_valid_length($password, USER_PASSWORD_LENGTH_MIN, USER_PASSWORD_LENGTH_MAX) === false){
    set_error('パスワードは'. USER_PASSWORD_LENGTH_MIN . '文字以上、' . USER_PASSWORD_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  if(is_alphanumeric($password) === false){
    set_error('パスワードは半角英数字で入力してください。');
    $is_valid = false;
  }
  if($password !== $password_confirmation){
    set_error('パスワードがパスワード(確認用)と一致しません。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_user($db, $login_id, $password, $password_confirmation, $name_kanji, $name_hiragana){
  $is_valid_name_kanji = is_valid_name_kanji($name_kanji);
  $is_valid_name_hiragana = is_valid_name_hiragana($name_hiragana);
  $is_valid_login_id = is_valid_login_id($db, $login_id);
  $is_valid_password = is_valid_password($password, $password_confirmation);
  return $is_valid_name_kanji && $is_valid_name_hiragana && $is_valid_login_id && $is_valid_password ;
}

//講師一覧---------------------------------------------
function get_teachers_list($db){
  $sql = '
    SELECT
      user_id,
      name_kanji,
      name_hiragana
    FROM
      users
    WHERE
      type=?
  ';
  return fetch_all_query($db, $sql, array(2));
}

//生徒一覧---------------------------------------------
function get_student_list($db){
  $sql = '
    SELECT
      user_id,
      name_kanji,
      name_hiragana
    FROM
      users
    WHERE
      type=?
  ';
  return fetch_all_query($db, $sql, array(3));
}