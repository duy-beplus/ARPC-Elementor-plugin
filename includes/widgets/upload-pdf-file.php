<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Upload_PDF_file_Widgets extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'upload-pdf-file-widget';
  }

  public function get_title()
  {
    return __('Upload PDF file');
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
    return ['upload', 'pdf'];
  }

  public function get_style_depends()
  {
    wp_register_style("upload_pdf_style", plugins_url('assets/css/upload-pdf-style.css', __FILE__), true);
    return [
      'upload_pdf_style'
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

    // Heading
    $this->add_control(
      'heading',
      [
        'label' => esc_html__('Heading', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 1,
        'default' => esc_html__('Useful Links', 'arpc-elementor-addon'),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'change_download_icon',
      [
        'label' => 'Change icon',
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => 'Yes',
        'label_off' => 'No',
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $this->add_control(
      'download_icon',
      [
        'label' => esc_html__('Icon', 'arpc-elementor-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-download',
          'library' => 'solid',
        ],
        'condition' => [
					'change_download_icon' => ['yes'],
				],
      ]
    );

    $this->end_controls_section();
    // End Content Tab

    // Start Style Tab
    $this->start_controls_section(
      'style_heading',
      [
        'label' => esc_html__( 'Style Heading', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
    // Heading
    $this->add_control(
      'heading_color',
      [
        'label' => 'Color',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .download-pdf-heading' => 'color: {{VALUE}}'],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Typography', 'arpc-elementor-addon' ),
        'name' => 'heading_typography',
        'selector' => '{{WRAPPER}} .download-pdf-heading',
      ]
    );

    $this->add_control(
			'heading_margin',
			[
				'label' => esc_html__( 'Margin', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .download-pdf-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'heading_padding',
			[
				'label' => esc_html__( 'Padding', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .download-pdf-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();

    //  Style Link
    $this->start_controls_section(
      'style_link',
      [
        'label' => esc_html__( 'Style link download', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
			'icon_width',
			[
				'label' => esc_html__( 'Icon Size', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
      'link_color',
      [
        'label' => 'Color',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .elementor-icon' => 'color: {{VALUE}}',
          '{{WRAPPER}} .post-title' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Link Typography', 'arpc-elementor-addon' ),
        'name' => 'link_typography',
        'selector' => '{{WRAPPER}} .post-title',
      ]
    );

    $this->add_control(
			'link_margin',
			[
				'label' => esc_html__( 'Margin', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .download-pdf-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'link_padding',
			[
				'label' => esc_html__( 'Padding', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .download-pdf-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();
    // End Style Tab
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    $link_download = get_field('upload_pdf_file');
    $elementor_icon = $settings['download_icon'];
    ?>
    <div class="download-pdf-container">
      <?php if($link_download): ?>
        <div class="download-pdf-heading">
          <span><?php echo $settings['heading']; ?></span>
        </div>
        <a href="<?php echo $link_download ?>" target="_blank">
          <div class="download-pdf-block">
            <?php if ($settings['change_download_icon'] == 'yes') : ?>
              <div class="elementor-icon-block">
                <span class="elementor-icon"><?php \Elementor\Icons_Manager::render_icon($elementor_icon, ['aria-hidden' => 'true']); ?></span>
              </div>
              <?php endif; ?>
              <?php if ($settings['change_download_icon'] !== 'yes') : ?>
              <div class="pdf-icon">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7n64fhjSOcgZ6CsfTxGybUMYfi0yZEV0xqA&usqp=CAU" alt="">
              </div>
              <?php endif; ?>
            <div class="post-title">
              <span>PDF <?php the_title(); ?></span>
            </div>
          </div>
        </a>
      <?php endif; ?>
    </div>
    <?php
  }
}
