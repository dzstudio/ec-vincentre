<div class="error-page">
  <h1><?php echo $code; ?></h1>
  <img id="logo" alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/logo.jpg">
  <div class="clear"></div>
  <a href="<?php echo Common::makeUrl('site/index')?>"><?php echo Yii::t('default', 'back_home_page') ?></a>
</div>