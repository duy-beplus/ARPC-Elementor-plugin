<?php

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Community_Content_Widgets extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'content-elementor-widget';
  }

  public function get_title()
  {
    return __('Content Edittor');
  }

  public function get_icon()
  {
    return 'eicon-edit';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function get_keywords()
  {
    return ['communnity', 'content'];
  }

  public function get_style_depends()
  {
    wp_register_style("community_content_editor_style", plugins_url('assets/css/content-widget-style.css', __FILE__));
    return [
      'community_content_editor_style'
    ];
  }

  public function get_script_depends()
  {
    wp_register_script('community_faq_script', plugins_url('assets/js/content-editor-script.js', __FILE__));
    return [
      'community_faq_script'
    ];
  }

  protected function register_controls()
  {
    // Start Content Tab
    //Heading section
    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Content', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    // Heading
    $this->add_control(
      'heading',
      [
        'label' => esc_html__('Heading', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 2,
        'default' => esc_html__('Your content heading', 'arpc-elementor-addon'),
        'label_block' => true,
      ]
    );
    // Content Editor
    $this->add_control(
      'content_editor',
      [
        'label' => esc_html__('Content Editor', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'placeholder' => esc_html__('Type your Content here', 'arpc-elementor-addon'),
        'default' => esc_html__('Type your content here...', 'arpc-elementor-addon'),
      ]
    );

    $this->end_controls_section();

    // Navigation Section
    $this->start_controls_section(
      'navigation_section',
      [
        'label' => esc_html__('Navigation', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'navigation_heading',
      [
        'label' => esc_html__('Navigation Heading', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 2,
        'default' => esc_html__('Navigation', 'arpc-elementor-addon'),
        'label_block' => true,
      ]
    );

    $navigation_repeater = new \Elementor\Repeater();

    $navigation_repeater->add_control(
      'navigation_list_item',
      [
        'label' => esc_html__('List Content', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 2,
        'label_block' => true,
      ]
    );

    $navigation_repeater->add_control(
      'navigation_list_link',
      [
        'label' => esc_html__('Add Link', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'arpc-elementor-addon'),
        'default' => [
          'url' => '',
          'is_external' => false,
          'nofollow' => false,
        ],
        'label_block' => true,
      ]
    );

    $this->add_control(
      'list',
      [
        'label' => esc_html__('Navigation Repeater List', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $navigation_repeater->get_controls(),
        'default' => [
          [
            'navigation_list_item' => esc_html__('Content #1', 'arpc-elementor-addon'),
          ],
          [
            'navigation_list_item' => esc_html__('Content #2', 'arpc-elementor-addon'),
          ],
          [
            'navigation_list_item' => esc_html__('Content #3', 'arpc-elementor-addon'),
          ],
        ],
        'title_field' => '{{{ navigation_list_item }}}',
      ]
    );

    $this->end_controls_section();
    // End Navigation Section

    // Useful Section
    $this->start_controls_section(
      'useful_section',
      [
        'label' => esc_html__('Useful Link and Resources', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'useful_heading',
      [
        'label' => esc_html__('Useful Heading', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 2,
        'default' => esc_html__('Useful link and resources', 'arpc-elementor-addon'),
        'label_block' => true,
      ]
    );

    $useful_repeater = new \Elementor\Repeater();

    $useful_repeater->add_control(
      'useful_list_item',
      [
        'label' => esc_html__('Useful List', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 1,
        'label_block' => true,
      ]
    );

    $useful_repeater->add_control(
      'useful_list_icon',
      [
        'label' => esc_html__('List Icon', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-star',
          'library' => 'solid',
        ],
      ]
    );

    $useful_repeater->add_control(
      'useful_list_link',
      [
        'label' => esc_html__('Add Useful Link', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'arpc-elementor-addon'),
        'default' => [
          'url' => '',
          'is_external' => false,
          'nofollow' => false,
        ],
        'label_block' => true,
      ]
    );

    $this->add_control(
      'useful_list',
      [
        'label' => esc_html__('Useful Repeater List', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $useful_repeater->get_controls(),
        'default' => [
          [
            'useful_list_item' => esc_html__('Content #1', 'arpc-elementor-addon'),
          ],
          [
            'useful_list_item' => esc_html__('Content #2', 'arpc-elementor-addon'),
          ],
          [
            'useful_list_item' => esc_html__('Content #3', 'arpc-elementor-addon'),
          ],
        ],
        'title_field' => '{{{ useful_list_item }}}',
      ]
    );

    $this->end_controls_section();
    // End Useful Section

    // Sharing Section
    $this->start_controls_section(
      'sharing_section',
      [
        'label' => esc_html__('Share Page', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'sharing_text',
      [
        'label' => esc_html__('Button Text', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 1,
        'default' => esc_html__('Share page', 'arpc-elementor-addon'),
        'label_block' => true,
      ]
    );

    $this->end_controls_section();
    // End Sharing Section
    // End Content Tab

    // Start Style Tab
    // Style Content
    $this->start_controls_section(
      'content_style_section',
      [
        'label' => esc_html__('Style Content', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
    // Style Heading
    $this->add_control(
      'content_heading_color',
      [
        'label' => esc_html__('Content Heading Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .content-heading' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Content Heading Typography', 'arpc-elementor-addon'),
        'name' => 'content_heading_typography',
        'selector' => '{{WRAPPER}} .content-heading',
      ]
    );

    // Style Content edit
    $this->add_control(
      'content_color',
      [
        'label' => esc_html__('Content Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .content-editor-block' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Content Typography', 'arpc-elementor-addon'),
        'name' => 'content_typography',
        'selector' => '{{WRAPPER}} .content-editor-block',
      ]
    );

    // margin useful items
    $this->add_control(
      'content_margin',
      [
        'label' => esc_html__('Margin', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .content-editor-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // padding useful items
    $this->add_control(
      'content_padding',
      [
        'label' => esc_html__('Padding', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .content-editor-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
    //End Style Content

    //Start Style Nav
    $this->start_controls_section(
      'nav_style_section',
      [
        'label' => esc_html__('Style Navigation', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Style Nav Heading
    $this->add_control(
      'nav_heading_color',
      [
        'label' => esc_html__('Nav Heading Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .nav-heading' => 'color: {{VALUE}};',
          '{{WRAPPER}} .nav-excerpt' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Nav Heading Typography', 'arpc-elementor-addon'),
        'name' => 'nav_heading_typography',
        'selector' => '{{WRAPPER}} .nav-heading',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Nav Subheading Typography', 'arpc-elementor-addon'),
        'name' => 'nav_subheading_typography',
        'selector' => '{{WRAPPER}} .nav-excerpt',
      ]
    );

    // Style Nav List
    $this->add_control(
      'nav_list_color',
      [
        'label' => esc_html__('Nav List Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .nav-list-link' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Nav List Typography', 'arpc-elementor-addon'),
        'name' => 'nav_list_typography',
        'selector' => '{{WRAPPER}} .nav-list-box',
      ]
    );

    // margin nav items
    $this->add_control(
      'nav_items_margin',
      [
        'label' => esc_html__('Margin', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .nav-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // padding nav items
    $this->add_control(
      'nav_items_padding',
      [
        'label' => esc_html__('Padding', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .nav-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // border nav items
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'nav_items_border',
        'label' => esc_html__('Item Border', 'arpc-elementor-addon'),
        'selector' => '{{WRAPPER}} .nav-items',
      ]
    );
    //box shadow nav items
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'nav_items_boxshadow',
        'label' => esc_html__('Box Shadow', 'arpc-elementor-addon'),
        'selector' => '{{WRAPPER}} .nav-items',
      ]
    );


    $this->end_controls_section();
    //End Style Nav

    // Start style Useful
    $this->start_controls_section(
      'useful_style_section',
      [
        'label' => esc_html__('Style Useful', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Style Useful Heading
    $this->add_control(
      'useful_heading_color',
      [
        'label' => esc_html__('Use Heading Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .useful-heading' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Useful Heading Typography', 'arpc-elementor-addon'),
        'name' => 'useful_heading_typography',
        'selector' => '{{WRAPPER}} .useful-heading',
      ]
    );

    // Style Useful Icon List
    $this->add_control(
      'useful_icon_list_color',
      [
        'label' => esc_html__('Useful Icon List Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .useful-icon-wrapper' => 'color: {{VALUE}};',
          '{{WRAPPER}} .useful-list-link' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Useful Icon List Typography', 'arpc-elementor-addon'),
        'name' => 'useful_icon_list_typography',
        'selector' => '{{WRAPPER}} .useful-icon-wrapper',
        'selector' => '{{WRAPPER}} .useful-list-link',
      ]
    );

    // margin useful items
    $this->add_control(
      'useful_items_margin',
      [
        'label' => esc_html__('Margin', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .useful-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // padding useful items
    $this->add_control(
      'useful_items_padding',
      [
        'label' => esc_html__('Padding', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .useful-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // border useful items
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'useful_items_border',
        'label' => esc_html__('Item Border', 'arpc-elementor-addon'),
        'selector' => '{{WRAPPER}} .useful-items',
      ]
    );
    //box shadow useful items
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'useful_items_boxshadow',
        'label' => esc_html__('Box Shadow', 'arpc-elementor-addon'),
        'selector' => '{{WRAPPER}} .useful-items',
      ]
    );


    $this->end_controls_section();
    //End Style Useful

    // Style Button Text
    $this->start_controls_section(
      'sharing_style_section',
      [
        'label' => esc_html__('Style Text Button', 'arpc-elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'sharing_text_color',
      [
        'label' => esc_html__('Text Color', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .btn-sharing' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__('Text Typography', 'arpc-elementor-addon'),
        'name' => 'sharing_text_typography',
        'selector' => '{{WRAPPER}} .btn-sharing',
      ]
    );
    $this->end_controls_section();
    //End Style Button text

    // End Style Tab

    // Add Tab for announcment content
    $this->start_controls_section(
      'announcment',
      [
        'label' => 'Announcment',
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT
      ]
    );
    $this->add_control(
      'announcment-show',
      [
        'label' => 'Show/Hide',
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => 'Show',
        'label_off' => 'Hide',
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );
    $this->add_control(
      'announcment-heading',
      [
        'label' => 'Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Announcment',
      ]
    );
    $this->add_control(
      'announcment-icon',
      [
        'label' => 'Icon',
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-star',
          'library' => 'solid',
        ],
      ]
    );
    $this->add_control(
      'announcment-content',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 2,
        'default' => "We're hiring. View our latest job postings here",
      ]
    );
    $this->add_control(
      'announcment-link',
      [
        'label' => 'Annoucment link',
        'type' => Controls_Manager::URL,
        'placeholder' => 'https://your-link.com',
        'default' => [
          'url' => '',
          'is_external' => true,
          'nofollow' => true,
          'custom_attributes' => '',
        ],
        'label_block' => 'false',
      ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
      'announcment-style',
      [
        'label' => 'Announcment',
        'tab' => \Elementor\Controls_Manager::TAB_STYLE
      ]
    );
    $this->add_control(
      'announcment-heading-style',
      [
        'label' => 'Heading',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .announcment-heading' => 'color: {{VALUE}}'],
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'announcment-heading_typography',
        'selector' => '{{WRAPPER}} .announcment-heading',
      ]
    );
    $this->add_control(
      'announcment-content-style',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .announcment-content' => 'color: {{VALUE}}'],
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'announcment-content_typography',
        'selector' => '{{WRAPPER}} .announcment-content',
      ]
    );
    $this->end_controls_section();
  }

  protected function render()
  {
    // get current page URL for share
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    // generate the final HTML on the frontend using PHP
    $settings = $this->get_settings_for_display();
    if (!empty($settings['announcment-link']['url'])) {
      $this->add_link_attributes('announcment-link', $settings['announcment-link']);
    }
?>
    <div class="community-content-editor">
      <div class="content-heading-block">
        <h2 class="content-heading"><?php echo $settings['heading']; ?></h2>
      </div>
      <div class="community-content-container">
        <!--  Navigation Left -->
        <div class="navigation-left">
          <p class="nav-excerpt">In this section</p>
          <div class="nav-line"></div>
          <div class="nav-left-container">
            <div class="navigation">
              <h3 class="nav-heading nav-items"><?php echo $settings['navigation_heading']; ?></h3>
              <?php if ($settings['list']) { ?>
                <ul class="nav-list-box">
                  <?php foreach ($settings['list'] as $item) { ?>
                    <li class="nav-list-item nav-items">
                      <a class="nav-list-link" href="<?php echo $item['navigation_list_link']['url']; ?>">
                        <?php echo $item['navigation_list_item']; ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              <?php } ?>
            </div>

            <div class="useful-container">
              <h3 class="useful-heading useful-items"><?php echo $settings['useful_heading']; ?></h3>
              <?php if ($settings['useful_list']) { ?>
                <ul class="useful-list-box">
                  <?php foreach ($settings['useful_list'] as $item) { ?>
                    <li class="useful-list-item useful-items">
                      <div class="useful-icon-wrapper">
                        <?php \Elementor\Icons_Manager::render_icon($item['useful_list_icon'], ['aria-hidden' => 'true']); ?>
                      </div>
                      <a class="useful-list-link" href="<?php echo $item['useful_list_link']['url']; ?>">
                        <?php echo $item['useful_list_item']; ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              <?php } ?>
            </div>
            <?php if ($settings['announcment-show'] == 'yes') : ?>
              <div class="announcment-container">
                <h3 class="announcment-heading">
                  <?php \Elementor\Icons_Manager::render_icon($settings['announcment-icon'], ['aria-hidden' => 'true']); ?>
                  <?php echo $settings['announcment-heading'] ?>
                </h3>
                <a <?php echo $this->get_render_attribute_string('announcment-link'); ?> class="announcment-content">
                  <?php echo $settings['announcment-content'] ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!--  Content Editor Center -->
        <div class="content-editor-block">
          <?php echo $settings['content_editor']; ?>
        </div>

        <!--  Sharing right -->
        <div class="sharing-right">
          <div class="btn-sharing" class="" type="button">
            <?php echo $settings['sharing_text'] ?>
            <div class="icon-plus"></div>
          </div>
          <div class="share-socials-box">
            <?php echo do_shortcode('[social-share-display display="1653549193" force="true" archive="true" custom="true" url="' . $current_url . '" message="" image="" tweet="Custom tweet"]') ?>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
