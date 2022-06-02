<?php

/*****
 * 
 * 
 * 
 * 
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use ElementorPro\Modules\GlobalWidget\Documents\Widget;
use \Elementor\Group_Control_Typography;

class RecruitmentSectionWidget extends Widget_Base
{
    public function get_name()
    {
        return 'recruiment_section_widget';
    }

    public function get_title()
    {
        return 'Custom Recruitment section';
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
        wp_register_script('script-recruitment-section', plugins_url('assets/js/recruitment-section.js', __FILE__));
        return [
            'script-recruitment-section'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('style-recruitment-section', plugins_url('assets/css/recruitment-section.css', __FILE__));
        return [
            'style-recruitment-section'
        ];
    }

    protected function register_content_controls_section()
    {
        $this->start_controls_section(
            'title',
            [
                'label' => 'Title',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'subheading',
            [
                'label' => 'Sub-Heading',
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_controls',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'repeater_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT
            ]
        );
        $repeater->add_control(
            'repeater_desc',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'repeater_url',
            [
                'label' => 'CTA link',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://Your-link.com/',
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
            ]
        );
        $this->add_control(
            'list',
            [
                'label' => 'Repeater List Content',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'repeater_title' => 'Feature one',
                        'repeater_desc' => 'Item content. Click the edit button to change this text.',
                    ],
                    [
                        'repeater_title' => 'Feature Two',
                        'repeater_desc' => 'Item content. Click the edit button to change this text.',
                    ],
                    [
                        'repeater_title' => 'Feature three',
                        'repeater_desc' => 'Item content. Click the edit button to change this text.',
                    ],
                ],
                'title_field' => '{{{ repeater_title }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'see_all',
            [
                'label' => 'See all section',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'see_all_text',
            [
                'label' => 'Text See all',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'see_all_link',
            [
                'label' => 'Link See all',
                'type' => Controls_Manager::TEXT
            ]
        );
        $this->end_controls_section();
    }
    protected function register_style_content_controls()
    {
        $this->start_controls_section(
            'style_heading',
            [
                'label' => 'Heading',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_heading_typo',
                'label' => 'Typography',
                'selector' => '{{WRAPPER}} .recruitment-section-heading',
            ]
        );
        $this->add_control(
            'style_heading_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-heading' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_heading_align',
            [
                'label' => 'Alignment',
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .recruitment-section-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_heading_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_heading_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_subheading',
            [
                'label' => 'subHeading',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_subheading_typo',
                'label' => 'Typography',
                'selector' => '{{WRAPPER}} .recruitment-section-subheading',
            ]
        );
        $this->add_control(
            'style_subheading_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-subheading' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_subheading_align',
            [
                'label' => 'Alignment',
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .recruitment-section-subheading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_subheading_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-subheading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_subheading_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .recruitment-section-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_content',
            [
                'label' => 'Title Content',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_title_typo',
                'label' => 'Title Typography',
                'selector' => '{{WRAPPER}} .item-title',
            ]
        );
        $this->add_control(
            'style_title_color',
            [
                'label' => 'Title Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_title_align',
            [
                'label' => 'Title Alignment',
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .item-title' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_title_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Title Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_title_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Title Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_desc_typo',
                'label' => 'Desc Typography',
                'selector' => '{{WRAPPER}} .item-desc',
            ]
        );
        $this->add_control(
            'style_desc_color',
            [
                'label' => 'Desc Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-desc' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_desc_align',
            [
                'label' => 'Desc Alignment',
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .item-desc' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_desc_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Title Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_desc_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Desc Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_content_controls_section();
        $this->register_style_content_controls();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="recruitment-section">
            <div class="recruitment-section-subheading">
                <?php echo $settings['subheading'] ?>
            </div>
            <h3 class="recruitment-section-heading">
                <?php echo $settings['heading'] ?>
            </h3>
            <div class="recruitment-section-content">
                <?php
                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                        $this->add_link_attributes('repeater_url', $item['repeater_url']);
                ?>
                        <div class="recruitment-section-content-item">
                            <div class="item-title"><?php echo $item['repeater_title'] ?></div>
                            <div class="item-desc"><?php echo $item['repeater_desc'] ?></div>
                            <a <?php echo $this->get_render_attribute_string('repeater_url'); ?> class="item-link">Action link <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <a href="<?php echo $settings['see_all_link'] ?>" class="recruitment-section-more">
                <span><?php echo $settings['see_all_text'] ?></span>
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
<?php
    }
}
