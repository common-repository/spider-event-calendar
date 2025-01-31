<?php
function php_window() {
  global $wpdb;
  $gutenberg_callback = sp_get('callback', 0);
	$gutenberg_id = sp_get('edit', 0);
  $themes = $wpdb->get_results("SELECT id,title FROM " . $wpdb->prefix . "spidercalendar_theme");
  $calendars = $wpdb->get_results("SELECT id,title FROM " . $wpdb->prefix . "spidercalendar_calendar WHERE published=1");
  ?>
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title>Spider Calendar</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <script language="javascript" type="text/javascript"
              src="<?php echo get_option("siteurl"); ?>/wp-includes/js/jquery/jquery.js"></script>
      <?php if( !$gutenberg_callback ){?>
     	<script language="javascript" type="text/javascript"
	src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<link rel="stylesheet" href="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/plugins/compat3x/css/dialog.css" type="text/css" media="all">
<script language="javascript" type="text/javascript"
	src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript"
	src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
     <?php }?>
     <link rel="stylesheet" id="dashicons-css" href="<?php echo get_option("siteurl"); ?>/wp-includes/css/dashicons.min.css?ver=5.1.1" type="text/css" media="all">
      <base target="_self">
    </head>
    <body id="link" dir="ltr" class="wp-core-ui">
    	<div class="wd-table">
	      <form name="spider_cat" action="#">
	       <?php if( !$gutenberg_callback ){?>
		        <div class="tabs" role="tablist" tabindex="-1">
		          <ul>
		            <li id="Single_product_tab" class="current" role="tab" tabindex="0"><span><a
		              href="javascript:mcTabs.displayTab('Single_product_tab','Single_product_panel');" onMouseDown="return false;"
		              tabindex="-1">Spider Calendar</a></span></li>
		          </ul>
		        </div>
		        <?php }?>
	        <div class="panel_wrapper">
	          <div id="Single_product_panel" class="panel current">
	            <br>
	            <table border="0" cellpadding="4" cellspacing="0">
	              <tbody>
	              <tr>
	                <td nowrap="nowrap"><label for="spider_Calendar" class="wd-label">Select Calendar</label></td>
	                <td><select name="spider_Calendar" id="spider_Calendar" >
	                  <option value="- Select a Calendar -" selected="selected">- Select a Calendar -</option>
	                  <?php
	                  foreach ($calendars as $calendar) {
	                    ?>
	                    <option value="<?php echo $calendar->id; ?>"><?php echo $calendar->title; ?></option>
	                    <?php }?>
	                </select>
	                </td>
	              </tr>
	              <tr>
	                <td nowrap="nowrap"><label for="spider_Calendar_theme" class="wd-label">Select Theme</label></td>
	                <td>
	                  <select name="spider_Calendar_theme" id="spider_Calendar_theme" >
	                    <option value="- Select a Theme -" selected="selected">- Select a Theme -</option>
	                    <?php
	                    foreach ($themes as $theme) {
	                      ?>
	                      <option value="<?php echo $theme->id; ?>"><?php echo $theme->title; ?></option>
	                      <?php }?>
	                  </select>
	                </td>
	              </tr>
	              <tr>
	                <td class="key"><label for="default_view" class="wd-label">Default View</label></td>
	                <td>
	                  <select id="default_view" style="width:150px;" onChange="spider_calendar_select_view(this.value)">
	                    <option value="month" selected="selected">Month</option>
	                    <option value="list">List</option>
	                    <option value="week">Week</option>
	                    <option value="day">Day</option>
	                  </select>
	                </td>
	              </tr>
	              <tr>
	                <td class="key"><label for="view_0" class="wd-label">Select Views</label></td>
	                <td style="font-size: 13px;">
	                  <input type="checkbox" id="view_0" value="month" checked="checked">Month
	                  <input type="checkbox" id="view_1" value="list" checked="checked">List
	                  <input type="checkbox" id="view_2" value="week" checked="checked">Week
	                  <input type="checkbox" id="view_3" value="day" checked="checked">Day
	                </td>
	              </tr>
	              </tbody>
	            </table>
	          </div>
	        </div>
	        <br>
	        <div class="mceActionPanel">
	          <div style="float: right;">
	            <input type="button" id="insert" name="insert" class="button-primary" value="Insert" onClick="insert_spider_calendar();"/>
	          </div>
	        </div>
	      </form>
  		</div>
      <style type="text/css">
	  		.wd-table {
			    clear: both;
			    display: table;
			    margin: 0;
			    padding: 10px 0;
			    position: relative;
			    table-layout: fixed;
			    width: 100%;
			}

			.wd-label {
			    display: block;
			    font-size: 14px;
			    font-weight: bold;
			    line-height: 20px;
			    margin-bottom: 10px;
			    padding: 0;
			}
			.wd-table select {
			    background: #fff none repeat scroll 0 0;
			    border: 1px solid #ddd;
			    border-radius: 4px;
			    box-shadow: none;
			    display: block;
			    height: initial;
			    line-height: 20px;
			    margin: 0;
			    max-width: 100%;
			    padding: 5px;
			    width: 100%;
			    margin-left: 5px;
			}
			#insert {
			    background: #2ea2cc;
			    background: -webkit-gradient(linear, left top, left bottom, from(#2ea2cc), to(#1e8cbe));
			    background: -webkit-linear-gradient(top, #2ea2cc 0%,#1e8cbe 100%);
			    background: linear-gradient(top, #2ea2cc 0%,#1e8cbe 100%);
			    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2ea2cc', endColorstr='#1e8cbe',GradientType=0 );
			    border: 1px solid #0074a2;
			    -webkit-box-shadow: inset 0 1px 0 rgba(120,200,230,0.5);
			    box-shadow: inset 0 1px 0 rgba(120,200,230,0.5);
			    color: #fff;
			    text-decoration: none;
			    text-shadow: 0 1px 0 rgba(0,86,132,0.7);
			    border-radius: 3px;
			    font-size: 13px;
			    line-height: 24px;
			    padding: 0 10px;
			}
			input[type=checkbox], input[type=radio] {
			    border: 1px solid #b4b9be;
			    background: #fff;
			    color: #555;
			    clear: none;
			    cursor: pointer;
			    display: inline-block;
			    line-height: 0;
			    height: 20px;
			    margin: -4px 4px 0 0;
			    outline: 0;
			    padding: 0!important;
			    text-align: center;
			    vertical-align: middle;
			    width: 20px;
			    min-width: 16px;
			    -webkit-appearance: none;
			    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
			    transition: .05s border-color ease-in-out;
			}
			#link .wd-table .panel_wrapper {
			    height: 155px;
			}
			input[type=checkbox]:checked:before {
			    font: normal 25px/1 dashicons;
			    margin: -3px -5px;
			}
			input[type=checkbox]:checked:before {
			    content: "\f147";
			    margin: -3px 0 0 -4px;
			    color: #1e8cbe;
			}
			input[type=checkbox] {
			    -webkit-appearance: none;
			}
			.wd-table input[type="checkbox"] {
			    margin-bottom: 5px;
			    display: inline-block;
			    height: 20px;
			    width: 20px;
			}
	  	</style>
      <script type="text/javascript">
        var short_code = get_params("Spider_Calendar");
        if (short_code) {
          document.getElementById("view_0").checked = false;
          document.getElementById("view_1").checked = false;
          document.getElementById("view_2").checked = false;
          document.getElementById("view_3").checked = false;
          document.getElementById("spider_Calendar").value = short_code['id'];
          document.getElementById("spider_Calendar_theme").value = short_code['theme'];
          document.getElementById("default_view").value = short_code['default'];
          var selected_views = short_code['select'].split(',');
          for (var selected_view_id in selected_views) {
            var selected_view = selected_views[selected_view_id];
            for (var i = 0; i < 4; i++) {
              if (document.getElementById("view_" + i).value == selected_view) {
                document.getElementById("view_" + i).checked = true;
              }
            }
          }
        }
        // Get shortcodes attributes.
        function get_params(module_name) {
          <?php if ($gutenberg_callback) {
        if ( $gutenberg_id == 0) {
        ?>
        return false;
        <?php
        }
        ?>
        var short_code_attr = new Array();
        short_code_attr['id'] = <?php echo (int) $gutenberg_id; ?>;
        selected_text = window.parent.window['<?php echo $gutenberg_callback . '_shortcode'; ?>'];
        <?php
        }
        else {?>
        	selected_text = top.tinyMCE.activeEditor.selection.getContent();
        <?php }?>
       
          var module_start_index = selected_text.indexOf("[" + module_name);
          var module_end_index = selected_text.indexOf("]", module_start_index);
          var module_str = "";
          if ((module_start_index >= 0) && (module_end_index >= 0)) {
            module_str = selected_text.substring(module_start_index + 1, module_end_index);
          }
          else {
            return false;
          }
          var params_str = module_str.substring(module_str.indexOf(" ") + 1);
          var key_values = params_str.split(" ");
          var short_code_attr = new Array();
          for (var key in key_values) {
            var short_code_index = key_values[key].split('=')[0];
            var short_code_value = key_values[key].split('=')[1];
            short_code_value = short_code_value.substring(1, short_code_value.length - 1);
            short_code_attr[short_code_index] = short_code_value;
          }
          return short_code_attr;
        }
        
        function spider_calendar_select_view(selected_value) {
          for (i = 0; i <= 3; i++) {
            if (document.getElementById('view_' + i).value == selected_value) {
              document.getElementById('view_' + i).checked = true;
            }
          }
        }
        function insert_spider_calendar() {
          var calendar_id = document.getElementById('spider_Calendar').value;
          var theme_id = document.getElementById('spider_Calendar_theme').value;
          var default_view = document.getElementById('default_view').value;
          var select_view = '';
          for (i = 0; i <= 3; i++) {
            if (document.getElementById('view_' + i).checked) {
              select_view = select_view + document.getElementById('view_' + i).value + ',';
            }
          }

          if ((calendar_id != '- Select a Calendar -') && (theme_id != '- Select a Theme -')) {
            var tagtext;
            tagtext = '[Spider_Calendar id="' + calendar_id + '" theme="' + theme_id + '" default="' + default_view + '" select="' + select_view + '"]';
            <?php if( !$gutenberg_callback ) { ?>
            	window.tinyMCE.execCommand('mceInsertContent', false, tagtext);
            	tinyMCEPopup.close();
        	<?php } else { ?>
        		window.parent.window.jQuery(".edit-post-layout__content").css({"z-index":"0","overflow":"auto"});
        		window.parent['<?php echo $gutenberg_callback; ?>'](tagtext, short_code['id']);
        		window.close();
        	<?php } ?>
        	<?php if( !$gutenberg_callback ) { ?>
          	tinyMCEPopup.close();
          <?php } else {  ?>
          	window.close();
          	<?php } ?>
          } else {
          	alert('Please Select Calendar and Theme');
      	  }
        }
      </script>
    </body>
  </html>
  <?php
  die();
}

function seemore() {
	global $wpdb;
	require_once("front_end/frontend_functions.php");
	$calendar = (isset($_GET['calendar_id']) ? (int) $_GET['calendar_id'] : 0);
	$ev_ids = (isset($_GET['ev_ids']) ? esc_html($_GET['ev_ids']) : '');
	$eventID = (isset($_GET['eventID']) ? (int) $_GET['eventID'] : '');
	$widget = ((isset($_GET['widget']) && (int) $_GET['widget']) ? (int) $_GET['widget'] : 0);
	$theme_id = (isset($_GET['theme_id']) ? (int) $_GET['theme_id'] : 1);
	$date = ( (isset($_GET['date']) && IsDate_inputed(esc_html($_GET['date']))) ? date("Y-m-d") : date("Y") . '-' . php_Month_num_seemore(date("F")) . '-' . date("d") );

	if ($widget) {
		$theme = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'spidercalendar_widget_theme WHERE id=%d', $theme_id));
		$show_event = 0;
	}
	else {
		$theme = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'spidercalendar_theme WHERE id=%d', $theme_id));
		$show_event = $theme->day_start;
	}
	$title_color = '#' . str_replace('#','',$theme->title_color);
	$title_size = $theme->title_font_size;
	$show_event_bgcolor = '#' . str_replace('#','',$theme->show_event_bgcolor);
	$popup_width = $theme->popup_width;
	$popup_height = $theme->popup_height;
	$show_repeat = $theme->show_repeat;
	$date_color = '#' . str_replace('#','',$theme->date_color);
	$date_size = $theme->date_size;
	$date_font = $theme->date_font;
	$date_format = $theme->date_format;
	$all_files = php_showevent_seemore($calendar, $date);
	$rows = $all_files[0]['rows'];

	$date_format_array = explode('/', $date_format);
	$date = ((isset($_GET['date']) && IsDate_inputed(esc_html($_GET['date']))) ? esc_html($_GET['date']) : date("Y-m-d"));
	$day = substr($date, 8);
	$ev_id = explode(',', $ev_ids);
	$activedate = explode('-', $date);
	$activedatetimestamp = mktime(0, 0, 0, $activedate[1], $activedate[2], $activedate[0]);
	$activedatestr = '';

	for ($i = 0; $i < count($date_format_array); $i++) {
		if ($date_format_array[$i] == 'w') {
			$date_format_array[$i] = 'l';
		}
		if ($date_format_array[$i] == 'm') {
			$date_format_array[$i] = 'F';
		}
		if ($date_format_array[$i] == 'y') {
			$date_format_array[$i] = 'Y';
		}
	}

	for ($i = 0; $i < count($date_format_array); $i++) {
		$activedatestr .= __(date("" . $date_format_array[$i] . "", $activedatetimestamp), 'sp_calendar') . ' ';
	}
	?>
	<html>
		<head>
			<script>
			function next(day_events, ev_id, theme_id, calendar_id, date, day) {
				var p = 0;
				for (var key in day_events) {
					p = p + 1;
					if (day_events[key] == ev_id && day_events[parseInt(key) + 1]) {
						window.location = '<?php echo admin_url('admin-ajax.php?action=spidercalendarbig'); ?>&theme_id=' + theme_id + '&calendar_id=' + calendar_id + '&eventID=' + day_events[parseInt(key) + 1] + '&date=' + date + '&day=' + day + '&widget=<?php echo $widget; ?>';
					}
				}
			}
			function prev(array1, ev_id, theme_id, calendar_id, date, day) {
				var day_events = array1;
				for (var key in day_events) {
					if (day_events[key] == ev_id && day_events[parseInt(key) - 1]) {
						window.location = '<?php echo admin_url('admin-ajax.php?action=spidercalendarbig'); ?>&theme_id=' + theme_id + '&calendar_id=' + calendar_id + '&eventID=' + day_events[parseInt(key) - 1] + '&date=' + date + '&day=' + day + '&widget=<?php echo $widget; ?>';
					}
				}
			}
			document.onkeydown = function (evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					window.parent.document.getElementById('sbox-window').close();
				}
			};
			</script>
			<style>
			body{
				margin:0px;
				padding:0px;
				font-family: segoe ui;
			}
			.date_rate{
				background-image: url(<?php echo plugins_url( 'images/calendar1.png' , __FILE__ ); ?>);    
				background-repeat: no-repeat; 
				<?php if ($show_event || $widget==1){ ?>
				padding: 15px 0px 3px 70px;
				background-position: 35px 15px; 
				<?php } else{ ?>
				padding: 15px 0 3px 33px;
				background-position: 5px 15px; 
				<?php } ?>
				background-size: 19px;
				vertical-align:middle;
				font-size: 14px;
				font-family: <?php echo $date_font; ?>;
				float: left;
			}
			.events a{
				float: left;
				width: 90%;
			}
			.events {
				border: 1px solid #cccccc;
				overflow: hidden;
				margin: 5px 0px 7px 0px;
				position: relative;
				padding: 10px 0; 
			}
			
			.pop_body .header_date{
				font-size: <?php echo $date_size; ?>px; 
				font-family: <?php echo $date_font; ?>; 
				font-weight:bold;
				text-align:center;
				color: <?php echo $date_color; ?>; 
				margin-bottom: 15px;
			}
			
			.pop_body .general_div{
				background-color:<?php echo $show_event_bgcolor; ?>; 
				padding:15px; 
				font-size: 15px;
			}
			</style>
		</head>
		<body class="pop_body">
			<div class="general_div">
				<div class="header_date"><?php echo $activedatestr; ?></div>
			<?php
			for ($i = 0; $i < count($ev_id); $i++) {
				$row = $wpdb->get_row($wpdb->prepare ("SELECT " . $wpdb->prefix . "spidercalendar_event.* , " . $wpdb->prefix . "spidercalendar_event_category.color	FROM " . $wpdb->prefix . "spidercalendar_event LEFT JOIN " . $wpdb->prefix . "spidercalendar_event_category ON " . $wpdb->prefix . "spidercalendar_event.category = " . $wpdb->prefix . "spidercalendar_event_category.id WHERE " . $wpdb->prefix . "spidercalendar_event.published=1  AND " . $wpdb->prefix . "spidercalendar_event.id=%d",$ev_id[$i]));
				$repeat = ( $row->repeat!='1' ? $row->repeat : "" );
				$weekdays = explode(',',$row->week);
				$row_time = ( ( isset($row->time) && $row->time!="" ) ? ', ' .$row->time : "");
				$row_color = ( (isset($row->color)) ? 'border-left: 2px solid #'.str_replace('#','',$row->color) : "" );
				if ($row->id == $ev_id[$i]) {
					echo '<div class="events" style="'.$row_color.';">';
					if ($show_event || $widget==1) {
						echo '<div style="display: table-cell; font-size: 17px; position: absolute; padding: 3px 5px;"><b>'.($i + 1).'&nbsp;</b></div>';
							echo '<a style=" padding-left: 30px;text-decoration: none;font-size: '.$theme->title_font_size.'px;color:' . $title_color . '; "
							href="' . add_query_arg(array(
							'action' => 'spidercalendarbig',
							'theme_id' => $theme_id,
							'calendar_id' => $calendar,
							'ev_ids' => $ev_ids,
							'eventID' => $ev_id[$i],
							'date' => $date,
							'day' => $day,
							'widget' => $widget,
							'TB_iframe' => 1,
							'tbWidth' => $popup_width,
							'tbHeight' => $popup_height,
							), admin_url('admin-ajax.php')) . '"><b>&nbsp;'.$row->title . '</b></a>';
					}
					else
					{
						echo '<a style="display: table-cell;text-decoration: none;font-size: '.$theme->title_font_size.'px;color:' . $title_color . '; line-height:30px"
						href="' . add_query_arg(array(
						'action' => 'spidercalendarbig',
						'theme_id' => $theme_id,
						'calendar_id' => $calendar,
						'ev_ids' => $ev_ids,
						'eventID' => $ev_id[$i],
						'date' => $date,
						'day' => $day,
						'widget' => $widget,
						'TB_iframe' => 1,
						'tbWidth' => $popup_width,
						'tbHeight' => $popup_height,
						), admin_url('admin-ajax.php')) . '">&nbsp;'.$row->title . '</a>';

					}

					$healthy = array("/", "m", "y", "w");
					$yummy   = array(" ","F", "Y", "l");

					$format_date = str_replace($healthy, $yummy, $date_format);	
					$start_day = date($format_date, strtotime($row->date));
					$date_end = ( ($row->date_end != "2035-12-12") ?  ' - '.date($format_date, strtotime($row->date_end)) : "");
					if($show_repeat){		
						if ($row->repeat_method == 'daily') {
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' ' .$repeat.' '.__('Day', 'sp_calendar').')'.$row_time .'</div>';
						}

						if($row->repeat_method=='weekly'){
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' ' .$repeat.' '.__('Week(s) on', 'sp_calendar').' ';
							for ($j=0;$j<count($weekdays);$j++){
								if($weekdays[$j]!=''){
									if( $j!=count($weekdays)-2 )
										echo week_convert($weekdays[$j]).', ';
									else echo week_convert($weekdays[$j]);
								}
							}
							echo ')'.$row_time .'</div>';
						}

						if($row->repeat_method=='monthly' and $row->month_type==1){
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' ' .$repeat.' '.__('Month(s) on the', 'sp_calendar').' '.$row->month.')'.$row_time .'</div>';	
						}


						if($row->repeat_method=='monthly' and $row->month_type==2){
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' '.$repeat.' '.__('Month(s) on the', 'sp_calendar').' '.week_number($row->monthly_list).' '.week_convert($row->month_week).')'.$row_time . '</div>';
						}

						if($row->repeat_method=='yearly' and $row->month_type==1){
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' ' .$repeat.' '.__('Year(s) in', 'sp_calendar').' '.date('F',mktime(0,0,0,$row->year_month + 1,0,0)).' '.__('on the', 'sp_calendar').' '.$row->month.')'.$row_time .'</div>';
						}						



						if($row->repeat_method=='yearly' and $row->month_type==2){
							echo '<div class="date_rate">Date: '.$start_day.''.$date_end.' ('. __('Repeat Every', 'sp_calendar').' ' .$repeat.' '.__('Year(s) in', 'sp_calendar').' '.date('F',mktime(0,0,0,$row->year_month + 1,0,0)).' '.__('on the', 'sp_calendar').' '.week_number($row->monthly_list).' '.week_convert($row->month_week).')' .$row_time .'</div>';	
						}						

						if($row->repeat_method=='no_repeat'){
							echo '<div class="date_rate">Date: '.$start_day.'' .$row_time .'</div>';	  
						}
					}
					echo '</div>'; 
				}
			}

			?>
			</div>
		</body>
	</html>
	<?php
	die();
}

function spiderbigcalendar() {
	global $wpdb;
	require_once("front_end/frontend_functions.php");
	$calendar_id = (isset($_GET['calendar_id']) ? (int) $_GET['calendar_id'] : 0);
	$date = ((isset($_GET['date']) && IsDate_inputed(esc_html($_GET['date']))) ? esc_html($_GET['date']) : date("Y") . '-' . php_Month_num(date("F")) . '-' . date("d"));
	$ev_ids_inline = (isset($_GET['ev_ids']) ? esc_html($_GET['ev_ids']) : '');
	$eventID = (isset($_GET['eventID']) ? (int) $_GET['eventID'] : '');
	$widget = ((isset($_GET['widget']) && (int) $_GET['widget']) ? (int) $_GET['widget'] : 0);
	$theme_id = (isset($_GET['theme_id']) ? (int) $_GET['theme_id'] : 1);
	
	if ($widget) {
		$theme = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'spidercalendar_widget_theme WHERE id=%d', $theme_id));
	}
	else {
		$theme = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'spidercalendar_theme WHERE id=%d', $theme_id));
	}

	$title_color = '#' . str_replace('#','',$theme->title_color);
	$title_size = ((isset($theme->title_font_size) && $theme->title_font_size!="") ? $theme->title_font_size : '21');
	$title_font = ((isset($theme->title_font) && $theme->title_font!="") ? $theme->title_font : '');
	$title_style = ((isset($theme->title_style) && $theme->title_style!="") ? $theme->title_style : 'bold');
	$date_color = '#' . str_replace('#','',$theme->date_color);
	$date_size = $theme->date_size;
	$date_font = $theme->date_font;
	$date_style = $theme->date_style;
	$next_prev_event_bgcolor = '#' . str_replace('#','',$theme->next_prev_event_bgcolor);
	$next_prev_event_arrowcolor = '#' . str_replace('#','',$theme->next_prev_event_arrowcolor);
	$show_event_bgcolor = '#' . str_replace('#','',$theme->show_event_bgcolor);
	$popup_width = $theme->popup_width;
	$popup_height = $theme->popup_height;
	$date_format = $theme->date_format;
	$show_repeat = $theme->show_repeat;
	$date_format_array = explode('/', $date_format);
	$date_format_pop = explode('/', $date_format);
	$date_font_weight = ( ($date_style == "bold" or $date_style == "bold/italic") ? "font-weight: bold" : "font-weight: normal" );
	$date_font_style = ( ($date_style == "bold" or $date_style == "bold/italic") ? "font-style: italic" : "font-style: inherit" );
	if ($title_style == "bold" or $title_style == "bold/italic") {
		$font_weight = "font-weight:bold";
		$font_style = "font-style:italic";
	}
	else {
		$font_weight = "font-weight:normal";
		$font_style = "";
	}

	$date_format_content = implode("/",$date_format_pop);
	
	for ($i = 0; $i < count($date_format_array); $i++) {
		if ($date_format_array[$i] == 'w') {
			$date_format_array[$i] = 'l';
			unset($date_format_pop[$i]);
		}
		if ($date_format_array[$i] == 'm') {
			$date_format_array[$i] = 'F';
		}
		if ($date_format_array[$i] == 'y') {
			$date_format_array[$i] = 'Y';
			$date_format_pop[$i] = 'Y';
		}
	}

	$all_files_cal = php_showevent($calendar_id, $date, $eventID);
	$row = $all_files_cal[0]['row'];
	$date = ((isset($_GET['date']) && IsDate_inputed(esc_html($_GET['date']))) ? esc_html($_GET['date']) : date("Y-m-d"));
	$day = substr($date, 8);
	$ev_id = explode(',', $ev_ids_inline); 
	$activedate = explode('-', $date);
	$activedatetimestamp = mktime(0, 0, 0, $activedate[1], $activedate[2], $activedate[0]);
	$activedatestr = '';
	$color = $wpdb->get_results("SELECT " . $wpdb->prefix . "spidercalendar_event.* , " . $wpdb->prefix . "spidercalendar_event_category.color FROM " . $wpdb->prefix . "spidercalendar_event JOIN " . $wpdb->prefix . "spidercalendar_event_category ON " . $wpdb->prefix . "spidercalendar_event.category = " . $wpdb->prefix . "spidercalendar_event_category.id WHERE " . $wpdb->prefix . "spidercalendar_event_category.published=1 AND " . $wpdb->prefix . "spidercalendar_event.id='".$row->id."'");

	$row_title = ( isset($row->title) ? $row->title : "" );
	$row_color = ( isset($color[0]->color) ? $color[0]->color : "" );
	$pop_content = wpautop($row->text_for_date);
	$pop_content = do_shortcode($pop_content);
	
	$weekdays = explode(',', $row->week);
	$date_format1 = substr($theme->date_format, 2);
	$repeat = ( $row->repeat != '1' ? $row->repeat : "");
	if ($row->date_end == '2035-12-12') {
		$row->date_end = '';
	}
	
	
	for ($i = 0; $i < count($date_format_array); $i++) {
		$activedatestr .= __(date("" . $date_format_array[$i] . "", $activedatetimestamp), 'sp_calendar') . ' ';
	}

	?>
	<html>
		<head>   
			<script>
			function next(day_events, ev_id, theme_id, calendar_id, date, day, ev_ids) {
				var p = 0;
				for (var key in day_events) {
					p = p + 1;
					if (day_events[key] == ev_id && day_events[parseInt(key) + 1]) {
						window.location = '<?php echo admin_url('admin-ajax.php?action=spidercalendarbig')?>&theme_id=' + theme_id + '&calendar_id=' + calendar_id + '&ev_ids=' + ev_ids + '&eventID=' + day_events[parseInt(key) + 1] + '&date=' + date + '&day=' + day + '&widget=<?php echo $widget; ?>';
					}
				}
			}
			function prev(array1, ev_id, theme_id, calendar_id, date, day, ev_ids) {
				var day_events = array1;
				for (var key in day_events) {
					if (day_events[key] == ev_id && day_events[parseInt(key) - 1]) {
						window.location = '<?php echo admin_url('admin-ajax.php?action=spidercalendarbig')?>&theme_id=' + theme_id + '&calendar_id=' + calendar_id + '&ev_ids=' + ev_ids + '&eventID=' + day_events[parseInt(key) - 1] + '&date=' + date + '&day=' + day + '&widget=<?php echo $widget; ?>';
					}
				}
			}
			document.onkeydown = function (evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					window.parent.document.getElementById('sbox-window').close();
				}
			};
			</script>
			<style>
			body{
				margin:0px;
				padding: 0px;
				font-family: segoe ui;
			}

			#previous,
			#next {
				cursor: pointer;
				height: 35px;
				width: 5%;
			}
			
			#next{
				float: right;
			}
			
			#previous{
				float: left;
			}
			
			#pn_arrows{
			    margin: 10px 0px 20px 0px;
				display: inline-block;
				width: 100%;
				height: 65px;
			}
			
			.arrow {
				color: <?php echo $next_prev_event_arrowcolor; ?>;				
				font-size: 29px;
				text-decoration: none;
				font-family: monospace;
			}
			
			.pop_body table{
				display: inline-block; 
				width:100%;
				font-size: 15px; 
				background-color: <?php echo $show_event_bgcolor; ?>; 
				border-spacing: 0; 
				padding: 15px; 
				max-width: calc( 100% - 30px);
			}
			
			.pop_body table tbody,
			.pop_body table tr,
			.pop_body table td{
				padding: 0; 
				display: inline-block; 
				width: 100%;
			}
			
			#dayevent{
				padding: 0 0px 7px 0; 
				line-height:30px;
			}
			
			#dayevent .header_date{
				padding: 7px 0; 
				text-align: center; 
				color: <?php echo $date_color; ?>;
				font-size: <?php echo $date_size; ?>px; 
				font-family: <?php echo $date_font; ?>; 
				<?php echo $date_font_weight; ?>; 
				<?php echo $date_font_style; ?>
			}
			</style>
		</head>
		<body class="pop_body">
			<table align="center" id="pop_table">
				<tbody>
					<tr>
						<td>
							<div id="dayevent">
								<div class="header_date"><b><?php echo $activedatestr; ?></b></div>
							<?php
							if ($row->date_end and $row->date_end != '0000-00-00') {
								echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Date', 'sp_calendar') . ':' . str_replace("d", substr($row->date, 8, 2), str_replace("m", substr($row->date, 5, 2), str_replace("y", substr($row->date, 0, 4), $date_format1))) . '&nbsp;-&nbsp;' . str_replace("d", substr($row->date_end, 8, 2), str_replace("m", substr($row->date_end, 5, 2), str_replace("y", substr($row->date_end, 0, 4), $date_format1))) . '&nbsp;' . $row->time . '</div>';
							}
							else {
								echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $font_weight . '; ' . $font_style . '  ">' . $row->time . '</div>';
							}
							if ($show_repeat == 1) {
								if ($row->repeat_method == 'daily') {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Day', 'sp_calendar') . '</div>';
								}
								if ($row->repeat_method == 'weekly') {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Week(s) on', 'sp_calendar') . ' : ';
									for ($i = 0; $i < count($weekdays); $i++) {
										if ($weekdays[$i] != '') {
											if ($i != count($weekdays) - 2) {
												echo week_convert($weekdays[$i]) . ', ';
											}
											else {
												echo week_convert($weekdays[$i]);
											}
										}
									}
									echo '</div>';
								}
								if ($row->repeat_method == 'monthly' and $row->month_type == 1) {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Month(s) on the', 'sp_calendar') . ' ' . $row->month . '</div>';
								}
								if ($row->repeat_method == 'monthly' and $row->month_type == 2) {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Month(s) on the', 'sp_calendar') . ' ' . week_number($row->monthly_list) . ' ' . week_convert($row->month_week) . '</div>';
								}
								if ($row->repeat_method == 'yearly' and $row->month_type == 1) {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Year(s) in', 'sp_calendar') . ' ' . date('F', mktime(0, 0, 0, $row->year_month + 1, 0, 0)) . ' ' . __('on the', 'sp_calendar') . ' ' . $row->month . '</div>';
								}
								if ($row->repeat_method == 'yearly' and $row->month_type == 2) {
									echo '<div style="color:' . $date_color . ';font-size:' . $date_size . 'px; font-family:' . $date_font . '; ' . $date_font_weight . '; ' . $date_font_style . '  ">' . __('Repeat Every', 'sp_calendar') . ' ' . $repeat . ' ' . __('Year(s) in', 'sp_calendar') . ' ' . date('F', mktime(0, 0, 0, $row->year_month + 1, 0, 0)) . ' ' . __('on the', 'sp_calendar') . ' ' . week_number($row->monthly_list) . ' ' . week_convert($row->month_week) . '</div>';
								}
							}
							echo "<hr style='max-width: 300px; margin-left: 0; background: #97a0a6; height: 1px; border: 0;'>";

							echo '<div style="color:' . $title_color . ';font-size:' . $title_size . 'px; font-family:' . $title_font . '; ' . $font_weight . '; ' . $font_style . '  ">' . $row_title . '</div>';
							if ($row->text_for_date != '') {
								echo '<div style="line-height:20px">' . $pop_content . '</div>';
							}
							else {
								echo '<p style="text-align:center">' . __('There Is No Text For This Event', 'sp_calendar') . '</p>';
							}
							?>
							</div>
							<div style="width:98%;text-align:right;<?php if(count($ev_id) == 1) echo 'display:none;' ?>">
								<a class="back_cal" style="color:<?php echo $title_color; ?>;font-size:15px; font-family:<?php echo $title_font; ?>; <?php echo $font_weight; ?>; <?php echo $font_style; ?>;"
								href="<?php echo add_query_arg(array(
								'action' => 'spiderseemore',
								'theme_id' => $theme_id,
								'calendar_id' => $calendar_id,
								'ev_ids' => $ev_ids_inline,
								'date' => $date,
								'widget' => $widget,
								'TB_iframe' => 1,
								'tbWidth' => $popup_width,
								'tbHeight' => $popup_height,
								), admin_url('admin-ajax.php')); ?>"><b><?php echo __('Back to event list', 'sp_calendar'); ?>
								</b></a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="pn_arrows" style="<?php if ( count($ev_id) == 1 ) echo 'display: none'; ?>;">
				<div id="previous"
					onClick="prev([<?php echo $ev_ids_inline; ?>],<?php echo $eventID; ?>,<?php echo $theme_id ?>,<?php echo $calendar_id ?>,'<?php echo $date; ?>',<?php echo $day ?>,'<?php echo $ev_ids_inline ?>')"
					style="<?php if (count($ev_id) == 1 or $eventID == $ev_id[0]) echo 'display: none'; ?>; text-align: center;"
					onMouseOver="document.getElementById('previous').style.backgroundColor='<?php echo $next_prev_event_bgcolor ?>'"
					onMouseOut="document.getElementById('previous').style.backgroundColor=''">
						<span class="arrow">&lt;</span>
				</div>
				<div id="next"
					onclick="next([<?php echo $ev_ids_inline ?>],<?php echo $eventID ?>,<?php echo $theme_id ?>,<?php echo $calendar_id ?>,'<?php echo $date ?>',<?php echo $day ?>,'<?php echo $ev_ids_inline ?>')"
					style="<?php if (count($ev_id) == 1 or $eventID == end($ev_id))
					echo 'display:none' ?>;text-align:center"
					onMouseOver="document.getElementById('next').style.backgroundColor='<?php echo $next_prev_event_bgcolor ?>'"
					onMouseOut="document.getElementById('next').style.backgroundColor=''">
						<span class="arrow">&gt;</span>
				</div>
			</div>
		</body>
	</html>
	<?php die(); 
} 
function sp_get($key, $default_value = '', $esc_html = true) {
    if (isset($_GET[$key])) {
      $value = $_GET[$key];
    }
    elseif (isset($_POST[$key])) {
      $value = $_POST[$key];
    }
    elseif (isset($_REQUEST[$key])) {
      $value = $_REQUEST[$key];
    }
    else {
      $value =$default_value;
    }
    if (is_array($value)) {
      array_walk_recursive( validate_data( $value ), $esc_html);
    }
    return $value;
}

function validate_data(&$value, $esc_html) {
    $value = stripslashes($value);
    if ($esc_html) {
      $value = esc_html($value);
    }
}
?>