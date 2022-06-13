<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Postcodes_Filter_Widgets extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'postcodes-elementor-widget';
  }

  public function get_title()
  {
    return __('Postcodes Filter');
  }

  public function get_icon()
  {
    return 'eicon-library-open';
  }

  public function get_categories()
  {
    return ['custom-category'];
  }

  public function get_keywords()
  {
    return ['postcodes', 'filter'];
  }

  public function get_style_depends()
  {
    wp_register_style("postcodes_filter_style", plugins_url('assets/css/postcodes-filter-style.css', __FILE__), true);
    return [
      'postcodes_filter_style'
    ];
  }

  public function get_script_depends()
  {
    wp_register_script('simple_bootstrap_paginator', "assets/js/simple-bootstrap-paginator.js", false );
    wp_register_script('postcodes_filter_script', plugins_url('assets/js/postcodes-filter-script.js', __FILE__) );
    wp_localize_script( 'postcodes_filter_script', 'ajaxObject', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' )) );
    return [
      'simple_bootstrap_paginator',
      'postcodes_filter_script'
    ];
  }

  protected function register_controls()
  {
    // Start Content Tab
    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Content', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->end_controls_section();
    // End Content Tab

    // Start Style Tab
    $this->start_controls_section(
      'style_section',
      [
        'label' => esc_html__( 'Style', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'text_color',
      [
        'label' => esc_html__( 'Text Color', 'arpc-elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .postcodes-filter-inner' => 'color: {{VALUE}};',
          '{{WRAPPER}} #postcodes-number' => 'color: {{VALUE}};',
          '{{WRAPPER}} #postcodes-states' => 'color: {{VALUE}};',
          '{{WRAPPER}} #postcodes-tiers' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Typography', 'arpc-elementor-addon' ),
        'name' => 'typography',
        'selector' => '{{WRAPPER}} .postcodes-filter-inner',
      ]
    );

    $this->end_controls_section();

    // Start Style Input number
    $this->start_controls_section(
      'input_postcodes_number',
      [
        'label' => esc_html__( 'Input Number', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Typography', 'arpc-elementor-addon' ),
        'name' => 'input_number_typography',
        'selector' => '{{WRAPPER}} #postcodes-number',
      ]
    );

    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_number_border',
				'label' => esc_html__( 'Border', 'arpc-elementor-addon' ),
				'selector' => '{{WRAPPER}} #postcodes-number',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'input_number_background',
				'label' => esc_html__( 'Background', 'arpc-elementor-addon' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} #postcodes-number',
			]
		);

    $this->end_controls_section();

    // Start Style Select State
    $this->start_controls_section(
      'select_state',
      [
        'label' => esc_html__( 'Select State', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Typography', 'arpc-elementor-addon' ),
        'name' => 'select_state_typography',
        'selector' => '{{WRAPPER}} #postcodes-states',
      ]
    );

    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'select_state_border',
				'label' => esc_html__( 'Border', 'arpc-elementor-addon' ),
				'selector' => '{{WRAPPER}} #postcodes-states',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'select_state_background',
				'label' => esc_html__( 'Background', 'arpc-elementor-addon' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} #postcodes-states',
			]
		);

    $this->end_controls_section();

    // Start Style Select Tier
    $this->start_controls_section(
      'select_tier',
      [
        'label' => esc_html__( 'Select Tier', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Typography', 'arpc-elementor-addon' ),
        'name' => 'select_tier_typography',
        'selector' => '{{WRAPPER}} #postcodes-tiers',
      ]
    );

    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'select_tier_border',
				'label' => esc_html__( 'Border', 'arpc-elementor-addon' ),
				'selector' => '{{WRAPPER}} #postcodes-tiers',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'select_tier_background',
				'label' => esc_html__( 'Background', 'arpc-elementor-addon' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} #postcodes-tiers',
			]
		);

    $this->end_controls_section();
    // End Style Tab
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="postcodes-filter-inner">
      <form class="postcodes-filter-form">
        <!-- Input Number -->
        <div class="postcodes-number-wrapper _flex_wrap">
          <label class="label" for="postcodes-number">Postcode</label>
          <input type="number" id="postcodes-number" name="postcodes-number" min="0" max="9999">
        </div>
        <!-- /Input Number -->
        <!-- Select State -->
        <div class="postcodes-state-wrapper _flex_wrap">
          <label class="label" for="postcodes-states">State</label>
          <select name="postcodes-states" id="postcodes-states">
            <option value="">All States</option>
            <option value="ACT">Australian Capital Territory</option>
            <option value="NSW">News South Wales</option>
            <option value="NT">Northern Territory</option>
            <option value="QLD">Queensland</option>
            <option value="SA">South Australia</option>
            <option value="TAS">Tasmania</option>
            <option value="VIC">Victoria</option>
            <option value="WA">Westhern Australia</option>
          </select>
        </div>
        <!-- /Select State -->
        <!-- Select Tier -->
        <div class="postcodes-tier-wrapper _flex_wrap">
          <label class="label" for="postcodes-tier">Tier</label>
          <select name="postcodes-tiers" id="postcodes-tiers">
            <option value="">All Tiers</option>
            <option value="A">Tier A</option>
            <option value="B">Tier B</option>
            <option value="C">Tier C</option>
          </select>
        </div>
        <!-- /Select Tier -->
        <!-- Result desciption -->
        <div class="result-description-wrapper _flex_wrap">
          <span></span>
          <div class="btn-download-excel"><i class="gg-software-download"></i> DOWNLOAD as Excel</div>
        </div>
        <!-- /Result desciption -->
      </form>
        <!-- Result Table -->
        <div class="postcodes-result-table">
          <table id="postcodes-table">
            <thead>
              <tr>
                <th>Postcode</th>
                <th>State</th>
                <th>Tier</th>
              </tr>
            </thead>
            <tbody id="body-table">
            <?php
            $jsonString = get_field('postcodes_data', 'option');
            $arrPostcodes = json_decode($jsonString, true);

            foreach ($arrPostcodes as $keys => $values) {
             ?>
              <tr>
                <td><?php echo $values['Postcode']; ?></td>
                <td><?php echo $values['State']; ?></td>
                <td><?php echo $values['Tier']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- Result Table -->
        <div id="pagination"></div>
        <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
    </div>
    <?php
  }
}
?>
