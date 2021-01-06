<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function update_option_period($db, $period){
  if($period<1 || $period>5){
    return false;
  }
  $sql="
    UPDATE
      admin_option
    SET
      period=?
    WHERE
      option_id=1;
  ";
  return execute_query($db, $sql, array($period));
}

function update_option_booth($db, $booth){
  if($booth<1 || $booth>5){
    return false;
  }
  $sql="
    UPDATE
      admin_option
    SET
      booth=?
    WHERE
      option_id=1;
  ";
  return execute_query($db, $sql, array($booth));
}

function get_option($db){
  $sql="
    SELECT 
      period,
      booth
    FROM
      admin_option
    LIMIT
      1;
    ";
  return fetch_query($db, $sql);
}