<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">登塾可能日入力</button>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="label1">登塾可能日</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <form method="post">
        <div class="modal-body">
          <h3><a href="?ym=<?php echo $prev_month; ?>">&lt;</a> <?php print $calendar_title; ?> <a href="?ym=<?php print $next_month; ?>">&gt;</a></h3>
          
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
                    <p class="calendar_day"><?php print $i; ?>限<input type="checkbox" name="days[<?php print $i; ?>][]" value="<?php print $value['day']; ?>" <?php if(in_array($value['day'], (array)$days_checked_checkbox[$i]) === true){print 'checked';} ?>></p>
                  <?php endfor; ?>
                <?php endif; ?>

              </td>
            <?php if($cnt === 7): ?>
            </tr>
            <tr>
            <?php $cnt = 0; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            </tr>
          </table>

        </div>

        <div class="modal-footer">
          <?php if($month_student_scheduled !== []): ?>
            <p>当月の予定は送信済みです。修正される場合は削除ボタンをクリックしてから再度入力してください。</p>
          <?php endif; ?>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <?php if($month_student_scheduled === []): ?>
            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
            <button type="submit" class="btn btn-primary" name="student_scheduled_submit" value="送信">送信</button>
          <?php else: ?>
            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
            <button type="submit" class="btn btn-primary" name="student_scheduled_delete_submit" value="削除">削除</button>
          <?php endif; ?>
        </div>
        
      </form>

    </div>
  </div>
</div>


