<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/web/css/screen.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
  body {
    background: #F0F0F0;
    min-height: 0;
  }
  #uploadImageButton {
    position: absolute;
    top: 0;
    left: 0;
    font-size: 12px;
    line-height: 18px;
    overflow: hidden;
    border: solid 1px #ABABAB;
    border-radius: 6px;
    padding: 3px 8px;
  }
  #fileUpload {
    position: absolute;
    top: 0;
    left: -164px;
    opacity: 0;
    filter: alpha(opacity=0);
    cursor: pointer;
  }
  </style>
</head>
<body>
  <form id="uploadForm" enctype="multipart/form-data" method="post" action="">
    <div id="uploadImageButton" class="metro-button">
    <?php echo Yii::t('default', 'upload_file')?><input name="upload_file" type="file" id="fileUpload" />
    </div>
  </form>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/web/js/jquery-1.7.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#fileUpload').change(function() {
        $('#uploadForm').submit();return;
    <?php if ($uploadType == 'image'): ?>
    parent.uploadImageStartCallback();
    <?php else: ?>
    parent.uploadAudioStartCallback();
    <?php endif; ?>
      $('#uploadForm').submit();
    });
  <?php if ($isUpload): ?>
    var result = <?php echo Convert::jsonEncode($result); ?>;
    <?php if ($uploadType == 'image'): ?>
    parent.uploadImageCallback(result);
    <?php else: ?>
    parent.uploadAudioCallback(result);
    <?php endif; ?>
  <?php endif; ?>
  });
  </script>
</body>