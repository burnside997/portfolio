<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>管理画面</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
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
            <a class="nav-link" href="admin_timetable.php">時間割作成</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student_list.php">生徒一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="teacher_list.php">講師一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup_student.php">生徒登録</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup_teacher.php">講師登録</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="admin_option.php">オプション</a>
          </li>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">ログアウト</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container">

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <h3>本日の時間割(<?php print $today; ?>)</h3>

        <?php for($i=1;$i<=$option['period'];$i++): ?>
          <p class="period"><?php print $i; ?>限</p>

          <?php for($k=1;$k<=$option['booth'];$k++): ?>
            <p class="booth">ブース<?php print $k; ?></p>
          
            <p class="determined_teacher">講師 : 
              <?php foreach($determined_timetable as $determined_timetable_value):?>
                <?php if($today === $determined_timetable_value['date'] && $i === $determined_timetable_value['period'] && $k === $determined_timetable_value['booth']): ?>
                  <?php print h($determined_timetable_value['teacher_id']) . h($determined_timetable_value['teacher_name']); ?>
                  <?php if(isset($determined_timetable_value['teacher_name'])): ?>
                  <?php break; ?>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; ?>
            </p>
            
            <p class="determined_student">生徒 :
              <?php foreach($determined_timetable as $determined_timetable_value):?>
                <?php if($today === $determined_timetable_value['date'] && $i === $determined_timetable_value['period'] && $k === $determined_timetable_value['booth']): ?>
                  <?php print h($determined_timetable_value['student_id']) . h($determined_timetable_value['student_name']); ?>　
                <?php endif; ?>
              <?php endforeach; ?>
            </p>

          <?php endfor; ?>
        <?php endfor; ?>

  </div>

</body>
</html>