<?php

/***
 *
 *
 *
 ***/

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class CustomCustomerSectionWidget extends Widget_Base
{
    public function get_name()
    {
        return 'customer-section';
    }

    public function get_title()
    {
        return 'Custom Customer Widget';
    }

    public function get_icon()
    {
        return 'eicon-elementor';
    }

    public function get_categories()
    {
        return ['custom-category'];
    }

    public function get_keywords()
    {
        return ['key', 'value'];
    }

    public function get_script_depends()
    {
        wp_register_script('custom-customer-section', plugins_url('assets/js/custom-customer-section.js', __FILE__));
        return [
            'custom-customer-section',
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('custom-customer-section', plugins_url('assets/css/custom-customer-section.css', __FILE__));
        return [
            'custom-customer-section',
        ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'customer-section-content',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'customer-section-heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'default' => 'Our customer',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'customer-section-desc',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        //Share Button section
        $this->start_controls_section(
            'share_button_section',
            [
                'label' => esc_html__('Share Button', 'arpc-elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'share_button_text',
            [
                'label' => esc_html__('Button Text', 'arpc-elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 1,
                'default' => esc_html__('Share', 'arpc-elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'share_button_url',
            [
                'label' => esc_html__('Share URL', 'arpc-elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => esc_html__('https://www.yourlink.com/', 'arpc-elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'arpc-elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'arpc-elementor-addon'),
                'label_off' => esc_html__('Hide', 'arpc-elementor-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        // End Share Button  section

        // style wrapper
        $this->start_controls_section(
            'customer-section-wrapper-style',
            [
                'label' => 'Background',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wrapper-background',
                'label' => esc_html__('Background', 'plugin-name'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .customer-section-wrapper',
            ]
        );
        $this->add_responsive_control(
            'padding-wrapper',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-wrapper',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // style Heading
        $this->start_controls_section(
            'customer-section-heading-style',
            [
                'label' => 'Heading',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .customer-section-heading',
            ]
        );
        $this->add_control(
            'customer-section-heading-color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{ WRAPPER }} .customer-section-heading' => 'color: {{ VALUE }}',
                ]
            ]
        );
        $this->add_control(
            'text_align-heading',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .customer-section-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-heading',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-heading',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // style Desc
        $this->start_controls_section(
            'customer-section-desc-style',
            [
                'label' => 'Description',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .customer-section-desc',
            ]
        );
        $this->add_control(
            'customer-section-desc-color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{ WRAPPER }} .customer-section-desc' => 'color: {{ VALUE }}',
                ]
            ]
        );
        $this->add_control(
            'text_align-desc',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .customer-section-desc' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-desc',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-desc',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .customer-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="customer-section-wrapper">
            <div class="customer-section-container">
                <div class="customer-section-heading">
                    <?php echo $settings['customer-section-heading']; ?>
                </div>
                <div class="customer-section-desc customer-section-desc-expand">
                    <?php echo $settings['customer-section-desc']; ?>
                </div>
            </div>
            <div class="customer-section-share">
                <?php
                if ('yes' === $settings['show_button']) {
                    echo '<button class="btn-share-customer" type="button">' . $settings['share_button_text'] . '<i class="fa-solid fa-link"></i></button>';
                }
                ?>
                <div class="customer-share-block">
                    <?php echo do_shortcode('[social-share-display display="1653549193" force="true" archive="true" custom="true" url="' . $settings['share_button_url'] . '" message="" image="" tweet="Custom tweet"]') ?>
                </div>
            </div>
            <div class="customer-section-more">
                <span>Expand to view our client listing</span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
<?php
    }
}
