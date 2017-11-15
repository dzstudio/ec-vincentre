<div class="list-header">
  <h1><?php echo Yii::t('default', 'new_arrivals') ?></h1>
  <a class="action-button" href="javascript:unsetNewProducts()"><?php echo Yii::t('default', 'unset')?></a>
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

function unsetNewProducts() {
  var inputs = $('#listContent td input:checked');
  if (inputs.length > 0) {
    if (confirm('<?php echo Yii::t('default', 'confirm_unset_newprod')?>')) {
      var ids = [];
      inputs.each(function() {
        ids.push($(this).attr('objId'));
      });
      spinner.show();
      $.post('<?php echo Common::makeUrl('admin/default/unsetNewProducts') ?>', {'ids':ids}, function(response) {
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
</script>