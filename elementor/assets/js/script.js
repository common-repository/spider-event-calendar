jQuery("document").ready(function () {
  elementor.hooks.addAction('panel/open_editor/widget/spc-elementor', function (panel, model, view) {
    var calendar_obj = jQuery('select[data-setting="spc_calendar_id"]', window.parent.document);
    spc_edit_calendar_link(calendar_obj);
    var theme_obj = jQuery('select[data-setting="spc_theme_id"]', window.parent.document);
    spc_edit_theme_link(theme_obj);
  });
  jQuery('body').on('change', 'select[data-setting="spc_calendar_id"]', window.parent.document, function () {
    spc_edit_calendar_link(jQuery(this));
  });
  jQuery('body').on('change', 'select[data-setting="spc_theme_id"]', window.parent.document, function () {
    spc_edit_theme_link(jQuery(this));
  });
});

function spc_edit_calendar_link(el) {
  var id = el.val();
  var link = el.closest('.elementor-control-content').find('.elementor-control-field-description').find('a');
  var new_link = 'admin.php?page=SpiderCalendar';
  if (id !== '0') {
    new_link = 'admin.php?page=SpiderCalendar&task=show_manage_event&calendar_id=' + id;
  }
  link.attr('href', new_link);
}

function spc_edit_theme_link(el) {
  console.log(el);
  var id = el.val();
  var link = el.closest('.elementor-control-content').find('.elementor-control-field-description').find('a');
  var new_link = 'admin.php?page=spider_calendar_themes';
  if (id !== '0') {
    new_link = 'admin.php?page=spider_calendar_themes&task=edit_theme&id=' + id;
  }
  link.attr('href', new_link);
}