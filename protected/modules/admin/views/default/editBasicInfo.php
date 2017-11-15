<div class="list-header">
  <h1><?php echo Yii::t('default', 'edit_site_info') ?></h1>
</div>
<?php if (isset($message)): ?>
<div class="error-msg center"><?php echo Yii::t('default', $message)?></div>
<?php endif; ?>
<div id="editContent" class="edit-content">
<form method="post" id="dataForm">
  <div class="form-row">
    <label><?php echo Yii::t('default', 'telephone') ?></label><?php echo CHtml::textField('telephone', $telephone) ?>
  </div>
  <div class="form-row center">
    <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
    <?php echo CHtml::link(Yii::t('default', 'cancel'), Common::makeUrl('admin/default/index')) ?>
  </div>
</form>
</div>