<?php
if(!defined('IN_MOUGE'))
  die("Access Denied");
?>
<!doctype html>
<html lang="zh-TW">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']?></title>
    <link rel="stylesheet" href="res/css/foundation.css"> 
    <script src="res/js/vendor/modernizr.js"></script>
<?php if(!$loginStatus or (!empty($_SESSION['login_method']) && $_SESSION['login_method'] == "persona")): ?>
    <script src="https://login.persona.org/include.js"></script>
    <script>
      navigator.id.watch({
        loggedInUser:<?php if(!empty($_SESSION['email'])) { echo $_SESSION['email']; } else { ?>null<? }?>,
        onlogin: function (assertion) {
          var assertion_field = document.getElementById("assertion-field");
          assertion_field.value = assertion;
          var login_form = document.getElementById("login-form");
          login_form.submit();
        },
        onlogout: function () {
          window.location = 'login.php?method=persona&logout=true';
        }
      });
    </script>
<?php endif; ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-50660741-2', 'studio-mouge.org');
      ga('send', 'pageview');

    </script>
    <style type="text/css">
      body {
        background: #EEE;
      }
      .alert-box h4 {
        color: #EEE;
      }
      .info {
        color: #777;
        size: .6em;
        margin-bottom: .6em;
      }
    </style>
  </head>
  <body>

<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <li class="name">
          <h1><a href="admin.php"><?=$data['nav_title']?></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>您好，<?php if($loginStatus){ echo $data['userName']; }else{?>遊客<?php } ?>！</span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
<?php if($loginStatus == 1): ?>
          <li class="show-for-medium-up"><a href="#">您好，<?=$data['userName']?>！</a></li>
          <li><a href="index.php">網站首頁</a></li>
          <li><a href="admin.php?mod=topic&act=view">管理公告</a></li>
          <li><a href="admin.php?mod=user&act=view">管理使用者</a></li>
          <li><a href="admin.php?mod=feedback">檢視意見回饋</a></li>
          <li><a href="<?php if(!empty($_SESSION['login_method']) && $_SESSION['login_method'] == 'persona') { ?>javascript:navigator.id.logout()<?php } else { ?>login.php?logout=true<?php } ?>">登出</a></li>
<?php endif; ?>
        </ul>
      </section>
    </nav>
</div>
