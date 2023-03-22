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
use \Elementor\Group_Control_Image_Size;
/**
 * Class Extra_Addon_Author_Bio
 */
class Extra_Addon_Author_Bio extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'extra_addon_author_bio';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Author Bio', EAFE_TEXT_DOMAIN );
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
		return 'dashicons dashicons-admin-users';
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
		return array( 'extra', 'author', 'bio', 'author bio' );
	}

	/**
	 * Register Title controls.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->start_controls_section(
			'extra_addon_author_bio_content',
			array(
				'label' => __( 'Content', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'eaab_image',
			[
				'label' => esc_html__( 'Author Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'eaab_image_size',
				'default' => 'large',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);
		$this->add_control(
			'eaab_author_name',
			array(
				'label'       => __( 'Name', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Abdullah Al Imran', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'			=> 3,
			)
		);
		$this->add_control(
			'eaab_author_profession',
			array(
				'label'       => __( 'Profession', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'WordPress Developer', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 3,
			)
		);
		$this->add_control(
			'eaab_author_descriptions',
			array(
				'label'       => __( 'Description', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'Hi, I am Abdullah Al Imran an full stack professional WordPress developer. Contributor of WordPress plugins and themes development market. ', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 5,
			)
		);
		$this->add_control(
			'eaab_show_social_links',
			[
				'label'        => __( 'Show Social Links', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);

		$this->end_controls_section();

		/**
		 * Start Section Title Style Options
		 */
		$this->start_controls_section(
			'eaab_author_name_style',
			[
				'label' => __( 'Author Name', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eaab_author_name_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_name h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eaab_author_name_typography',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_name h4',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'eaab_author_name_text_stroke',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_name h4',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'eaab_author_name_text_shadow',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_name h4',
			]
		);

		$this->add_responsive_control(
			'eaab_name_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'eaab_name_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/**
		 * Subtitle Heading Style
		 */
		$this->start_controls_section(
			'eaab_profession_style',
			[
				'label' => __( 'Author Profession', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eaab_profession_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_profession h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eaab_profession_typography',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_profession h5',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'eaab_profession_text_stroke',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_profession h5',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'eaab_profession_text_shadow',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_profession h5',
			]
		);

		$this->add_responsive_control(
			'eaab_profession_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_profession' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'eaab_profession_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_profession' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		/**
		 * Paragraph Style
		 */
		$this->start_controls_section(
			'eaab_descriptions_style',
			[
				'label' => __( 'Author Description', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eaab_descriptions_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_descriptions p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eaab_descriptions_typography',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_descriptions p',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'eaab_descriptions_text_stroke',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_descriptions p',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'eaab_descriptions_text_shadow',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_descriptions p',
			]
		);

		$this->add_responsive_control(
			'eaab_descriptions_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_descriptions' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'eaab_descriptions_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_descriptions' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		/**
		 * Button Style
		 */
		$this->start_controls_section(
			'eaab_social_links_style',
			[
				'label' => __( 'Social Links', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'eaab_social_link_tabs'
		);
		$this->start_controls_tab(
			'eaab_social_link_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'eaab_social_links_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'eaab_social_links_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'eaab_social_links_size',
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
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'eaab_social_links_width',
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
						'max' => 1000,
					],
					'vw' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'eaab_social_links_height',
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
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'eaab_social_links_border_radius',
				'selector' => '{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'eaab_social_links_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'eaab_social_links_padding',
			[
				'label' => __( 'Icon Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'eaab_social_links_margin',
			[
				'label' => __( 'Icon Margin Between', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'eaab_social_links_wrap_margin',
			[
				'label' => __( 'Wrapper Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'eaab_social_link_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'eaab_social_links_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'eaab_social_links_hover_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eaab_wrapper .eaab_links .social-link a:hover' => 'color: {{VALUE}};',
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
		$eaab_image = $settings['eaab_image'];
		$eaab_name = $settings['eaab_author_name'];
		$eaab_profession = $settings['eaab_author_profession'];
		$eaab_descriptions = $settings['eaab_author_descriptions'];
		$show_social_liks = $settings['eaab_show_social_links'];
		?>
		<div class="eaab_wrapper">
			<div class="eaab_inner">
				<?php
				if (!empty($eaab_image)) :?>
				<div class="eaab_image">
					<?php
						echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'eaab_image_size', 'eaab_image' );
					?>
				</div>
				<?php
				endif;
				?>
				<div class="eaab_content_wrapper">
					<?php
					if (!empty($eaab_name)):?>
					<div class="eaab_name">
						<h4><?php echo esc_html( $eaab_name );?></h4>
					</div>
					<?php endif;
					if (!empty($eaab_profession)):
					?>
					<div class="eaab_profession">
						<h5><?php echo esc_html( $eaab_profession );?></h5>
					</div>
					<?php
					endif;
					if (!empty($eaab_descriptions)) :?>
					<div class="eaab_descriptions">
						<p><?php echo wp_kses_post( $eaab_descriptions );?></p>
					</div>
					<?php
					endif;
					if ('true' === $show_social_liks) :
					?>
					<div class="eaab_links">
						<?php wpbeeg_social_links(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
