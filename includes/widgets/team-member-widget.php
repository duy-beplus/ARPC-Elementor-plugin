<?php

/******
 * 
 * 
 * 
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

class TeamMemberWidget extends Widget_Base
{
    public function get_name()
    {
        return 'team-member-widget';
    }

    public function get_title()
    {
        return 'Custom Team Members';
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
        wp_register_script('script-team-member', plugins_url('assets/js/team-member-widget.js', __FILE__));
        return [
            'script-team-member'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('style-team-member', plugins_url('assets/css/team-member-widget.css', __FILE__));
        return [
            'style-team-member'
        ];
    }

    protected function register_content_section_controls()
    {
        $this->start_controls_section(
            'content_title_section',
            [
                'label' => 'Title',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title_heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'default' => 'The board</br>and leadership',
                'label_block' => 'false'
            ]
        );

        $this->end_controls_section();
    }
    protected function register_setting_section()
    {

        // The board settings
        $this->start_controls_section(
            'board-section',
            [
                'label' => 'The Board',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'title_board_desc',
            [
                'label' => 'Board Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => 'false'
            ]
        );
        $this->add_control(
            'setting_board',
            [
                'label' => 'Select Board?',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => "If you turn off. All Board will show",
            ]
        );
        // Get query options
        $optionsBoard = [];
        $posts = get_posts(array(
            'post_type'  => 'teammembers',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => 'board',
                ),
            ),
        ));

        foreach ($posts as $post) {
            $optionsBoard[$post->ID] = $post->post_title;
        }
        // $this->add_control(
        //     'board-select',
        //     [
        //         'label' => 'Select Board',
        //         'type' => Controls_Manager::SELECT2,
        //         'multiple' => true,
        //         'label_block' => 'false',
        //         'options' => $options,
        //     ]
        // );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'repeater-board',
            [
                'label' => 'Title',
                'type' => Controls_Manager::SELECT,
                'label_block' => 'false',
                'options' => $optionsBoard
            ]
        );
        $this->add_control(
            'list-board',
            [
                'label' => 'Repeater List Board',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'setting_board' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // The Leadership settings
        $this->start_controls_section(
            'leadership-section',
            [
                'label' => 'The Leadership',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'title_leadership_desc',
            [
                'label' => 'Leadership Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => 'false'
            ]
        );
        $this->add_control(
            'setting_leadership',
            [
                'label' => 'Select Leadership?',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => "If you turn off. All Leadership will show",
            ]
        );

        // Get query options
        $optionsLeadership = [];
        $posts = get_posts(array(
            'post_type'  => 'teammembers',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => 'leadership',
                ),
            ),
        ));
        foreach ($posts as $post) {
            $optionsLeadership[$post->ID] = $post->post_title;
        }
        // $this->add_control(
        //     'leadership-select',
        //     [
        //         'label' => 'Select Board',
        //         'type' => Controls_Manager::SELECT2,
        //         'multiple' => true,
        //         'label_block' => 'false',
        //         'options' => $options,
        //     ]
        // );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'repeater-leadership',
            [
                'label' => 'Title',
                'type' => Controls_Manager::SELECT,
                'label_block' => 'false',
                'options' => $optionsLeadership
            ]
        );
        $this->add_control(
            'list-leadership',
            [
                'label' => 'Repeater List Leadership',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'setting_leadership' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();
        // Setiing section
        $this->start_controls_section(
            'setting_section',
            [
                'label' => 'Settings',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'setting_share_btn',
            [
                'label' => 'Show/Hide Share button',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'setting_full_or_less',
            [
                'label' => 'Show Full or Less content',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Full',
                'label_off' => 'Less',
                'return_value' => 'yes'
            ]
        );
        $this->add_control(
            'setting_expand_text',
            [
                'label' => 'Setting Expand text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Expand to view our client listing',
                'label_block' => 'false',
                'condition' => [
                    'setting_full_or_less' => ''
                ]
            ]
        );
        $this->end_controls_section();
        // The board settings
        $this->start_controls_section(
            'board-section',
            [
                'label' => 'The Board',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Get query options
        $options = [];
        $posts = get_posts(array(
            'post_type'  => 'teammembers',
            'category' => 'board'
        ));

        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'board-select',
            [
                'label' => 'Select Board',
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => 'false',
                'options' => $options,
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
                'selector' => '{{WRAPPER}} .team_member-section-heading',
            ]
        );
        $this->add_control(
            'style_heading_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_member-section-heading' => 'color: {{VALUE}}'
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
                    '{{WRAPPER}} .team_member-section-heading' => 'text-align: {{VALUE}}'
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
                    '{{WRAPPER}} .team_member-section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .team_member-section-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Description
        $this->start_controls_section(
            'style_desc',
            [
                'label' => 'Description',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_desc_typo',
                'label' => 'Typography',
                'selector' => '{{WRAPPER}} .team_member-section-posts-desc p',
            ]
        );
        $this->add_control(
            'style_desc_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_member-section-posts-desc p' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_desc_align',
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
                    '{{WRAPPER}} .team_member-section-posts-desc p' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_desc_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .team_member-section-posts-desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_desc_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .team_member-section-posts-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // title posts
        $this->start_controls_section(
            'style_title',
            [
                'label' => 'Title',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'title_style'
        );
        // Start Normal tab for title
        $this->start_controls_tab(
            'title_normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_title_typo',
                'label' => 'Typography',
                'selector' => '{{WRAPPER}} .post-content-title',
            ]
        );
        $this->add_control(
            'style_title_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content-title' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_title_align',
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
                    '{{WRAPPER}} .post-content-title' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_title_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_title_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // End Normal tab for title
        // Start hover tab for title
        $this->start_controls_tab(
            'title_hover',
            [
                'label' => 'Hover'
            ]
        );
        $this->add_control(
            'style_title_color_hover',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content-title:hover' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_tab();
        //end Hover tab for title
        $this->end_controls_tabs();
        $this->end_controls_section();
        // content posts
        $this->start_controls_section(
            'style_content',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_content_typo',
                'label' => 'Typography',
                'selector' => '{{WRAPPER}} .post-content',
            ]
        );
        $this->add_control(
            'style_content_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'style_content_align',
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
                    '{{WRAPPER}} .post-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_content_padding',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Padding',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_content_margin',
            [
                'type' => Controls_Manager::DIMENSIONS,
                'label' => 'Margin',
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function register_controls()
    {
        $this->register_content_section_controls();
        $this->register_setting_section();
        $this->register_style_content_controls();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <input class="data-post" type="hidden" data-expand="<?php echo $settings['setting_full_or_less'] ?>">
        <div class="team_member-wrapper">
            <h3 class="team_member-section-heading">
                <?php echo $settings['title_heading']; ?>
            </h3>
            <div class="team_member-section">
                <div class="team_member-section-list">
                    <div class="team_member-section-list-item" id="tab-board" onclick="openTab('board')">Board</div>
                    <div class="team_member-section-list-item" id="tab-leadership" onclick="openTab('leadership')">Leadership</div>
                </div>
                <!-- Query posts by term -->
                <?php
                $boards = $settings['list-board'];
                $board_posts = get_posts(array(
                    'post_type'  => 'teammembers',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => 'board',
                        ),
                    ),
                ));
                ?>
                <div class="team_member-section-posts" id="board">
                    <div class="team_member-section-posts-desc">
                        <?php echo $settings['title_board_desc']; ?>
                    </div>
                    <?php
                    if ($settings['setting_board'] == '') :
                        foreach ($board_posts as $board) :
                            $getBoard = get_post($board);
                    ?>
                            <div class="team_member-section-posts-item">
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink($board) ?>" class="post-content-title">
                                        <?php echo get_the_post_thumbnail($board, 'thumbnail'); ?>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a href="<?php the_permalink($board) ?>" class="post-content-title">
                                        <?php echo $getBoard->post_title ?>
                                    </a>
                                    <div class="post-content-info">
                                        <div class="info-position">
                                            <?php the_field('member_position', $board) ?>
                                        </div>
                                        <div class="info-term">
                                            <?php the_field('member_term', $board) ?>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <?php echo $getBoard->post_content; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        foreach ($boards as $board) :
                            $getBoard = get_post($board['repeater-board']);
                        ?>
                            <div class="team_member-section-posts-item">
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink($board['repeater-board']) ?>" class="post-content-title">
                                        <?php echo get_the_post_thumbnail($board['repeater-board'], 'thumbnail'); ?>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a href="<?php the_permalink($board['repeater-board']) ?>" class="post-content-title">
                                        <?php echo $getBoard->post_title ?>
                                    </a>
                                    <div class="post-content-info">
                                        <div class="info-position">
                                            <?php the_field('member_position', $board['repeater-board']) ?>
                                        </div>
                                        <div class="info-term">
                                            <?php the_field('member_term', $board['repeater-board']) ?>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <?php echo $getBoard->post_content; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <!-------------- Leadership ----------------->
                <!-- Query posts by term -->
                <?php
                $leaderships = $settings['list-leadership'];
                ?>
                <div class="team_member-section-posts" id="leadership">
                    <div class="team_member-section-posts-desc">
                        <?php echo $settings['title_leadership_desc']; ?>
                    </div>
                    <?php
                    if ($settings['setting_leadership'] == '') :
                        $leadership_posts = get_posts(array(
                            'post_type'  => 'teammembers',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'terms' => 'leadership',
                                ),
                            ),
                        ));
                        foreach ($leadership_posts as $leadership) :
                            $getLeadership = get_post($leadership);
                    ?>
                            <div class="team_member-section-posts-item">
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink($leadership) ?>" class="post-content-title">
                                        <?php echo get_the_post_thumbnail($leadership, 'thumbnail'); ?>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a href="<?php the_permalink($leadership) ?>" class="post-content-title">
                                        <?php echo $getLeadership->post_title ?>
                                    </a>
                                    <div class="post-content-info">
                                        <div class="info-position">
                                            <?php the_field('member_position', $leadership) ?>
                                        </div>
                                        <div class="info-term">
                                            <?php the_field('member_term', $leadership) ?>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <?php echo $getLeadership->post_content; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        foreach ($leaderships as $leadership) :
                            $getLeadership = get_post($leadership['repeater-leadership']);
                        ?>
                            <div class="team_member-section-posts-item">
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink($leadership['repeater-leadership']) ?>" class="post-content-title">
                                        <?php echo get_the_post_thumbnail($leadership['repeater-leadership'], 'thumbnail'); ?>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a href="<?php the_permalink($leadership['repeater-leadership']) ?>" class="post-content-title">
                                        <?php echo $getLeadership->post_title ?>
                                    </a>
                                    <div class="post-content-info">
                                        <div class="info-position">
                                            <?php the_field('member_position', $leadership['repeater-leadership']) ?>
                                        </div>
                                        <div class="info-term">
                                            <?php the_field('member_term', $leadership['repeater-leadership']) ?>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <?php echo $getLeadership->post_content; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="team_member-share">
                <?php
                if ('yes' === $settings['setting_share_btn']) {
                    echo '<button class="share-btn" type="button">Share<i class="fa-solid fa-link"></i></button>';
                }
                ?>
                <div class="share-block">
                    <?php echo do_shortcode('[social-share-display display="1653549193" force="true" archive="true" custom="true" url="' . $settings['share_button_url'] . '" message="' . $settings['sharing_message'] . '" image="' . $settings['sharing_img']['url'] . '" tweet="Custom tweet"]') ?>
                </div>
            </div>
            <?php
            if ($settings['setting_full_or_less'] == '') :
            ?>
                <div class="team_member-expand">
                    <span data-text-expand="<?php echo $settings['setting_expand_text'] ?>"><?php echo $settings['setting_expand_text'] ?></span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
