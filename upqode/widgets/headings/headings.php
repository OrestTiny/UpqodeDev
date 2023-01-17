<?php
namespace Elementor;

class Upqode_Heading extends Widget_Base {

	public function get_name() {
		return 'upqode-heading';
	}

	public function get_title() {
		return 'Upqode Heading';
	}

	public function get_icon() {
		return 'dashicons dashicons-heading';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'upqode' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'upqode' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My title' , 'upqode' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'upqode' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'There is some text for my subtitle' , 'upqode' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'upqode-heading', UPQODE_T_URI . '/widgets/headings/assets/css/heading.css' );
	}

	public function get_style_depends() {
		return [ 'upqode-heading' ];
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>
		<div class="upqode-heading">

            <?php if ( ! empty( $settings['title'] ) ) { ?>
                <h2 class="upqode-heading__title">
                    <?php echo esc_html( $settings['title']); ?>
                </h2>
            <?php } ?>

            <?php if ( ! empty( $settings['subtitle'] ) ) { ?>
                <p class="upqode-heading__subtitle">
                    <?php echo esc_html( $settings['subtitle']); ?>
                </p>
            <?php } ?>

		</div>
		<?php
	}

}