<div class="list-header">
  <h1><?php echo ($isCreate ? Yii::t('default', 'create') : Yii::t('default', 'edit')) . Yii::t('default', 'category') ?></h1>
</div>
<?php if (isset($message)): ?>
<div class="error-msg center"><?php echo Yii::t('default', $message)?></div>
<?php endif; ?>
<div id="editContent" class="edit-content">
<form method="post" id="dataForm">
  <div class="form-row">
    <label><?php echo Yii::t('default', 'category_name') ?></label><?php echo CHtml::textField('catename', $category->name) ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'parent_category') ?></label><?php echo CHtml::dropDownList('parentid', $category->category_id, $topCategories) ?>
  </div>
  <div class="form-row center">
    <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
    <?php echo CHtml::link(Yii::t('default', 'cancel'), Common::makeUrl('admin/default/categoryList')) ?>
  </div>
</form>
</div>