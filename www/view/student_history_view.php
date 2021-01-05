<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>受講履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'teacher_history.css'); ?>">
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
            <a class="nav-link" href="<?php print STUDENT_URL; ?>">戻る</a>
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

    <h1>受講履歴</h1>

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <table class="table table-bordered text-center teacher_list">
      <thead class="thead-light">
        <tr>
          <th>日付</th>
          <th>時限</th>
          <th>講師ID</th>
          <th>講師名</th>
          <th>コメント</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($student_history as $history): ?>
        <tr>
          <td><?php print $history['date']; ?></td>
          <td><?php print $history['period']; ?></td>
          <td><?php print $history['teacher_id']; ?></td>
          <td><?php print $history['teacher_name']; ?></td>
          <td class="comment"><?php print $history['comment']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>  

  </div>

</body>
</html>