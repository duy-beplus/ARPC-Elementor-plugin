<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Query_Posts_Widget extends \Elementor\Widget_Base {
  public function get_name() {
      return 'custom-query-posts-widget';
  }

  public function get_title() {
      return __( 'Custom Query Posts');
  }

  public function get_icon() {
      return 'eicon-posts-grid';
  }

  public function get_categories() {
      return [ 'general' ];
  }

  public function get_keywords() {
    return [ 'query', 'posts' ];
  }

  public function get_style_depends() {
      wp_register_style( 'query_posts_style', plugins_url('assets/css/query-posts-style.css',__FILE__ ) );
      return [
          'query_posts_style'
      ];
  }

  public function get_script_depends() {
		wp_register_script( 'query_posts_script', plugins_url( 'assets/js/query-posts-script.js', __FILE__ ) );
		return [
			'query_posts_script'
		];
	}

  protected function register_controls() {
    // Start Content Tab
    //Settings section
    $this->start_controls_section(
    'settings_section',
      [
        'label' => esc_html__( 'Settings', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
        'placeholder',
        [
            'label' => esc_html__( 'Placeholder', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 1,
            'default' => esc_html__( 'Placeholder...', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'button_text',
        [
            'label' => esc_html__( 'Button Text', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 1,
            'default' => esc_html__( 'Search', 'arpc-elementor-addon' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'suggestions',
        [
            'label' => esc_html__( 'Suggestions', 'arpc-elementor-addon' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 2,
            'default' => esc_html__( 'lorem ipsum, dolor semet, sed it embaco', 'arpc-elementor-addon' ),
            'label_block' => true,
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

    $this->end_controls_section();
    // End Settings section

    // Start Filters section
    $this->start_controls_section(
    'filters_section',
      [
        'label' => esc_html__( 'Filters', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'post' => __( 'Post', 'arpc-elementor-addon' ),
				],
				'label_block' => false,
				'default' => 'resources',
			]
		);

		$this->add_control(
			'ica_filters',
			[
				'label' => __( 'Filters by?', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'resources-tags'  => __( 'Tags', 'arpc-elementor-addon' ),
					'resources-topics' => __( 'Topics', 'arpc-elementor-addon' ),
					'date' => __( 'Date', 'arpc-elementor-addon' ),
				],
				'label_block' => true,
				'default' => [ 'resources-tags', 'resources-topics', 'date' ],
			]
		);

		$this->add_control(
			'cat_tags',
			[
				'label' => __( 'Tags', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('resources-tags'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'cat_topics',
			[
				'label' => __( 'Topics', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('resources-topics'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'arpc-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'arpc-elementor-addon' ),
					'desc' => __( 'DESC', 'arpc-elementor-addon' ),
				],
			]
		);

    $this->end_controls_section();
    // End Filters section

    // Start Style Tab
      // Style
    $this->start_controls_section(
      'form_style_section',
      [
        'label' => esc_html__( 'Style Form', 'arpc-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Form Typography', 'arpc-elementor-addon' ),
        'name' => 'faqs_heading_typography',
        'selector' => [
          '{{WRAPPER}} .search-input',
          '{{WRAPPER}} .btn-seacrh',
        ],
      ]
    );

    $this->end_controls_section();
    // End Style Tab
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

  protected function render() {
    $settings = $this->get_settings_for_display();

    //start date
    if(isset($_GET['start_date']) && $_GET['start_date'] != ''){
      $start_date = $_GET['start_date'];
    }

    //end date
    if(isset($_GET['end_date']) && $_GET['end_date'] != ''){
      $end_date = $_GET['end_date'];
    }
    ?>
    <!-- Search post form -->
    <div id="search-posts-form">
      <!-- Search Input -->
      <div class="search-block">
        <input class="search-input" type="text" name="" value="" placeholder="<?php echo $settings['placeholder'] ?>">
        <button class="btn-seacrh" type="button" name="button"><?php echo $settings['button_text'] ?></button>
      </div>
      <!-- /Search Input -->
      <!-- Suggestions and Filters -->
      <div class="filter-suggestions">
        <div class="load-suggestions">
          <span>Suggestions:</span>
          <div class="list-suggestions">
            <span>lorem ipsum, dolor semet, sed it embaco</span>
          </div>
        </div>
        <button type="button" name="button">
          <i class="fa-solid fa-chevron-down"></i>
          Filters
        </button>
      </div>
      <!-- /Suggestions and Filters -->
      <!-- Select date range -->
      <?php $years = date('Y',current_time( 'timestamp', 1 )); ?>

      <div class="date-range-block">
        <div class="select-date-start">
          <select name="date-range-start">
            <option value=""><?php echo __('Select start year','arpc-elementor-addon') ?></option>
            <?php for ($i=2018; $i <= $years; $i++) {
              $selected = ($i == $start_date) ? 'selected="selected"' : '';
              ?><option value="<?php echo $i ?>" <?php echo $selected; ?>><?php echo $i ?></option><?php
            } ?>
          </select>
        </div>
        <div class="select-date-end">
          <select name="date-range-end">
            <option value=""><?php echo __('Select end year','arpc-elementor-addon') ?></option>
            <?php for ($i=2018; $i <= $years; $i++) {
              $selected = ($i == $end_date) ? 'selected="selected"' : '';
              ?><option value="<?php echo $i ?>" <?php echo $selected; ?>><?php echo $i ?></option><?php
            } ?>
          </select>
        </div>
      </div>
      <!-- /Select date range -->
      <!-- Select Tag -->
      <div class="seclect-tag-block">
        <div class="select-tag-title">
          <span>Select by tag</span>
        </div>
        <div class="seclect-tag-wrapper">
          <?php
          foreach ( $settings['cat_tags'] as $option ) {
          ?>
          <div class="tag-item">
            <span><?php echo $option ?></span>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- /Select Tag -->
      <!-- Select Topic -->
      <div class="seclect-topic-block">
        <div class="select-topic-title">
          <span>Select by topic</span>
        </div>
        <div class="seclect-topic-wrapper">
          <?php
      $taxonomies = get_object_taxonomies( 'resources', 'objects' );
      foreach( $taxonomies as $taxonomy ){
        $terms = get_terms('resources-topics',
          array(
            'taxonomy' => $taxonomy->name,
            'hide_empty' => false,
          )
        );
      }
      foreach( $terms as $term ){
      ?>
          <div class="topic-item">
            <span><?php echo $term->name; ?></span>
          </div>
      <?php } ?>
        </div>
      </div>
      <!-- /Select Topic -->
      <!-- Clear filters block -->
      <div class="clear-filters-block">
        <button class="btn-clear-filters" type="button" name="button"><i class="fa-solid fa-xmark"></i>Clear all filters</button>
      </div>
      <!-- Clear filters block -->
    </div>
    <div class="post-grid-container">
      <?php
      $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page'  => '3',
        'paged' => 1,
        );
        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) :
            while ( $the_query->have_posts() ):
               $the_query->the_post();
       ?>
       <!-- Item Blog post -->
       <div class="item-post-block">
         <a href="<?php the_permalink();?>">
        <div class="post-thumbnail">
          <?php the_post_thumbnail(); ?>
        </div>
        </a>
        <div class="post-content">
          <a href="<?php the_permalink();?>">
              <h3 class="post_title"> <?php the_title(); ?></h3>
          </a>
          <div class="post-excerpt">
            <?php the_excerpt(); ?>
          </div>
          <a href="#">Action link <i class="fa-solid fa-chevron-right"></i></a>
        </div>
       </div>
       <!-- /Item Blog post -->
       <?php
        endwhile;
        wp_reset_postdata();
        else: echo '<h2 class="text-warning">Nothing in here now!</h2>';
        endif;
      ?>
    </div>
    <?php
  }
}
