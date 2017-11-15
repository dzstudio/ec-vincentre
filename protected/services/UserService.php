<?php
class UserService {
  private static $model = null;
  private static $allCategories = null;

  private static function modelInstance() {
    if (self::$model == null) {
      self::$model = new ObjectUser();
    }
    return self::$model;
  }

  public static function loadAllUsers() {
    $id = Yii::app()->user->getState('user_id');
    $sql = "SELECT * FROM `object_user` WHERE `id` <> 0;";
    $command = Yii::app()->db->createCommand($sql);
    return $command->query();
  }

  public static function isUserNameExist($name) {
    $user = self::modelInstance()->find("username='$name'");
    return $user != null;
  }
}