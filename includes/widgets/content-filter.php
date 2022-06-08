<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Content_Filter extends Widget_Base {

	public function get_name() {
		return 'ica-content-filter';
	}

	public function get_title() {
		return __( 'Content Filter', 'arpc-elementor-addon' );
	}

	public function get_icon() {
		return 'fa fa-filter';
	}

	public function get_categories() {
		return [ 'arpc-elementor-addon' ];
	}

  public function get_script_depends() {
		wp_register_script( 'elementor-addons-masonry', plugins_url( 'assets/js/masonry.pkgd.min.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-bloodhound', plugins_url( 'assets/js/typeahead/typeahead.bundle.min.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-content-filter-script', plugins_url( 'assets/js/content-filter.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-custom-frontend', plugins_url( 'assets/js/custom-frontend.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		$year_current = date( 'Y', current_time( 'timestamp', 1 ) ) ;

		wp_localize_script( 'elementor-addons-content-filter-script', 'ajaxObject', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'year_current' => $year_current ) );

		return [
			'elementor-addons-masonry',
			'elementor-addons-bloodhound' ,
			'elementor-addons-content-filter-script',
			'elementor-addons-custom-frontend',
		 ];
	}

  public function get_style_depends() {
		wp_register_style( 'elementor-addons-content-filter-style', plugins_url( 'assets/css/content-filter.css', __FILE__ ) , array() , ELEMENT_ADDON_VER );
		return [
			'elementor-addons-content-filter-style'
		 ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Settings', 'arpc-elementor-addon' ),
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Enter search term', 'arpc-elementor-addon' ),
			]
		);

		$this->add_control(
			'ica_suggestions',
			[
				'label' => __( 'Suggestions', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => 'lorem ipsum,dolor semet,sed it embaco',
			]
		);

		$this->add_control(
			'ajax_toggle',
			[
				'label' => __( 'Show results by ajax?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Yes', 'arpc-elementor-addon' ),
				'label_on' => __( 'No', 'arpc-elementor-addon' ),
				'return_value' => '1',
				'default' => '1',
			]
		);

		$this->add_control(
			'action_result',
			[
				'label' => __( 'Redirect to Page Result?', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( '', 'arpc-elementor-addon' ),
				'placeholder' => home_url().'/advanced-search/',
				'condition' => [
					'ajax_toggle' => '',
				],
			]
		);

		$this->add_control(
			'pagination_toggle',
			[
				'label' => __( 'Show/Hide Pagination?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'arpc-elementor-addon' ),
				'label_on' => __( 'ON', 'arpc-elementor-addon' )
			]
		);

		$this->add_control(
			'sortby_toggle',
			[
				'label' => __( 'Show/Hide Sortby?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'arpc-elementor-addon' ),
				'label_on' => __( 'ON', 'arpc-elementor-addon' ),
				'return_value' => '1',
				'default' => '1',
			]
		);

		$this->add_control(
			'content_toggle',
			[
				'label' => __( 'Default Content?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'HIDE', 'arpc-elementor-addon' ),
				'label_on' => __( 'SHOW', 'arpc-elementor-addon' )
			]
		);

		$this->add_control(
			'filter_toggle',
			[
				'label' => __( 'Default Filter?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'HIDE', 'arpc-elementor-addon' ),
				'label_on' => __( 'SHOW', 'arpc-elementor-addon' )
			]
		);

		$this->add_control(
			'show_filter_2',
			[
				'label' => __( 'Show Filter 2?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'HIDE', 'arpc-elementor-addon' ),
				'label_on' => __( 'SHOW', 'arpc-elementor-addon' )
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_filter_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Filter 1', 'arpc-elementor-addon' ),
			]
		);

		$this->add_control(
			'ica_source',
			[
				'label' => __( 'Source', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => [
					'resources'  => __( 'Resources', 'arpc-elementor-addon' ),
					'ins-faqs' => __( 'FAQs', 'arpc-elementor-addon' ),
					'post' => __( 'Post', 'arpc-elementor-addon' ),
					'page' => __( 'Page', 'arpc-elementor-addon' ),
					'team' => __( 'Team', 'arpc-elementor-addon' )
				],
				'label_block' => false,
				'default' => 'resources',
			]
		);

		$this->add_control(
			'ica_template_faq',
			[
				'label' => __( 'Templates', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => [
					'grid'  => __( 'Grid', 'arpc-elementor-addon' ),
					'list' => __( 'List', 'arpc-elementor-addon' ),
				],
				'label_block' => true,
				'default' => 'grid',
				'condition' => [
					'ica_source' => ['ins-faqs', 'page','team'],
				],
			]
		);

		$this->add_control(
			'ica_filters',
			[
				'label' => __( 'Filters by?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'resources-tags'  => __( 'Types', 'arpc-elementor-addon' ),
					'resources-topics' => __( 'Topic', 'arpc-elementor-addon' ),
					'date' => __( 'Date', 'arpc-elementor-addon' ),
				],
				'label_block' => true,
				'default' => [ 'resources-tags', 'resources-topics', 'date' ],
				'condition' => [
					'ica_source' => array('resources','ins-faqs'),
				]
			]
		);

		$this->add_control(
			'cat_type',
			[
				'label' => __( 'Types', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('resources-tags'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'select_team',
			[
				'label'       => __( 'Select Team', 'bears-elementor-extension' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->bears_show_post_team_for_select(),
				'default'     => [],
				'description' => __( 'Select post to be included', 'arpc-elementor-addon' ),
				'condition' => [
					'ica_source' => 'team',
				],
			]
		);

		$this->add_control(
			'cat_topic',
			[
				'label' => __( 'Topics', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('resources-topics'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'cat_faq',
			[
				'label' => __( 'Category', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT2,
				// 'options' => $this->get_supported_taxonomies('cat-faq'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'ins-faqs',
				],
			]
		);

		$this->add_control(
			'ex_cat_faq',
			[
				'label' => __( 'Exclude Category', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT2,
				// 'options' => $this->get_supported_taxonomies('cat-faq'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'ins-faqs',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'arpc-elementor-addon' ),
					'post_title' => __( 'Title', 'arpc-elementor-addon' ),
					'menu_order' => __( 'Custom', 'arpc-elementor-addon' ),
					'rand' => __( 'Random', 'arpc-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'arpc-elementor-addon' ),
					'desc' => __( 'DESC', 'arpc-elementor-addon' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_filter_2_section_controls() {
		$this->start_controls_section(
			'section_query_2',
			[
				'label' => __( 'Filter 2', 'arpc-elementor-addon' ),
				'condition' => [
					'show_filter_2' => 'yes',
				],
			]
		);

		$this->add_control(
			'ica_source_2',
			[
				'label' => __( 'Source', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => [
					'resources'  => __( 'Resources', 'arpc-elementor-addon' ),
					'ins-faqs' => __( 'FAQs', 'arpc-elementor-addon' ),
					'post' => __( 'Post', 'arpc-elementor-addon' ),
					'page' => __( 'Page', 'arpc-elementor-addon' )
				],
				'label_block' => false,
				'default' => 'resources',
			]
		);

		$this->add_control(
			'ica_template_faq_2',
			[
				'label' => __( 'Templates', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => [
					'grid'  => __( 'Grid', 'arpc-elementor-addon' ),
					'list' => __( 'List', 'arpc-elementor-addon' ),
				],
				'label_block' => true,
				'default' => 'grid',
				'condition' => [
					'ica_source_2' => ['ins-faqs', 'page'],
				],
			]
		);

		$this->add_control(
			'posts_per_page_2',
			[
				'label' => __( 'Posts Per Page', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'orderby_2',
			[
				'label' => __( 'Order By', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'arpc-elementor-addon' ),
					'post_title' => __( 'Title', 'arpc-elementor-addon' ),
					'menu_order' => __( 'Custom', 'arpc-elementor-addon' ),
					'rand' => __( 'Random', 'arpc-elementor-addon' ),
				],
			]
		);

		$this->add_control(
			'order_2',
			[
				'label' => __( 'Order', 'arpc-elementor-addon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'arpc-elementor-addon' ),
					'desc' => __( 'DESC', 'arpc-elementor-addon' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_form_section_controls(){
		$this->start_controls_section(
				'style_title_section',[
						'label' => __( 'Form', 'arpc-elementor-addon' ),
						'tab' => Controls_Manager::TAB_STYLE,
				 ]
		);

		$this->add_control(
				'ica_form_bg',
				[
						'label' => __( 'Background Color', 'arpc-elementor-addon' ),
						'type' => Controls_Manager::COLOR,
						'default' => 'transparent',
						'selectors' => [
								'{{WRAPPER}} .wrrap-content-filter' => 'background-color: {{VALUE}};',
						],
				]
		);

		$this->add_responsive_control(
				'ica_form_padding',
				[
						'label' => __( 'Padding Form', 'elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'selectors' => [
								'{{WRAPPER}} .wrrap-content-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
				]
		);

		$this->add_responsive_control(
				'ica_content_padding',
				[
						'label' => __( 'Padding Content', 'elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'selectors' => [
								'{{WRAPPER}} .list-grids' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
				]
		);

		$this->end_controls_section();
	}

	protected function get_supported_taxonomies($taxonomy) {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => $taxonomy,
	    'hide_empty' => false,
		) );
		if( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->slug] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	// function query post type team
	protected function bears_show_post_team_for_select(){
			$supported_ids = [];

			$wp_query = new \WP_Query( array(
					'post_type' => 'team',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'DESC',
			) );

			if ( $wp_query->have_posts() ) {
					while ( $wp_query->have_posts() ) {
							$wp_query->the_post();
							$supported_ids[get_the_ID()] = get_the_title();
					}
			}



			return $supported_ids;
	}

  protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_query_filter_section_controls();
		$this->register_query_filter_2_section_controls();
		$this->register_style_form_section_controls();
	}

	protected function render_icon( $icon ) {
		$icon_html = '';

		if( !empty( $icon['value'] ) ) {
			if( 'svg' !== $icon['library'] ) {
				$icon_html = '<i class="' . esc_attr( $icon['value'] ) . '" aria-hidden="true"></i>';
			} else {
				$icon_html = file_get_contents($icon['value']['url']);
			}
		}

		return $icon_html;
	}

  protected function render() {
		$settings = $this->get_settings_for_display();
		$placeholder = $settings['placeholder'];
		$filters = (!empty($settings['ica_filters'])) ? implode(',',$settings['ica_filters']) : '';
		$ajax = $settings['ajax_toggle'];
		$action = $settings['action_result'];
		echo do_shortcode('[ica_content_filter
			placeholder="'.$placeholder.'"
			suggestions="'.$settings['ica_suggestions'].'"
			filters="'.$filters.'"
			ajax="'.$ajax.'"
			action="'.$action.'"
			post_type="'.$settings['ica_source'].'"
			numberposts="'.$settings['posts_per_page'].'"
			orderby="'.$settings['orderby'].'"
			order="'.$settings['order'].'"
			default_filter="'.$settings['filter_toggle'].'"
			pagination="'.$settings['pagination_toggle'].'"
			showcontent="'.$settings['content_toggle'].'"
			sortby="'.$settings['sortby_toggle'].'"
			tags="'.($settings['cat_type'] ? implode(',',$settings['cat_type']) :'').'"
			topics="'.($settings['cat_topic'] ? implode(',',$settings['cat_topic']) : '').'"
			cats_faq="'.($settings['cat_faq'] ? implode(',',$settings['cat_faq']) : '').'"
			ex_cats_faq="'.($settings['ex_cat_faq'] ? implode(',',$settings['ex_cat_faq']) : '').'"
			template="'.($settings['ica_template_faq'] ? $settings['ica_template_faq'] : '').'"
			showfilter2="'.$settings['show_filter_2'].'"
			post_type2="'.$settings['ica_source_2'].'"
			numberposts2="'.$settings['posts_per_page_2'].'"
			orderby2="'.$settings['orderby_2'].'"
			order2="'.$settings['order_2'].'"
			template2="'.($settings['ica_template_faq_2'] ? $settings['ica_template_faq_2'] : '').'"
			select_team = "'.($settings['select_team'] ? implode(',',$settings['select_team']) : '').'"
		]');
	}

	protected function content_template() {

	}
}
