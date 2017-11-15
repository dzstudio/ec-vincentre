<?php
class CategoryService {
  private static $model = null;
  private static $allCategories = null;

  private static function modelInstance() {
    if (self::$model == null) {
      if (Yii::app()->language == 'zh-cn') {
        self::$model = new ObjectProdCategory();
      } else {
        self::$model = new ObjectProdCategoryEn();
      }
    }

    return self::$model;
  }

  public static function categoryName($id) {
    if (self::$allCategories == null) {
      self::$allCategories = self::modelInstance()->findAll();
    }
    foreach (self::$allCategories as $category) {
      if ($category->id == $id) {
        return $category->name;
        break;
      }
    }

    return false;
  }

  public static function wineCategories() {
    if (self::$allCategories == null) {
      self::$allCategories = self::modelInstance()->findAll();
    }
    $categories = array();
    foreach (self::$allCategories as $category) {
      if ($category->category_id == WINE_CATEGORY) {
        $categories[] = $category;
      }
    }

    return $categories;
  }

  public static function foodCategories() {
    if (self::$allCategories == null) {
      self::$allCategories = self::modelInstance()->findAll();
    }
    $categories = array();
    foreach (self::$allCategories as $category) {
      if ($category->category_id == FOOD_CATEGORY) {
        $categories[] = $category;
      }
    }

    return $categories;
  }

  public static function deleteCategories($ids) {
    $result = true;
    foreach ($ids as $id) {
      $obj = self::modelInstance()->findByPk($id);
      if ($obj) {
        if (!$obj->delete()) {
          $result = false;
          break;
        }
      }
    }

    return $result;
  }

  public static function getCategoriesCount() {
    return self::modelInstance()->count();
  }
}