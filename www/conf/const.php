<?php

define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');

define('STYLESHEET_PATH', '/assets/css/');

if($_SERVER['SERVER_ADDR'] === '160.251.10.213'){
  define('DB_HOST', 'localhost');
}else{
  define('DB_HOST', 'mysql');
}
define('DB_NAME', 'sample');
define('DB_USER', 'testuser');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');

define('LOGIN_URL', '/login.php');
define('LOGOUT_URL', '/logout.php');
define('ADMIN_URL', '/admin.php');
define('SIGNUP_TEACHER_URL', '/signup_teacher.php');
define('SIGNUP_STUDENT_URL', '/signup_student.php');
define('TEACHER_URL', '/teacher.php');
define('STUDENT_URL', '/student.php');

define('USER_TYPE_ADMIN', 1);
define('USER_TYPE_TEACHER', 2);
define('USER_TYPE_STUDENT', 3);

define('USER_NAME_LENGTH_MIN', 6);
define('USER_NAME_LENGTH_MAX', 100);
define('USER_PASSWORD_LENGTH_MIN', 6);
define('USER_PASSWORD_LENGTH_MAX', 100);

define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
define('REGEXP_kanji', '/\A[0-9a-zA-Z]+\z/');