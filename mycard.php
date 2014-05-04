<?php
/*
 * Filename: mycard.php
 * $Id$
 * 檢視我的卡片資訊。
 */
define('IN_MOUGE', true);

session_start();

require_once 'config.inc.php';
require_once 'src/database.php';

$db = new Database;
$db->connect($config['database']['host'], $config['database']['user'], $config['database']['passwd']);
$db->select($config['database']['name']);

if(!empty($_SESSION['user_id']) && !empty($_SESSION['user_token'])){
  $checkToken = md5($config['secret']['key'][1] . md5($_SESSION['user_id'] . $config['secret']['key'][0]));
  if($_SESSION['user_token'] == $checkToken)
    $loginStatus = 1;
  else{
    $loginStatus = 0;
    unset($_SESSION['user_id']);
    unset($_SESSION['user_token']);
    unset($_SESSION['user_name']);
  }
}else{
  $loginStatus = 0;
}

if(!$loginStatus) die("Please log in first");

$data['title'] = "徵戰友 | 遇見先鋒 - Powered by MouGE";
$data['nav_title'] = "徵戰友";
if($loginStatus){
  $data['uid'] = $_SESSION['user_id'];
  $data['userName'] = $_SESSION['user_name'];
}
$data['success'] = false;
$data['expire'] = false;

$card_record = $db->fetch_where('user_card', array('*'), array('uid' => $data['uid']));
$second_record = $db->fetch_where('user_card_second', array('*'), array('uid' => $data['uid']));

//檢查 POST 
if(!empty($_POST['tos_id'])){
  //保存入庫
  //檢查是否已有記錄
  if($card_record){
    //已有記錄 -> Update
    $db->update('user_card', array(
                               'tos_id' => $_POST['tos_id'],
                               'detail' => $_POST['detail'],
                              'card_id' => $_POST['card_id'],
                           'card_level' => $_POST['card_level'],
                          'skill_level' => $_POST['skill_level'],
                              'logtime' => time()), array('uid' => $data['uid']));
  } else {
    $db->insert('user_card', array(
                                  'uid' => $data['uid'],
                               'tos_id' => $_POST['tos_id'],
                               'detail' => $_POST['detail'],
                              'card_id' => $_POST['card_id'],
                           'card_level' => $_POST['card_level'],
                          'skill_level' => $_POST['skill_level'],
                              'logtime' => time()));
  }

  $data['form']['tos_id'] = $_POST['tos_id'];
  $data['form']['detail'] = $_POST['detail'];
  $data['form']['card_id'] = $_POST['card_id'];
  $data['form']['card_level'] = $_POST['card_level'];
  $data['form']['skill_level'] = $_POST['skill_level'];

  //檢查候補資料表
  if($second_record){
    //已有記錄 -> Update
    $db->update('user_card_second', array(
                             'card1_id' => $_POST['card1_id'],
                             'card2_id' => $_POST['card2_id'],
                             'card3_id' => $_POST['card3_id'],
                             'card4_id' => $_POST['card4_id']), array('uid' => $data['uid']));
  }else{
    $db->insert('user_card_second', array(
                                  'uid' => $data['uid'],
                             'card1_id' => $_POST['card1_id'],
                             'card2_id' => $_POST['card2_id'],
                             'card3_id' => $_POST['card3_id'],
                             'card4_id' => $_POST['card4_id']));
  }

  $data['form']['card1_id'] = $_POST['card1_id'];
  $data['form']['card2_id'] = $_POST['card2_id'];
  $data['form']['card3_id'] = $_POST['card3_id'];
  $data['form']['card4_id'] = $_POST['card4_id'];

  $data['success'] = true;
} else {
  //無 POST 記錄，直接將資料庫內容寫入表單。
  if($card_record){
    $data['form']['tos_id'] = $card_record[0]['tos_id'];
    $data['form']['detail'] = $card_record[0]['detail'];
    $data['form']['card_id'] = $card_record[0]['card_id'];
    $data['form']['card_level'] = $card_record[0]['card_level'];
    $data['form']['skill_level'] = $card_record[0]['skill_level'];
  } else {
    $data['form']['tos_id'] = "";
    $data['form']['detail'] = "";
    $data['form']['card_id'] = "";
    $data['form']['card_level'] = "";
    $data['form']['skill_level'] = "";
  }
  if($second_record){
    $data['form']['card1_id'] = $second_record[0]['card1_id'];
    $data['form']['card2_id'] = $second_record[0]['card2_id'];
    $data['form']['card3_id'] = $second_record[0]['card3_id'];
    $data['form']['card4_id'] = $second_record[0]['card4_id'];
  } else {
    $data['form']['card1_id'] = "";
    $data['form']['card2_id'] = "";
    $data['form']['card3_id'] = "";
    $data['form']['card4_id'] = "";
  }
}

include 'var/view/header.php';

include 'var/view/mycard.php';

include 'var/view/footer.php';
