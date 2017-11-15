<?php
/**
 * @author Dillon Zhang
 * @date 2014/2/22
 */

class UploadController extends Controller {
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
        'actions' => array('mediaUpload', 'imageUpload'),
        'users' => array('@'),
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      )
    );
  }

  public function actionMediaUpload() {
    $isUpload = false;
    $acceptType = $_GET['accept'];

    if (!Yii::app()->getRequest()->getIsPostRequest()) {
      $this->renderPartial('mediaUpload', array('isUpload' => false, 'accept' => $acceptType, 'uploadType' => $uploadType));
      return;
    }

    $result = array(
      'status' => false,
      'data' => '',
      'message' => ''
    );

    if (0 >= $_FILES["upload_file"]["error"]) {
      $uploadFile = $_FILES["upload_file"]["tmp_name"];
      $uploadFileName = $_FILES['upload_file']['name'];
      $mimeType = $_FILES['upload_file']['type'];
      $fileSize = $_FILES['upload_file']['size'];
      $extend = pathinfo($uploadFileName);
      $extend = strtolower($extend["extension"]);
      if ($uploadFile) {
        $newFileName = date('YmdHis') . '.' . $extend;
        $relativePath = 'web/uploads/audios';
        $path = str_replace('protected', '', Yii::app()->getBasePath()) . $relativePath;
        if (!is_dir($path)) {
          mkdir($path, 0777);
        }
        if (move_uploaded_file($uploadFile, $path . '/' . $newFileName)) {
          $result['status'] = true;
          $id = AudioService::createAudioResource(
            $uploadFileName,
            $relativePath . '/' . $newFileName,
            $fileSize,
            $mimeType
          );
          $result['data'] = array(
            'id' => $id,
            'path' => $relativePath . '/' . $newFileName,
            'name' => $uploadFileName
          );
        }
        else {
          $result['message'] = '系统无法保存您上传的文件';
        }
      }
    }

    $this->renderPartial('mediaUpload', array('isUpload' => true, 'result' => $result, 'uploadType' => $uploadType));
  }

  public function actionImageUpload() {
    $isUpload = false;
    $uploadType = 'image';

    if (!Yii::app()->getRequest()->getIsPostRequest()) {
      $this->renderPartial('mediaUpload', array('isUpload' => false, 'uploadType' => $uploadType));
      return;
    }

    $result = array(
      'status' => false,
      'data' => '',
      'message' => ''
    );

    if (0 >= $_FILES["upload_file"]["error"]) {
      $uploadFile = $_FILES["upload_file"]["tmp_name"];
      $uploadFileName = $_FILES['upload_file']['name'];
      $mimeType = $_FILES['upload_file']['type'];
      $extend = pathinfo($uploadFileName);
      $extend = strtolower($extend["extension"]);
	  $relativePath = '';
      if ($uploadFile) {
        $newFileName = date('YmdHis') . '.' . $extend;
        if (strpos($mimeType, 'image') !== false) {
          $relativePath .= 'web/uploads/images/' . date('Ymd');
          $path = str_replace('protected', '', Yii::app()->getBasePath()) . $relativePath;
          if (!is_dir($path)) {
            mkdir($path, 0777);
          }
          if (move_uploaded_file($uploadFile, $path . '/' . $newFileName)) {
            $result['status'] = true;
            $result['data'] = array(
              'image_url' => $relativePath . '/' . $newFileName,
              'name' => $uploadFileName
            );
          } else {
            $result['message'] = '系统无法保存您上传的文件';
          }
        } else {
          $result['message'] = '请上传图片文件';
        }
      }
    }

    $this->renderPartial('mediaUpload', array('isUpload' => true, 'result' => $result, 'uploadType' => $uploadType));
  }
}