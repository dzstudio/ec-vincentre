<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/web/images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/web/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/admin.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/screen.css" type="text/css" />
    <!-- Third Party plugin -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/jquery-1.7.min.js"></script>
    <title><?php echo Yii::t('default', 'app_name')?> <?php echo Yii::t('default', 'app_subtitle')?></title>
</head>
<body>
  <div id="header">
    <label><?php echo Yii::t('default', 'app_name')?> <?php echo Yii::t('default', 'app_subtitle')?></label>
    <div class="right align-right capi-case">
      <a href="?hl=en">English</a> | <a href="?hl=zh">中文</a>
      <?php if (!Yii::app()->user->isGuest):?>
      <div style="margin-top:6px">
        <?php echo Yii::t('default', 'welcome_back') . Yii::app()->user->getState('username'); ?> |
        <a href="<?php echo Common::makeUrl('admin/default/logout')?>"><?php echo Yii::t('default', 'logout') ?></a>
      </div>
      <?php endif;?>
    </div>
  </div>
  <div id="main-content">
  <?php echo $content; ?>
  </div>
</body>
</html>