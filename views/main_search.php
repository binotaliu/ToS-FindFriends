<?php
if(!defined('IN_MOUGE'))
  die("Access Denied");
include 'views/cards_option.php';
?>
    <div class="row">
      <div class="large_12 column">
        <h1 class="centered">徵戰友</h1>
      </div>
      <div class="large-12 panel column">
        <h3>馬上來徵戰友吧！</h3>
        <p>預見先鋒徵戰友系統強勢上線！搭載最先進最好用的徵戰友系統，幫你找到最適合的戰友！</p>
        <div class="clear"></div>
        <div class="row">
          <div class="large-6 column">
            <form action="search.php" method="get">
              <div class="row collapse">
                <div class="small-10 column">
                  <select name="card">
                    <?php showCardList(0); ?>
                  </select>
                </div>
                <div class="small-2 column">
                  <button class="postfix" type="submit" value="0">找！</button>
                </div>
              </div>
            </form>
          </div>
          <div class="large-6 column">
            <form action="search.php" method="get">
              <div class="row collapse">
                <div class="small-10 column">
                  <input type="text" name="keyword" placeholder="依卡片名稱搜尋">
                </div>
                <div class="small-2 column">
                  <button class="postfix" type="submit" value="1">找！</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
