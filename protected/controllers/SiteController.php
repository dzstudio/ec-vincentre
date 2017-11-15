<?php

class SiteController extends BaseController
{
  /**
   * Declares class-based actions.
   */
  public function actions()
  {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha'=>array(
        'class'=>'CCaptchaAction',
        'backColor'=>0xFFFFFF,
      ),
      // page action renders "static" pages stored under 'protected/views/site/pages'
      // They can be accessed via: index.php?r=site/page&view=FileName
      'page'=>array(
        'class'=>'CViewAction',
      ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex() {
    $newProducts = ProductService::getNewProducts();
    $starProducts = ProductService::getStarProducts();

    $wineCategories = CategoryService::wineCategories();
    $foodCategories = CategoryService::foodCategories();

    $configs = Yii::app()->user->getFlash('system', null, false);
    $sliders = '{}';
    if (array_key_exists('home_sliders_data', $configs)) {
      $sliders = $configs['home_sliders_data'];
    }

    $this->render('index', array(
        'newProducts' => $newProducts,
        'starProducts' => $starProducts,
        'wineCategories' => $wineCategories,
        'foodCategories' => $foodCategories,
        'sliders' => $sliders
      )
    );
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError()
  {
    if($error=Yii::app()->errorHandler->error)
    {
      if(Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  public function actionContact() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    $contactUs = $configs['contact_us'];

    $this->render('contact', array('contactUs' => $contactUs));
  }

  public function actionProfile() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    $profile = $configs['company_profile'];

    $this->render('profile', array('profile' => $profile));
  }
}