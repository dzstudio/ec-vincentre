<div class="list-header">
  <h1><?php echo Yii::t('default', 'new_user') ?></h1>
</div>
<?php if (isset($message)): ?>
<div class="error-msg center"><?php echo Yii::t('default', $message)?></div>
<?php endif; ?>
<div id="editContent" class="edit-content">
<form method="post" id="dataForm">
  <div class="form-row">
    <label><?php echo Yii::t('default', 'name') ?></label><?php echo CHtml::textField('username') ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'password') ?></label><?php echo CHtml::passwordField('password') ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'role') ?></label><?php echo CHtml::dropDownList('role',null, Common::getRoleList()) ?>
    <span><?php echo Yii::t('default', 'general_user_privilege')?></span>
  </div>
  <div class="form-row center">
    <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
    <?php echo CHtml::link(Yii::t('default', 'cancel'), Common::makeUrl('admin/default/prodList')) ?>
  </div>
</form>
</div>