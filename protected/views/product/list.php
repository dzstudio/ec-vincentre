<div id="listCategory">
  <label class="prod-category left"><?php echo Yii::t('default', 'products')?></label>
  <?php if ($categoryId || $keyword): ?>
  <a class="all-products" href="<?php echo Common::makeUrl('product/list') ?>"><?php echo Yii::t('default', 'all_products') ?></a>
  <?php endif; ?>
  <div class="clear"></div>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/wine_icon.png">
      <a class="prod-cate" href="<?php echo Common::makeUrl('product/list', array('category' => WINE_CATEGORY))?>"><?php echo Yii::t('default', 'drink')?></a>
      <?php foreach ($wineCategories as $category): ?>
      <a <?php echo $category->id == $categoryId ? 'class="selected"' : '' ?> href="<?php echo Common::makeUrl('product/list', array('category' => $category->id, 'keyword' => $keyword)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/food_icon.png">
      <a class="prod-cate" href="<?php echo Common::makeUrl('product/list', array('category' => FOOD_CATEGORY))?>"><?php echo Yii::t('default', 'food')?></a>
      <?php foreach ($foodCategories as $category): ?>
      <a <?php echo $category->id == $categoryId ? 'class="selected"' : '' ?> href="<?php echo Common::makeUrl('product/list', array('category' => $category->id, 'keyword' => $keyword)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div id="productGridView">
  <div class="sort-bar">
    <a <?php echo $sort == 'latest' ? 'class="selected"' : '' ?> href="<?php echo "?category=$categoryId&keyword=$keyword" ?>&sort=latest" ><?php echo Yii::t('default', 'the_latest')?></a> |
    <a <?php echo $sort == 'htl' ? 'class="selected"' : '' ?> href="<?php echo "?category=$categoryId&keyword=$keyword" ?>&sort=htl" ><?php echo Yii::t('default', 'price_high_to_low')?></a> |
    <a <?php echo $sort == 'lth' ? 'class="selected"' : '' ?> href="<?php echo "?category=$categoryId&keyword=$keyword" ?>&sort=lth" ><?php echo Yii::t('default', 'price_low_to_high')?></a> |
  </div>
  <div class="prod-list-view">
  <?php if (Yii::app()->user->hasFlash('no_searched_prods')): ?>
  <div class="no-match-prod">
    <h1><?php echo Yii::app()->user->getFlash('no_searched_prods') ?></h1>
  </div>
  <?php endif;?>
  <?php foreach ($products as $product):?>
  <div class="product-grid-cell">
    <img src="<?php echo Yii::app()->request->baseUrl . '/' . $product['image_url']; ?>" />
    <div class="product-desc">
      <label class="prod-name"><?php echo $product['name']?></label>
      <label class="desc-title"><?php echo Yii::t('default', 'original')?>:</label><label class="desc-value"><?php echo Yii::t('default', $product['prod_place'])?></label>
      <label class="desc-title"><?php echo Yii::t('default', 'type')?>:</label><label class="desc-value"><?php echo Yii::t('default', CategoryService::categoryName($product['category_id']))?></label>
    </div>
    <div class="clear"></div>
    <div class="product-action">
      <label class="desc-value"><?php echo Yii::t('default', '$') . $product['price'] ?></label>
      <a class="btn-shopping" href="<?php echo Common::makeUrl('product/detail', array('id' => $product['id']))?>"><?php echo Yii::t('default', 'detail')?></a>
    </div>
  </div>
  <?php endforeach;?>
  </div>
</div>