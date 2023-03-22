<?php
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

class Extra_Addon_Post_Layouts extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'extra_addon_post_layouts';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'POST LAYOUTS', EAFE_TEXT_DOMAIN );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'dashicons dashicons-layout';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'extra_addons_for_elementor' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'eafe_post_layouts_query_section',
			[
				'label' => __( 'Query', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs(
			'eafe_post_layouts_query_tabs'
		);
		$this->start_controls_tab(
			'eafe_post_layouts_query_include',
			[
				'label' => __( 'Include', EAFE_TEXT_DOMAIN ),
			]
		);
		$select_post_categories = array();
		$select_post_cats = get_terms( 'category' );
		foreach ($select_post_cats as $select_post_cat) :
			$select_post_categories[$select_post_cat->slug] = $select_post_cat->name;
		endforeach;
		$this->add_control(
			'select_categories',
			[
				'label' => __( 'Select Categories', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $select_post_categories,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_authors_include',
			[
				'label' => __( 'Include Authors', EAFE_TEXT_DOMAIN ),
				'description' => __( 'Insert Author ID seperated by Comma.', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder'=> '79,109',
				'rows' => '2',
				'multiple' => true,
				'options' => $select_post_categories,
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'eafe_post_layouts_query_exclude',
			[
				'label' => __( 'Exclude', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'exclude_categories',
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
			'exclude_authors',
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
			'post_offset',
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
			'posts_count',
			[
				'label' => __( 'Posts Per Page', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 6,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ignore_sticky_post',
			[
				'label'        => __( 'Ignore Sticky Post?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'YES', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'NO', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'		=> 'before',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'eafe_post_layouts_section',
			[
				'label' => __( 'Layout', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'posts_per_row',
			[
				'label' => __( 'Posts Columns', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'three',
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
			'masonry_active',
			[
				'label'        => __( 'Masonry Layout?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'		=> 'before',
			]
		);

		$this->add_control(
			'post_thumbnail_show',
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
					'post_thumbnail_show'	=>	'true',
				]
			]
		);
		$this->add_responsive_control(
			'post_layout_thumbnail_column_width',
			[
				'label' => esc_html__( 'Thumbnail Column Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'separator'	=> 'before',
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
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>	[
					'thumbnail_position!'	=>	'top',
				]
			]
		);
		$this->add_responsive_control(
			'post_layout_content_column_width',
			[
				'label' => esc_html__( 'Content Column Width', EAFE_TEXT_DOMAIN ),
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
					'{{WRAPPER}} .eafe-posts-layout-one__content-wrapper.col-md-6' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition'	=>	[
					'thumbnail_position!'	=>	'top',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Actually its `image_size`.
				'default' => 'large',
				'exclude' => [ 'custom' ],
				'separator'	=> 'before',
				'condition'	=>	[
					'post_thumbnail_show'	=>	'true',
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'eafe_post_layouts_element_on_off_section',
			[
				'label' => __( 'Post Element On//Off', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_meta_show',
			[
				'label'        => __( 'Show Post Meta?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_meta_data',
			[
				'label' => __( 'Post Meta', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'separator'	=> 'before',
				'options' => [
					'author'	=>	__( 'Author', EAFE_TEXT_DOMAIN ),
					'date'	=>	__( 'Date', EAFE_TEXT_DOMAIN ),
					'comments'	=>	__( 'Comments', EAFE_TEXT_DOMAIN ),
				],
				'default'	=> ['author', 'date'],
				'condition'	=>	[
					'post_meta_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'post_meta_position',
			[
				'label'     => __( 'Meta Position', EAFE_TEXT_DOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'b_title',
				'separator' => 'before',
				'condition' => [
					'post_meta_show' => 'true',
				],
				'options' => [
					'b_title'  => __( 'Bellow Post Title', EAFE_TEXT_DOMAIN ),
					'b_excerpt' => __( 'Bellow Post Excerpt', EAFE_TEXT_DOMAIN ),
					'b_button' => __( 'Bellow Read More Button', EAFE_TEXT_DOMAIN ),
					'b_thumbnail' => __( 'Bellow Post Thumbnail', EAFE_TEXT_DOMAIN ),
				],
			]
		);
		$this->add_control(
			'post_excerpt_show',
			[
				'label'        => __( 'Show Excerpt?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'		=> 'before',
			]
		);
		$this->add_control(
			'post_excerpt_type',
			[
				'label' => __( 'Excerpt Type', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default' => 'excerpt',
				'options' => [
					'excerpt' => esc_html__( 'Excerpt', EAFE_TEXT_DOMAIN ),
					'fullcontent'  => esc_html__( 'Full Content', EAFE_TEXT_DOMAIN ),
				],
				'separator'		=> 'before',
				'condition'	=>	[
					'post_excerpt_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'post_excerpt_length',
			[
				'label' => __( 'Excerpt Length', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'min' => 70,
				'max' => 600,
				'step' => 10,
				'default' => 150,
				'separator'		=> 'before',
				'condition'	=>	[
					'post_excerpt_type'	=>	'excerpt',
				]
			]
		);

		$this->add_control(
			'post_title_show',
			[
				'label'        => __( 'Show Title?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'		=> 'before',
			]
		);
		$this->add_control(
			'post_category_show',
			[
				'label'        => __( 'Show Category?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'		=> 'before',
			]
		);
		$this->add_control(
			'post_category_position',
			[
				'label'     => __( 'Category Position', EAFE_TEXT_DOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'half_over_thumbnail',
				'separator'		=> 'before',
				'condition' => [
					'post_category_show' => 'true',
				],
				'options' => [
					'top_left_corner'  => __( 'Top Left Corner', EAFE_TEXT_DOMAIN ),
					'top_right_corner' => __( 'Top Right Corner', EAFE_TEXT_DOMAIN ),
					'bottom_left_corner' => __( 'Bottom Left Corner', EAFE_TEXT_DOMAIN ),
					'bottom_right_corner' => __( 'Bottom Right Corner', EAFE_TEXT_DOMAIN ),
					'above_title' => __( 'Above Post Title', EAFE_TEXT_DOMAIN ),
					'half_over_thumbnail' => __( 'Half Over Thumbnail', EAFE_TEXT_DOMAIN ),
				],
			]
		);
		$this->add_control(
			'read_button_show',
			[
				'label'        => __( 'Show Read More Button?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'false',
				'separator'	=> 'before',
			]
		);

		$this->add_control(
			'read_more_button_text',
			[
				'label'        => __( 'Button Text', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::TEXT,
				'default'      => __( 'Read More', EAFE_TEXT_DOMAIN ),
				'separator'	=> 'before',
				'condition'		=>	[
					'read_button_show'	=>	'true',
				]
			]
		);
		$this->add_control(
			'post_pagination_show',
			[
				'label' => __( 'Pagination', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'separator'	=> 'before',
				'options'	=>	[
					'none' => __( 'None', EAFE_TEXT_DOMAIN ),
					'number' => __( 'Number', EAFE_TEXT_DOMAIN ),
					'navs' => __( 'Next / Prev', EAFE_TEXT_DOMAIN ),
				],
				'default'      => 'none',
			]
		);
		$this->add_control(
			'east_pagination_alignment',
			[
				'label' => __( 'Pagination Alignment', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default'      => 'center',
				'separator'	=> 'before',
				'options'	=>	[
					'start'	=>	__( 'Left', EAFE_TEXT_DOMAIN ),
					'center'	=>	__( 'Center', EAFE_TEXT_DOMAIN ),
					'end'	=>	__( 'Right', EAFE_TEXT_DOMAIN ),
				],
				'condition'	=>	[
					'post_pagination_show'	=>	'number'
				]
			]
		);

		$this->end_controls_section();
		/*style tab*/
		/*Style Tab*/
		$this->start_controls_section(
			'post_style_section',
			[
				'label' => __( 'Box', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'post_box_style_tabs'
		);
		$this->start_controls_tab(
			'post_style_normal_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'post_box_background',
				'separator'	=> 'before',
				'label' => __( 'Box Background', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one, {{WRAPPER}} .eafe-posts-layout-one__content-wrapper',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'separator'	=> 'before',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one',
			]
		);

		$this->add_responsive_control(
			'post_box_padding',
			[
				'label' => __( 'Content Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_item_box_padding',
			[
				'label' => __( 'Item Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_box_margin',
			[
				'label' => __( 'Item Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_box_border',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_content_alignment',
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
					'{{WRAPPER}} .eafe-posts-layout-one__content-wrapper' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul' => 'justify-content: {{VALUE}}',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'post_style_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'post_box_hover_background',
				'label' => __( 'Box Background', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_box_hover_shadow',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		$this->start_controls_section(
			'post_thumnail_style',
			[
				'label' => __( 'Post Thumbnail', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'post_thumbnail_style_tab'
		);
		$this->start_controls_tab(
			'post_thumbnail_style_normal_tab',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_width',
			[
				'label' => esc_html__( 'Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_max_width',
			[
				'label' => esc_html__( 'Max Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_height',
			[
				'label' => esc_html__( 'Height', EAFE_TEXT_DOMAIN ),
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
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_object-fit',
			[
				'label' => esc_html__( 'Object Fit', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'post_thumbnail_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', EAFE_TEXT_DOMAIN ),
					'fill' => esc_html__( 'Fill', EAFE_TEXT_DOMAIN ),
					'cover' => esc_html__( 'Cover', EAFE_TEXT_DOMAIN ),
					'contain' => esc_html__( 'Contain', EAFE_TEXT_DOMAIN ),
				],
				'default' => 'cover',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'post_thumbnail_filter',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__thumbnail img',
			]
		);
		$this->add_control(
			'post_thumbnail_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one .eafe-posts-layout-one__thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'post_thumbnail_style_hover_tab',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'post_thumbnail_hover_filter',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__thumbnail img:hover',
			]
		);
		$this->add_control(
			'post_thumbnail_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__thumbnail img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'post_title_style',
			[
				'label' => __( 'Post Title', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_title_show' => 'true',
				]
			]
		);
		$this->start_controls_tabs(
			'style_title_tabs'
		);
		$this->start_controls_tab(
			'title_tab_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_title_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__title h2',
			]
		);

		$this->add_control(
			'post_title_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__title h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_title_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_title_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'post_title_hover_color',
			[
				'label' => __( 'Title Hover Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__title h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_title_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__title h2',
			]
		);

		$this->add_control(
			'show_post_title_border',
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
			'post_title_border_color',
			[
				'label' => __( 'Border Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'show_post_title_border' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__title h2 a' => 'background-image: linear-gradient(to right, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'post_excerpt_style',
			[
				'label' => __( 'Post Excerpt', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=>	[
					'post_excerpt_show' => 'true',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_excerpt_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__excerpt',
			]
		);
		$this->add_control(
			'post_excerpt_color',
			[
				'label' => __( 'Description Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_excerpt_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__excerpt p',
			]
		);
		$this->add_responsive_control(
			'post_excerpt_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__excerpt p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_excerpt_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__excerpt p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'post_category_style',
			[
				'label' => __( 'Post category', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=>	[
					'post_category_show' => 'true',
				]
			]
		);
		$this->start_controls_tabs(
			'post_category_style_tab'
		);
		$this->start_controls_tab(
			'post_category_normal_tab',
			[
				'label'	=>	__( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_category_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a',
			]
		);
		$this->add_control(
			'post_category_color',
			[
				'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_category_bg_color',
			[
				'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_category_border',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_category_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_category_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a',
			]
		);
		$this->add_responsive_control(
			'post_category_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_category_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'post_category_hover_tab',
			[
				'label'	=>	__( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_category_hover_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a:hover',
			]
		);
		$this->add_control(
			'post_category_hover_color',
			[
				'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_category_bg_hover_color',
			[
				'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_category_hover_border',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_category_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__categories a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_category_text_hover_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__categories a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'post_meta_style',
			[
				'label' => __( 'Post Meta', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=>	[
					'post_meta_show' => 'true',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul li',
			]
		);
		$this->add_control(
			'post_meta_color',
			[
				'label' => __( 'Meta Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_meta_icon_color',
			[
				'label' => __( 'Icon Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul li a span.fa-regular, {{WRAPPER}} .eafe-posts-layout-one__blog-meta ul li span.fa-regular' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_meta_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_meta_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__blog-meta ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_read_button_style',
			[
				'label' => __( 'Read More Button', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'read_button_show'	=> 'true',
				]
			]
		);
		$this->start_controls_tabs(
			'readmore_button_tabs'
		);
		$this->start_controls_tab(
				'style_normal_button',
				[
					'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
				]
			);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_read_button_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a',
			]
		);
		$this->add_control(
			'post_read_button_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_read_button_bg_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_read_button_border',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_read_button_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_read_button_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a',
			]
		);
		$this->add_responsive_control(
			'post_read_button_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_read_button_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_hover_button',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_read_button_hover_typography',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover',
			]
		);
		$this->add_control(
			'post_read_button_hover_color',
			[
				'label' => __( 'Button Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_read_button_bg_hover_color',
			[
				'label' => __( 'Button Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'post_read_button_hover_border',
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_read_button_border_hover_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_read_button_hover_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-posts-layout-one__read-more a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'east_pagination_style',
			[
				'label' => __( 'Pagination', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);
		$this->start_controls_tabs(
			'east_pagination_tabs'
		);

		$this->start_controls_tab(
			'east_pagination_tab_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'east_pagination_typography',
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a',
			]
		);
		$this->add_control(
			'east_pagination_color',
			[
				'label' => __( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'east_pagination_bg_color',
			[
				'label' => __( 'Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'east_pagination_border',
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'east_pagination_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers,{{WRAPPER}} .pagination-wrapper .page-numbers li span.current, {{WRAPPER}} .post-navigation-older-newer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'east_pagination_text_shadow',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers,{{WRAPPER}} .pagination-wrapper .page-numbers li span.current, {{WRAPPER}} .post-navigation-older-newer a',
			]
		);

		$this->add_responsive_control(
			'east_pagination_width',
			[
				'label' => esc_html__( 'Width', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper ul.page-numbers li a.page-numbers,{{WRAPPER}} .pagination-wrapper ul.page-numbers li span.current' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>	[
					'post_pagination_show'	=> 'number',
				]
			]
		);

		$this->add_responsive_control(
			'east_pagination_height',
			[
				'label' => esc_html__( 'Height', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size'	=> 40,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper ul.page-numbers li a.page-numbers,{{WRAPPER}} .pagination-wrapper ul.page-numbers li span.current' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>	[
					'post_pagination_show'	=> 'number',
				]
			]
		);

		$this->add_responsive_control(
			'east_pagination_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-navigation-older-newer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition'	=>	[
					'post_pagination_show'	=> 'navs',
				]
			]
		);

		$this->add_responsive_control(
			'east_pagination_section_margin',
			[
				'label' => __( 'Pagination Section Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .frontpage.navigation, {{WRAPPER}} .post-navigation-older-newer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'east_pagination_tab_hover',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'east_pagination_hover_color',
			[
				'label' => __( 'Text Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper ul li a:hover, {{WRAPPER}} .post-navigation-older-newer a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'east_pagination_hover_bg_color',
			[
				'label' => __( 'Background', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper ul li a:hover, {{WRAPPER}} .post-navigation-older-newer a:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$eafe_get_categories = $settings['select_categories'];
		$eafe_posts_per_row = $settings['posts_per_row'];
		$eafe_posts_count = $settings['posts_count'];
		$authorIn = $settings['post_authors_include'];
		$postOffset = $settings['post_offset'];
		$excludeCategories = $settings['exclude_categories'];
		$excludeAuthors = $settings['exclude_authors'];
		$ignoreStickyPosts = $settings['ignore_sticky_post'];
		$eafe_meta_position = $settings['post_meta_position'];
		$eafe_masonry_active = $settings['masonry_active'];
		$eafe_thumbnail_position = $settings['thumbnail_position'];
		if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // if is static front page
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}
		$get_post_args = array(
			'post_type' => array('post'),
			'posts_per_page' => $eafe_posts_count,
			'paged'			=> $paged,
		);

		if (!empty($eafe_get_categories)) {
			$eafe_category_string = implode(',', $eafe_get_categories);
			$get_post_args['category_name'] = $eafe_category_string;
		}
		if (!empty($authorIn)) {
			$get_post_args['author_in'] = explode(',' , $authorIn);
		}
		if ( 0 != $postOffset ) {
			$get_post_args['offset'] = absint($postOffset);
		}
		if (!empty($excludeCategories)) {
			$get_post_args['category__not_in'] = explode(',' , $excludeCategories);
		}
		if (!empty($excludeAuthors)) {
			$get_post_args['author__not_in'] = explode(',' , $excludeAuthors);
		}
		if ('true' != $ignoreStickyPosts) {
			$get_post_args['post__not_in'] = get_option('sticky_posts');
		}

		$eafe_post_query = new \WP_Query( $get_post_args );

		$masonry_row_class = $masonry_grid_class = $post_columns_class = "";
		if ('true' === $eafe_masonry_active) {
			$masonry_row_class = ' masonaryactive ';
			$masonry_grid_class = 'blog-grid-layout ';
		}
		if ('one' === $eafe_posts_per_row) {
		$post_columns_class = 'col-md-12';
		}elseif('two' === $eafe_posts_per_row) {
			$post_columns_class = 'col-md-6 col-lg-6';
		}elseif('three' === $eafe_posts_per_row){
			$post_columns_class = 'col-md-6 col-lg-4';
		}elseif('four' === $eafe_posts_per_row){
			$post_columns_class = 'col-md-4 col-lg-3';
		}elseif('six' === $eafe_posts_per_row){
			$post_columns_class = 'col-md-3 col-lg-2';
		}
		$thumbnail_container = '';
		$thumbnail_wrapper	= '';
		$content_wrapper	= '';
		if ('left' === $eafe_thumbnail_position) {
			$thumbnail_container = ' row ml-0 mr-0';
			$thumbnail_wrapper	= ' col-md-6 pl-0 pr-3';
			$content_wrapper	= ' col-md-6 pr-0';
		}elseif ('right' === $eafe_thumbnail_position) {
			$thumbnail_container = ' row flex-row-reverse ml-0 mr-0';
			$thumbnail_wrapper	= ' col-md-6 pl-3 pr-0';
			$content_wrapper	= ' col-md-6 pl-0';
		}
		if ($eafe_post_query->have_posts()) :
			echo '<div class="row'.$masonry_row_class.'">'; //start row
			while ($eafe_post_query->have_posts()) :
				$eafe_post_query->the_post();
					echo '<div class="'. $masonry_grid_class . $post_columns_class .'">'; //Start Column
						echo '<div class="eafe-posts-layout-one'.$thumbnail_container.'">';
							//start single post wrapper
							echo '<div class="eafe-posts-layout-one__thumbnail'.$thumbnail_wrapper.'">';
								$this->eafe_render_post_thumbnail();
							echo '</div>';
							echo '<div class="eafe-posts-layout-one__content-wrapper'.$content_wrapper.'">'; //start content wrapper
								$this->eafe_render_category();
								if('b_thumbnail' === $eafe_meta_position):
									$this->eafe_render_post_meta();
								endif;
								$this->eafe_render_title();
								if('b_title' === $eafe_meta_position):
									$this->eafe_render_post_meta();
								endif;
								$this->eafe_render_excerpt();
								if('b_excerpt' === $eafe_meta_position):
									$this->eafe_render_post_meta();
								endif;
								$this->eafe_render_readmore_button();
								if('b_button' === $eafe_meta_position):
									$this->eafe_render_post_meta();
								endif;
							echo '</div>'; //End Content Wrapper
						echo '</div>'; // end single post wrapper
					echo '</div>'; // End column
			endwhile;
			echo '</div>'; //end row
			$this->eafe_render_pagination($paged, $eafe_post_query);
		endif; wp_reset_postdata();
	}

	public function eafe_render_post_thumbnail(){
		$settings = $this->get_settings_for_display();
		$eafe_post_thumbnail_show = $settings['post_thumbnail_show'];
		$eafe_image_size = $settings['image_size'];
		$eafe_post_category_show = $settings['post_category_show'];
		// $eafe_show_category_over_image = $settings['show_category_over_image'];
		$eafe_post_category_position = $settings['post_category_position'];
		// $eafe_category_wrapper = has_post_thumbnail() ? '' : ' position-static';

		if (has_post_thumbnail()) {
			if ('top_left_corner' === $eafe_post_category_position) {
			$eafe_post_caegory_wrapper_classes = ' position-left-top-corner';
			}elseif('top_right_corner' === $eafe_post_category_position){
				$eafe_post_caegory_wrapper_classes = ' position-right-top-corner';
			}elseif('bottom_left_corner' === $eafe_post_category_position){
				$eafe_post_caegory_wrapper_classes = ' position-bottom-left-corner';
			}elseif('bottom_right_corner' === $eafe_post_category_position){
				$eafe_post_caegory_wrapper_classes = ' position-bottom-right-corner';
			}elseif('above_title' === $eafe_post_category_position){
				$eafe_post_caegory_wrapper_classes = ' position-above-title position-static';
			}elseif('half_over_thumbnail' === $eafe_post_category_position){
				$eafe_post_caegory_wrapper_classes = ' position-half-over-thumbnail';
			}
		}else{
			$eafe_post_caegory_wrapper_classes = ' position-above-title position-static';
		}
		if('true' === $eafe_post_thumbnail_show) : ?>
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail( $eafe_image_size );?></a>
			<?php if('true' === $eafe_post_category_show && 'above_title' !== $eafe_post_category_position) : ?>
			<div class="eafe-posts-layout-one__categories<?php echo esc_attr($eafe_post_caegory_wrapper_classes);?>">
				<?php
					$categories_list = get_the_category_list( esc_html__( ', ', 'eafe' ) );
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links">' . esc_html__( '%1$s', 'eafe' ) . '</span>', $categories_list ); // WPCS: XSS OK.
					}
					?>
			</div>
			<?php endif;
		endif;
	}
	public function eafe_render_title(){
		$settings = $this->get_settings_for_display();
		$eafe_post_title_show = $settings['post_title_show'];
		if('true' === $eafe_post_title_show):
			?>
			<div class="eafe-posts-layout-one__title">
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			</div>
		<?php endif;
	}
	public function eafe_render_excerpt(){
		$settings = $this->get_settings_for_display();
		$eafe_post_excerpt_type = $settings['post_excerpt_type'];
		$eafe_post_excerpt_show = $settings['post_excerpt_show'];
		$eafe_post_excerpt_length = $settings['post_excerpt_length'];
		if('true' === $eafe_post_excerpt_show) :
			if ('excerpt' === $eafe_post_excerpt_type)  :
		?>
			<div class="eafe-posts-layout-one__excerpt">
				<p>
					<?php echo esc_html( eafe_get_excerpt( $eafe_post_excerpt_length ) );?>
				</p>
			</div>
		<?php
			elseif ('fullcontent' === $eafe_post_excerpt_type) :
				?>
				<div class="eafe-post-full-content-as-excerpt">
					<?php the_content(); ?>
				</div>
				<?php
			endif;
		endif;
	}
	public function eafe_render_readmore_button(){
		$settings = $this->get_settings_for_display();
		$eafe_read_button_show = $settings['read_button_show'];
		$eafe_read_more_button_text = $settings['read_more_button_text'];
		if('true' === $eafe_read_button_show):
		?>
		<div class="eafe-posts-layout-one__read-more">
			<a href="<?php the_permalink();?>"><?php echo esc_html($eafe_read_more_button_text); ?></a>
		</div>
		<?php endif;
	}
	public function eafe_render_post_meta(){
		$settings = $this->get_settings_for_display();
		$eafe_post_meta_show = $settings['post_meta_show'];
		$eafe_post_meta_data = is_array($settings['post_meta_data']) ? $settings['post_meta_data'] : array();
		if('true' === $eafe_post_meta_show) :
		?>
		<div class="eafe-posts-layout-one__blog-meta">
			<ul>
				<?php if(in_array('author', $eafe_post_meta_data)) : ?>
				<li class="author-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span class="post-author-image"><?php echo get_avatar( get_the_author_meta('ID'), 30); ?></span> <?php echo esc_html( get_the_author() ); ?></a></li>
				<?php endif;
				if(in_array('date', $eafe_post_meta_data)) :
				?>
				<li><a href="#"> <span class="fa-regular fa-calendar"></span><?php eafe_posted_on(); ?></a></li>
				<?php endif;
				if(in_array('comments', $eafe_post_meta_data)) :
				?>
				<li><span class="fas fa-comment"></span> <?php eafe_comment_popuplink(); ?></li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif;
	}
	public function eafe_render_category(){
		$settings = $this->get_settings_for_display();
		$eafe_post_category_show = $settings['post_category_show'];
		// $eafe_show_category_over_image = $settings['show_category_over_image'];
		$eafe_post_category_position = $settings['post_category_position'];
		if('true' === $eafe_post_category_show && 'above_title' === $eafe_post_category_position) : ?>
		<div class="eafe-posts-layout-one__categories position-static">
				<?php
				$categories_list = get_the_category_list( esc_html__( ', ', EAFE_TEXT_DOMAIN ) );
				if ( $categories_list ):
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . __( '%1$s', EAFE_TEXT_DOMAIN ) . '</span>', $categories_list ); // WPCS: XSS OK.
				endif;
				?>
		</div>
		<?php endif;
	}
	public function eafe_render_pagination($paged, $query){
		$settings = $this->get_settings_for_display();
		$eafe_posts_pagination = $settings['post_pagination_show'];
		$eafe_pagination_alignment = $settings['east_pagination_alignment'];
		$totalpages = $query->max_num_pages;
	    $current = max(1,$paged );
	    $prev_icon = '<i class="fas fa-angle-left"></i>';
	    $next_icon = '<i class="fas fa-angle-right"></i>';
		if ('number' === $eafe_posts_pagination && $totalpages > 1) :?>
		<div class="Page d-flex justify-content-<?php echo esc_attr( $eafe_pagination_alignment );?> frontpage navigation example">
			<div class="pagination-wrapper">
				<?php
				global $wp_query;
	            $big = 999999999; // need an unlikely integer
				$paginate_args = array(
		            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) ,
		            'format' => '?paged=%#%',
		            'current' => $current,
		            'total' => $totalpages,
		            'show_all' => False,
		            'end_size' => 1,
		            'mid_size' => 3,
		            'prev_next' => true,
		            'prev_text' => $prev_icon ,
		            'next_text' => $next_icon ,
		            'type' => 'list',
		          );
        		echo paginate_links($paginate_args);?>
			</div>
		</div>
		<?php elseif( 'navs' === $eafe_posts_pagination ) :
			$olderpost = esc_html__( 'Older Posts', EAFE_TEXT_DOMAIN ) . '<i class="fa fa-long-arrow-right"></i>';
			$newerpost = '<i class="fa fa-long-arrow-left"></i>' . esc_html__( 'Newer Posts', EAFE_TEXT_DOMAIN );
		?>
		<div class="post-navigation-older-newer">
			<div class="older-posts-link">
				<?php next_posts_link(  $olderpost, $query->max_num_pages ); ?>
			</div>
			<div class="newer-posts-link">
             	<?php previous_posts_link( $newerpost ) ?>
			</div>
		</div>
			<?php
		endif;
	}

}