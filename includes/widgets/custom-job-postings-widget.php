<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Job_Postings_Widget extends \Elementor\Widget_Base {
  public function get_name() {
      return 'custom-job-postings-widget';
  }

  public function get_title() {
      return __( 'Custom Job Postings');
  }

  public function get_icon() {
      return 'eicon-post-list';
  }

  public function get_categories() {
      return [ 'general' ];
  }

  public function get_keywords() {
    return [ 'job', 'postings' ];
  }

  public function get_style_depends() {
      wp_register_style( 'job_postings_style', plugins_url('assets/css/job-postings-style.css',__FILE__ ) );
      return [
          'job_postings_style'
      ];
  }

  public function get_script_depends() {
		wp_register_script( 'job_postings_script', plugins_url( 'assets/js/job-postings-script.js', __FILE__ ) );
		return [
			'job_postings_script'
		];
	}

  protected function render() {
    $settings = $this->get_settings_for_display();

    $args = array(
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'posts_per_page'  => '9',
      'order'          => 'DESC',
      'orderby'        => 'date',
      );
      $the_query = new WP_Query( $args );
      if($the_query->have_posts() ) :
          while ( $the_query->have_posts() ):
             $the_query->the_post();
    ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php
  }
}
