<h3><a href="?ym=<?php print $prev_month; ?>">&lt;</a> <?php print $calendar_title; ?> <a href="?ym=<?php print $next_month; ?>">&gt;</a></h3>
<table class="table table-bordered">
    <tr>
      <th>日</th>
      <th>月</th>
      <th>火</th>
      <th>水</th>
      <th>木</th>
      <th>金</th>
      <th>土</th>
  </tr>

  <tr>
  <?php $cnt = 0; ?>
  <?php foreach ($calendar as $key => $value): ?>
      <td>
        <?php $cnt++; ?>
        <?php print $value['day']; ?>

        <?php if($value['day'] !== ''): ?>

          <?php for($i=1;$i<=$option['period'];$i++): ?>
            <p class="calendar_day"><?php print $i; ?>限</p>
            <div class="students">
              <?php foreach($admin_check_teacher_calendar as $check): ?>
                <?php if(($ym . '-' . str_pad($value['day'], 2, '0', STR_PAD_LEFT)) === $check['date'] && $i === $check['period']): ?>
                  <p class="student_name"><?php print $check['student_id']; ?><?php print $check['student_name']; ?></p>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
 
          <?php endfor; ?>

        <?php endif; ?>

      </td>
  <?php if ($cnt == 7): ?>
  </tr>
  <tr>
  <?php $cnt = 0; ?>
  <?php endif; ?>
  <?php endforeach; ?>
  </tr>
</table>

