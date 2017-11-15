<?php
class UserController extends Controller {
  public $layout = 'admin';

  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow', // allow authenticated user to perform 'home' and 'say' actions
        'actions' => array('list', 'create'),
        'users' => array('@'),
      ),
      array('allow',
        'actions' => array('login', 'logout'),
        'users' => array('*')
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      )
    );
  }

  public function actionList() {
    $users = UserService::loadAllUsers();
    $this->render('list', array('users' => $users));
  }

  public function actionCreate() {
    $user = new ObjectUser();
    $user->attributes = $_POST;
    $status = true;

    if (Yii::app()->request->isPostRequest) {
      $password = $user->password;
      $user->register_date = Common::getNow();
      $user->password = md5($password);
      if (!UserService::isUserNameExist(trim($user->username)) && $user->validate()) {
        if (strlen($user->username) >= 3 && strlen($password) >= 6 && $user->save()) {
          $this->redirect('list');
        } else {
          $this->render('create', array('message' => 'save_record_failed'));
        }
      } else {
        $this->render('create', array('message' => 'save_record_failed'));
      }
    } else {
      $this->render('create');
    }
  }
}