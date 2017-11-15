<div class="list-header">
  <h1><?php echo Yii::t('default', 'statistics') ?></h1>
</div>
<div class="stats-section">
  <label><?php echo Yii::t('default', 'category') ?>:</label><span><?php echo CHtml::link($cateCount, Common::makeUrl('admin/default/categoryList')) ?></span>
  <label><?php echo Yii::t('default', 'product') ?>:</label><span><?php echo CHtml::link($prodCount, Common::makeUrl('admin/default/prodList')) ?></span>
  <label><?php echo Yii::t('default', 'star_prod') ?>:</label><span><?php echo CHtml::link($starCount, Common::makeUrl('admin/default/starProdList')) ?></span>
  <label><?php echo Yii::t('default', 'new_arrivals') ?>:</label><span><?php echo CHtml::link($newCount, Common::makeUrl('admin/default/newProdList')) ?></span>
</div>