<?php

function set_session($name, $value){
  $_SESSION[$name] = $value;
}

function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  }
  return '';
}

function set_error($error){
  $_SESSION['__errors'][] = $error;
}

function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}

function set_message($message){
  $_SESSION['__messages'][] = $message;
}

function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}

function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

function is_logined(){
  return get_session('user_id') !== '';
}

function is_admin($user){
  return $user['type'] === USER_TYPE_ADMIN;
}

function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function get_csrf_token(){
  $token = get_random_string(30);
  set_session('csrf_token', $token);
  return $token;
}

function is_valid_csrf_token($token){
  if( $token === '' || get_session('csrf_token') !== $token ){
    return false;
  }
  return $token === get_session('csrf_token');
}

function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}

function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

