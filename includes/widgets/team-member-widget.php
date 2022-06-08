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
        $this->add_control(
            'title_board_desc',
            [
                'label' => 'Board Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => 'false'
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
        $this->end_controls_section();
    }
    protected function register_setting_section()
    {
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
        global $wp_post_types;
        $getPosts = $wp_post_types['teammembers'];
        $getCate = get_categories($getPosts->taxonomies);
        // print_r($getCate)
?>
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
                $custom_terms = get_terms('category');
                ?>
                <input class="data-post" type="hidden" data-number-post="<?php echo $getNumberPost = 10 ?>" data-expand="<?php echo $settings['setting_full_or_less'] ?>">
                <?php
                foreach ($custom_terms as $custom_term) :
                    wp_reset_query();
                    $args = array(
                        'post_type' => 'teammembers',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $custom_term->name,
                            ),
                        ),
                        'posts_per_page' => $getNumberPost,
                    );
                    $loop = new WP_Query($args);
                ?>
                    <div class="team_member-section-posts" id="<?php echo $custom_term->slug ?>">
                        <div class="team_member-section-posts-desc">
                            <?php if ($custom_term->slug == 'board') :
                                echo $settings['title_board_desc'];
                            else :
                                echo $settings['title_leadership_desc'];
                            endif;
                            ?>
                        </div>
                        <?php
                        if ($loop->have_posts()) :
                            while ($loop->have_posts()) : $loop->the_post();
                        ?>
                                <div class="team_member-section-posts-item">
                                    <div class="post-thumbnail">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                    <div class="post-content">
                                        <a href="<?php the_permalink() ?>" class="post-content-title">
                                            <?php the_title() ?>
                                        </a>
                                        <div class="post-content-info">
                                            <?php the_field('member_position') ?>
                                            <?php the_field('member_term') ?>
                                        </div>
                                        <div class="post-content-desc">
                                            <?php the_content() ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
                    </div>

                <?php
                endforeach;
                ?>

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
