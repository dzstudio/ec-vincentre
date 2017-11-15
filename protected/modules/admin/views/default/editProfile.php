<div class="list-header">
  <h1><?php echo Yii::t('default', 'company_profile') ?></h1>
</div>
<?php if (isset($message)): ?>
<div class="error-msg center"><?php echo Yii::t('default', $message)?></div>
<?php endif; ?>
<form method="post" id="dataForm">
  <script id="ueditor" name="profile_info" type="text/plain" style="height:500px">
  <?php echo $companyProfile ?>
  </script>
  <div class="form-row center">
    <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
    <?php echo CHtml::link(Yii::t('default', 'cancel'), Common::makeUrl('admin/default/index')) ?>
  </div>
</form>

<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/lang/en/en.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  var ue = UE.getEditor('ueditor', {
    textarea: 'desciption'
  });
});
</script>