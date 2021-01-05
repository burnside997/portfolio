<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>生徒登録</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'signup.css'); ?>">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="headerNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php print ADMIN_URL; ?>">戻る</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">ログアウト</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container">
  <h1>生徒登録</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="signup_student_process.php" class="signup_form mx-auto">
      <div class="form-group">
        <label for="name_kanji">名前(漢字):</label>
        <input type="text" name="name_kanji" id="name_kanji" class="form-control">
      </div>
      <div class="form-group"> 
        <label for="name_hiragana">なまえ(ひらがな):</label>
        <input type="text" name="name_hiragana" id="name_hiragana" class="form-control">
      </div>
      <div class="form-group">
        <label for="login_id">ログインID: </label>
        <input type="text" name="login_id" id="login_id" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="password_confirmation">パスワード（確認用）: </label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>
      <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
      <input type="submit" value="登録" class="btn btn-primary">
    </form>

  </div>
</body>
</html>