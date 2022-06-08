<?php

namespace Community_Elementor_Addon;

if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
class Plugin
{
	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';
	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{
		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}
	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'arpc-elementor-addon'),
			'<strong>' . esc_html__('ARPC Elementor Addon', 'arpc-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'arpc-elementor-addon') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'arpc-elementor-addon'),
			'<strong>' . esc_html__('ARPC Elementor Addon', 'arpc-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'arpc-elementor-addon') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'arpc-elementor-addon'),
			'<strong>' . esc_html__('Flexbox Elementor Addon', 'arpc-elementor-addon') . '</strong>',
			'<strong>' . esc_html__('PHP', 'arpc-elementor-addon') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init()
	{
		// Load translation
		// add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		// add_action( 'plugins_loaded', array( $this, 'init' ) );

		// Register widget styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		//Content Filter
		add_shortcode( 'ica_content_filter', array( $this, 'ica_content_filter_render' ) );
		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		add_action('elementor/controls/register', [$this, 'register_controls']);

		//Action Load ajax
		add_action( 'wp_ajax_load_filter_data', array( $this, 'load_filter_data_ajax' )  );
		add_action( 'wp_ajax_nopriv_load_filter_data', array( $this, 'load_filter_data_ajax' ) );

	}

	function void_grid_post_type(){
 		$args= array(
 				'public'	=> 'true',
 				'_builtin'	=> false
 			);
 		$post_types = get_post_types( $args, 'names', 'and' );
 		$post_types = array( 'post'	=> 'post' ) + $post_types;
 		return $post_types;
 	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */

	 public function widget_styles() {

	}

	public function widget_scripts() {
	
	}

	// public function __construct() {
	//
	// 	// // Register widget styles
	// 	// add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );
	// 	//
	// 	// // Register widget scripts
	// 	// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
	//
	// 	// Register widgets
	// 	// add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	//
	// 	// Register editor scripts
	// 	// add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
	//
	// 	// Register category
	// 	// add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
	//
	// 	$this->add_page_settings_controls();
	// }

	//----------------Search Content Filter-------------
	public function ica_content_filter_render( $atts ) {
	$atts = shortcode_atts( array(
			'placeholder' => 'Search...',
			'suggestions' => '',
			'filters' => array(),
			'ajax'	=> true,
			'default_filter' => true,
			'action' => '',
			'post_type' => 'resources',
			'numberposts' => 6,
			'orderby'	=> 'post_date',
			'order' => "DESC",
			'pagination' => '',
			'showcontent' => '',
			'sortby'	=> '',
			'types'	=> '',
			'topics' => '',
			'cats_faq' => '',
			'ex_cats_faq' => '',
			'template' => '',
			'post_type2' => '',
			'showfilter2' => '',
			'numberposts2' => '',
			'orderby2' => '',
			'order2' => '',
			'template2' => '',
			'select_team' => ''
	), $atts, 'ica_content_filter' );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	ob_start();
	include(ELEMENT_ADDON_TEMPLATE.'content-filter/form-search.php');
	return ob_get_clean();
}

/**
* Ajax Content Filter
* @access private
*/

public function load_filter_data_ajax(){

	$result = array();

	$key = $_POST['key'];
	$filters = $_POST['filters'];
	$paged = $_POST['paged'];
	$pagination = $_POST['pagination'];
	$option = $_POST['option'];
	$sortby		 = $_POST['sortby'];
	$cats_faq  = $_POST['cats_faq'];
	$ex_cats_faq  = $_POST['ex_cats_faq'];
	$type_filter = $_POST['type_filter'];
	$numberposts = $_POST['numberposts'];
	$orderby = $_POST['orderby'];
	$order =  $_POST['order'];
	$post_type = $_POST['post_type'];
	$template  =   $_POST['template'];
	$select_team  =   $_POST['select_team'];

	$args = array(
		'post_type' 		 => $post_type,
		'post_status' 	 => 'publish',
		'posts_per_page' => $numberposts,
		'orderby' 	 		 => $orderby,
		'order' 		 		 => $order,
		'paged' 		 		 => $paged,
		 's' 						 => $key
	);

	//Page
	if($post_type == 'page'){
		$args['meta_query'][] = array(
				'key' => 'is_not_search_page',
				'value' =>	'1',
				'compare' => '!='
		);
	}

	// Team
	if($post_type == 'team' && $select_team != ''){
		$args['post__in'] = explode(',',$select_team);
	}

	//Resources
	if(trim($key) != '' && $post_type == 'resources'){
		$args['meta_query'][] = array(
				'key' => 'content_file',
				'value' =>	$key,
				'compare' => 'LIKE'
		);
		$args['_search_key'] = $key;
	}else{
		$args['s'] = $key;
	}


	if(!empty($filters)){
		$args['tax_query']['relation'] = 'AND';

		foreach ($filters as $key => $filter) {
			if($filter['name'] !== 'post_date'){
				$args['tax_query'][] = array(
						'taxonomy' => $filter['name'],
						'field'    => 'slug',
						'terms'    => $filter['value']
				);
			}
			if($filter['name'] == 'post_date' && $filter['value'] !== ','){
				$args['search_date'] = $filter['value'];
			}
		}
	}

	//FAQs
	if(!empty($cats_faq)){
		$args['tax_query'][] = array(
				'taxonomy' => 'cat-faq',
				'field'    => 'slug',
				'terms'    => explode(',',$cats_faq)
		);
	}
	if(!empty($ex_cats_faq)){
		$args['tax_query'][] = array(
				'taxonomy' => 'cat-faq',
				'field'    => 'slug',
				'operator' => 'NOT IN',
				'terms'    => explode(',',$ex_cats_faq)
		);
	}

	//Tags
	if(!empty($cats_tag)){
		$args['tax_query'][] = array(
				'taxonomy' => 'resources-tags',
				'field'    => 'slug',
				'terms'    => explode(',',$cats_tag)
		);
	}

	ob_start();
	add_filter('posts_where', array($this, 'ica_title_filter') , 10, 2 );
	$the_query = new WP_Query($args);
	$_GLOBAL['wp_query'] = $the_query;
	remove_filter('posts_where', array($this, 'ica_title_filter') , 10, 2 );
	$totalpost = (($numberposts*($paged-1)) + $the_query->post_count);

	//Top content filter
	if($paged < 2){
		if(!empty($filters)){
			foreach ($filters as $key => $filter) {
				if($filter['name'] == 'resources-tags'){
					?>
					<div class="filter-selected">
							<label for="">Selected filters by “Tags”</label>
							<div class="list-selected">
								<?php foreach ($filter['value'] as $key => $val) {
									$text = ucwords(str_replace('-',' ',$val));
									?><span class="item-filter"><?php echo $text; ?> <i class="fa fa-times" data-filter="<?php echo $val;?>"></i></span><?php
								} ?>
							</div>
					</div>
					<?php
					break;
				}

			}
		}
		if($sortby):
			?>
			<div class="sort-by-content">
				<div class="info-numberposts">Showing <span class="totalpost"><?php echo $totalpost ?></span> of <?php echo $the_query->found_posts; ?> results</div>
				<div class="btn-sortby <?php echo ($option == 'sortby') ? '__is-actived' : ''; ?>">
					<span>Sort by <i class="fa fa-angle-down" aria-hidden="true"></i></span>
					<div class="content-sortby" data-type_filter="<?php echo $type_filter; ?>" style="display:<?php echo ($option == 'sortby') ? 'block' : 'none'; ?>">
							<div class="item-sortby <?php echo $orderby == 'post_date' ? '__is-actived' : ''; ?>" data-order="<?php echo $orderby == 'post_date' ? $order : 'desc'; ?>" data-orderby="post_date">
								Date <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
							</div>
							<div class="item-sortby <?php echo $orderby == 'title' ? '__is-actived' : ''; ?>" data-order="<?php echo $orderby == 'title' ? $order : 'desc'; ?>" data-orderby="title">
								A-Z <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
							</div>
					</div>
				</div>
			</div>
			<?php
		endif;
	}

	// The Loop
	if ( $the_query->have_posts() ) {
			$countpost = $the_query->found_posts;
			$item = 0;

			if($paged < 2){ ?> <div class="list-grids template-<?php echo $post_type.($template ? '-'.$template:''); ?>"> <?php }
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					include(ELEMENT_ADDON_TEMPLATE.'content-filter/item-'.$post_type.($template ? '-'.$template:'').'.php');
				}
			if($paged < 2){ ?></div> <?php }
	} else {
			$countpost = 0;
			?> <div class="not-found">
				<i class="fa fa-frown-o" aria-hidden="true"></i>
				<div><?php echo __("No found result!"); ?></div>
			</div> <?php
	}

	if($pagination && $the_query->max_num_pages > $paged && $paged < 2){
		?><div class="content-filter-pagination"><button type="button" name="button-showmore" data-type_filter="<?php echo $type_filter; ?>">Show more</button></div><?php
	}

	//Top content filter
	if($paged < 2){
		if(!empty($filters)){
			foreach ($filters as $key => $filter) {
				if($filter['name'] == 'resources-topics'){
					?>
					<div class="filter-selected">
							<label for="">Selected filters by “Topic”</label>
							<div class="list-selected">
								<?php foreach ($filter['value'] as $key => $val) {
									$text = ucwords(str_replace('-',' ',$val));
									?><span class="item-filter"><?php echo $text; ?> <i class="fa fa-times" data-filter="<?php echo $val;  ?>"></i></span><?php
								} ?>
							</div>
					</div>
					<?php
					break;
				}

			}
		}
	}

	//check pagination
	if($_GLOBAL['wp_query']->max_num_pages == $paged){
		$result['pagination'] = false;
	}else{
		$result['pagination'] = true;
	}

	$result['html'] = ob_get_clean();

	$result['countpost'] = $countpost;
	$result['totalpost'] = $totalpost;
	$result['global'] = $cats_faq;

	wp_send_json($result);
}

public function ica_title_filter( $where, &$wp_query ){
		global $wpdb;

		if ( $_search_key = $wp_query->get( '_search_key' ) ) {
			$like_sql = ' OR (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $_search_key ) ) . '%\')';
			$like_sql .= ' OR (' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql( $wpdb->esc_like( $_search_key ) ) . '%\')';
			$like_sql .= ' OR (' . $wpdb->posts . '.post_excerpt LIKE \'%' . esc_sql( $wpdb->esc_like( $_search_key ) ) . '%\')';
			$where = str_replace(
				") AND ".$wpdb->posts.".post_type",
				$like_sql." ) AND ".$wpdb->posts.".post_type",
				$where
			);
		}

		if ( $search_date = $wp_query->get( 'search_date' ) ) {
				$date = explode(',',$search_date);
				if($date[0] && !$date[1])
						$where .= " AND post_date >= '".$date[0]."-01-01'";
				if(!$date[0] && $date[1])
						$where .= " AND post_date <= '".$date[1]."-12-31'";
				if($date[0] && $date[1])
						$where .= " AND post_date >= '".$date[0]."-01-01'  AND post_date <= '".$date[1]."-12-31'";
		}

		return $where;

}
//-------------End Search Content Filter--------------

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		// Community Content widget by Tuan
		require_once(__DIR__ . '/widgets/community-content-widgets.php');
		$widgets_manager->register(new \Community_Content_Widgets());

		//Content widget by Tuan
		require_once(__DIR__ . '/widgets/community-faq-widget.php');
		$widgets_manager->register(new \Community_FAQ_Widgets());

		//Custom Job Postings widget by Tuan
		require_once(__DIR__ . '/widgets/custom-job-postings-widget.php');
		$widgets_manager->register(new \Custom_Job_Postings_Widget());

		// Custom Postcodes Filter widget by Tuan
		require_once(__DIR__ . '/widgets/postcodes-filter.php');
		$widgets_manager->register(new \Postcodes_Filter_Widgets());

		// Login section widget by Duy
		require_once(__DIR__ . '/widgets/custom-login_section.php');
		$widgets_manager->register(new \CustomLoginSectionWidget);

		// Featured section widget by Duy
		require_once(__DIR__ . '/widgets/custom-tropical_section.php');
		$widgets_manager->register(new \CustomTropicalSectionWidget);

		// Customer section widget by Duy
		require_once(__DIR__ . '/widgets/custom-customer-section.php');
		$widgets_manager->register(new \CustomCustomerSectionWidget);

		// Culture section widget by Duy
		require_once(__DIR__ . '/widgets/custom-culture-section.php');
		$widgets_manager->register(new \CustomCultureSectionWidget);

		// Team member widget by Duy
		require_once(__DIR__ . '/widgets/team-member-widget.php');
		$widgets_manager->register(new \TeamMemberWidget);

		// Recruitment widget by Duy
		require_once(__DIR__ . '/widgets/recruitment-section.php');
		$widgets_manager->register(new \RecruitmentSectionWidget);
	}

	/**
	 * Register Controls
	 *
	 * Load controls files and register new Elementor controls.
	 *
	 * Fired by `elementor/controls/register` action hook.
	 *
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 */
	public function register_controls($controls_manager)
	{
	}
}
