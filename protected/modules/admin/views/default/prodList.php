<div class="list-header">
  <h1><?php echo Yii::t('default', 'prod_list') ?></h1>
  <a class="action-button" href="javascript:setStarProducts()"><?php echo Yii::t('default', 'star_prod')?></a>
  <a class="action-button" href="javascript:setNewProducts()"><?php echo Yii::t('default', 'new_arrivals')?></a>
  <a class="action-button action-red" href="javascript:deleteProducts()"><?php echo Yii::t('default', 'delete')?></a>
</div>
<div id="listContent" class="list-content"></div>
<script type="text/javascript">
var objects = <?php echo Convert::jsonEncode($data) ?>;
$(document).ready(function() {
  generateTableList(objects);
  $('#checkAll').live('change', function() {
    $('#listContent td :checkbox').attr('checked', this.checked);
  });
});

function generateTableList(data) {
  var html = '<table class="data-table" cellspacing="0" cellpadding="0">';
  html += '<tr><th><input type="checkbox" id="checkAll"></th><th>ID</th><th><?php echo Yii::t('default', 'name') ?></th><th><?php echo Yii::t('default', 'original') ?></th><th><?php echo Yii::t('default', 'price') ?></th><th><?php echo Yii::t('default', 'action') ?></th></tr>';

  var rowClass = "even";
  var count = 0;
  for (var i in data) {
    count ++;
    var obj = data[i];
    rowClass = (rowClass == "odd" ? "even" : "odd");
    html += '<tr class="' + rowClass + '">'
      + '<td><input type="checkbox" objId=' + obj.id + '></td>'
      + '<td>' + obj.id + '</td>'
      + '<td>' + obj.name + '</td>'
      + '<td>' + obj.prod_place + '</td>'
      + '<td>' + obj.price + '</td>'
      + '<td><a class="action-line" href="<?php echo Common::makeUrl('admin/default/createProd') ?>?id=' + obj.id + '"><?php echo Yii::t('default', 'edit') ?></a>'
      + '</td></tr>';
  }
  if (count == 0) {
    html += '<tr><td class="center" colspan="9"><?php echo Yii::t('default', 'no_record') ?></td></tr>';
  }
  html += '</table>';
  $('#listContent').html(html);
}

function deleteProducts() {
  var inputs = $('#listContent td input:checked');
  if (inputs.length > 0) {
    if (confirm('<?php echo Yii::t('default', 'confirm_delete_items')?>')) {
      var ids = [];
      inputs.each(function() {
        ids.push($(this).attr('objId'));
      });
      spinner.show();
      $.post('<?php echo Common::makeUrl('admin/default/deleteProd') ?>', {'ids':ids}, function(response) {
        spinner.hide();
        response = JSON.parse(response);
        if (response.status == 'success') {
          window.location.reload();
        } else if (response.message) {
          alert(response.message);
        }
      });
    }
  } else {
    alert("<?php echo Yii::t('default', 'select_atleast_one')?>");
  }
}

function setNewProducts() {
  var inputs = $('#listContent td input:checked');
  if (inputs.length > 0) {
    if (confirm('<?php echo Yii::t('default', 'confirm_add_new_prod')?>')) {
      var ids = [];
      inputs.each(function() {
        ids.push($(this).attr('objId'));
      });
      spinner.show();
      $.post('<?php echo Common::makeUrl('admin/default/setNewProducts') ?>', {'ids':ids}, function(response) {
        spinner.hide();
        response = JSON.parse(response);
        if (response.status == 'success') {
            window.location.href = '<?php echo Common::makeUrl('admin/default/newProdList')?>';
        } else if (response.message) {
          alert(response.message);
        }
      });
    }
  } else {
    alert("<?php echo Yii::t('default', 'select_atleast_one')?>");
  }
}

function setStarProducts() {
  var inputs = $('#listContent td input:checked');
  if (inputs.length > 0) {
    if (confirm('<?php echo Yii::t('default', 'confirm_add_star_prod')?>')) {
      var ids = [];
      inputs.each(function() {
        ids.push($(this).attr('objId'));
      });
      spinner.show();
      $.post('<?php echo Common::makeUrl('admin/default/setStarProducts') ?>', {'ids':ids}, function(response) {
        spinner.hide();
        response = JSON.parse(response);
        if (response.status == 'success') {
            window.location.href = '<?php echo Common::makeUrl('admin/default/starProdList')?>';
        } else if (response.message) {
          alert(response.message);
        }
      });
    }
  } else {
    alert("<?php echo Yii::t('default', 'select_atleast_one')?>");
  }
}
</script>