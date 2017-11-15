<div id="uploadWidget">
  <iframe class="fn-left" width=68 height=26 frameborder=0 scrolling=no src="<?php echo Common::makeUrl('admin/upload/imageUpload') ?>"></iframe>
</div>
<script type="text/javascript">
function uploadImageCallback(result) {
  if (result.status) {
    uploadImageSuccess(result.data);
  } else {
    uploadImageFailed(result.message);
  }
}

function uploadImageStartCallback() {
  uploadImageStart();
}
</script>