<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/web/images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/web/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/main.css" type="text/css" />
    <!-- Third Party plugin -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/flexslider/jquery.flexslider-min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/web/js/flexslider/flexslider.css" type="text/css" />
    <title><?php echo Yii::t('default', 'app_name')?> <?php echo Yii::t('default', 'app_subtitle')?></title>
</head>
<body>
  <div id="header">
    <img id="logo" alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/logo.jpg">
    <a class="site-name" href="<?php echo Common::makeUrl('site/index')?>"><?php echo Yii::t('default', 'app_name')?></a>
    <label class="header-subtitle"><?php echo Yii::t('default', 'app_subtitle')?></label>
    <div class="search-bar">
      <form action="<?php echo Common::makeUrl('product/list') ?>" method="get">
        <input type="text" name="keyword" placeholder="<?php echo Yii::t('default', 'wine')?>" value="<?php echo Yii::app()->user->getState('keyword');?>" />
        <input type="submit" class="upper-case" value="<?php echo Yii::t('default', 'search')?>" />
      </form>
    </div>
    <div class="lang-link">
      <a class="english" href="?hl=en"><img alt="English" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/english.jpg"></a>
      <a class="chinese" href="?hl=zh"><img alt="中文" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/chinese.jpg"></a>
    </div>
  </div>
  <div class="main-navi">
    <ul class="navi-wrapper capi-case">
      <li><a href="<?php echo Common::makeUrl('site/index') ?>"><?php echo Yii::t('default', 'home')?></a></li>
      <li><a href="<?php echo Common::makeUrl('product/list', array('category' => WINE_CATEGORY)) ?>"><?php echo Yii::t('default', 'wine-world')?></a></li>
      <!-- <li><a href="#"><?php echo Yii::t('default', 'news')?></a></li> -->
      <li><a href="<?php echo Common::makeUrl('site/contact') ?>"><?php echo Yii::t('default', 'contact_us')?></a></li>
      <li><a href="<?php echo Common::makeUrl('site/profile') ?>"><?php echo Yii::t('default', 'company_profile')?></a></li>
    </ul>
  </div>
  <div id="main-content">
  <?php echo $content; ?>
  </div>
  <div id="footer">
  <div id="footerWrapper">
  <!--
    <ul>
      <li class="footer-title"><?php echo Yii::t('default', 'order_service')?></li>
      <li><a href="#"><?php echo Yii::t('default', 'ordering_guide')?></a></li>
      <li><a href="#"><?php echo Yii::t('default', 'payment')?></a></li>
      <li><a href="#"><?php echo Yii::t('default', 'shipping_policy')?></a></li>
    </ul>
    <ul>
      <li class="footer-title"><?php echo Yii::t('default', 'service_and_support')?></li>
      <li><a href="#"><?php echo Yii::t('default', 'service')?></a></li>
      <li><a href="#"><?php echo Yii::t('default', 'questions')?></a></li>
    </ul>
  -->
    <ul>
      <li class="footer-title"><?php echo Yii::t('default', 'about_us')?></li>
      <li><a href="<?php echo Common::makeUrl('site/profile') ?>"><?php echo Yii::t('default', 'company_profile')?></a></li>
      <!-- <li><a href="#"><?php echo Yii::t('default', 'join_us')?></a></li> -->
      <li><a href="<?php echo Common::makeUrl('site/contact') ?>"><?php echo Yii::t('default', 'contact_us')?></a></li>
    </ul>
    <div id="basic-info">
      <h1><?php $configs = Yii::app()->user->getFlash('system'); echo $configs['website_telephone'] ?></h1>
      <h3><?php echo Yii::t('default', 'working_range')?></h3>
      <h3 class="copyright">Copyright © 2012-2014, XXX Co., Ltd. All Rights Reserved. </h3>
    </div>
  </div>
</div>
</body>
</html>