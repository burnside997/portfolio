<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'login.css'); ?>">
</head>
<body>
  <div class="container">
    <h1>ログイン</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="login_process.php" class="login_form mx-auto">
      <div class="form-group">
        <label for="login_id">ログインID: </label>
        <input type="text" name="login_id" id="login_id" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
      <input type="submit" value="ログイン" class="btn btn-primary">
    </form>
  </div>

  <div class="preview">
    <p>このサイトの使用方法<a href="preview.php">http://localhost:8082/preview.php</a></p>
  </div>
</body>
</html>