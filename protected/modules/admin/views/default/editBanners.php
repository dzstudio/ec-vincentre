<div class="list-header">
  <h1><?php echo Yii::t('default', 'edit_home_banners') ?></h1>
</div>
<div id="sliderImages">
  <div class="slider-add"><?php $this->widget('UploadImage'); ?></div>
</div>
<div class="clear"></div>
<form method="post" id="dataForm">
<input type="hidden" name="sliders-data" id="slidersData" value=''/>
<div class="form-row center">
  <?php echo CHtml::submitButton(Yii::t('default', 'save'), array('class' => 'submit-button')) ?>
  <?php echo CHtml::link(Yii::t('default', 'undo'), 'javascript:window.location.reload()') ?>
</div>
</form>
<script type="text/javascript">
var sliders = <?php echo Convert::jsonEncode($sliders)?>;

function generateSliders() {
  var html = '';
  for (var i in sliders) {
    html += '<div class="slider-img"><a class="slider-action" imgId="' + i + '" href="javascript:void(0)">X</a><img alt="" src="<?php echo Yii::app()->baseUrl ?>/' + sliders[i] + '" /></div>';
  }
  $('.slider-img').remove();
  $('.slider-add').before(html);
  $('#slidersData').val(JSON.stringify(sliders));
}

$(document).ready(function() {
  generateSliders();
  $('.slider-action').live('click', function() {
    delete sliders[$(this).attr('imgId')];
    generateSliders();
  });
});

function uploadImageSuccess(data) {
  var imageUrl = data.image_url;
  var count = 1;
  for (var i in sliders) {
    count++;
  }
  sliders[count] = imageUrl;
  spinner.hide();
  generateSliders();
}

function uploadImageFailed(message) {
  alert(message);
}

function uploadImageStart() {
  spinner.show();
}

</script>