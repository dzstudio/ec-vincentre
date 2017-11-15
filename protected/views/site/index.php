<div id="productCategory">
  <label class="prod-category"><?php echo Yii::t('default', 'products')?></label>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/wine_icon.png">
      <label><?php echo Yii::t('default', 'drink')?></label>
    </div>
    <div>
      <?php foreach ($wineCategories as $category): ?>
      <a href="<?php echo Common::makeUrl('product/list', array('category' => $category->id)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="category-section">
    <div>
      <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/web/images/food_icon.png">
      <label><?php echo Yii::t('default', 'food')?></label>
    </div>
    <div>
      <?php foreach ($foodCategories as $category): ?>
      <a href="<?php echo Common::makeUrl('product/list', array('category' => $category->id)) ?>"><?php echo Yii::t('default', $category->name)?></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div id="flexslider"></div>
<div class="clear"></div>
<?php if (count($starProducts) > 0): ?>
<div class="prod-stage">
  <label class="sub-title"><?php echo Yii::t('default', 'star_prod')?></label>
  <div class="stage-content">
    <?php foreach ($starProducts as $product):?>
    <div class="product-grid-cell">
      <div class="clear"></div>
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
<?php endif; ?>
<?php if (count($newProducts) > 0): ?>
<div class="prod-stage">
  <label class="sub-title"><?php echo Yii::t('default', 'new_arrivals')?></label>
  <div class="stage-content">
    <?php foreach ($newProducts as $product):?>
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
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function() {
  var sliders = <?php echo $sliders; ?>;
  var html = '<ul class="slides">';
  for (var i in sliders) {
    html += '<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/' + sliders[i] + '" /></li>';
  }
  html += '</ul>';
  $('#flexslider').html(html);

  $('#flexslider').flexslider({
    animation: "slide",
    animationLoop: true,
    directionNav: false,
    slideshowSpeed: 4000,
    animationSpeed: 1200
  });
});
</script>