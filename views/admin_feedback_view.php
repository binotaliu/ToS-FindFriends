<?php
if(!defined('IN_MOUGE'))
  die('Access Denied');
?>

<div class="row">
  <div class="small-12 column">
    <h2>檢視意見回饋</h2>
  </div>
  <?php foreach($data['feedback'] as $feedback): ?>
    <div class="small-12 panel column">
      <h2><?=$feedback['title']?></h2>
      <div class="small-12 column info">
        發表時間：<?=$feedback['time']?>，作者：<?=$db->fetch_where('user', array('nickname'), array('uid' => $feedback['uid']))[0]['nickname']?>
      </div>
      <div class="small-12 column">
       <?=$feedback['content']?>      
      </div>
      <!--div class="small-5 medium-7 medium-offset-5 large-4 large-offset-8 column">
        <ul class="inline-list">
          <li><a href="admin.php?mod=topic&act=edit&tid=">編輯</a></li>
          <li><a href="admin.php?mod=topic&act=del&tid=">刪除</a></li>
        </ul>
      </div-->
    </div>
  <?php endforeach; ?>
  <!--a class="button large radius" href="admin.php?mod=topic&act=add">新增公告</a-->

</div>

