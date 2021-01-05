<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>オプション</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin_option.css'); ?>">
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

    <h1>オプション</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post">
      <div class="form-group select_period">
        時限数
        <select class="form-control" name="period">
          <option value="1" <?php if($option['period'] === 1){print 'selected';} ?>>1</option>
          <option value="2" <?php if($option['period'] === 2){print 'selected';} ?>>2</option>
          <option value="3" <?php if($option['period'] === 3){print 'selected';} ?>>3</option>
          <option value="4" <?php if($option['period'] === 4){print 'selected';} ?>>4</option>
          <option value="5" <?php if($option['period'] === 5){print 'selected';} ?>>5</option>
        </select>
      </div>
      <input type="submit" class="btn btn-primary" name="period_submit" value="決定">
    </form>

    <form method="post">
      <div class="form-group select_booth">
        ブース数
        <select class="form-control" name="booth">
          <option value="1" <?php if($option['booth'] === 1){print 'selected';} ?>>1</option>
          <option value="2" <?php if($option['booth'] === 2){print 'selected';} ?>>2</option>
          <option value="3" <?php if($option['booth'] === 3){print 'selected';} ?>>3</option>
          <option value="4" <?php if($option['booth'] === 4){print 'selected';} ?>>4</option>
          <option value="5" <?php if($option['booth'] === 5){print 'selected';} ?>>5</option>
        </select>
      </div>
      <input type="submit" class="btn btn-primary" name="booth_submit" value="決定">
    </form>

  </div>



</body>
</html>