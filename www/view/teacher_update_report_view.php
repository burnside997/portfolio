<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>指導報告書</title>
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
            <a class="nav-link" href="teacher_history.php">戻る</a>
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

    <h1>指導報告書修正</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="teacher_update_report_process.php" class="report_form mx-auto">
   
      <div class="form-row">
        <div class="form-group col-md-4">
        <label for="inputState">月</label>
        <select id="inputState" class="form-control" name="month">
          <option value="">月</option>
          <?php for($i=1;$i<=12;$i++): ?>
            <option value="<?php print $i; ?>" <?php if($i === $report_before_update['MONTH(date)']){print 'selected';} ?>><?php print $i; ?>月</option>
          <?php endfor; ?>
        </select>
        </div>
        <div class="form-group col-md-4">
        <label for="inputState">日</label>
        <select id="inputState" class="form-control" name="day">
          <option value="">日</option>
          <?php for($i=1;$i<=31;$i++): ?>
            <option value="<?php print $i; ?>" <?php if($i === $report_before_update['DAY(date)']){print 'selected';} ?>><?php print $i; ?>日</option>
          <?php endfor; ?>
        </select>
        </div>
        <div class="form-group col-md-4">
        <label for="inputState">限</label>
        <select id="inputState" class="form-control" name="period">
          <option value="">時限</option>
          <?php for($i=1;$i<=5;$i++): ?>
            <option value="<?php print $i; ?>" <?php if($i === $report_before_update['period']){print 'selected';} ?>><?php print $i; ?>限</option>
          <?php endfor; ?>
        </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputState">生徒</label>
        <select id="inputState" class="form-control" name="student">
          <option value="">生徒選択</option>
          <?php foreach($student_list as $student): ?>
            <option value="<?php print $student['user_id']; ?>" <?php if($student['user_id'] === $report_before_update['student_id']){print 'selected';} ?>><?php print $student['user_id']; ?><?php print $student['name_kanji']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">コメント</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="comment"><?php print $report_before_update['comment']; ?></textarea>
      </div>

      <div class="text-right">
        <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
        <input type="hidden" name="history_id" value="<?php print $report_before_update['history_id']; ?>">
        <input type="submit" name="update_report" class="btn btn-primary submit_update_report" value="修正">
      </div>

    </form>

  </div>

</body>
</html>