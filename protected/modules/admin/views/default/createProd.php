<div class="list-header">
  <h1><?php echo ($isCreate ? Yii::t('default', 'create') : Yii::t('default', 'edit')) . Yii::t('default', 'product') ?></h1>
</div>
<?php if (isset($message)): ?>
<div class="error-msg center"><?php echo Yii::t('default', $message)?></div>
<?php endif; ?>
<div id="editContent" class="edit-content">
<form method="post" id="dataForm">
  <div class="form-row">
    <label><?php echo Yii::t('default', 'name') ?></label><?php echo CHtml::textField('name', $product->name) ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'parent_category') ?></label><?php echo CHtml::dropDownList('category_id', $product->category_id, $categories) ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'price') ?></label><?php echo CHtml::textField('price', $product->price) ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'original') ?></label><?php echo CHtml::textField('prod_place', $product->prod_place) ?>
  </div>
  <div class="form-row">
    <label><?php echo Yii::t('default', 'keywords') ?></label><?php echo CHtml::textField('category', $product->category) ?><span> <?php echo Yii::t('default', 'seperate_with_comma')?></span>
  </div>
  <div class="form-row">
    <label class="left"><?php echo Yii::t('default', 'image')?></label>
    <input type="hidden" name="image_url" id="imageUrl" value="<?php echo $product->image_url ?>"/>
    <?php $this->widget('UploadImage'); ?>
    <img alt="" class="<?php echo $product->image_url ? '' : 'hide' ?> left" id="imagePreview" src="<?php echo $product->image_url ? Yii::app()->baseUrl . '/' . $product->image_url : '' ?>" />
    <span class="left" id="imageName"></span>
  </div>
  <div>
    <h1><?php echo Yii::t('default', 'detail') ?></h1>
    <script id="ueditor" name="description" type="text/plain" style="height:500px">
    <?php echo $product->description ?>
    </script>
  </div>
  <div class="form-row center">
    <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
    <?php echo CHtml::link(Yii::t('default', 'cancel'), Common::makeUrl('admin/default/prodList')) ?>
  </div>
</form>
</div>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/ueditor/lang/en/en.js"></script>

<script type="text/javascript">
function uploadImageSuccess(data) {
  var imageUrl = data.image_url;
  $('#imagePreview').attr('attr', imageUrl);
  $('#imageUrl').val(imageUrl);
  $('#imageName').text(data.name);
  $('#imagePreview').attr('src', '<?php echo Yii::app()->baseUrl ?>/' + imageUrl).show();
}

function uploadImageFailed(message) {
  $('#imageName').text(message);
  $('#imagePreview').hide();
}

function uploadImageStart() {
  $('#imageName').text('正在上传...');
}

$(document).ready(function() {
  var ue = UE.getEditor('ueditor', {
    textarea: 'desciption'
  });
});
</script>