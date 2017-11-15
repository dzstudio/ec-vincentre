<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
  /*
   * Description: Init language setting.
   */
  public function init() {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
    if (preg_match("/en/i", $lang)) {
      $lang = 'en-us';
    } else {
      $lang = 'zh-cn';
    }

    if (Yii::app()->user->hasState('lang')) {
      $lang = Yii::app()->user->getState('lang');
    }

    if (isset ($_GET['hl']) && 'en' === $_GET['hl']) {
      $lang = 'en-us';
      Yii::app()->user->setState('lang', $lang);
    } else if (isset ($_GET['hl']) && 'zh'===$_GET['hl']) {
      $lang = 'zh-cn';
      Yii::app()->user->setState('lang', $lang);
    }
    Yii::app()->language = $lang;

    // Load system config
    Yii::app()->user->setFlash('system', SystemService::loadSystemConfig());
  }
  /**
   * @var string the default layout for the controller view. Defaults to '//layouts/column1',
   * meaning using a single column layout. See 'protected/views/layouts/main.php'.
   */
  public $layout='main';
  /**
   * @var array context menu items. This property will be assigned to {@link CMenu::items}.
   */
  public $menu=array();
  /**
   * @var array the breadcrumbs of the current page. The value of this property will
   * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
   * for more details on how to specify this property.
   */
  public $breadcrumbs=array();
}