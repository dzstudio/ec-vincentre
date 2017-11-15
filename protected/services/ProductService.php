<?php
class ProductService {
  private static $model = null;
  private static $table = null;

  private static function modelInstance() {
    if (self::$model == null) {
      if (Yii::app()->language == 'zh-cn') {
        self::$model = new ObjectProduct();
      } else {
        self::$model = new ObjectProductEn();
      }
    }

    return self::$model;
  }

  private static function tableName() {
    if (self::$table == null) {
      if (Yii::app()->language == 'zh-cn') {
        self::$table = 'object_product';
      } else {
        self::$table = 'object_product_en';
      }
    }

    return self::$table;
  }

  public static function getStarProducts() {
    $table = self::tableName();
    $sql = "SELECT * FROM `$table` WHERE `category` LIKE '%star_prod%' ORDER BY `last_modified` DESC;";
    $command = Yii::app()->db->createCommand($sql);
    return $command->query();
  }

  public static function getNewProducts() {
    $table = self::tableName();
    $sql = "SELECT * FROM `$table` WHERE `category` LIKE '%new_arrivals%' ORDER BY `last_modified` DESC;";
    $command = Yii::app()->db->createCommand($sql);
    return $command->query();
  }

  public static function deleteProductByIds($ids) {
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

  public static function setProductKeywordByIds($ids, $keyword, $isunset = false) {
    $result = true;
    foreach ($ids as $id) {
      $obj = self::modelInstance()->findByPk($id);
      if ($obj) {
        $keywords = strlen(trim($obj->category)) > 0 ? explode(',', $obj->category) : array();
        if (in_array($keyword, $keywords)) {
          if ($isunset) {
            foreach ($keywords as $key => $value) {
              if ($value == $keyword) {
                unset($keywords[$key]);
                break;
              }
            }
          }
        } else if (!$isunset) {
          $keywords[] = $keyword;
        }
        $obj->category = join(',', $keywords);
        if (!$obj->save()) {
          $result = false;
          break;
        }
      }
    }

    return $result;
  }

  public static function searchProducts($categoryId, $keyword, $sort) {
    $condition1 = '';
    $condition2 = '';
    $condition = '';
    if ($categoryId > 0) {
      $condition1 = "`category_id` = '$categoryId'";
    }
    if (strlen($keyword) > 0) {
      $condition2 = "(`category` LIKE '%$keyword%' OR name LIKE '%$keyword%')";
    }
    if (strlen($condition1) > 0) {
      $condition = 'WHERE ' . $condition1;
      if (strlen($condition2) > 0) {
        $condition = $condition . ' AND ' . $condition2;
      }
    } else if (strlen($condition2) > 0) {
      $condition = 'WHERE ' . $condition2;
    }

    $orderBy = '';
    switch ($sort) {
      case 'latest':
        $orderBy = ' ORDER BY `last_modified` DESC;';
        break;
      case 'htl':
        $orderBy = ' ORDER BY `price` DESC;';
        break;
      case 'lth':
        $orderBy = ' ORDER BY `price` ASC;';
        break;
    }

    $table = self::tableName();
    $sql = "SELECT * FROM `$table` $condition $orderBy";
    $command = Yii::app()->db->createCommand($sql);

    return $command->query();
  }

  public static function listAllWinesOrFoods($id) {
    $table = self::tableName();
    $sql = "SELECT `prod`.* FROM `$table` AS `prod` LEFT JOIN `object_prod_category` AS `cate` ON `prod`.`category_id` = `cate`.`id` WHERE `cate`.`category_id` = $id;";
    $command = Yii::app()->db->createCommand($sql);

    return $command->query();
  }

  public static function getPrductsCount() {
    return self::modelInstance()->count();
  }

  public static function getStarProdsCount() {
    return self::modelInstance()->count("`category` LIKE '%star_prod%'");
  }

  public static function getNewProdsCount() {
    return self::modelInstance()->count("`category` LIKE '%new_arrivals%'");
  }
}