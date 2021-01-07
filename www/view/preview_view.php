<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>プレビュー</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'preview.css'); ?>">
</head>
<body>

<header>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="collapse navbar-collapse" id="headerNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php print ADMIN_URL; ?>">戻る</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div class="container">
  <h3>使用方法</h3>
  <ol>
    <li>
      <p>ログインID: admin パスワード: admin でログインします。(以後adminユーザー)</p>
      <p><img src="<?php print(PREVIEW_PATH . 'login.png'); ?>" class="login_img"></p>
    </li>
    <li>
      <p>画面上部のナビゲーションメニューから新しく講師登録をします。</p>
      <p><img src="<?php print(PREVIEW_PATH . 'admin_top.png'); ?>" class="admin_top_img"></p>
    </li>
    <li>
      <p>ログアウトしてから先ほど登録したログインIDとパスワードを入力してログインしてください。講師トップ画面が表示されます。</p>
      <p><img src="<?php print(PREVIEW_PATH . 'teacher_top.png'); ?>" class="teacher_top_img"></p>
    </li>
    <li>
      <p>画面上部のナビゲーションメニューから「出勤可能日入力」をクリックするとモーダルが表示されるので、日付をクリックして送信ボタンを押してください。これでadminユーザーが時間割作成時に選択することができます。</p>
      <p><img src="<?php print(PREVIEW_PATH . 'calendar_modal.png'); ?>" class="calendar_modal_img"></p>
    </li>
    <li>
      <p>手順2~4と同じように、adminユーザーから生徒登録をして、登録したログインID・パスワードでログインした後、画面上部のナビゲーションメニューから「登塾可能日」を選択して、日付を選択して送信ボタンを押してください。</p>
    </li>
    <li>
      <p>adminユーザーでログインした後、画面上部のナビゲーションメニューから「時間割作成」をクリックすると下のような画面が表示されます。講師と生徒が手順4のように予定を送信している場合は、セレクトボックスから選択可能になりますので、時間割を作成することができます。</p>
      <p><img src="<?php print(PREVIEW_PATH . 'timetable.png'); ?>" class="timetable_img"></p>
    </li>
    <li>
      <p>基本的な使い方は以上となります。プラスアルファとして adminユーザーは「オプション」から時限数、ブース数を選択することができます。 講師は授業後の指導報告書を作成してadminユーザー、生徒が閲覧できる機能も実装しました。</p>
    </li>

  </ol>
</div>
  



</body>
</html>