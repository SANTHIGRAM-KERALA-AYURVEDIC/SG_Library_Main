<?php
namespace AcademixCoreElementor\Modules\PostGrid\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * PostGrid Widget
 */
class PostGrid extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'post-grid';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Post Grid', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['post', 'post gird', 'blog post', 'blog', 'latest post', 'academix'];
    }

    /**
     * Retrieve the list of scripts the buttons widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the button widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'academix-widgets' ];
    }



    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->register_general_controls();
        $this->register_query_controls();
        $this->register_additional_controls();
        $this->register_image_style_controls();
        $this->register_title_style_controls();
        $this->register_meta_style_controls();
        $this->register_content_style_controls();
        $this->register_btn_style_controls();
        $this->register_box_style_controls();
    }

    protected function register_general_controls(){
        $this->start_controls_section(
            'section_post-grid',
            [
                'label' => __( 'Post Grid', 'academix-core-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'Columns', 'academix-core-elementor' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => 4,
                'tablet_default' => 6,
                'mobile_default' => 12,
                'options'        => [
                    12 => '1',
                    6 => '2',
                    4 => '3',
                    3 => '4',
                    2 => '5',
                ],
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label' => __('Limit', 'academix-core-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->add_control(
            'column_gap',
            [
                'label'   => esc_html__( 'Column Gap', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'small'    => esc_html__( 'Small', 'academix-core-elementor' ),
                    'medium'   => esc_html__( 'Medium', 'academix-core-elementor' ),
                    'large'    => esc_html__( 'Large', 'academix-core-elementor' ),
                    'default' => esc_html__( 'Default', 'academix-core-elementor' ),
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_size',
                'exclude'   => [ 'custom' ],
                'default'   => 'full',
            ]
        );


        $this->end_controls_section();

    }

    protected function register_query_controls(){

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'Query', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => esc_html__( 'Date', 'academix-core-elementor' ),
                    'post_title' => esc_html__( 'Title', 'academix-core-elementor' ),
                    'menu_order' => esc_html__( 'Menu Order', 'academix-core-elementor' ),
                    'rand'       => esc_html__( 'Random', 'academix-core-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__( 'ASC', 'academix-core-elementor' ),
                    'desc' => esc_html__( 'DESC', 'academix-core-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_additional_controls(){
        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __( 'Additional Options', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'   => esc_html__( 'Title', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label'   => esc_html__( 'Author', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'   => esc_html__( 'Date', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'   => esc_html__( 'Excerpt', 'academix-core-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'      => esc_html__( 'Excerpt Length', 'academix-core-elementor' ),
                'type'       => Controls_Manager::NUMBER,
                'default'    => 25,
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'show_excerpt',
                            'value' => 'yes'
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'show_readmore',
            [
                'label'     => esc_html__( 'Read More', 'academix-core-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'readmore_text',
            [
                'label'       => esc_html__( 'Read More Text', 'academix-core-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'academix-core-elementor' ),
                'placeholder' => esc_html__( 'Enter your text', 'academix-core-elementor' ),
                'condition'   => [
                    'show_readmore' => 'yes',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function register_image_style_controls(){
        $this->start_controls_section(
            'post_grid_image',
            [
                'label' => __( 'Image', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_grid_image_height',
            [
                'label' => __( 'Height', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_image_width',
            [
                'label' => __( 'Width', 'academix-core-elementor' ),
                'size_units' => [ 'px', '%' ],
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_grid_image_border',
                'selector' => '{{WRAPPER}} .academix-blog-item img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'post_grid_image_border_radius',
            [
                'label' => __( 'Border Radius', 'academix-core-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_image_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_image_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_title_style_controls(){
        $this->start_controls_section(
            'post_grid_title',
            [
                'label' => __( 'Title', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_grid_title_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner h3 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_grid_title_typography',
                'selector' => '{{WRAPPER}} .academix-blog-item .blog-inner h3 a',
            ]
        );

        $this->add_responsive_control(
            'post_grid_title_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_title_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_title_align',
            [
                'label' => __( 'Alignment', 'academix-core-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_content_style_controls(){
        $this->start_controls_section(
            'post_grid_content',
            [
                'label' => __( 'Content', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_grid_content_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_grid_content_typography',
                'selector' => '{{WRAPPER}} .academix-blog-item .blog-inner p',
            ]
        );

        $this->add_responsive_control(
            'post_grid_content_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_content_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_content_align',
            [
                'label' => __( 'Alignment', 'academix-core-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner p' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_meta_style_controls(){
        $this->start_controls_section(
            'post_grid_meta',
            [
                'label' => __( 'Meta', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_grid_meta_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-post-info ul li strong' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_grid_meta_link_color',
            [
                'label' => __( 'Link Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-post-info ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_grid_meta_typography',
                'selector' => '{{WRAPPER}} .academix-blog-post-info ul li a, .academix-blog-post-info ul li strong',
            ]
        );

        $this->add_control(
            'post_grid_meta_space',
            [
                'label' => __( 'Space Between Meta', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-post-info ul li:not(:last-child)' => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_meta_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-post-info ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_meta_align',
            [
                'label' => __( 'Alignment', 'academix-core-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'academix-core-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-post-info ul' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_btn_style_controls(){
        $this->start_controls_section(
            'post_grid_read_more',
            [
                'label' => __( 'Read More', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_grid_read_more_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_grid_read_more_hover_color',
            [
                'label' => __( 'Hover Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_grid_read_more_bg_color',
            [
                'label' => __( 'Background Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_grid_read_more_bg_hover_color',
            [
                'label' => __( 'Background Hover Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_read_more_fz',
            [
                'label' => __( 'Font Size', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em' ],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'default' => [],
                'tablet_default' => [],
                'mobile_default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_read_more_padding',
            [
                'label' => __( 'Padding', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_grid_read_more_border',
                'selector' => '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'post_grid_read_more_border_radius',
            [
                'label' => __( 'Border Radius', 'academix-core-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner a.read-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_box_style_controls(){
        $this->start_controls_section(
            'post_grid_box',
            [
                'label' => __( 'Box', 'academix-core-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_grid_box_bg_color',
            [
                'label' => __( 'Background Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_grid_box_border',
                'selector' => '{{WRAPPER}} .academix-blog-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'post_grid_box_border_radius',
            [
                'label' => __( 'Border Radius', 'academix-core-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_grid_box_shadow',
                'selector' => '{{WRAPPER}} .academix-blog-item',
            ]
        );

        $this->add_responsive_control(
            'post_grid_box_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item .blog-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_grid_box_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .academix-blog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render_image( $image_id, $image_size ) {

        $placeholder_image_src = Utils::get_placeholder_image_src();

        $image_src = wp_get_attachment_image_src( $image_id, $image_size );

        if ( ! $image_src ) {
            $image_src = $placeholder_image_src;
        } else {
            $image_src = $image_src[0];
        }

        echo '<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '"><img src="'.esc_url($image_src).'" class="img-fluid" alt="' . esc_attr(get_the_title()) . '"></a>';
    }

    public function render_title() {

        if ( ! $this->get_settings('show_title') ) {
            return;
        }

        echo '<h3><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">
                    ' . esc_html(get_the_title())  . '</a></h3>';
    }

    public function render_date() {

        if ( ! $this->get_settings('show_date') ) {
            return;
        }

        echo '<li><strong>'.esc_html__('Posted On', 'academix-core-elementor').'</strong><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.esc_attr(get_the_date()).'</a></li>';
    }

    public function render_author() {

        if ( ! $this->get_settings('show_author') ) {
            return;
        }

        echo '<li>'.esc_html__('By ', 'academix-core-elementor').'<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author().'</a></li>';
    }

    public function render_excerpt($excerpt_length) {

        if ( ! $this->get_settings('show_excerpt') ) {
            return;
        }

        echo '<p>' . wp_trim_words( get_the_excerpt(), $excerpt_length, '') . '</p>';
    }

    public function render_readmore() {

        if ( ! $this->get_settings('show_readmore') ) {
            return;
        }

        echo '<a class="read-more-btn" href="' . esc_url(get_permalink()) . '">'.esc_html($this->get_settings('readmore_text')).'</a>';
    }


    public function render_post_grid_item( $post_id, $image_size, $excerpt_length ) {
        $settings = $this->get_settings();
        global $post;

        ?>
        <div class="academix-blog-item">

            <?php $this->render_image(get_post_thumbnail_id( $post_id ), $image_size ); ?>

            <div class="blog-inner">

                <?php $this->render_title(); ?>

                <?php if ($settings['show_author'] or $settings['show_date']) : ?>
                    <div class="academix-blog-post-info">
                        <ul>
                            <?php $this->render_date(); ?>
                            <?php $this->render_author(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php $this->render_excerpt($excerpt_length); ?>
                <?php $this->render_readmore(); ?>
            </div>

        </div>
        <?php
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        global $post;

        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty($post_limit) ? $post_limit : 3,
            'order'                 => $order,
            'orderby'               => $orderby
        );

        $query = new \WP_Query( $args );

        if( $query->have_posts() ){
            ?>
            <div class="academix-blog-grid col-sm-12">
                <div class="row">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        $image_size = isset($image_size) ? $image_size : 'full';
                        ?>
                        <div class="col-sm-12 col-md-<?php echo esc_attr($columns); ?> <?php echo esc_attr($column_gap); ?>">
                            <?php $this->render_post_grid_item( $post->ID, $image_size, $excerpt_length ); ?>
                        </div>
                    <?php
                    endwhile;
                    ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        }
    }

    /**
     * Render buttons widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {

    }
}