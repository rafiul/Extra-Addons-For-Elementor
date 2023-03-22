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
 * Class Extra_Addon_Section_Title
 */
class Extra_Addon_Section_Title extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'extra_addon_section_title';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Section Title', EAFE_TEXT_DOMAIN );
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
		return 'dashicons dashicons-heading';
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
		return array( 'extra', 'section', 'title', 'text', 'headline', 'heading' );
	}

	/**
	 * Register Title controls.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->start_controls_section(
			'extra_addon_section_title_content',
			array(
				'label' => __( 'Content', EAFE_TEXT_DOMAIN ),
			)
		);
		$this->add_control(
			'east_title_style',
			array(
				'label'       => __( 'Title', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'blog',
				'options'     => array(
					'blog' => __( 'Blog Default', EAFE_TEXT_DOMAIN ),
					'blog-classic' => __( 'Blog Classic', EAFE_TEXT_DOMAIN ),
					'corporate' => __( 'Corporate Title', EAFE_TEXT_DOMAIN ),
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'east_main_title',
			array(
				'label'       => __( 'Title', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Title Here', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'			=> 3,

			)
		);
		$this->add_control(
			'east_sub_title',
			array(
				'label'       => __( 'Subtitle', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Subtitle Here', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 3,
				'condition'	=>	[
					'east_title_style'	=>	'corporate',
				]
			)
		);
		$this->add_control(
			'east_descriptions',
			array(
				'label'       => __( 'Description', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Descriptions Here', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 5,
				'condition'	=>	[
					'east_title_style'	=>	'corporate',
				]
			)
		);
		$this->add_control(
			'east_show_button',
			[
				'label'        => __( 'Show Button', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'condition'	=>	[
					'east_title_style'	=>	'blog',
				]
			]
		);
		$this->add_control(
			'east_button_text',
			array(
				'label'       => __( 'Button Text', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'View All', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 5,
				'condition'	=>	[
					'east_show_button'	=>	'true',
				]
			)
		);
		$this->add_control(
			'east_button_link',
			array(
				'label'       => __( 'Button Link', EAFE_TEXT_DOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '#', EAFE_TEXT_DOMAIN ),
				'label_block' => true,
				'rows'		=> 5,
				'condition'	=>	[
					'east_show_button'	=>	'true',
				]
			)
		);
		$this->add_control(
			'east_button_icon_show',
			[
				'label'        => __( 'Show Button Icon', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'condition'	=>	[
					'east_show_button'	=>	'true',
				]
			]
		);
		$this->end_controls_section();

		/**
		 * Start Section Title Options
		 */
		$this->start_controls_section(
			'east_main_title_style',
			[
				'label' => __( 'Mian Heading', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'east_main_title_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'east_main_title_typography',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'east_main_title_text_stroke',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'east_main_title_text_shadow',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);
		$this->end_controls_section();
		/**
		 * Subtitle Heading
		 */
		$this->start_controls_section(
			'east_subtitle_style',
			[
				'label' => __( 'Sub Heading', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'east_subtitle_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'east_subtitle_typography',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'east_subtitle_text_stroke',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'east_subtitle_text_shadow',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->end_controls_section();
		/**
		 * Paragraph
		 */
		$this->start_controls_section(
			'east_paragraph_style',
			[
				'label' => __( 'Descriptions', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'east_paragraph_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'east_paragraph_typography',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'east_paragraph_text_stroke',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'east_paragraph_text_shadow',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-wrapper h2',
			]
		);

		$this->end_controls_section();
		/**
		 * Button
		 */
		$this->start_controls_section(
			'east_button_style',
			[
				'label' => __( 'Button', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'slider_title_tabs'
		);
		$this->start_controls_tab(
			'slider_title_style_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'east_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'east_button_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'east_button_typography',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'east_button_text_stroke',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'east_button_text_shadow',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn',
			]
		);
		$this->add_responsive_control(
			'east_button_padding',
			[
				'label' => __( 'Button Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'east_button_margin',
			[
				'label' => __( 'Button Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'slider_title_style_hover',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'east_button_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'east_button_hover_color',
			[
				'label' => esc_html__( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'east_button_hover_text_stroke',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'east_button_hover_text_shadow',
				'selector' => '{{WRAPPER}} .extra-addon-section-title__blog-title-button .view-all-btn:hover',
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
		$maintitle = $settings['east_main_title'];
		$subtitle = $settings['east_sub_title'];
		$descriptions = $settings['east_descriptions'];
		$title_type = $settings['east_title_style'];
		$buttonshow = $settings['east_show_button'];
		$buttontext = $settings['east_button_text'];
		$buttonlink = $settings['east_button_link'];
		$buttoniconshow = $settings['east_button_icon_show'];
		$title_area_class = 'blog-style-title';
		if ('blog' === $title_type) {
			$title_area_class = ' blog-style-title';
		}elseif('corporate' === $title_type){
			$title_area_class = ' corporate-style-title';
		}
		?>
		<div class="extra-addon-section-title<?php echo esc_attr($title_area_class);?>">
			<div class="container pl-0 pr-0">
				<?php
				if ('corporate' === $title_type) :
				?>
				<div class="row ml-0 mr-0">
					<div class="col-md-12 pl-0 pr-0">
						<div class="extra-addon-section-title__wrapper">
							<div class="extra-addon-section-title__inner">
								<?php
								if (!empty($subtitle)) :
								?>
								<div class="extra-addon-section-title__subtitle">
									<h4><?php echo wp_kses_post( $subtitle );?></h4>
								</div>
								<?php endif;
								if (!empty($maintitle)) :
								?>
								<div class="extra-addon-section-title__main-title">
									<h2><?php echo wp_kses_post( $maintitle );?></h2>
								</div>
								<?php endif;
								if (!empty($descriptions)) :
								?>
								<div class="extra-addon-section-title__descriptions">
									<p><?php echo wp_kses_post( $descriptions );?></p>
								</div>
								<?php
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			<?php
			elseif ('blog' === $title_type) : ?>
				<div class="row align-items-center ml-0 mr-0">
					<div class="col-md-9 pl-0 pr-0">
						<?php if (!empty($maintitle)): ?>
						<div class="extra-addon-section-title__blog-title-wrapper text-left">
							<h2><?php echo wp_kses_post( $maintitle );?></h2>
						</div>
						<?php endif; ?>
					</div>
					<?php
					if ('true' === $buttonshow)  :
					?>
					<div class="col-md-3 pl-0 pr-0">
						<div class="extra-addon-section-title__blog-title-button text-right">
							<a href="<?php echo esc_url($buttonlink);?>" class="view-all-btn"><?php echo esc_html( $buttontext );?>
								<?php
								if ('true' === $buttoniconshow) :
								?>
									<i class="view-button-icon fa-regular fa-circle-right"></i>
								<?php
								endif;
								?>
							</a>
						</div>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
