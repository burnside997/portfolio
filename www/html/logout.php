<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

header('X-FRAME-OPTIONS: DENY'); 
session_start();
//セッション変数の破棄
$_SESSION = array();
//セッションクッキーのパラメータ
$params = session_get_cookie_params();
//クッキー削除
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
//セッション破棄
session_destroy();

redirect_to(LOGIN_URL);

