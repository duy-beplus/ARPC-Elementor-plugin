<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class CustomLoginSectionWidget extends Widget_Base
{
    // Get Name
    public function get_name()
    {
        return 'custom-login_section';
    }
    // Get Title
    public function get_title()
    {
        return 'Custom Login Section';
    }
    // Get Icon
    public function get_icon()
    {
        return 'eicon-elementor';
    }
    //  Get Category
    public function get_categories()
    {
        return ['custom-category'];
    }
    // Get keywords
    public function get_keywords()
    {
        return ['key', 'value'];
    }
    // Register Script
    public function get_script_depends()
    {
        wp_register_script('script-custom-login-section', plugins_url('assets/js/custom-login-section.js', __FILE__));
        return [
            'script-custom-login-section'
        ];
    }
    // Register Style
    public function get_style_depends()
    {
        wp_register_style('style-custom-login-section', plugins_url('assets/css/custom-login-section.css', __FILE__));
        return [
            'style-custom-login-section'
        ];
    }
    // Register Controls
    protected function register_controls()
    {
        // Add content control
        $this->start_controls_section(
            'content',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Add heading
        $this->add_control(
            'content-heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'placeholder' => 'Add your Heading here!',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'content-desc',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'placeholder' => 'Add your Description here!',
            ]
        );
        $this->end_controls_section();
        // Style Section
        $this->start_controls_section(
            'style-background',
            [
                'label' => 'Settings Background',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'plugin-name'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .login-section',
            ]
        );
        $this->add_responsive_control(
            'padding-background',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'close_button_color',
            [
                'label' => 'Close button color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .login-section-close button i' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'close_button_size',
            [
                'label' => 'Close button size',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .login-section-close button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Style Heading
        $this->start_controls_section(
            'style-heading',
            [
                'label' => 'Heading',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .login-section-heading',
            ]
        );
        $this->add_control(
            'color-heading',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-heading' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'text_align-heading',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .login-section-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-heading',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-heading',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Style Desc
        $this->start_controls_section(
            'style-desc',
            [
                'label' => 'Description',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .login-section-desc',
            ]
        );
        $this->add_control(
            'color-desc',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-desc' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'text_align-desc',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .login-section-desc' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-desc',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-desc',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Add Button
        $this->start_controls_section(
            'button',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'button-show',
            [
                'label' => 'Show/Hide Button',
                'type' => Controls_Manager::SWITCHER,
                'description' => 'This will be Show/Hide your Button type',
                'label_on' => 'Show',
                'Label_off' => 'Hide',
            ]
        );
        $this->add_control(
            'button-text',
            [
                'label' => 'Button text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Click here!'
            ]
        );
        $this->add_control(
            'button-url',
            [
                'label' => 'Button URL',
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
            ]
        );
        $this->add_control(
            'button-close-show',
            [
                'label' => 'Show/Hide Close Button',
                'type' => Controls_Manager::SWITCHER,
                'description' => 'This will be Show/Hide your Close Button type',
                'label_on' => 'Show',
                'Label_off' => 'Hide',
            ]
        );
        $this->end_controls_section();
        // Style Button
        $this->start_controls_section(
            'style-button',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button-normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .login-section-button',
            ]
        );
        $this->add_control(
            'color-button-text',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Text color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-button' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'color-button',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Button color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-button' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'text_align-button',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .login-button-wrap' => 'justify-content: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-button',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-section-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-button',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .login-button-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border-button',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .login-section-button',
            ]
        );
        $this->end_controls_tab();
        // End Normal tab for button
        // Start Hover tab for Button
        $this->start_controls_tab(
            'button_style_hover',
            [
                'label' => 'Hover',
            ]
        );
        $this->add_control(
            'color-button-text-hover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Text color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-button:hover' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'color-button-hover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Button color',
                'selectors' => [
                    '{{WRAPPER}} .login-section-button:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border-button-hover',
                'label' => 'Border',
                'selector' => '{{WRAPPER}} .tropical-section-button:hover',
            ]
        );
        $this->end_controls_tab();
        // End Hover control tab for button
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    // Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['button-url']['url'])) {
            $this->add_link_attributes('button-url', $settings['button-url']);
        }
?>
        <div class="login-section">
            <?php if ($settings['content-heading']) { ?>
                <div class="login-section-heading">
                    <?php echo $settings['content-heading']; ?>
                </div>
            <?php } ?>
            <?php if ($settings['content-desc']) { ?>
                <div class="login-section-desc">
                    <?php echo $settings['content-desc']; ?>
                </div>
            <?php } ?>
            <?php if ($settings['button-text'] && $settings['button-show'] == 'yes') { ?>
                <div class="login-button-wrap" style="display: flex;">
                    <a <?php echo $this->get_render_attribute_string('button-url'); ?>>
                        <button class="login-section-button">
                            <?php echo $settings['button-text']; ?>
                        </button>
                    </a>
                </div>
            <?php } ?>
            <?php if ($settings['button-close-show'] == 'yes') { ?>
                <div class="login-section-close">
                    <button>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            <?php } ?>
        </div>
<?php
    }
}
