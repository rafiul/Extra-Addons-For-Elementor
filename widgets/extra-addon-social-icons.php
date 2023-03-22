<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // If this file is called directly, abort.
}
// Elementor Classes.
use \Elementor\Controls_Stack;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

/**
 * Class Extra_Addon_Social_Icons
 */
class Extra_Addon_Social_Icons extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'extra_addon_social_icons';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Social Icons', EAFE_TEXT_DOMAIN );
	}

	/**
	 * Retrieve Widget Icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string widget icon.
	 */
	public function get_icon() {
		return 'dashicons dashicons-networking';
	}

	/**
	 * Retrieve Widget Categories.
	 *
	 * @since 1.5.1
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'extra_addons_for_elementor' );
	}

	/**
	 * Retrieve Widget Dependent CSS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array CSS style handles.
	 */
	public function get_keywords() {
		return array( 'extra', 'socials', 'social', 'icon' );
	}

	/**
	 * Register Title controls.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->start_controls_section(
			'extra_addon_social_icons_start',
			array(
				'label' => __( 'Content', EAFE_TEXT_DOMAIN ),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'social_link',
			[
				'label' => esc_html__( 'Social Link', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
				'label_block' => true,
			]
		);
		$this->add_control(
			'easi_social_links',
			array(
				'label'       => __( 'Social Links', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::REPEATER,
				'label_block' => true,
				'fields' => $repeater->get_controls(),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'easi_social_links_addons',
			[
				'label' => __( 'Social Links', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'easi_social_link_tabs'
		);
		$this->start_controls_tab(
			'easi_social_link_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'easi_social_links_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'easi_social_links_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'easi_social_links_size',
			[
				'label' => esc_html__( 'Font Size', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'rem', 'em' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'rem' => [
						'min' => 1,
						'max' => 3,
					],
					'em' => [
						'min' => 1,
						'max' => 3,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'easi_social_links_width',
			[
				'label' => esc_html__( 'Icon Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'%' => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 20,
						'max' => 100,
					],
					'vw' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'easi_social_links_height',
			[
				'label' => esc_html__( 'Icon Height', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'easi_social_links_border_radius',
				'selector' => '{{WRAPPER}} .easi-social-links-container .social-link a',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'easi_social_links_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'easi_social_links_padding',
			[
				'label' => __( 'Icon Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'easi_social_links_margin',
			[
				'label' => __( 'Icon Margin Between', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'easi_social_links_wrap_margin',
			[
				'label' => __( 'Wrapper Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'easi_social_link_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'easi_social_links_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'easi_social_links_hover_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easi-social-links-container .social-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$easi_social_links = $settings['easi_social_links'];
		?>
		<div class="easi-social-links-wrapper">
			<div class="easi-social-links-inner">
				<div class="easi-social-links-container">
					<?php
					foreach( $easi_social_links as $social_link ) :
					?>
					<div class="social-link">
						<a href="<?php echo esc_url($social_link['social_link']);?>" class="<?php echo esc_attr($social_link['social_icon']['value']);?>"></a>
					</div>
				<?php endforeach;?>
				</div>
			</div>
		</div>
		<?php
	}
}
