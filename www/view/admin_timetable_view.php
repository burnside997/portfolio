<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>管理画面</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin_timetable.css'); ?>">
</head>
<body>
  
  <?php include VIEW_PATH . 'templates/header.php'; ?>

  <div class="container">
    <h1>時間割作成</h1>
      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <h3><a href="?ym=<?php print $prev_month; ?>">&lt;</a> <?php print $calendar_title; ?> <a href="?ym=<?php print $next_month; ?>">&gt;</a></h3>

      <table class="table table-bordered vertical_calendar">
        <?php foreach($verticel_calendar as $day): ?>
          <tr>
            <td class="day week<?php print $day['week']; ?>">
              <?php print $day['day']; ?>(<?php print $day['week_str']; ?>)
            </td>
            <td>
              <?php for($i=1;$i<=$option['period'];$i++): ?>
                <p class="period"><?php print $i; ?>限</p>


                <?php for($k=1;$k<=$option['booth'];$k++): ?>
                  <p class="booth">ブース<?php print $k; ?></p>

                  <?php if((in_array($ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT), (array)$check_timetable_period_and_booth_and_date[$i][$k]) === true) ): ?>
                  
                    <form method="post" action="admin_delete_timetable.php">
                      <p class="determined_teacher">講師 : 
                        <?php foreach($determined_timetable as $determined_timetable_value):?>
                          <?php if(($ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT)) === $determined_timetable_value['date'] && $i === $determined_timetable_value['period'] && $k === $determined_timetable_value['booth']): ?>
                            <?php print h($determined_timetable_value['teacher_id']) . h($determined_timetable_value['teacher_name']); ?>
                            <input type="hidden" name="teacher_id" value="<?php print $determined_timetable_value['teacher_id']; ?>">
                            <?php if(isset($determined_timetable_value['teacher_name'])): ?>
                            <?php break; ?>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </p>
                      
                      <p class="determined_student">生徒 : 
                        <?php foreach($determined_timetable as $determined_timetable_value):?>
                          <?php if(($ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT)) === $determined_timetable_value['date'] && $i === $determined_timetable_value['period'] && $k === $determined_timetable_value['booth']): ?>
                            <?php print h($determined_timetable_value['student_id']) . h($determined_timetable_value['student_name']); ?>　
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </p>
                        
                      <input type="hidden" name="date" value="<?php print $ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT); ?>">
                      <input type="hidden" name="period" value="<?php print $i; ?>">
                      <input type="hidden" name="booth" value="<?php print $k; ?>">
                      <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                      <input type="submit" class="btn btn-dark timetable_delete" name="timetable_delete" value="削除">
                    </form>

                  <?php else: ?>

                    <form method="post" action="admin_insert_timetable.php">

                      <div class="form-group select_teacher">
                        <select class="form-control" name="teacher">
                          <option value="">講師選択</option>
                          <?php foreach($teacher_in_scheduled as $teacher): ?>
                            <?php if($teacher['scheduled_work_date'] === $ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT) && $teacher['period'] === $i): ?>
                              <option class="dropdown-item" value="<?php print $teacher['user_id']; ?>">
                                <p><?php print $teacher['user_id']; ?> <?php print $teacher['name_kanji']; ?></p>
                                </option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      
                      <?php for($j=1;$j<=3;$j++): ?>
                        <div class="form-group select_student">
                          <select class="form-control" name="student[]">
                            <option value="">生徒選択</option>
                            <?php foreach($student_in_scheduled as $student): ?>
                              <?php if($student['scheduled_work_date'] === $ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT) && $student['period'] === $i): ?>
                                <option class="dropdown-item" value="<?php print $student['user_id']; ?>">
                                  <p><?php print $student['user_id']; ?>  <?php print $student['name_kanji']; ?></p>
                                </option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      <?php endfor; ?>
                      <input type="hidden" name="date" value="<?php print $ym . '-' . str_pad($day['day'], 2, '0', STR_PAD_LEFT); ?>">
                      <input type="hidden" name="period" value="<?php print $i; ?>">
                      <input type="hidden" name="booth" value="<?php print $k; ?>">
                      <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                      <input type="submit" class="btn btn-primary timetable_decision" name="timetable_submit" value="決定">

                    </form>
                  
                  <?php endif; ?>

                <?php endfor; ?>

              <?php endfor; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
  <script>
    $('.timetable_delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>