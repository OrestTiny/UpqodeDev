<?php

namespace Elementor;

class Upqode_Banner_Slider extends Widget_Base {

	public function get_name() {
		return 'upqode-banner-slider';
	}

	public function get_title() {
		return 'Upqode Banner Slider';
	}

	public function get_icon() {
		return 'dashicons dashicons-format-gallery';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		wp_register_style( 'upqode-banner-slider', UPQODE_T_URI . '/widgets/banner-slider/assets/css/banner-slider.css' );
		wp_register_script( 'upqode-banner-slider-js', UPQODE_T_URI . '/widgets/banner-slider/assets/js/banner-slider.min.js', [
			'elementor-frontend',
			'swiper'
		], '1.0.0', true );
	}


	public function get_script_depends() {
		return [ 'swiper', 'upqode-banner-slider-js' ];
	}

	public function get_style_depends() {
		return [ 'upqode-banner-slider' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'upqode' ),
			]
		);

		$banner_slides = new Repeater();

		$banner_slides->add_control(
			'slide_bg_image',
			[
				'label'       => esc_html__( 'Background Image', 'upqode' ),
				'type'        => Controls_Manager::MEDIA,
				'placeholder' => esc_html__( 'Select image', 'upqode' ),
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$banner_slides->add_control(
			'slide_heading', [
				'label'       => esc_html__( 'Heading', 'upqode' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'upqode' ),
				'label_block' => true,
			]
		);

		$banner_slides->add_control(
			'slide_description', [
				'label'       => esc_html__( 'Short Description', 'upqode' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'There is some text for short description', 'upqode' ),
				'label_block' => true,
			]
		);

		$banner_slides->add_control(
			'slide_btn_text', [
				'label'       => esc_html__( 'Button text', 'upqode' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Button', 'upqode' ),
				'label_block' => true,
			]
		);

		$banner_slides->add_control(
			'slide_btn_url', [
				'label'       => esc_html__( 'Button URL', 'upqode' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'upqode' ),
				'default'     => [
					'url' => '',
				]
			]
		);

		$banner_slides->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Description paddings', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{CURRENT_ITEM}} .upqode-banner-slider__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'banner_slides',
			[
				'label'  => esc_html__( 'Banner slides', 'upqode' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $banner_slides->get_controls(),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'upqode' ),
			]
		);
		$this->add_control(
			'slider_autoplay', [
				'label'       => esc_html__( 'Autoplay', 'upqode' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '5000', 'upqode' ),
				'description' => esc_html__( 'Enter autoplay speed(in ms). 0 - autoplay off.', 'aheto' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>
        <div class="upqode-banner-slider">
			<?php if ( ! empty( $settings['banner_slides'] ) ) {
			    $autoplay = isset($settings['slider_autoplay']) && !empty($settings['slider_autoplay']) ? $settings['slider_autoplay'] : 5000; ?>
                <div class="swiper-container" data-autoplay="<?php echo esc_attr($autoplay); ?>">
                    <div class="swiper-wrapper">
						<?php foreach ( $settings['banner_slides'] as $slide ) :

							if ( empty( $slide['slide_bg_image'] ) && empty( $slide['slide_heading'] ) && empty( $slide['slide_description'] ) && empty( $slide['slide_btn_text'] ) ) {
								continue;
							}

							$bg_image = isset( $slide['slide_bg_image']['url'] ) && ! empty( $slide['slide_bg_image']['url'] ) ? 'style="background-image: url(' . esc_url( $slide['slide_bg_image']['url'] ) . ')"' : ''; ?>

                            <div class="swiper-slide">
                                <div class="upqode-banner-slider__content elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>" <?php echo $bg_image; ?>>
									<?php if ( ! empty( $slide['slide_heading'] ) ) { ?>
                                        <h2 class="upqode-banner-slider__heading"><?php echo wp_kses( $slide['slide_heading'], 'post' ); ?></h2>
									<?php } ?>
									<?php if ( ! empty( $slide['slide_description'] ) ) { ?>
                                        <div class="upqode-banner-slider__description"><?php echo wp_kses( $slide['slide_description'], 'post' ); ?></div>
									<?php } ?>
									<?php if ( ! empty( $slide['slide_btn_text'] ) && isset( $slide['slide_btn_url']['url'] ) && ! empty( $slide['slide_btn_url']['url'] ) ) { ?>
                                        <a href="<?php echo esc_url( $slide['slide_btn_url']['url'] ); ?>"
                                           class="upqode-banner-slider__btn"
                                           target="_self"><?php echo esc_html( $slide['slide_btn_text'] ); ?></a>
									<?php } ?>
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

			<?php } ?>
        </div>
		<?php
	}

}