<?php

class ProductController extends BaseController
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

  public function actionList() {
    $categoryId = 0;
    if (isset($_GET['category']) && is_numeric($_GET['category'])) {
      $categoryId = $_GET['category'];
      if ($categoryId <= 0 || !CategoryService::categoryName($categoryId)) {
        $categoryId = 0;
      }
    }

    $keyword = '';
    if (isset($_GET['keyword']) && strlen(trim($_GET['keyword'])) > 0) {
      $keyword = trim($_GET['keyword']);
    }

    $sort = '';
    if (isset($_GET['sort'])) {
      $sort = trim($_GET['sort']);
    }
    // If access the all products page and not keyword, reset the keyword.
    if (!$keyword && ($categoryId > 0 || $sort)) {
      $keyword = Yii::app()->user->getState('keyword');
    } else {
      Yii::app()->user->setState('keyword', $keyword);
    }
    if (!in_array($sort, array('latest', 'lth', 'htl'))) {
      $sort = 'latest';
    }

    // List all foods or wines
    if ($categoryId == WINE_CATEGORY || $categoryId == FOOD_CATEGORY) {
      $keyword = '';
      $products = ProductService::listAllWinesOrFoods($categoryId);
    } else {
      $products = ProductService::searchProducts($categoryId, $keyword, $sort);
    }

    if (count($products) == 0 && strlen($keyword) > 0) {
      $products = ProductService::searchProducts(0, '', $sort);
      Yii::app()->user->setFlash('no_searched_prods', Yii::t('default', 'no_matched_products'));
    }

    $wineCategories = CategoryService::wineCategories();
    $foodCategories = CategoryService::foodCategories();

    $this->render('list', array(
        'keyword' => $keyword,
        'wineCategories' => $wineCategories,
        'foodCategories' => $foodCategories,
        'categoryId' => $categoryId,
        'products' => $products,
        'sort' => $sort
      )
    );
  }

  public function actionDetail() {
    $id = 0;
    if (isset($_GET['id'])) {
      $id = trim($_GET['id']);
    }

    if (Yii::app()->language == 'zh-cn') {
      $model = new ObjectProduct();
    } else {
      $model = new ObjectProductEn();
    }
    $product = $model->findByPk($id);

    if (!$product) {
      $this->redirect('list');
    }
    $wineCategories = CategoryService::wineCategories();
    $foodCategories = CategoryService::foodCategories();

    $this->render('detail', array(
        'product' => $product,
        'wineCategories' => $wineCategories,
        'foodCategories' => $foodCategories,
      )
    );
  }
}