<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>講師一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>

  <div class="container">
  <h1>講師一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <table class="table table-bordered text-center teacher_list">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>なまえ</th>
          <th>詳細</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($teachers_list as $teacher): ?>
        <tr>
          <td><?php print h($teacher['user_id']); ?></td>
          <td><?php print h($teacher['name_kanji']); ?></td>
          <td><?php print h($teacher['name_hiragana']); ?></td>
          <td>
            <form method="post" action="teacher_list_details.php">
              <input type="submit" class="btn btn-info" name="teacher_details" value="詳細">
              <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
              <input type="hidden" name="teacher_id" value="<?php print $teacher['user_id']; ?>">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>