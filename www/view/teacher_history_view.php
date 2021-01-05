<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>指導履歴</title>
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
            <a class="nav-link" href="<?php print TEACHER_URL; ?>">戻る</a>
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

    <h1>指導履歴</h1>

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <table class="table table-bordered text-center teacher_list">
      <thead class="thead-light">
        <tr>
          <th>日付</th>
          <th>時限</th>
          <th>生徒ID</th>
          <th>生徒名</th>
          <th>コメント</th>
          <th>修正</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($teacher_history as $history): ?>
        <tr>
          <td><?php print $history['date']; ?></td>
          <td><?php print $history['period']; ?></td>
          <td><?php print $history['student_id']; ?></td>
          <td><?php print $history['student_name']; ?></td>
          <td class="comment"><?php print $history['comment']; ?></td>
          <td class="update">
            <form method="post" action="teacher_update_report.php">
              <input type="hidden" name="history_id" value="<?php print $history['history_id']; ?>">
              <input type="submit" name="update" class="btn btn-info submit_update" value="修正">
            </form>
          </td>
          <td class="delete">
            <form method="post" action="teacher_delete_report.php">
              <input type="hidden" name="history_id" value="<?php print $history['history_id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
              <input type="submit" name="delete" class="btn btn-dark submit_delete" value="削除">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>  

  </div>

  <script>
    $('.submit_delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>