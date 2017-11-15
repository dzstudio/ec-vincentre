<?php

class DefaultController extends Controller {
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
        'actions' => array('index', 'createProd', 'deleteProd', 'prodList', 'createCategory', 'categoryList', 'createNews', 'newsList',
          'starProdList', 'newProdList', 'setStarProducts', 'setNewProducts', 'unsetStarProducts', 'unsetNewProducts',
          'editContact', 'editProfile', 'editBasicInfo', 'deleteCategory', 'editBanners'
        ),
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

  public function actionIndex() {
    $cateCount = CategoryService::getCategoriesCount();
    $prodCount = ProductService::getPrductsCount();
    $starCount = ProductService::getStarProdsCount();
    $newCount = ProductService::getNewProdsCount();

    $this->render('index', array('cateCount' => $cateCount, 'prodCount' => $prodCount, 'starCount' => $starCount, 'newCount' => $newCount));
  }

  public function actionLogin() {
    $this->layout = "main";

    if (Yii::app()->request->isPostRequest) {
      $result = Array();
      $model = new LoginForm;
      $model->username = trim($_POST['username']);
      $model->password = trim($_POST['password']);

      if($model->validate() && $model->login()) {
        $result['status'] = true;
      } else {
        $result['status'] = false;
        $result['message'] = Yii::t('default', 'username_or_pwd_wrong');
      }

      if (!$result['status']) {
        $this->render('login', $result);
      } else {
        $this->redirect('index');
      }
    } else {
      $this->render('login');
    }
  }

  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect('login');
  }

  public function actionCreateProd() {
    $isCreate = true;
    if (Yii::app()->language == 'zh-cn') {
      $product = new ObjectProduct();
    } else {
      $product = new ObjectProductEn();
    }


    // Get the categories, drink and food.
    if (Yii::app()->language == 'zh-cn') {
      $cateModel = new ObjectProdCategory();
    } else {
      $cateModel = new ObjectProdCategoryEn();
    }
    $cates = $cateModel->findAll('category_id > 0');
    $categories = array();
    foreach ($cates as $cate) {
      $categories[$cate->id] = Yii::t('default', $cate->name);
    }

    if (isset($_GET['id'])) {
      $id = trim($_GET['id']);
      $product = $product->findByPk($id);
      if ($product) {
        $isCreate = false;
      }
    }
    if (!$product) {
      if (Yii::app()->language == 'zh-cn') {
        $product = new ObjectProduct();
      } else {
        $product = new ObjectProductEn();
      }
    }

    // Update keywords, remove unused spaces.
    if ($product->category) {
      $product->category = str_replace('，', ',', $product->category); // Replace full comma.
      $keywords = explode(',', $product->category);
      $tKeywords = array();
      foreach ($keywords as $keyword) {
        $tKeywords[] = trim($keyword);
      }
      $product->category = join(',', $tKeywords);
    }

    if (Yii::app()->request->isPostRequest) {
      $product->attributes = $_POST;
      $product->last_modified = Common::getNow();
      $status = true;

      if (!$product->validate() || !$product->save()) {
        $status = false;
      }

      if ($status) {
        $this->redirect('prodList');
      } else {
        $this->render('createProd', array(
          'product' => $product,
          'categories' => $categories,
          'isCreate' => $isCreate,
          'message' => Yii::t('default', 'save_record_failed'))
        );
      }
    } else {
      $this->render('createProd', array('product' => $product, 'categories' => $categories, 'isCreate' => $isCreate));
    }
  }

  public function actionProdList() {
    if (Yii::app()->language == 'zh-cn') {
      $model = new ObjectProduct();
    } else {
      $model = new ObjectProductEn();
    }
    $products = $model->findAll();
    $this->render('prodList', array('data' => $products));
  }

  public function actionNewProdList() {
    if (Yii::app()->language == 'zh-cn') {
      $model = new ObjectProduct();
    } else {
      $model = new ObjectProductEn();
    }
    $products = ProductService::getNewProducts();
    $this->render('newProdList', array('data' => $products));
  }

  public function actionStarProdList() {
    if (Yii::app()->language == 'zh-cn') {
      $model = new ObjectProduct();
    } else {
      $model = new ObjectProductEn();
    }
    $products = ProductService::getStarProducts();
    $this->render('starProdList', array('data' => $products));
  }

  public function actionSetNewProducts() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (!ProductService::setProductKeywordByIds($ids, 'new_arrivals')) {
      $result['status'] = 'failed';
      $result['message'] = Yii::t('default', 'save_record_failed');
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionSetStarProducts() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (!ProductService::setProductKeywordByIds($ids, 'star_prod')) {
      $result['status'] = 'failed';
      $result['message'] = Yii::t('default', 'save_record_failed');
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionUnsetNewProducts() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (!ProductService::setProductKeywordByIds($ids, 'new_arrivals', true)) {
      $result['status'] = 'failed';
      $result['message'] = Yii::t('default', 'save_record_failed');
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionUnsetStarProducts() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (!ProductService::setProductKeywordByIds($ids, 'star_prod', true)) {
      $result['status'] = 'failed';
      $result['message'] = Yii::t('default', 'save_record_failed');
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionCreateCategory() {
    $isCreate = true;
    if (Yii::app()->language == 'zh-cn') {
      $category = new ObjectProdCategory();
    } else {
      $category = new ObjectProdCategoryEn();
    }

    // Get the top categories, drink and food.
    $parentCategories = $category->findAllByAttributes(array('category_id' => 0));
    $topCategories = array();
    foreach ($parentCategories as $cate) {
      $topCategories[$cate->id] = Yii::t('default', $cate->name);
    }
    $topCategories[0] = Yii::t('default', 'none');

    if (isset($_GET['id'])) {
      $id = trim($_GET['id']);
      $category = $category->findByPk($id);
      if ($category) {
        $isCreate = false;
      }
    }
    if (!$category) {
      if (Yii::app()->language == 'zh-cn') {
        $category = new ObjectProdCategory();
      } else {
        $category = new ObjectProdCategoryEn();
      }
    }

    if (Yii::app()->request->isPostRequest) {
      $category->name = trim($_POST['catename']);
      $category->category_id = trim($_POST['parentid']);

      $status = true;
      if ($category->name == '') {
        $status = false;
      } else if (!in_array($category->category_id, array_keys($topCategories))) {
        $status = false;
      } else if (!$category->save()) {
        $status = false;
      }

      if ($status) {
        $this->redirect('categoryList');
      } else {
        $this->render('createCategory', array(
          'category' => $category,
          'topCategories' => $topCategories,
          'isCreate' => $isCreate,
          'message' => Yii::t('default', 'save_record_failed'))
        );
      }
    } else {
      $this->render('createCategory', array('category' => $category, 'topCategories' => $topCategories, 'isCreate' => $isCreate));
    }
  }

  public function actionDeleteCategory() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (in_array(WINE_CATEGORY, $ids) || in_array(FOOD_CATEGORY, $ids)) {
      $result['status'] = 'failed';
      $result['message'] = Yii::t('default', 'cant_delete_main_cate');
    } else if (!CategoryService::deleteCategories($ids)) {
      $result['status'] = 'failed';
      $result['message'] = "删除分类\"($obj->name)\"失败。。。";
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionDeleteProd() {
    $ids = $_POST['ids'];
    $result = array(
      'status' => 'success',
      'message' => ''
    );

    if (!ProductService::deleteProductByIds($ids)) {
      $result['status'] = 'failed';
      $result['message'] = "删除产品\"($obj->name)\"失败。。。";
    }

    echo Convert::jsonEncode($result);
    Yii::app()->end();
  }

  public function actionCategoryList() {
    if (Yii::app()->language == 'zh-cn') {
      $model = new ObjectProdCategory();
    } else {
      $model = new ObjectProdCategoryEn();
    }
    $categories = $model->findAll();
    $this->render('categoryList', array('data' => $categories));
  }

  public function actionCreateNews() {
    $this->render('createNews');
  }
  public function actionNewsList() {
    $this->render('newsList');
  }

  public function actionEditContact() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    $contactUs = '';
    if (array_key_exists('contact_us', $configs)) {
      $contactUs = $configs['contact_us'];
    }

    if (Yii::app()->request->isPostRequest) {
      // Update telephone info
      if (isset($_POST['contact_info'])) {
        SystemService::updateSystemConfig('contact_us', trim($_POST['contact_info']));
        $contactUs = trim($_POST['contact_info']);
      }
    }

    $this->render('editContact', array('contactUs' => $contactUs));
  }

  public function actionEditProfile() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    $companyProfile = '';
    if (array_key_exists('company_profile', $configs)) {
      $companyProfile = $configs['company_profile'];
    }

    if (Yii::app()->request->isPostRequest) {
      // Update telephone info
      if (isset($_POST['profile_info'])) {
        SystemService::updateSystemConfig('company_profile', trim($_POST['profile_info']));
        $companyProfile = trim($_POST['profile_info']);
      }
    }

    $this->render('editProfile', array('companyProfile' => $companyProfile));
  }

  public function actionEditBasicInfo() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    $telephone = '';
    if (array_key_exists('website_telephone', $configs)) {
      $telephone = $configs['website_telephone'];
    }

    if (Yii::app()->request->isPostRequest) {
      // Update telephone info
      if (isset($_POST['telephone'])) {
        SystemService::updateSystemConfig('website_telephone', trim($_POST['telephone']));
        $telephone = trim($_POST['telephone']);
      }
    }

    $this->render('editBasicInfo', array('telephone' => $telephone));
  }

  public function actionEditBanners() {
    $configs = Yii::app()->user->getFlash('system', null, false);
    if (array_key_exists('home_sliders_data', $configs)) {
      $sliders = Convert::jsonDecode($configs['home_sliders_data']);
    }

    if (Yii::app()->request->isPostRequest) {
      // Update sliders info
      if (isset($_POST['sliders-data'])) {
        SystemService::updateSystemConfig('home_sliders_data', trim($_POST['sliders-data']));
        $sliders = Convert::jsonDecode($_POST['sliders-data']);
      }
    }

    $this->render('editBanners', array('sliders' => $sliders));
  }
}