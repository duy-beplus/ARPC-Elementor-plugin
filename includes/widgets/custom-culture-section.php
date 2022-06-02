<?php

/*****
 * 
 * 
 * 
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;

class CustomCultureSectionWidget extends Widget_base
{
    public function get_name()
    {
        return 'custom-culture-section';
    }

    public function get_title()
    {
        return 'Custom culture section';
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
        wp_register_script('custom-culture-section', plugins_url('assets/js/custom-culture-section.js', __FILE__));
        wp_register_script('elementor-swiper', plugins_url('/assets/js/swiper.min.js', __FILE__), ['jquery'], false, true);
        return [
            'custom-culture-section',
            'elementor-swiper',
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('custom-culture-section', plugins_url('assets/css/custom-culture-section.css', __FILE__));
        return [
            'custom-culture-section',
        ];
    }

    protected function register_additional_section_controls()
    {
        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => 'Additional Options',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'type' => Controls_Manager::SELECT,
                'label' => 'Navigation',
                'default' => 'icon',
                'options' => [
                    '' => 'None',
                    'icon' => 'Icon',
                    'text' => 'Text',
                    'both' => 'Icon and Text',
                ],
                'prefix_class' => 'elementor-navigation-type-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => 'Pagination',
                'type' => Controls_Manager::SELECT,
                'default' => 'bullets',
                'options' => [
                    '' => 'None',
                    'bullets' => 'Dots',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progress',
                ],
                'prefix_class' => 'elementor-pagination-type-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => 'Transition Duration',
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => 'Autoplay',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => 'Autoplay Speed',
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => 'Infinite Loop',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_design_navigation_section_controls()
    {
        $this->start_controls_section(
            'section_design_navigation',
            [
                'label' => 'Navigation',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_arrows');

        $this->start_controls_tab(
            'tabs_arrow_prev',
            [
                'label' => 'Previous',
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => 'Previous Icon',
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'navigation!' => ['text', ''],
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_text',
            [
                'label' => 'Previous Text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Prev',
                'label_block' => true,
                'condition' => [
                    'navigation!' => ['icon', ''],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_arrow_next',
            [
                'label' => 'Next',
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'arrow_next_icon',
            [
                'label' => 'Next Icon',
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'navigation!' => ['text', ''],
                ],
            ]
        );

        $this->add_control(
            'arrow_next_text',
            [
                'label' => 'Next Text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Next',
                'label_block' => true,
                'condition' => [
                    'navigation!' => ['icon', ''],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'navigation_position',
            [
                'label' => 'Position',
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => 'Inside',
                    'outside' => 'Outside',
                ],
                'prefix_class' => 'elementor-navigation-position-',
                'render_type' => 'template',
                'separator' => 'before',
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_space',
            [
                'label' => 'Spacing',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',

                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_size',
            [
                'label' => 'Button Size',
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 120,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_icon_size',
            [
                'label' => 'Icon Size',
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-swiper-button img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['text', ''],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'navigation_text_typography',
                'label' => 'Text Typography',
                'selector' => '{{WRAPPER}} .elementor-swiper-button span',
                'condition' => [
                    'navigation!' => ['icon', ''],
                ],
            ]
        );

        $this->add_control(
            'navigation_border_width',
            [
                'label' => 'Border Width',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_border_radius',
            [
                'label' => 'Border Radius',
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_navigation');

        $this->start_controls_tab(
            'tabs_navigation_normal',
            [
                'label' => 'Normal',
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_icon_color',
            [
                'label' => 'Icon Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-swiper-button svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['text', ''],
                ],
            ]
        );

        $this->add_control(
            'navigation_text_color',
            [
                'label' => 'Text Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['icon', ''],
                ],
            ]
        );

        $this->add_control(
            'navigation_background',
            [
                'label' => 'Background Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_border_color',
            [
                'label' => 'Border Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_navigation_hover',
            [
                'label' => 'Hover',
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_icon_color_hover',
            [
                'label' => 'Icon Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-swiper-button:hover svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['text', ''],
                ],
            ]
        );

        $this->add_control(
            'navigation_text_color_hover',
            [
                'label' => 'Text Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button:hover span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['icon', ''],
                ],
            ]
        );

        $this->add_control(
            'navigation_background_hover',
            [
                'label' => 'Background Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->add_control(
            'navigation_border_color_hover',
            [
                'label' => 'Border Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_additional_section_controls();
        $this->register_design_navigation_section_controls();
        $this->start_controls_section(
            'section_layout',
            [
                'label' => 'Layout',
            ]
        );

        $this->add_responsive_control(
            'sliders_per_view',
            [
                'label' => 'Slides Per View',
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_image',
            [
                'label' => 'Thumbnail',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_url',
            [
                'label' => 'Url',
                'type' => Controls_Manager::TEXT,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'list_desc',
            [
                'label' => 'Decription',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Enter your Description',
            ]
        );

        $repeater->add_control(
            'list_author',
            [
                'label' => 'Author',
                'type' => Controls_Manager::TEXT,
                'default' => 'Enter your Name of Author',
            ]
        );
        $repeater->add_control(
            'list_position',
            [
                'label' => 'Position',
                'type' => Controls_Manager::TEXT,
                'default' => 'Enter your Position of Author',
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => 'List',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_image' => Utils::get_placeholder_image_src(),
                        'list_url' => '#',
                        'list_desc' => 'Enter your Description',
                        'list_author' => 'Name of Author',
                        'list_position' => 'Position of Author',
                    ],
                    [
                        'list_image' => Utils::get_placeholder_image_src(),
                        'list_url' => '#',
                        'list_desc' => 'Enter your Description',
                        'list_author' => 'Name of Author',
                        'list_position' => 'Position of Author',
                    ],
                    [
                        'list_image' => Utils::get_placeholder_image_src(),
                        'list_url' => '#',
                        'list_desc' => 'Enter your Description',
                        'list_author' => 'Name of Author',
                        'list_position' => 'Position of Author',
                    ],
                ],
                'title_field' => '{{{ list_desc }}}',
            ]
        );
        $this->end_controls_section();
        // style Desc
        $this->start_controls_section(
            'customer-section-desc-style',
            [
                'label' => 'Decription',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .right-desc',
            ]
        );
        $this->add_control(
            'right-desc-color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{ WRAPPER }} .right-desc' => 'color: {{ VALUE }}',
                ]
            ]
        );
        $this->add_control(
            'text_align-desc',
            [
                'label' => 'Alignment',
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .right-desc' => 'text-align: {{VALUE}}'
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
                    '{{WRAPPER}} .right-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .right-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // style Author's name
        $this->start_controls_section(
            'customer-section-author-style',
            [
                'label' => 'Author',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .content-author',
            ]
        );
        $this->add_control(
            'content-author-color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{ WRAPPER }} .content-author' => 'color: {{ VALUE }}',
                ]
            ]
        );
        $this->add_control(
            'text_align-author',
            [
                'label' => 'Alignment',
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content-author' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-author',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-author',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // style Author's position
        $this->start_controls_section(
            'customer-section-position-style',
            [
                'label' => 'Position',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .content-position',
            ]
        );
        $this->add_control(
            'content-position-color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{ WRAPPER }} .content-position' => 'color: {{ VALUE }}',
                ]
            ]
        );
        $this->add_control(
            'text_align-position',
            [
                'label' => 'Alignment',
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content-position' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'padding-position',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin-position',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function swiper_data()
    {
        $settings = $this->get_settings_for_display();

        $slides_per_view = $this->get_settings_for_display('sliders_per_view') ? $this->get_settings_for_display('sliders_per_view') : 1;
        $slides_per_view_tablet = $this->get_settings_for_display('sliders_per_view_tablet') ? $this->get_settings_for_display('sliders_per_view_tablet') : $slides_per_view;
        $slides_per_view_mobile = $this->get_settings_for_display('sliders_per_view_mobile') ? $this->get_settings_for_display('sliders_per_view_mobile') : $slides_per_view_tablet;

        // $space_between = $this->get_settings_for_display('space_between')['size'] ? $this->get_settings_for_display('space_between')['size'] : 30;
        // $space_between_tablet = $this->get_settings_for_display('space_between_tablet')['size'] ? $this->get_settings_for_display('space_between_tablet')['size'] : $space_between;
        // $space_between_mobile = $this->get_settings_for_display('space_between_mobile')['size'] ? $this->get_settings_for_display('space_between_mobile')['size'] : $space_between_tablet;


        $swiper_data = array(
            'slidesPerView' => $slides_per_view_mobile,
            'spaceBetween' => 20,
            'speed' => $settings['speed'],
            'loop' => $settings['loop'] == 'yes' ? true : false,
            'breakpoints' => array(
                // 767 => array(
                //     'slidesPerView' => /* $slides_per_view_tablet */ 1,
                //     'spaceBetween' => 20,
                // ),
                1024 => array(
                    'slidesPerView' => /* $slides_per_view */ 1,
                    'spaceBetween' => 20,
                )
            ),

        );

        if ('' !== $settings['navigation']) {
            $swiper_data['navigation'] = array(
                'nextEl' => '.elementor-swiper-button-next',
                'prevEl' => '.elementor-swiper-button-prev',
            );
        }

        if ('' !== $settings['pagination']) {
            $swiper_data['pagination'] = array(
                'el' => '.elementor-swiper-pagination',
                'type' => $settings['pagination'],
                'clickable' => true,
            );
        }

        if ($settings['autoplay'] === 'yes') {
            $swiper_data['autoplay'] = array(
                'delay' => $settings['autoplay_speed'],
            );
        }

        return $swiper_json = json_encode($swiper_data);
    }
    public function render_loop_header()
    {
        $settings = $this->get_settings_for_display();

        $classes = 'elementor-swiper swiper-container';

        $classes .= ' elementor-posts--default pv-elements-elementor';

?>
        <div class="<?php echo esc_attr($classes); ?>" data-swiper="<?php echo esc_attr($this->swiper_data()); ?>">
            <div class="swiper-wrapper">
            <?php
        }

        protected function render_icon($icon)
        {
            $icon_html = '';

            if (!empty($icon['value'])) {
                if ('svg' !== $icon['library']) {
                    $icon_html = '<i class="' . esc_attr($icon['value']) . '" aria-hidden="true"></i>';
                } else {
                    $icon_html = file_get_contents($icon['value']['url']);;
                }
            }

            return $icon_html;
        }

        protected function render_navigation()
        {
            $settings = $this->get_settings_for_display();

            if ('' === $settings['navigation']) {
                return;
            }

            ?>
                <div class="elementor-swiper-button elementor-swiper-button-prev">
                    <?php
                    if ('' !== $this->render_icon($settings['arrow_prev_icon'])) {
                        echo $this->render_icon($settings['arrow_prev_icon']);
                    }

                    if (('both' === $settings['navigation'] || 'text' === $settings['navigation']) && '' !== $settings['arrow_prev_text']) {
                        echo '<span>' . $settings['arrow_prev_text'] . '</span>';
                    }
                    ?>

                </div>
                <div class="elementor-swiper-button elementor-swiper-button-next">
                    <?php
                    if (('both' === $settings['navigation'] || 'text' === $settings['navigation']) && '' !== $settings['arrow_next_text']) {
                        echo '<span>' . $settings['arrow_next_text'] . '</span>';
                    }

                    if ('' !== $this->render_icon($settings['arrow_next_icon'])) {
                        echo $this->render_icon($settings['arrow_next_icon']);
                    }
                    ?>
                </div>
            <?php
        }

        protected function render_pagination()
        {
            $settings = $this->get_settings_for_display();

            if ('' === $settings['pagination']) {
                return;
            }

            ?>
                <div class="elementor-swiper-pagination"></div>
            <?php
        }

        public function render_loop_footer()
        {
            $settings = $this->get_settings_for_display();

            ?>
            </div>

            <?php
            // if ('inside' === $settings['pagination_position']) {
            //     $this->render_pagination();
            // }

            if ('inside' === $settings['navigation_position']) {
                $this->render_navigation();
            }
            ?>

        </div>

        <?php
            // if ('outside' === $settings['pagination_position']) {
            //     $this->render_pagination();
            // }

            if ('outside' === $settings['navigation_position']) {
                $this->render_navigation();
            }
        ?>

        <?php
        }

        protected function render_post()
        {
            $settings = $this->get_settings_for_display();
            foreach ($settings['list'] as $index => $item) {
        ?>
            <div class="swiper-slide culture-section">
                <article>
                    <div class="culture-section-left">
                        <a href="<?php echo esc_url($item['list_url']); ?>">
                            <div class="slide-image">
                                <?php
                                $attachment = wp_get_attachment_image_src($item['list_image']['id'], 'medium-large');
                                if (!empty($attachment)) {
                                    echo '<img src=" ' . esc_url($attachment[0]) . ' " alt="">';
                                } else {
                                    echo '<img src=" ' . esc_url($item['list_image']['url']) . ' " alt="">';
                                }
                                ?>
                            </div>
                        </a>
                    </div>
                    <div class="culture-section-right">
                        <div class="right-desc"><?php echo $item['list_desc'] ?></div>
                        <div class="right-content">
                            <div class="content-author"><?php echo $item['list_author'] ?>,</div>
                            <div class="content-position"><?php echo $item['list_position'] ?></div>
                        </div>
                    </div>
                </article>
            </div>
<?php }
        }

        protected function render()
        {

            $this->render_loop_header();

            $this->render_post();

            $this->render_loop_footer();
        }

        /**
         * Render the widget output in the editor.
         *
         * Written as a Backbone JavaScript template and used to generate the live preview.
         *
         * @since 1.0.0
         *
         * @access protected
         */
        protected function content_template()
        {
        }
    }
