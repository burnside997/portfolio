<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>生徒一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>

  <div class="container">
  <h1>生徒一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <table class="table table-bordered text-center student_list">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>なまえ</th>
          <th>詳細</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($student_list as $student): ?>
        <tr>
          <td><?php print h($student['user_id']); ?></td>
          <td><?php print h($student['name_kanji']); ?></td>
          <td><?php print h($student['name_hiragana']); ?></td>
          <td>
            <form method="post" action="student_list_details.php">
              <input type="hidden" name="student_id" value="<?php print $student['user_id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
              <input type="submit" class="btn btn-info" name="student_details" value="詳細">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>