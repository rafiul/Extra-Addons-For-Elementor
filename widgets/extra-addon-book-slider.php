<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // If this file is called directly, abort.
}
// Elementor Classes.
use \Elementor\Controls_Stack;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Css_Filter;
/**
 * Class Extra_Addon_Social_Icons
 */
class Extra_Addon_Book_Slider extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'extra_addon_book_slider';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Book Slider', EAFE_TEXT_DOMAIN );
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
		return 'dashicons dashicons-book-alt';
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
		return array( 'extra', 'book', 'slider', 'carousel' );
	}

	/**
	 * Register Title controls.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * Query
		 */
		$this->start_controls_section(
			'eafe_book_layouts_query_section',
			[
				'label' => __( 'Query', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs(
			'eafe_book_layouts_query_tabs'
		);
		$this->start_controls_tab(
			'eafe_book_layouts_query_include',
			[
				'label' => __( 'Include', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'book_categories_include',
			[
				'label' => __( 'Include Categories', EAFE_TEXT_DOMAIN ),
				'description' => __( 'Insert Category ID seperated by Comma.', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder'=> '79,109',
				'separator' => 'before',
				'rows' => '2',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_authors_include',
			[
				'label' => __( 'Include Authors', EAFE_TEXT_DOMAIN ),
				'description' => __( 'Insert Author ID seperated by Comma.', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder'=> '79,109',
				'rows' => '2',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'eafe_book_layouts_query_exclude',
			[
				'label' => __( 'Exclude', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'book_categories_exclude',
			[
				'label' => __( 'Exclude Categories', EAFE_TEXT_DOMAIN ),
				'description' => __( 'Insert Category ID seperatef by Comma.', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder'=> '107,116',
				'rows' => '2',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_authors_exclude',
			[
				'label' => __( 'Exclude Authors', EAFE_TEXT_DOMAIN ),
				'description' => __( 'Insert Author ID seperated by Comma.', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder'=> '57,86',
				'rows' => '2',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_offset',
			[
				'label' => __( 'Offset', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'separator' => 'before',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'books_per_page',
			[
				'label' => __( 'Books Per Page', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 4,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'books_order',
			[
				'label' => esc_html__( 'Order', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'ASC', EAFE_TEXT_DOMAIN ),
					'DESC'  => esc_html__( 'DESC', EAFE_TEXT_DOMAIN ),
				],
			]
		);

		$this->add_control(
			'books_order_by',
			[
				'label' => esc_html__( 'Order By', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'modified' => esc_html__( 'Order by last modified date', EAFE_TEXT_DOMAIN ),
					'comment_count'  => esc_html__( 'Order by number of comments', EAFE_TEXT_DOMAIN ),
					'title'  => esc_html__(  'Order by title', EAFE_TEXT_DOMAIN ),
					'date'  => esc_html__( 'Order by date', EAFE_TEXT_DOMAIN ),
				],
			]
		);

		$this->end_controls_section();
		/**
		 * Layouts
		 */
		$this->start_controls_section(
			'eafe_book_layouts_section',
			[
				'label' => __( 'Layouts', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'sts_l_screen',
			[
				'label' => __( 'Slide To Show Large Screen', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '4',
				'separator' => 'before',
				'options' => [
					'1' => __( '1 Item', EAFE_TEXT_DOMAIN ),
					'2' => __( '2 Items', EAFE_TEXT_DOMAIN ),
					'3' => __( '3 Items', EAFE_TEXT_DOMAIN ),
					'4' => __( '4 Items', EAFE_TEXT_DOMAIN ),
					'5' => __( '5 Items', EAFE_TEXT_DOMAIN ),
				],
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'sts_m_screen',
			[
				'label' => __( 'Slide To Show Medium Screen', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '3',
				'separator' => 'before',
				'options' => [
					'1' => __( '1 Item', EAFE_TEXT_DOMAIN ),
					'2' => __( '2 Items', EAFE_TEXT_DOMAIN ),
					'3' => __( '3 Items', EAFE_TEXT_DOMAIN ),
					'4' => __( '4 Items', EAFE_TEXT_DOMAIN ),
					'5' => __( '5 Items', EAFE_TEXT_DOMAIN ),
				],
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'sts_s_screen',
			[
				'label' => __( 'Slide To Show Small Screen', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '1',
				'separator' => 'before',
				'options' => [
					'1' => __( '1 Item', EAFE_TEXT_DOMAIN ),
					'2' => __( '2 Items', EAFE_TEXT_DOMAIN ),
					'3' => __( '3 Items', EAFE_TEXT_DOMAIN ),
					'4' => __( '4 Items', EAFE_TEXT_DOMAIN ),
					'5' => __( '5 Items', EAFE_TEXT_DOMAIN ),
				],
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'book_thumbnail_show',
			[
				'label'        => __( 'Show Thumbnail?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);

		$this->add_control(
			'book_thumbnail_type',
			[
				'label' => __( 'What You Want To Show?', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'book_cover',
				'options' => [
					'book_cover' => __( 'Book Cover Image', EAFE_TEXT_DOMAIN ),
					'book_mockup' => __( 'Book Mockup Image', EAFE_TEXT_DOMAIN ),
				],
				'condition'	=>	[
					'book_title_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'thumbnail_position',
			[
				'label' => __( 'Thumbnail Position', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'top',
				'options' => [
					'left' => __( 'Thumbnail Left', EAFE_TEXT_DOMAIN ),
					'top' => __( 'Thumbnail Top', EAFE_TEXT_DOMAIN ),
					'right' => __( 'Thumbnail Right', EAFE_TEXT_DOMAIN ),
				],
				'condition'	=>	[
					'book_thumbnail_show'	=>	'true',
				]
			]
		);
		$this->add_responsive_control(
			'book_thumbnail_column_width',
			[
				'label' => esc_html__( 'Thumbnail Column Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 30,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 30,
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-image.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>	[
					'thumbnail_position!'	=>	'top',
				]
			]
		);
		$this->add_responsive_control(
			'book_content_column_width',
			[
				'label' => esc_html__( 'Content Column Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 70,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 70,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 70,
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>	[
					'thumbnail_position!'	=>	'top',
				],
			]
		);
		$this->add_control(
			'book_category_show',
			[
				'label'        => __( 'Show Categories?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_title_show',
			[
				'label'        => __( 'Show Title?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_title_type',
			[
				'label' => __( 'What You Want To Show?', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'book_name',
				'options' => [
					'title' => __( 'Title', EAFE_TEXT_DOMAIN ),
					'book_name' => __( 'Book Name', EAFE_TEXT_DOMAIN ),
				],
				'condition'	=>	[
					'book_title_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'book_author_show',
			[
				'label'        => __( 'Author Show?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'book_price_show',
			[
				'label'        => __( 'Price Show?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'book_description_show',
			[
				'label'        => __( 'Description Show?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'book_excerpt_type',
			[
				'label'        => __( 'Description Limit', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'      => 'excerpt',
				'options' => [
					'fullcontent'  => __( 'Full Content', EAFE_TEXT_DOMAIN ),
					'excerpt' => __( 'Excerpt', EAFE_TEXT_DOMAIN ),
				],
				'condition'	=>	[
					'book_description_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'book_description_limit',
			[
				'label'        => __( 'Description Limit', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::NUMBER,
				'separator' => 'before',
				'default'      => '60',
				'condition'	=>	[
					'book_excerpt_type'	=>	'excerpt',
				]
			]
		);
		$this->add_control(
			'book_buy_btn_show',
			[
				'label'        => __( 'Buy Now Button Show?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'book_msl_links_show',
			[
				'label'        => __( 'Multiple Sales Links Show?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'book_msl_title',
			[
				'label'        => __( 'Title', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::TEXT,
				'return_value' => 'true',
				'separator' => 'before',
				'default'      => __( 'Order The Book', EAFE_TEXT_DOMAIN ),
				'condition'	=>	[
					'book_msl_links_show'	=> 'true',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'book_style_section',
			[
				'label' => __( 'Box', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'book_container_style_tabs'
		);
		$this->start_controls_tab(
			'book_container_normal_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'book_container_background',
				'separator'	=> 'before',
				'label' => __( 'Box Background', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rswpthemes-book-container, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'separator'	=> 'before',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-container',
			]
		);

		$this->add_responsive_control(
			'book_container_padding',
			[
				'label' => __( 'Content Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_item_box_padding',
			[
				'label' => __( 'Item Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_container_margin',
			[
				'label' => __( 'Item Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_container_border',
				'selector' => '{{WRAPPER}} .rswpthemes-book-container',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_content_alignment',
			[
				'label'     => __( 'Text AlignMent', EAFE_TEXT_DOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options' => [
					'left'  => __( 'Left', EAFE_TEXT_DOMAIN ),
					'center' => __( 'Center', EAFE_TEXT_DOMAIN ),
					'right' => __( 'Right', EAFE_TEXT_DOMAIN ),
				],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper,{{WRAPPER}} .msl-title-wrapper h2.msl-text, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-desc, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn, {{WRAPPER}} .book-also-available-websites-wrapper .msl-title-inner' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price, {{WRAPPER}} .rswpthemes-book-container .rswpthemes-book-loop-image.thumbnail-position-top a, {{WRAPPER}} .book-also-available-website-list, {{WRAPPER}} .eafe-book-multiple-sales-links .book-also-available-website-list .has-website-image a, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn' => 'justify-content: {{VALUE}}',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'book_container_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'book_container_hover_background',
				'label' => __( 'Box Background', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rswpthemes-book-container:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'book_container_hover_shadow',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-container:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/**
		 * Book Category Style
		 */
		$this->start_controls_section(
			'book_category_style_section',
			[
				'label' => __( 'Book category', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'book_category_style_tab'
		);
		$this->start_controls_tab(
			'book_category_normal_tab',
			[
				'label'	=>	__( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_category_typography',
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a',
			]
		);
		$this->add_control(
			'book_category_color',
			[
				'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'book_category_bg_color',
			[
				'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_category_border',
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_category_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_category_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'book_category_hover_tab',
			[
				'label'	=>	__( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_category_hover_typography',
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a:hover',
			]
		);
		$this->add_control(
			'book_category_hover_color',
			[
				'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'book_category_bg_hover_color',
			[
				'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_category_hover_border',
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_category_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_category_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-categories h6 a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'book_category_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories h6 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_category_margin',
			[
				'label' => __( 'Wrapper Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/**
		 * Book Title Style
		 */
		$this->start_controls_section(
			'book_title_style_section',
			[
				'label' => __( 'Book Title', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'book_title_style_tabs'
		);
		$this->start_controls_tab(
			'book_title_tab_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_title_typography',
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title',
			]
		);

		$this->add_control(
			'book_title_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'book_title_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_title_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_tab_hover',
			[
				'label' => __( 'hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'book_title_hover_color',
			[
				'label' => __( 'Title Hover Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_title_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title',
			]
		);

		$this->add_control(
			'show_book_title_border',
			[
				'label'        => __( 'Show Border?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',

			]
		);

		$this->add_control(
			'book_title_border_color',
			[
				'label' => __( 'Border Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'show_book_title_border' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-title a.border_on_hover' => 'background-image: linear-gradient(to right, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/**
		 * Author Name Styles
		 */
		$this->start_controls_section(
			'book_author_style',
			[
				'label' => __( 'Book Author', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'book_author_style_tabs',
		);
		$this->start_controls_tab(
			'book_author_style_normal_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_author_prefix_typography',
				'label' =>__( 'Prefix Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author strong',
			]
		);

		$this->add_control(
			'book_author_prefix_color',
			[
				'label' => __( 'Prefix Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author strong' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_author_name_typography',
				'label' =>__( 'Author Name Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author a',
			]
		);
		$this->add_control(
			'book_author_name_color',
			[
				'label' => __( 'Author Name Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'book_author_style_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'book_author_name_hover_color',
			[
				'label' => __( 'Author Name Hover Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'book_author_wrapper_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_author_wrapper_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		/**
		 * Book Price Styles
		 */
		$this->start_controls_section(
			'book_price_style',
			[
				'label' => __( 'Book Price', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_price_typography',
				'label' =>__( 'Regular Price Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price .regular-price',
			]
		);

		$this->add_control(
			'book_regular_price_color',
			[
				'label' => __( 'Regular Price Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price .regular-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_sale_price_typography',
				'label' =>__( 'Sale Price Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price .sale-price',
			]
		);
		$this->add_control(
			'book_sale_price_color',
			[
				'label' => __( 'Sale Price Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price .sale-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'book_price_wrapper_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_price_wrapper_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		/**
		 * Description Text
		 */
		$this->start_controls_section(
			'book_author_description_section',
			[
				'label' => __( 'Book Description', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_description_typography',
				'label' => __( 'Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-desc p,{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-full-content-as-excerpt',
			]
		);
		$this->add_control(
			'book_description_color',
			[
				'label' => __( 'Description Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-desc p,{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-full-content-as-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'book_description_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-desc, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-full-content-as-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_description_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-desc, {{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-full-content-as-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/**
		 * Book Button Style
		 */
		$this->start_controls_section(
			'book_buy_btn_style_section',
			[
				'label' => __( 'Buy Now Button', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'book_buy_btn_style_tab'
		);
		$this->start_controls_tab(
			'book_buy_btn_normal_tab',
			[
				'label'	=>	__( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_buy_btn_typography',
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button',
			]
		);
		$this->add_control(
			'book_buy_btn_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'book_buy_btn_bg_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_buy_btn_border',
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_buy_btn_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_buy_btn_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'book_buy_btn_hover_tab',
			[
				'label'	=>	__( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_buy_btn_hover_typography',
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover',
			]
		);
		$this->add_control(
			'book_buy_btn_hover_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'book_buy_btn_bg_hover_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_buy_btn_hover_border',
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_buy_btn_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_buy_btn_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'book_buy_btn_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn a.rswpthemes-book-buy-now-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_buy_btn_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rswpthemes-book-loop-content-wrapper .book-buy-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/**
		 * Multiple Sales Links
		 */
		$this->start_controls_section(
			'multiple_msl_style_section',
			[
				'label' => __( 'Multiple Sales Links', EAFE_TEXT_DOMAIN ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			],
		);
		$this->add_control(
			'book_msl_align',
			[
				'label'        => __( 'Align', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SELECT,
				'return_value' => 'true',
				'separator' => 'before',
				'options'	=> [
					'left'	=> 'Left',
					'center'	=> 'Center',
					'right'	=> 'right',
				],
				'default'      => 'center',
				'condition'	=>	[
					'book_msl_links_show'	=> 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list' => 'justify-content: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title Typography', EAFE_TEXT_DOMAIN ),
				'name' => 'book_msl_title_typography',
				'selector' => '{{WRAPPER}} .msl-title-wrapper h2.msl-text',
			]
		);
		$this->add_control(
			'book_msl_title_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .msl-title-wrapper h2.msl-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'book_msl_title_border_color',
			[
				'label' => __( 'Border Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .msl-title-wrapper .msl-before-draw, {{WRAPPER}} .msl-title-wrapper .msl-after-draw' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'book_msl_title_width',
			[
				'label' => esc_html__( 'Title Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 70,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 70,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 70,
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .msl-title-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'book_msl_title_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
				'allowed_dimensions' => 'vertical',
				'placeholder' => [
					'top' => '',
					'right' => 'auto',
					'bottom' => '',
					'left' => 'auto',
				],
				'selectors' => [
					'{{WRAPPER}} .msl-title-wrapper' => 'margint-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'book_msl_btn_style_tab',
			[
				'separator' => 'before',
			]
		);
		$this->start_controls_tab(
			'book_msl_btn_normal_tab',
			[
				'label'	=>	__( 'Links Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_msl_btn_typography',
				'selector' => '{{WRAPPER}} .book-also-available-website-list a',
			]
		);
		$this->add_control(
			'book_msl_btn_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'book_msl_btn_bg_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_msl_btn_border',
				'selector' => '{{WRAPPER}} .book-also-available-website-list a',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'book_msl_btn_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_msl_btn_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .book-also-available-website-list a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'book_msl_btn_hover_tab',
			[
				'label'	=>	__( 'Links Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_msl_btn_hover_typography',
				'selector' => '{{WRAPPER}} .book-also-available-website-list a:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_msl_btn_hover_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'book_msl_btn_bg_hover_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_msl_btn_hover_border',
				'label' => __( 'Border', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .book-also-available-website-list a:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'book_msl_btn_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_msl_btn_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .book-also-available-website-list a:hover',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'book_msl_btn_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_msl_btn_margin',
			[
				'label' => __( 'Margin Between', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'book_msl_wrapper_margin',
			[
				'label' => __( 'Wrapper Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .book-also-available-websites-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
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
	public function render() {
		$settings = $this->get_settings_for_display();
		$booksPerPage = $settings['books_per_page'];
		$thumbnailPosition = $settings['thumbnail_position'];
		$catIncludes = $settings['book_categories_include'];
		$catExcludes = $settings['book_categories_exclude'];
		$authorsInclude = $settings['book_authors_include'];
		$authorsExclude = $settings['book_authors_exclude'];
		$bookOffset = $settings['book_offset'];
		$showThumbnail = $settings['book_thumbnail_show'];
		$thumbnailType = $settings['book_thumbnail_type'];
		$showCategory = $settings['book_category_show'];
		$showTitle = $settings['book_title_show'];
		$titleType = $settings['book_title_type'];
		$showAuthor = $settings['book_author_show'];
		$showPrice = $settings['book_price_show'];
		$showDescription = $settings['book_description_show'];
		$excerptType = $settings['book_excerpt_type'];
		$descriptionsLimit = $settings['book_description_limit'];
		$showBuybtn = $settings['book_buy_btn_show'];
		$lScreen = $settings['sts_l_screen'];
		$mScreen = $settings['sts_m_screen'];
		$sScreen = $settings['sts_s_screen'];
		$showMslinks = $settings['book_msl_links_show'];
		$showMslTitle = $settings['book_msl_title'];
		$mslTitleAlign = $settings['book_msl_align'];
		?>
		<div class="eafe-book-slider-section-wrapper">
			<?php
			echo do_shortcode("[rswpbs_book_slider
				books_per_page=\"$booksPerPage\"
				categories_include=\"$catIncludes\"
				categories_exclude=\"$catExcludes\"
				authors_include=\"$authorsInclude\"
				authors_exclude=\"$authorsExclude\"
				book_offset=\"$bookOffset\"
				show_author=\"$showAuthor\"
				show_title=\"$showTitle\"
				title_type=\"$titleType\"
				excerpt_type=\"$excerptType\"
				show_description=\"$showDescription\"
				description_limit=\"$descriptionsLimit\"
				show_image=\"$showThumbnail\"
				image_type=\"$thumbnailType\"
				show_price=\"$showPrice\"
				show_buy_button=\"$showBuybtn\"
				book_cover_position=\"$thumbnailPosition\"
				sts_l_screen=\"$lScreen\"
				sts_m_screen=\"$mScreen\"
				sts_s_screen=\"$sScreen\"
				show_msl=\"$showMslinks\"
				msl_title_align=\"$mslTitleAlign\"
				msl_title=\"$showMslTitle\"
			]");
			?>
		</div>
		<?php
		wp_reset_postdata();
	}
}
