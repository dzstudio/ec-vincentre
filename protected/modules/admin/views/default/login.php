<form method="post">
<div id="loginForm">
  <?php if (isset($message)): ?>
  <div class="error-msg"><?php echo Yii::t('default', $message)?></div>
  <?php endif; ?>
  <div class="form-line">
    <label><?php echo Yii::t("default", "username")?></label>
    <input type="text" name="username" />
  </div>
  <div class="form-line">
    <label><?php echo Yii::t("default", "password")?></label>
    <input type="password" name="password" />
  </div>
  <input type="submit" value="<?php echo Yii::t('default', 'login')?>"/>
</div>
</form>