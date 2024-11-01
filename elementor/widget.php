<?php

class SPCElementorWidget extends \Elementor\Widget_Base {
  /**
   * Get widget name.
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'spc-elementor';
  }

  /**
   * Get widget title.
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __('Spider Calendar', 'sp_calendar');
  }

  /**
   * Get widget icon.
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'twbb-spider-calendar twbb-widget-icon';
  }

  /**
   * Get widget categories.
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'tenweb-plugins-widgets' ];
  }

  /**
   * Register widget controls.
   */
  protected function _register_controls() {
    $this->start_controls_section('spc_general', [
      'label' => __('Spider Calendar', 'sp_calendar'),
    ]);
    $this->add_control('spc_calendar_id', [
      'label' => __('Calendar', 'sp_calendar'),
      'label_block' => TRUE,
      'description' => __('Select the Calendar to display.', 'sp_calendar') . ' <a target="_blank" href="' . add_query_arg(array( 'page' => 'SpiderCalendar' ), admin_url('admin.php')) . '">' . __('Edit calendar', 'sp_calendar') . '</a>',
      'type' => \Elementor\Controls_Manager::SELECT,
      'options' => $this->get_calendars(),
      'default' => 0,
    ]);
    $this->add_control('spc_theme_id', [
      'label' => __('Theme', 'sp_calendar'),
      'label_block' => TRUE,
      'description' => __('Select the Theme to display.', 'sp_calendar') . ' <a target="_blank" href="' . add_query_arg(array( 'page' => 'spider_calendar_themes' ), admin_url('admin.php')) . '">' . __('Edit theme', 'sp_calendar') . '</a>',
      'type' => \Elementor\Controls_Manager::SELECT,
      'options' => $this->get_themes(),
      'default' => $this->get_theme_first_id(),
    ]);
    $this->add_control('spc_views', [
      'label' => __('Select Views', 'sp_calendar'),
      'label_block' => TRUE,
      'description' => __('Select the View to display.', 'sp_calendar'),
      'multiple' => TRUE,
      'type' => \Elementor\Controls_Manager::SELECT2,
      'options' => $this->get_views(),
      'default' => [ 'month' ],
    ]);
    $this->add_control('spc_active_view', [
      'label' => __('Active View', 'sp_calendar'),
      'label_block' => TRUE,
      'description' => __('Select the View to display.', 'sp_calendar'),
      'type' => \Elementor\Controls_Manager::SELECT,
      'options' => $this->get_views(),
      'default' => 'month',
    ]);
    $this->end_controls_section();
  }

  /**
   * Render widget output on the frontend.
   */
  protected function render() {
    $views = $this->get_views();
    $settings = $this->get_settings_for_display();
    $id = $settings['spc_calendar_id'];
    $theme_id = $settings['spc_theme_id'];
    $views_default = implode(array_keys($views), ',');
    $spc_views = implode($settings['spc_views'], ',');
    $select = (!empty($spc_views) ? $spc_views : $views_default) . ',';
    $default = ($settings['spc_active_view']) ? $settings['spc_active_view'] : 'month';
    if ( !$id ) {
      $this->calendar_not_selected();

      return FALSE;
    }
    $params = [
      'id' => $id,
      'theme' => $theme_id,
      'select' => $select,
      'default' => $default,
    ];
    echo '<div style="height:0.5px;"></div>'; //@TODO this output is required because ajax is running and at first output is empty
    echo spider_calendar_big($params);
  }

  /**
   * Get calendars.
   *
   * @return array
   */
  protected function get_calendars() {
    global $wpdb;
    $data = [ 0 => __('Select a Calendar', 'sp_calendar') ];
    $rows = $wpdb->get_results('SELECT `id`, `title` FROM `' . $wpdb->prefix . 'spidercalendar_calendar` WHERE published=1');
    if ( !empty($rows) ) {
      foreach ( $rows as $row ) {
        $data[$row->id] = $row->title;
      }
    }

    return $data;
  }

  /**
   * Get themes.
   *
   * @return array
   */
  protected function get_themes() {
    global $wpdb;
    $data = [ 0 => __('Select a Theme', 'sp_calendar') ];
    $rows = $wpdb->get_results('SELECT `id`, `title` FROM `' . $wpdb->prefix . 'spidercalendar_theme`');
    if ( !empty($rows) ) {
      foreach ( $rows as $row ) {
        $data[$row->id] = $row->title;
      }
    }

    return $data;
  }

  /**
   * Get views.
   *
   * @return array
   */
  protected function get_views() {
    $data = [
      'month' => __('Month', 'sp_calendar'),
      'list' => __('List', 'sp_calendar'),
      'week' => __('Week', 'sp_calendar'),
      'day' => __('Day', 'sp_calendar'),
    ];

    return $data;
  }

  private function calendar_not_selected() {
    $font_class = new \Elementor\Scheme_Typography();
    $font = $font_class->get_scheme_value();
    $color_class = new \Elementor\Scheme_Color();
    $color = $color_class->get_scheme();
    $style = '';
    if ( !empty($font[3]) ) {
      if ( !empty($font[3]["font_family"]) ) {
        $style .= 'font-family: ' . $font[3]["font_family"];
      }
      if ( !empty($font[3]["font_weight"]) ) {
        $style .= 'font-weight: ' . $font[3]["font_weight"];
      }
    }
    if ( !empty($color[3]) && !empty($color[3]["value"]) ) {
      $style .= 'color: ' . $color[3]["value"];
    }
    if ( !empty($style) ) {
      echo '<style>.elementor-widget-container .spc-message { ' . $style . '}</style>';
    }
    echo '<div class="spc-message">' . __('There is no calendar selected or the calendar was deleted.', 'sp_calendar') . '</div>';
  }

  /**
   * Get theme first id.
   *
   * @return int
   */
  private function get_theme_first_id() {
    $keys = array_keys($this->get_themes());
    $id = ($keys[1]) ? $keys[1] : 0;

    return $id;
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new SPCElementorWidget());