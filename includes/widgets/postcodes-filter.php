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
    wp_register_script('postcodes_filter_script', plugins_url('assets/js/postcodes-filter-script.js', __FILE__) );
    wp_localize_script( 'postcodes_filter_script', 'ajaxObject', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' )) );
    return [
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
          <span>All Postcodes</span>
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
    </div>
    <?php
  }
}
?>
