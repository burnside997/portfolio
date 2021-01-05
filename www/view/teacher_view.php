<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>講師</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'teacher.css'); ?>">
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
            <a class="nav-link" href="teacher_report.php">指導報告書作成</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="teacher_history.php">指導履歴</a>
          </li>
          <li class="nav-item">
            <?php include VIEW_PATH . 'teacher_calendar_input.php' ?>
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

    <h1>講師トップ画面</h1>

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <?php include VIEW_PATH . 'teacher_calendar_display.php'; ?>

  </div>

</body>
</html>