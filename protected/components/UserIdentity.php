<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
  /**
   * Authenticates a user.
   * The example implementation makes sure if the username and password
   * are both 'demo'.
   * In practical applications, this should be changed to authenticate
   * against some persistent user identity storage (e.g. database).
   * @return boolean whether authentication succeeds.
   */
  public function authenticate() {
    $userModel = ObjectUser::model();
    $user = $userModel->findByAttributes(array('username' => $this->username, 'password' => md5($this->password)));

    if (null === $user) {
      $this->errorCode=self::ERROR_USERNAME_INVALID;
    } else {
      Yii::app()->user->setState('username', $this->username);
      Yii::app()->user->setState('user_id', $user->id);
      $this->errorCode=self::ERROR_NONE;
    }

    return $user;
  }
}