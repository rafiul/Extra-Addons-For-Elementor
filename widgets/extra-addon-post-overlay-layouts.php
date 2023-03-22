<?php
/**
 * Extra Addons Post Overlay Layouts
 */
use \Elementor\Controls_Stack;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Image_Size;

class Extra_Addon_Post_Overlay_Layouts extends Widget_Base {

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
		return 'extra_addon_post_overlay_layouts';
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
		return __( 'Post Overlay Layout', EAFE_TEXT_DOMAIN );
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
			'eafe_post_query_section',
			[
				'label' => __( 'Query', EAFE_TEXT_DOMAIN ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs(
			'eafe_overlay_post_query_tabs'
		);
		$this->start_controls_tab(
			'eafe_overlay_post_query_include',
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
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'eafe_overlay_post_query_exclude',
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
		$this->end_controls_tabs();
		$this->add_control(
			'overlay_post_count',
			[
				'label' => __( 'Post Count', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 15,
				'step' => 1,
				'default' => 3,

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
		$this->end_controls_section();

		$this->start_controls_section(
			'main_overlay_post_element_on_off',
			[
				'label' => __( 'Post Element On//Off', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_image_show',
			[
				'label'        => __( 'Show Thumbnail?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'overlay_post', // Actually its `image_size`.
				'default' => 'large',
				'exclude' => [ 'custom' ],
			]
		);
		$this->add_control(
			'post_overlay_post_title_show',
			[
				'label'        => __( 'Show Title?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'show_overlay_post_excerpt',
			[
				'label'        => __( 'Show Excerpt?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'false',
			]
		);

		$this->add_control(
			'overlay_post_excerpt_length',
			[
				'label' => __( 'Excerpt Length', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::NUMBER,
				'min' => 70,
				'max' => 600,
				'step' => 10,
				'default' => 150,
				'condition' => [
					'show_overlay_post_excerpt' => 'true',
				],
			]
		);
		$this->add_control(
			'show_overlay_post_meta',
			[
				'label'        => __( 'Show Post Meta?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',

			]
		);
		$this->add_control(
			'overlay_post_meta_data',
			[
				'label' => __( 'Post Meta', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'author'	=>	__( 'Author', EAFE_TEXT_DOMAIN ),
					'date'	=>	__( 'Date', EAFE_TEXT_DOMAIN ),
				],
				'default'	=> ['author', 'date', 'comments'],
				'condition'	=>	[
					'show_overlay_post_meta'	=>	'true',
				]
			]
		);
		$this->add_control(
			'show_overlay_post_category',
			[
				'label'        => __( 'Show Category?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',

			]
		);

		$this->add_control(
			'eafe_overlay_post_layout_read_more_button',
			[
				'label'        => __( 'Show Read More Button?', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', EAFE_TEXT_DOMAIN ),
				'label_off'    => __( 'Hide', EAFE_TEXT_DOMAIN ),
				'return_value' => 'true',
				'default'      => 'true',

			]
		);

		$this->add_control(
			'button_text',
			[
				'label'        => __( 'Button Text', EAFE_TEXT_DOMAIN ),
				'type'         => Controls_Manager::TEXT,
				'default'      => __( 'Read More', EAFE_TEXT_DOMAIN ),
				'condition' => [
					'eafe_overlay_post_layout_read_more_button' => 'true',
				],
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
			'eafe_pagination_alignment',
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

		/*Style Tab*/
		$this->start_controls_section(
			'overlay_post_settings',
			[
				'label' => __( 'Post Settings', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'overlay_post_height',
			[
				'label' => __( 'Post Height', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail img' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'show_overlay_post_overly',
			[
				'label' => __( 'Show Post Overlay', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'return_value' => 'true',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'eafe_post_overlay_container',
				'label' => __( 'Post Overlay', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail .eafe-overlay-container',
				'fields_options' => [
			        'background' => [
			            'label' => __( 'Post Overlay Color', EAFE_TEXT_DOMAIN ),
			        ],
			    ],
				'condition' => [
					'show_overlay_post_overly' => 'true'
				]
			]
		);
		$this->add_responsive_control(
			'overlay_post_box_margin',
			[
				'label' => __( 'Post Box Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/*Style Tab*/
		$this->start_controls_section(
			'overlay_content_box_style',
			[
				'label' => __( 'Post Content Box', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_content_background',
				'show_label' => false,
				'label' => __( 'Post Content Background', EAFE_TEXT_DOMAIN ),
				'label_block'	=>	true,
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eafe-overlay-post-layouts .eafe-overlay-post-layouts__content >.container',
				'fields_options' => [
			        'background' => [
			            'label' => __( 'Post Content Box Background', EAFE_TEXT_DOMAIN ),
			        ],
			    ],
			]
		);
		$this->add_responsive_control(
			'overlay_content_box_padding',
			[
				'label' => __( 'Content Box Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layouts .eafe-overlay-post-layouts__content >.container, .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_content_box_margin',
			[
				'label' => __( 'Content Box Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layouts .eafe-overlay-post-layouts__content >.container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'overlay_content_box_radious',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layouts .eafe-overlay-post-layouts__content >.container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'overlay_content_vr_alignment',
			[
				'label'     => __( 'Content Alignment Verticle', EAFE_TEXT_DOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'flex-end',
				'options' => [
					'flex-start'  => __( 'TOP', EAFE_TEXT_DOMAIN ),
					'center' => __( 'Center', EAFE_TEXT_DOMAIN ),
					'flex-end' => __( 'Bottom', EAFE_TEXT_DOMAIN ),
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__content' => 'align-items: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'overlay_content_text_alignment',
			[
				'label'     => __( 'Text Alignment', EAFE_TEXT_DOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options' => [
					'left'  => __( 'Left', EAFE_TEXT_DOMAIN ),
					'center' => __( 'Center', EAFE_TEXT_DOMAIN ),
					'right' => __( 'Right', EAFE_TEXT_DOMAIN ),
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__content, {{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__content h2' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta ul' => 'justify-content: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_post_thumnail',
			[
				'label' => __( 'Post Thumbnail', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'overlay_post_image',
				'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail img',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_post_thumbnail_background',
				'label' => __( 'Thumbnail Background', EAFE_TEXT_DOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail.backgrouncolor',
			]
		);
		$this->add_control(
			'overlay_post_thumbnail_border_radius',
			[
				'label' => __( 'Border Radius', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__post-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'overlay_post_title_style',
			[
				'label' => __( 'Post Title', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'overlay_post_title_tabs'
		);
		$this->start_controls_tab(
			'overlay_post_title_style_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'overlay_post_title_typography',
				'selector' => '{{WRAPPER}} .eafe-overlay-post-title',
			]
		);
		$this->add_control(
			'overlay_post_heading_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'overlay_post_heading_text_shadow',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-overlay-post-title a',
			]
		);
		$this->add_responsive_control(
			'overlay_post_heading_padding',
			[
				'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_post_heading_margin',
			[
				'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'overlay_post_title_style_hover',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'overlay_post_heading_hover_color',
			[
				'label' => __( 'Title Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_overlay_post_title_border',
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
			'overlay_post_heading_border_color',
			[
				'label' => __( 'Border Color', EAFE_TEXT_DOMAIN ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'show_overlay_post_title_border' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .eafe-overlay-post-title a:hover' => 'background-image: linear-gradient(to right, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'overlay_post_heading_text_shadow_hover',
				'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .eafe-overlay-post-title a:hover',
			]
		);
	$this->end_controls_tab();
	$this->end_controls_tabs();
	$this->end_controls_section();
	$this->start_controls_section(
		'overlay_post_description_style',
		[
			'label' => __( 'Post Description', EAFE_TEXT_DOMAIN ),
			'tab'   => Controls_Manager::TAB_STYLE,

		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'overlay_post_description_typography',
			'selector' => '{{WRAPPER}} .excerpt',
		]
	);
	$this->add_control(
		'overlay_post_description_color',
		[
			'label' => __( 'Description Color', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Text_Shadow::get_type(),
		[
			'name' => 'overlay_post_description_text_shadow',
			'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
			'selector' => '{{WRAPPER}} .excerpt',
		]
	);
	$this->add_responsive_control(
		'overlay_post_description_padding',
		[
			'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->add_responsive_control(
		'overlay_post_description_margin',
		[
			'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);

	$this->end_controls_section();
	$this->start_controls_section(
		'overlay_post_category_style',
		[
			'label' => __( 'Post category', EAFE_TEXT_DOMAIN ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition'	=>	[
				'show_overlay_post_category' => 'true',
			]
		]
	);
	$this->start_controls_tabs(
			'overlay_post_category_tabs'
		);
	$this->start_controls_tab(
		'overlay_post_category_normal_tab',
		[
			'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'overlay_post_category_typography',
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a',
		]
	);
	$this->add_control(
		'overlay_post_category_color',
		[
			'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'overlay_post_category_bg_color',
		[
			'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a' => 'background: {{VALUE}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'overlay_post_category_border',
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a',
			'separator' => 'before',
		]
	);

	$this->add_control(
		'overlay_post_category_border_radius',
		[
			'label' => __( 'Border Radius', 'elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Text_Shadow::get_type(),
		[
			'name' => 'overlay_post_category_text_shadow',
			'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a',
		]
	);
	$this->add_responsive_control(
		'overlay_post_category_padding',
		[
			'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->add_responsive_control(
		'overlay_post_category_margin',
		[
			'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'overlay_post_category_hover_tab',
		[
			'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'overlay_post_category_hover_typography',
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a:hover',
		]
	);
	$this->add_control(
		'overlay_post_category_hover_color',
		[
			'label' => __( 'Category Color', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a:hover' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'overlay_post_category_hover_bg_color',
		[
			'label' => __( 'Category Background', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a:hover' => 'background: {{VALUE}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'overlay_post_hover_category_border',
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a:hover',
			'separator' => 'before',
		]
	);

	$this->add_control(
		'overlay_post_category_hover_border_radius',
		[
			'label' => __( 'Border Radius', 'elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__categories a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();
	$this->end_controls_section();
	$this->start_controls_section(
		'overlay_post_meta_style',
		[
			'label' => __( 'Post Post Meta', EAFE_TEXT_DOMAIN ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition'	=>	[
				'show_overlay_post_meta' => 'true',
			]
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'overlay_post_meta_typography',
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta li a',
		]
	);
	$this->add_control(
		'overlay_post_meta_color',
		[
			'label' => __( 'Meta Color', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta li a, {{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta li span' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Text_Shadow::get_type(),
		[
			'name' => 'overlay_post_meta_text_shadow',
			'label' => __( 'Text Shadow', EAFE_TEXT_DOMAIN ),
			'selector' => '{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta li',
		]
	);
	$this->add_responsive_control(
		'overlay_post_meta_padding',
		[
			'label' => __( 'Padding', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->add_responsive_control(
		'overlay_post_meta_margin',
		[
			'label' => __( 'Margin', EAFE_TEXT_DOMAIN ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .eafe-overlay-post-layout-area .eafe-overlay-post-layouts__blog-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);

	$this->end_controls_section();
	$this->start_controls_section(
			'eafe_pagination_style',
			[
				'label' => __( 'Pagination', EAFE_TEXT_DOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);
		$this->start_controls_tabs(
			'eafe_pagination_tabs'
		);

		$this->start_controls_tab(
			'eafe_pagination_tab_normal',
			[
				'label' => __( 'Normal', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eafe_pagination_typography',
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a',
			]
		);
		$this->add_control(
			'eafe_pagination_color',
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
			'eafe_pagination_bg_color',
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
				'name' => 'eafe_pagination_border',
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers, {{WRAPPER}} .post-navigation-older-newer a',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eafe_pagination_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
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
				'name' => 'eafe_pagination_text_shadow',
				'label' => __( 'Box Shadow', EAFE_TEXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .pagination-wrapper .page-numbers li a.page-numbers,{{WRAPPER}} .pagination-wrapper .page-numbers li span.current, {{WRAPPER}} .post-navigation-older-newer a',
			]
		);

		$this->add_responsive_control(
			'eafe_pagination_width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
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
			'eafe_pagination_height',
			[
				'label' => esc_html__( 'Height', 'elementor' ),
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
			'eafe_pagination_padding',
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
			'eafe_pagination_section_margin',
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
			'eafe_pagination_tab_hover',
			[
				'label' => __( 'Hover', EAFE_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'eafe_pagination_hover_color',
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
			'eafe_pagination_hover_bg_color',
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
		$eafe_posts_per_row = $settings['posts_per_row'];
		$eafe_get_categories = $settings['select_categories'];
		$overlay_post_count = $settings['overlay_post_count'];
		$authorIn = $settings['post_authors_include'];
		$postOffset = $settings['post_offset'];
		$excludeCategories = $settings['exclude_categories'];
		$excludeAuthors = $settings['exclude_authors'];
		$ignoreStickyPosts = $settings['ignore_sticky_post'];

		if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}
		$get_post_args = array(
			'post_type' => array('post'),
			'posts_per_page' => $overlay_post_count,
			'paged'	=> $paged,
		);
		if (!empty($eafe_get_categories)) {
			$eafe_cat_array_to_string = implode(',', $eafe_get_categories);
			$get_post_args['category_name'] = $eafe_cat_array_to_string;
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

		$overlay_post_V_alignment = $settings['overlay_content_vr_alignment'];
		?>
		<section class="eafe-overlay-post-layout-area">
			<div class="row">
				<?php
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
				$eafe_post_query = new WP_Query($get_post_args);
				while ($eafe_post_query->have_posts()) :
					$eafe_post_query->the_post();
				?>
				<div class="eafe-overlay-post-layout-column <?php echo esc_attr($post_columns_class);?>">
					<div class="eafe-overlay-post-layouts">
						<?php $this->eafe_render_post_thumbnail(); ?>
					    <div class="eafe-overlay-post-layouts__content <?php echo esc_attr($overlay_post_V_alignment);?>">
					         <div class="container">
						         <?php
						        $this->eafe_render_category();
						    	$this->eafe_render_title();
						    	$this->eafe_render_post_meta();
						    	$this->eafe_render_excerpt();
						    	?>
					        </div>
					    </div>
					</div>
				</div>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php
			$this->eafe_render_pagination($paged, $eafe_post_query); ?>
	    </section>
		<?php
	}
	private function eafe_render_post_thumbnail(){
		$settings = $this->get_settings_for_display();
		$post_image_show  = $settings['post_image_show'];
		$eafe_image_size = $settings['overlay_post_size'];
		$show_eafe_post_overlay_container = $settings['show_overlay_post_overly'];
		$nopost_thumbnail_class = 'true' === $post_image_show ? '' : ' backgrouncolor'; ?>
	    <div class="eafe-overlay-post-layouts__post-thumbnail<?php echo esc_attr( $nopost_thumbnail_class );?>">
	    	<a href="<?php the_permalink();?>">
		    	<?php if ('true' === $show_eafe_post_overlay_container):?>
		    	<div class="eafe-overlay-container"></div>
		    	<?php endif; ?>
		        <?php
		        if ('true' === $post_image_show) :
		        	if (get_transient( 'eafe_image_size' )) {
		        		$eafe_get_image_size = get_transient( 'eafe_image_size' );
		        	}else{
		        		$eafe_get_image_size = 'full';
		        	}
		         the_post_thumbnail( $eafe_get_image_size );
		     	endif;
		         ?>
	     	</a>
	    </div>
	   <?php
	}
	private function eafe_render_title(){
		$settings = $this->get_settings_for_display();
		$post_title_show = $settings['post_overlay_post_title_show'];
		$show_title_border = $settings['show_overlay_post_title_border'];
		if ('true' === $post_title_show) :
		?>
		<h2 class="eafe-overlay-post-title"><a class="<?php echo ('true' === $show_title_border ? esc_attr('border_on_hover') : esc_attr('no_border_on_hover'));?>" href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
		<?php
		endif;
	}
	private function eafe_render_category(){
		$settings = $this->get_settings_for_display();
		$show_overlay_post_category = $settings['show_overlay_post_category'];
		if('true' === $show_overlay_post_category) : ?>
         	<div class="eafe-overlay-post-layouts__categories">
				<?php
				$categories_list = get_the_category_list( esc_html__( ' ', EAFE_TEXT_DOMAIN ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . __( '%1$s', EAFE_TEXT_DOMAIN ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}
				?>
			</div>
		<?php endif;
	}
	private function eafe_render_post_meta(){
		$settings = $this->get_settings_for_display();
		$show_overlay_post_meta = $settings['show_overlay_post_meta'];
		$get_overlay_post_meta_data = is_array($settings['overlay_post_meta_data']) ? implode(',', $settings['overlay_post_meta_data']) : array();
		$overlay_post_meta_data = (!empty($get_overlay_post_meta_data) ? explode(',', $get_overlay_post_meta_data) : array());

		if ('true' === $show_overlay_post_meta && !empty($overlay_post_meta_data)) :?>
        <div class="eafe-overlay-post-layouts__blog-meta">
			<ul>
			<?php if(in_array('author', $overlay_post_meta_data)) : ?>
			<li class="author-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span class="post-author-image"><?php echo get_avatar( get_the_author_meta('ID'), 30); ?></span> <?php echo esc_html( get_the_author() ); ?></a></li>
			<?php endif;
			if(in_array('date', $overlay_post_meta_data)) :
			?>
			<li><a href="#"> <span class="fa-regular fa-calendar"></span><?php eafe_posted_on(); ?></a></li>
			<?php endif; ?>
			</ul>
		</div>
		<?php endif;
	}
	private function eafe_render_excerpt(){
		$settings = $this->get_settings_for_display();
		$overlay_post_excerpt_length 			   = $settings['overlay_post_excerpt_length'];
		$show_overlay_post_excerpt = $settings['show_overlay_post_excerpt'];
		if ('true' === $show_overlay_post_excerpt) :?>
	    	<p class="excerpt"> <?php echo esc_html( eafe_get_excerpt( $overlay_post_excerpt_length ) ); ?> </p>
		<?php endif;
	}
	private function eafe_render_post_readmore_button(){
		$settings = $this->get_settings_for_display();
		$eafe_overlay_post_layout_read_more_button = $settings['eafe_overlay_post_layout_read_more_button'];
		$button_text  = $settings['button_text'];
		if('true' === $eafe_overlay_post_layout_read_more_button): ?>
        <div class="welcome-button">
            <a href="<?php the_permalink();?>" class="btn btn-default button-primary"><?php echo esc_html($button_text); ?></a>
        </div>
    	<?php endif;
	}
	public function eafe_render_pagination($paged, $query){
		$settings = $this->get_settings_for_display();
		$eafe_posts_pagination = $settings['post_pagination_show'];
		$eafe_pagination_alignment = $settings['eafe_pagination_alignment'];
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