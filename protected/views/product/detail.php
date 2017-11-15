<div id="listCategory">
  <label class="prod-category left"><?php echo Yii::t('default', 'products')?></label>
  <a class="all-products" href="<?php echo Common::makeUrl('product/list') ?>"><?php echo Yii::t('default', 'all_products') ?></a>
  <div class="clear"></div>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/wine_icon.png">
      <a class="prod-cate" href="<?php echo Common::makeUrl('product/list', array('category' => WINE_CATEGORY))?>"><?php echo Yii::t('default', 'drink')?></a>
      <?php foreach ($wineCategories as $category): ?>
      <a <?php echo $category->id == $product->category_id ? 'class="selected"' : '' ?> href="<?php echo Common::makeUrl('product/list', array('category' => $category->id)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/food_icon.png">
      <a class="prod-cate" href="<?php echo Common::makeUrl('product/list', array('category' => FOOD_CATEGORY))?>"><?php echo Yii::t('default', 'food')?></a>
      <?php foreach ($foodCategories as $category): ?>
      <a <?php echo $category->id == $product->category_id ? 'class="selected"' : '' ?> href="<?php echo Common::makeUrl('product/list', array('category' => $category->id)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div id="productDetail">
  <img alt="" class="prod-thumb" src="<?php echo Yii::app()->request->baseUrl . '/' . $product->image_url; ?>">
  <div>
    <h1 class="prod-title"><?php echo $product->name ?></h1>
    <div class="prod-desc">
      <label><?php echo Yii::t('default', 'type') ?></label><label><?php echo CategoryService::categoryName($product->category_id) ?></label><span>|</span>
      <label><?php echo Yii::t('default', 'original') ?></label><label><?php echo Yii::t('default', $product->prod_place) ?></label><span>|</span>
      <label><?php echo Yii::t('default', 'price') ?></label><label><?php echo Yii::t('default', '$') . $product->price ?></label>
    </div>
  </div>
</div>
<?php echo $product->description;?>