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
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/spinner.php"></script>
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
  <div id="contentWrapper" class="hide-over">
    <div id="mainmenu" class="hide-over">
      <div class="menu-title"><?php echo Yii::t('default', 'prod_manage')?></div>
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=>Yii::t('default', 'create_product'), 'url'=>array('/admin/default/createProd')),
          array('label'=>Yii::t('default', 'prod_list'), 'url'=>array('/admin/default/prodList')),
          array('label'=>Yii::t('default', 'star_prod'), 'url'=>array('/admin/default/starProdList')),
          array('label'=>Yii::t('default', 'new_arrivals'), 'url'=>array('/admin/default/newProdList'))
        )
      )); ?>
      <div class="menu-title"><?php echo Yii::t('default', 'category_manage')?></div>
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=>Yii::t('default', 'create_category'), 'url'=>array('/admin/default/createCategory')),
          array('label'=>Yii::t('default', 'cate_list'), 'url'=>array('/admin/default/categoryList'))
        )
      )); ?>
      <div class="menu-title"><?php echo Yii::t('default', 'news')?></div>
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=> Yii::t('default', 'create_news'), 'url'=>array('/admin/default/createNews')),
          array('label'=> Yii::t('default', 'news_list'), 'url'=>array('/admin/default/newsList'))
        )
      )); ?>
      <div class="menu-title"><?php echo Yii::t('default', 'user_manage')?></div>
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=> Yii::t('default', 'new_user'), 'url'=>array('/admin/user/create')),
          array('label'=> Yii::t('default', 'user_list'), 'url'=>array('/admin/user/list'))
        )
      )); ?>
      <div class="menu-title"><?php echo Yii::t('default', 'systen_config')?></div>
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=> Yii::t('default', 'statistics'), 'url'=>array('/admin/default/index')),
          array('label'=> Yii::t('default', 'contact_us'), 'url'=>array('/admin/default/editContact')),
          array('label'=> Yii::t('default', 'company_profile'), 'url'=>array('/admin/default/editProfile')),
          array('label'=> Yii::t('default', 'edit_site_info'), 'url'=>array('/admin/default/editBasicInfo')),
          array('label'=> Yii::t('default', 'edit_home_banners'), 'url'=>array('/admin/default/editBanners')),
          array(
            'label' => Yii::t('default', 'view_homesite'),
            'url' => array('/site/index'),
            'linkOptions' => array('target'=>'_blank')
          )
        )
      )); ?>
    </div><!-- mainmenu -->
    <?php if(Yii::app()->user->hasFlash('errorMessage')):?>
    <div class="error-flush"><?php echo Yii::app()->user->getFlash('errorMessage'); ?></div>
    <?php endif; ?>
    <div id="content"><?php echo $content; ?></div>
  </div>
  <div id="footer">
    Copyright &copy; <?php echo date('Y'); ?> by Vincent. All Rights Reserved.
  </div><!-- footer -->
    <script id="ueditor" type="text/plain"></script>
</body>
</html>