<?php
class Common {
  public static $now = null;

  public static function getErrorFromModel($form)
  {
    $errors = $form->getErrors();
    if (!empty($errors)) {
      foreach ($errors as $key => $value) {
        $errors = $value[0];
      }
    }
    else {
      $errors = '';
    }

    return $errors;
  }

  /**
   * Get DB time
   *
   * @return date
   */
  public static function getNow() {
    if (self::$now) {
      date('Y-m-d H:i:s', self::$now);
    }

    $command = Yii::app()->db->createCommand('SELECT unix_timestamp() AS `timestamp`');
    $reader = $command->queryRow();
    foreach($reader as $row)
    {
      self::$now = $row;
      break;
    }

    return date('Y-m-d H:i:s', self::$now);
  }

  /**
   * Encapsulates the createUrl method.
   *
   * @param string the controller and the action (e.g. user/signin)
   * @param array list of GET parameters (name=>value). Both the name and value will be URL-encoded.
   * If the name is '#', the corresponding value will be treated as an anchor
   * and will be appended at the end of the URL.
   * @return string returns the constructed URL
   */
  public static function makeUrl($urlStr, $paramArray = array()) {
    return Yii::app()->urlManager->createUrl($urlStr, $paramArray);
  }

  public static function getRoleList() {
    return array(
      'general' => Yii::t('default', 'general'),
      'admin' => Yii::t('default', 'admin')
     );
  }
}