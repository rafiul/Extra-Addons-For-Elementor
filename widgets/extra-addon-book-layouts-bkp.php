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
class Extra_Addon_Book_Layouts extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'extra_addon_book_layouts';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Book Layouts', EAFE_TEXT_DOMAIN );
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
		return array( 'extra', 'book', 'grid', 'list' );
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
			'book_columns',
			[
				'label' => __( 'Book Columns', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'two',
				'separator' => 'before',
				'options' => [
					'one' => __( 'One Column', EAFE_TEXT_DOMAIN ),
					'two' => __( 'Two Column', EAFE_TEXT_DOMAIN ),
					'three' => __( 'Three Column', EAFE_TEXT_DOMAIN ),
					'four' => __( 'Four Column', EAFE_TEXT_DOMAIN ),
					'six' => __( 'Six Column', EAFE_TEXT_DOMAIN ),
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
			'thumbnail_position',
			[
				'label' => __( 'Thumbnail Position', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'top',
				'separator'	=> 'before',
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
				'separator'	=> 'before',
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
					'{{WRAPPER}} .eafe-book-thumbnail.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
					'size' => 50,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 50,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 50,
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
					'{{WRAPPER}} .eafe-book-inner.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition'	=>	[
					'thumbnail_position!'	=>	'top',
				]
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
				'separator' => 'before',
				'default'      => 'true',
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
				'separator' => 'before',
				'default'      => 'true',
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
				'selector' => '{{WRAPPER}} .eafe-book-wrapper',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'separator'	=> 'before',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-wrapper',
			]
		);

		$this->add_responsive_control(
			'book_container_padding',
			[
				'label' => __( 'Content Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_container_border',
				'selector' => '{{WRAPPER}} .eafe-book-wrapper',
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
					'{{WRAPPER}} .eafe-book-inner,{{WRAPPER}} .book-also-available-websites-wrapper h4' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .eafe-book-price, {{WRAPPER}} .eafe-book-thumbnail.thumbnail-position-top a, {{WRAPPER}} .book-also-available-website-list, {{WRAPPER}} .eafe-book-multiple-sales-links .book-also-available-website-list .has-website-image a' => 'justify-content: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .eafe-book-wrapper:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'book_container_hover_shadow',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-wrapper:hover',
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
				'selector' => '{{WRAPPER}} .eafe-book-title h2',
			]
		);

		$this->add_control(
			'book_title_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-title h2 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-title h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_title_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-title h2',
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
					'{{WRAPPER}} .eafe-book-title h2 a.border_on_hover' => 'background-image: linear-gradient(to right, {{VALUE}} 0%, {{VALUE}} 100%);',
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
				'selector' => '{{WRAPPER}} .eafe-book-author-name strong',
			]
		);

		$this->add_control(
			'book_author_prefix_color',
			[
				'label' => __( 'Prefix Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eafe-book-author-name strong' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_author_name_typography',
				'label' =>__( 'Author Name Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-author-name a',
			]
		);
		$this->add_control(
			'book_author_name_color',
			[
				'label' => __( 'Author Name Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-author-name a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-author-name a:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-author-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .eafe-book-price .regular-price.previous-price',
			]
		);

		$this->add_control(
			'book_regular_price_color',
			[
				'label' => __( 'Regular Price Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eafe-book-price .regular-price.previous-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'book_sale_price_typography',
				'label' =>__( 'Sale Price Typography', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-price .sale-price',
			]
		);
		$this->add_control(
			'book_sale_price_color',
			[
				'label' => __( 'Sale Price Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-price .sale-price' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .eafe-book-descriptions p',
			]
		);
		$this->add_control(
			'book_description_color',
			[
				'label' => __( 'Description Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-descriptions p' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-descriptions' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-descriptions' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a',
			]
		);
		$this->add_control(
			'book_buy_btn_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-buy-now-btn a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_buy_btn_border',
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_buy_btn_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a',
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
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a:hover',
			]
		);
		$this->add_control(
			'book_buy_btn_hover_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-book-buy-now-btn a:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'book_buy_btn_hover_border',
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a:hover',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'book_buy_btn_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-book-buy-now-btn a:hover',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .eafe-book-buy-now-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title Typography', EAFE_TEXT_DOMAIN ),
				'name' => 'book_msl_title_typography',
				'selector' => '{{WRAPPER}} .book-also-available-websites-wrapper h4',
			]
		);
		$this->add_control(
			'book_msl_title_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-websites-wrapper h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'book_msl_title_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .book-also-available-websites-wrapper h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'book_msl_btn_width',
			[
				'label' => esc_html__( 'Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator'	=> 'before',
				'selectors' => [
					'{{WRAPPER}} .book-also-available-website-list .single-website' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
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
				'label' => __( 'Wrapper Between', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-book-multiple-sales-links' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function render() {
		$settings = $this->get_settings_for_display();

		$booksQargs = array(
			'post_type'	=> array('book'),
		);

		if (!empty($settings['books_per_page'])) {
			$booksQargs['posts_per_page'] = $settings['books_per_page'];
		}

		if (!empty($settings['book_categories_include'])) {
			$includeBookCategories = array_map('intval', explode(',' , $settings['book_categories_include']));
			$booksQargs['category__in'] = $includeBookCategories;
		}

		if (!empty($settings['book_categories_exclude'])) {
			$excludeBookCategories = array_map('intval', explode(',' , $settings['book_categories_exclude']));
			$booksQargs['category__not_in'] = $excludeBookCategories;
		}

		if (!empty($settings['book_authors_include'])) {
			$includeBookAuthors = array_map('intval', explode(',' , $settings['book_authors_include']));
			$booksQargs['author__in'] = $includeBookAuthors;
		}

		if (!empty($settings['book_authors_exclude'])) {
			$excludeBookAuthors = array_map('intval', explode(',' , $settings['book_authors_exclude']));

			$booksQargs['author__not_in'] = $excludeBookAuthors;
		}

		if (!empty($settings['book_offset'])) {
			$booksQargs['offset'] = $settings['book_offset'];
		}

		if (!empty($settings['books_order'])) {
			$booksQargs['order'] = $settings['books_order'];
		}

		if (!empty($settings['books_order_by'])) {
			$booksQargs['orderby'] = $settings['books_order_by'];
		}

		$titleHoverClasses = '';
		if ('true' === $settings['show_book_title_border']) {
			$titleHoverClasses = 'border_on_hover';
		}
		$booksQuery = new WP_Query($booksQargs);

		/**
		 * Layuts
		 */
		$eafe_book_columns = $settings['book_columns'];
		$eafe_thumbnail_position = $settings['thumbnail_position'];
		$book_columns_class = "";
		if ('one' === $eafe_book_columns) {
		$book_columns_class = 'col-md-12';
		}elseif('two' === $eafe_book_columns) {
			$book_columns_class = 'col-md-6 col-lg-6';
		}elseif('three' === $eafe_book_columns){
			$book_columns_class = 'col-md-6 col-lg-4';
		}elseif('four' === $eafe_book_columns){
			$book_columns_class = 'col-md-4 col-lg-3';
		}elseif('six' === $eafe_book_columns){
			$book_columns_class = 'col-md-3 col-lg-2';
		}
		$book_list_row_classes = '';
		$thumbnail_wrapper_classes	= '';
		$content_wrapper_classes	= '';
		if ('left' === $eafe_thumbnail_position) {
			$book_list_row_classes = ' row mr-0 ml-0 post-list-layout thumbnail-position-left';
			$thumbnail_wrapper_classes	= ' col-md-6 pl-0';
			$content_wrapper_classes	= ' col-md-6';
		}elseif ('right' === $eafe_thumbnail_position) {
			$book_list_row_classes = ' row flex-row-reverse post-list-layout thumbnail-position-right';
			$thumbnail_wrapper_classes	= ' col-md-6 pr-0 text-right';
			$content_wrapper_classes	= ' col-md-6';
		}elseif ('top' === $eafe_thumbnail_position) {
			$thumbnail_wrapper_classes	= ' thumbnail-position-top';
		}

		/**
		 * Post Elemenet On Off
		 */
		$showThumbnail = $settings['book_thumbnail_show'];
		$showCategory = $settings['book_category_show'];
		$showTitle = $settings['book_title_show'];
		$showAuthor = $settings['book_author_show'];
		$showPrice = $settings['book_price_show'];
		$showDescription = $settings['book_description_show'];
		$showBuybtn = $settings['book_buy_btn_show'];
		$showMSL = $settings['book_msl_links_show'];
		$mslTitle = $settings['book_msl_title'];
		?>
		<div class="eafe-books-layout-section">
			<?php
			if ($booksQuery->have_posts()) :
			?>
			<div class="eafe-books-layout-row row">
				<?php
				while($booksQuery->have_posts()) :
					$booksQuery->the_post();
					if (class_exists('Rswpbs')) :
					?>
					<div class="eafe-book-layout-column <?php echo esc_attr($book_columns_class);?>">
						<div class="eafe-book-wrapper<?php echo esc_attr($book_list_row_classes);?>">
							<?php
							if ('true' === $showThumbnail) :
								if (has_post_thumbnail()) :
									?>
									<div class="eafe-book-thumbnail<?php echo esc_attr($thumbnail_wrapper_classes);?>">
										<a href="<?php the_permalink();?>"><?php echo wp_kses_post(rswpbs_get_book_image(get_the_ID())); ?></a>
									</div>
									<?php
								endif;
							endif;
							 ?>
							<div class="eafe-book-inner<?php echo esc_attr($content_wrapper_classes);?>">
								<?php
								if('true' === $showCategory) :
								?>
								 <div class="eafe-book-categories">
								 	<h6>
								 		<?php echo wp_kses_post(rswpbs_get_book_categories(get_the_ID(), false));?>
								 	</h6>
								 </div>
								 <?php
								endif;
								if('true' === $showTitle) :
								 ?>
								 <div class="eafe-book-title">
								 	<h2><a <?php echo ('true' === $settings['show_book_title_border'] ? 'class="'.$titleHoverClasses.'"' : ''); ?> href="<?php the_permalink();?>"><?php echo wp_kses_post(rswpbs_get_book_name());?></a></h2>
								 </div>
								 <?php
								endif;
								if('true' === $showAuthor) :
								 ?>
								 <div class="eafe-book-author-name">
								 	<strong><?php esc_html_e( 'By: ', EAFE_TEXT_DOMAIN );?></strong><?php echo wp_kses_post(rswpbs_get_book_author()); ?>
								 </div>
								 <?php
								endif;
								if('true' === $showPrice) :
								  ?>
								 <div class="eafe-book-price">
								 	<?php echo wp_kses_post(rswpbs_get_book_price());?>
								 </div>
								 <?php
								endif;
								if('true' === $showDescription) :
								 ?>
								 <div class="eafe-book-descriptions">
								 	 <p><?php echo wp_kses_post(rswpbs_get_book_desc());?></p>
								 </div>
								 <?php
								endif;
								if('true' === $showBuybtn) :
								 ?>
								 <div class="eafe-book-buy-now-btn">
								 	<?php echo wp_kses_post( rswpbs_get_book_buy_btn() ); ?>
								 </div>
								<?php
								endif;
								if ('true' === $showMSL) :
								?>
								<div class="eafe-book-multiple-sales-links">
									<?php rswpbs_pro_book_also_availeble_web_list($mslTitle); ?>
								</div>
								<?php
								endif;
								 ?>
							</div>
						</div>
					</div>
					<?php
					endif;
				endwhile;
				?>
			</div>
			<?php
			endif;
			?>
		</div>
		<?php
		wp_reset_postdata();
	}
}
