<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class CustomTropicalSectionWidget extends Widget_Base
{
    // Get Name
    public function get_name()
    {
        return 'custom-tropical_section';
    }
    // Get Title
    public function get_title()
    {
        return 'Custom Tropical Section';
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
        wp_register_script('script-custom-tropical-section', plugins_url('assets/js/custom-tropical-section.js', __FILE__));
        return [
            'script-custom-tropical-section'
        ];
    }
    // Register Style
    public function get_style_depends()
    {
        wp_register_style('style-custom-tropical-section', plugins_url('assets/css/custom-tropical-section.css', __FILE__));
        return [
            'style-custom-tropical-section'
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
                'selector' => '{{WRAPPER}} .tropical-section',
            ]
        );
        $this->add_responsive_control(
            'padding-background',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tropical-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tropical-section-heading',
            ]
        );
        $this->add_control(
            'color-heading',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .tropical-section-heading' => 'color: {{VALUE}}'
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
                    '{{WRAPPER}} .tropical-section-heading' => 'text-align: {{VALUE}}'
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
                    '{{WRAPPER}} .tropical-section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tropical-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tropical-section-desc',
            ]
        );
        $this->add_control(
            'color-desc',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .tropical-section-desc' => 'color: {{VALUE}}'
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
                    '{{WRAPPER}} .tropical-section-desc' => 'text-align: {{VALUE}}'
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
                    '{{WRAPPER}} .tropical-section-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tropical-section-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .tropical-section-button',
            ]
        );
        $this->add_control(
            'color-button-text',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Text color',
                'selectors' => [
                    '{{WRAPPER}} .tropical-section-button' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'color-button',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Button color',
                'selectors' => [
                    '{{WRAPPER}} .tropical-section-button' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'text_align-button',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .tropical-button-wrap' => 'justify-content: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-button',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tropical-section-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-button',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tropical-button-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border-button',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .tropical-section-button',
            ]
        );
        $this->end_controls_section();
        // Add Useful link control
        $this->start_controls_section(
            'useful-links',
            [
                'label' => 'Useful links',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Add heading
        $this->add_control(
            'useful-heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'label_block' => true,
                'default' => 'Useful links'
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'text-link',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Enter your title',
                'label_block' => false
            ]
        );
        $repeater->add_control(
            'links',
            [
                'label' => 'Link',
                'type' => Controls_Manager::URL,
                'show_label' => true,
            ]
        );
        $this->add_control(
            'useful-repeater',
            [
                'label' => 'Useful links',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->add_control(
            'follow-content',
            [
                'label' => 'Icon',
                'type' => Controls_Manager::WYSIWYG,
            ]
        );
        $this->add_control(
            'follow-icon',
            [
                'label' => 'Icon',
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'links-social',
            [
                'label' => 'Link icon',
                'type' => Controls_Manager::URL,
                'show_label' => true,
            ]
        );
        $this->end_controls_section();
        // Useful link style
        $this->start_controls_section(
            'useful-link',
            [
                'label' => 'Useful links',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'usefulheading_typography',
                'selector' => '{{WRAPPER}} .useful-heading',
            ]
        );
        $this->add_control(
            'color-usefulheading',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .useful-heading' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-usefulheading',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .useful-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-usefulheading',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .useful-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Useful link style
        $this->start_controls_section(
            'link-item',
            [
                'label' => 'Useful links item',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'usefulitem_typography',
                'selector' => '{{WRAPPER}} .useful-links-item',
            ]
        );
        $this->add_control(
            'color-usefulitem',
            [
                'type' => Controls_Manager::COLOR,
                'label' => 'Color',
                'selectors' => [
                    '{{WRAPPER}} .useful-links-item' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-usefulitem',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .useful-links-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-usefulitem',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .useful-links-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    // Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['button-url']['url'])) {
            $this->add_link_attributes('button-url', $settings['button-url']);
        }
        if (!empty($settings['links-social']['url'])) {
            $this->add_link_attributes('links-social', $settings['button-url']);
        }
?>
        <div class="wrap-background">
            <div class="tropical-section">
                <div class="tropical-section-left">
                    <?php if ($settings['content-heading']) { ?>
                        <div class="tropical-section-heading">
                            <?php echo $settings['content-heading']; ?>
                        </div>
                    <?php } ?>
                    <?php if ($settings['content-desc']) { ?>
                        <div class="tropical-section-desc">
                            <?php echo $settings['content-desc']; ?>
                        </div>
                    <?php } ?>
                    <?php if ($settings['button-text'] && $settings['button-show'] == 'yes') { ?>
                        <div class="tropical-button-wrap" style="display: flex;">
                            <a <?php echo $this->get_render_attribute_string('button-url'); ?>>
                                <button class="tropical-section-button">
                                    <?php echo $settings['button-text']; ?>
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="tropical-section-right">
                    <div class="useful-heading">
                        <?php echo $settings['useful-heading']; ?>
                    </div>
                    <div class="useful-links">
                        <?php foreach ($settings['useful-repeater'] as $index => $item) : ?>
                            <a class="useful-links-item" href="<?php echo $item['links']['url'] ?>">
                                <?php echo $item['text-link'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="useful-follow">
                        <a href="<?php echo $settings['links-social']['url'] ?>">
                            <?php \Elementor\Icons_Manager::render_icon($settings['follow-icon'], ['aria-hidden' => 'true']); ?>
                        </a>
                        <?php echo $settings['follow-content'] ?>
                    </div>
                </div>
            </div>
            <?php if ($settings['button-close-show'] == 'yes') { ?>
                <div class="tropical-section-close">
                    <button>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            <?php } ?>
        </div>
<?php
    }
}
