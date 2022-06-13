<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Community_FAQ_Widgets extends \Elementor\Widget_Base {
  public function get_name() {
      return 'faq-elementor-widget';
  }

  public function get_title() {
      return __( 'FAQs Editor');
  }

  public function get_icon() {
      return 'eicon-editor-list-ul';
  }

  public function get_categories() {
      return [ 'general' ];
  }

  public function get_keywords() {
    return [ 'faqs', 'community' ];
  }

  public function get_style_depends() {
      wp_register_style( "community_faq_style", plugins_url('assets/css/faq-widget-style.css',__FILE__ ) );
      return [
          'community_faq_style'
      ];
  }

  public function get_script_depends() {
		wp_register_script( 'community_faq_script', plugins_url( 'assets/js/community-faq-script.js', __FILE__ ) );
		return [
			'community_faq_script'
		];
	}

  protected function register_controls() {
    // Start Content Tab
    //FAQs section
    $this->start_controls_section(
    'faq_section',
      [
        'label' => esc_html__( 'FAQs Content', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    // Heading
    $this->add_control(
        'faq_heading',
        [
            'label' => esc_html__( 'Heading', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 1,
            'default' => esc_html__( 'FAQs', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
			'show_answers',
			[
				'label' => esc_html__( 'Show Answers', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'arpc-elementor-addon' ),
				'label_off' => esc_html__( 'Hide', 'arpc-elementor-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    $faq_repeater = new \Elementor\Repeater();

    $faq_repeater->add_control(
        'faq_list_question',
        [
            'label' => esc_html__( 'FAQs Question', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 3,
            'default' => esc_html__( 'Type your question here', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $faq_repeater->add_control(
        'faq_list_answer',
        [
            'label' => esc_html__( 'FAQs Answer', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 3,
            'default' => esc_html__( 'Type your answer here', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'faqs_list',
        [
            'label' => esc_html__( 'FAQs Repeater List', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $faq_repeater->get_controls(),
            'default' => [
                [
                    'faq_list_question' => esc_html__( 'Question #1', 'arpc-elementor-addon' ),
                ],
                [
                    'faq_list_question' => esc_html__( 'Question #2', 'arpc-elementor-addon' ),
                ],
                [
                    'faq_list_question' => esc_html__( 'Question #3', 'arpc-elementor-addon' ),
                ],
            ],
            'title_field' => '{{{ faq_list_question }}}',
        ]
    );

    $this->end_controls_section();
    // End FAQs section

    //Share Button section
    $this->start_controls_section(
    'share_button_section',
      [
        'label' => esc_html__( 'Share Button', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
        'share_button_text',
        [
            'label' => esc_html__( 'Button Text', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 1,
            'default' => esc_html__( 'Share', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'faqs_share_button_url',
        [
            'label' => esc_html__( 'Share URL', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 2,
            'default' => esc_html__( 'https://www.yourlink.com/', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'arpc-elementor-addon' ),
				'label_off' => esc_html__( 'Hide', 'arpc-elementor-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    $this->end_controls_section();
    // End Share Button  section
    // End Content Tab

    // Start Style Tab
      // Style FAQs
    $this->start_controls_section(
      'faq_style_section',
      [
        'label' => esc_html__( 'Style Heading', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Style FAQs Heading
    $this->add_control(
      'faqs_heading_color',
      [
        'label' => esc_html__( 'Heading Color', 'arpc-elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .faqs-heading-title' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Heading Typography', 'arpc-elementor-addon' ),
        'name' => 'faqs_heading_typography',
        'selector' => '{{WRAPPER}} .faqs-heading-title',
      ]
    );

    // margin Heading
    $this->add_control(
			'faqs_heading_margin',
			[
				'label' => esc_html__( 'Margin', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .faqs-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    // padding Heading
    $this->add_control(
			'faqs_heading_padding',
			[
				'label' => esc_html__( 'Padding', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .faqs-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();

    // Style Share Button text
    $this->start_controls_section(
      'faqs_share_button_style_section',
      [
        'label' => esc_html__( 'Style Button text', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Style FAQs Share button
    $this->add_control(
      'faqs_share_button_color',
      [
        'label' => esc_html__( 'Button Text Color', 'community-elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .btn-faqs-share' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Text Typography', 'community-elementor-addon' ),
        'name' => 'faqs_share_button_typography',
        'selector' => '{{WRAPPER}} .btn-faqs-share',
      ]
    );

    $this->end_controls_section();
    // End style button text

    // Style List Question
    $this->start_controls_section(
      'list_question_style_section',
      [
        'label' => esc_html__( 'Style Questions', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'list_question_color',
      [
        'label' => esc_html__( 'Questions Color', 'community-elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .list-item-question' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Questions Typography', 'community-elementor-addon' ),
        'name' => 'list_question_typography',
        'selector' => '{{WRAPPER}} .question',
      ]
    );

    // margin list questions
    $this->add_control(
			'questions_margin',
			[
				'label' => esc_html__( 'Margin', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .faqs-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    // padding list question
    $this->add_control(
			'questions_padding',
			[
				'label' => esc_html__( 'Padding', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .faqs-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'faqs_item_border',
				'label' => esc_html__( 'Item Border', 'arpc-elementor-addon' ),
				'selector' => '{{WRAPPER}} .faqs-list-item',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'faqs_item_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'arpc-elementor-addon' ),
				'selector' => '{{WRAPPER}} .faqs-list-item',
			]
		);


    $this->end_controls_section();
    // End style list questions

    // Style List Answer
    $this->start_controls_section(
      'list_answers_style_section',
      [
        'label' => esc_html__( 'Style Answers', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'list_answers_color',
      [
        'label' => esc_html__( 'Answers Color', 'community-elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .answer' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Answers Typography', 'community-elementor-addon' ),
        'name' => 'list_answers_typography',
        'selector' => '{{WRAPPER}} .answer',
      ]
    );

    $this->add_control(
			'answers_margin',
			[
				'label' => esc_html__( 'Margin', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .answer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'answers_padding',
			[
				'label' => esc_html__( 'Padding', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .answer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();
    // End style list Answers
    // End FAQs style section

    // End Style Tab
  }

  protected function render() {
      // generate the final HTML on the frontend using PHP
      $settings = $this->get_settings_for_display();
      ?>
      <div class="faqs-section">
        <div class="faqs-heading">
          <h2 class="faqs-heading-title"><?php echo $settings['faq_heading']; ?></h2>
          <div class="faqs-share-block">
            <?php
            if ( 'yes' === $settings['show_button'] ) {
              echo '<div class="btn-faqs-share">' . $settings['share_button_text'] . '<i class="fa fa-link"></i></div>';
            }
             ?>
             <div class="share-socials-block">
               <?php echo do_shortcode('[social-share-display display="1653549193" force="true" archive="true" custom="true" url="'.$settings['faqs_share_button_url'].'" message="Your custom message" image="" tweet="Custom tweet"]') ?>
             </div>
          </div>
        </div>
        <div class="faqs-container">
          <?php   if ( $settings['faqs_list'] ) { ?>
          <div class="faqs-list-box">
              <?php foreach (  $settings['faqs_list'] as $item ) { ?>
            <div class="faqs-list-item">
              <div class="list-item-question">
                <h4 class="question"><?php echo $item['faq_list_question']; ?></h4>
                <i class="gg-chevron-down"></i>
                <i class="gg-chevron-up"></i>
              </div>
              <div class="list-item-answer">
                <?php if ( 'yes' === $settings['show_answers'] ) { ?>
                <p class="answer"><?php echo $item['faq_list_answer']; ?></p>
                <?php } ?>
              </div>
            </div>
              <?php } ?>
          </div>
        <?php } ?>
        </div>
      </div>
      <?php
  }
}
