<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function update_option_period($db, $period){
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