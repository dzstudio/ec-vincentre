<div class="list-header">
  <h1><?php echo Yii::t('default', 'user_list') ?></h1>
  <a class="action-button action-red" href="javascript:deleteCategories()"><?php echo Yii::t('default', 'delete')?></a>
</div>
<div id="listContent" class="list-content"></div>
<script type="text/javascript">
var objects = <?php echo Convert::jsonEncode($users) ?>;
$(document).ready(function() {
  generateTableList(objects);
  $('#checkAll').live('change', function() {
    $('#listContent td :checkbox').attr('checked', this.checked);
  });
});

function generateTableList(data) {
  var html = '<table class="data-table" cellspacing="0" cellpadding="0">';
  html += '<tr><th><input type="checkbox" id="checkAll"></th><th>ID</th><th><?php echo Yii::t('default', 'name') ?></th><th><?php echo Yii::t('default', 'register_date') ?></th></tr>';

  var rowClass = "even";
  var count = 0;
  for (var i in data) {
    count ++;
    var obj = data[i];
    rowClass = (rowClass == "odd" ? "even" : "odd");
    html += '<tr class="' + rowClass + '">'
      + '<td><input type="checkbox" objId = ' + obj.id + '></td>'
      + '<td>' + obj.id + '</td>'
      + '<td class="capi-case">' + obj.username + '</td>'
      + '<td>' + obj.register_date + '</td>'
      + '</td></tr>';
  }
  if (count == 0) {
    html += '<tr><td class="center" colspan="9"><?php echo Yii::t('default', 'no_record') ?></td></tr>';
  }
  html += '</table>';
  $('#listContent').html(html);
}

function deleteCategories() {
  var inputs = $('#listContent td input:checked');
  if (inputs.length > 0) {
    if (confirm('<?php echo Yii::t('default', 'confirm_delete_items')?>')) {
      var ids = [];
      inputs.each(function() {
        ids.push($(this).attr('objId'));
      });
      spinner.show();
      $.post('<?php echo Common::makeUrl('admin/default/deleteCategory') ?>', {'ids':ids}, function(response) {
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