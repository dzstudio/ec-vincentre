/**
 * @author Dillon Zhang
 * @date 2014/3/13
 *
 * A javascript plugin to create screen overlay spinner.
 */

var spinner = {
  show: function() {
    if ($('#screen_spinner_overlay').length > 0) {
      return;
    } else {
      var html = '<div class="screen_spinner_overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:#000000;opacity:0.4;filter:alpha(opacity=40);"></div>'
        + '<img class="screen_spinner_overlay" style="position:fixed;top:50%;left:50%;margin-top:-7px;margin-left:-57px;" src="<?php echo $_SERVER["PHP_SELF"] ?>/../../images/progress-bar.gif">';
      $('body').append(html);
    }
  },
  hide: function() {
    $('.screen_spinner_overlay').fadeOut("normal", function(){
      $(this).remove();
    });
  }
}