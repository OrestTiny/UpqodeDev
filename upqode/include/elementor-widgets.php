<?php
if ( ! class_exists( 'Upqode_Elementor_Widgets' ) ) {
	class Upqode_Elementor_Widgets {

		protected static $instance = null;

		public static function get_instance() {
			if ( ! isset( static::$instance ) ) {
				static::$instance = new static;
			}

			return static::$instance;
		}

		protected function __construct() {
			require_once UPQODE_T_PATH . '/widgets/banner-slider/banner-slider.php';
			require_once UPQODE_T_PATH . '/widgets/headings/headings.php';
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		}

		public function register_widgets() {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Upqode_Banner_Slider() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Upqode_Heading() );
		}

	}
}

if ( ! function_exists( 'upqode_elementor_init' ) ) {

	function upqode_elementor_init() {
		Upqode_Elementor_Widgets::get_instance();
	}
	add_action( 'init', 'upqode_elementor_init' );

}