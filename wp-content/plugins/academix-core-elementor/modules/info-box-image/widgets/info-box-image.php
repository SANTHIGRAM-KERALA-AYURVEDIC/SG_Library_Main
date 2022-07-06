<?php
namespace AcademixCoreElementor\Modules\InfoBoxImage\Widgets;

// Elementor Classes
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
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
 * LatestEvent Widget
 */
class InfoBoxImage extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'info_box_image';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Info Box Image', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-image-box';
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
        return ['info', 'info box', 'info box image', 'academix'];
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
     * Register buttons widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__( 'Image Box', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'academix-core-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title & Description', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Immunology: T-cell tweaks to target tumours', 'academix-core-elementor' ),
                'placeholder' => esc_html__( 'Enter your title', 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, con adipiscing elit. Etiam convallis elit id impedie. Quisq commodo', 'academix-core-elementor' ),
                'placeholder' => esc_html__( 'Enter your description', 'academix-core-elementor' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => esc_html__( 'Title HTML Tag', 'academix-core-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'display_button',
            [
                'label' => __( 'Display Button', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator'     => 'before',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'         => __( 'Button Text', 'academix-core-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => false,
                'default'       => __( 'read more', 'academix-core-elementor' ),
                'condition'     => [
                    'display_button' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'             => __( 'Button URL', 'academix-core-elementor' ),
                'type'              => Controls_Manager::URL,
                'dynamic'           => [
                    'active'  => true,
                ],
                'label_block'       => true,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
        $this->image_style();
        $this->title_style();
        $this->description_style();
        $this->button_style();
        $this->wrapper_style();
    }

    protected function image_style()
    {
        $selector = '.sabbi-thumlinepost-card-figure img';
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'academix-core-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_space',
            [
                'label' => esc_html__( 'Spacing', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} '.$selector => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} '.$selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} '.$selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function title_style() {
        $selector = '.sabbi-thumlinepost-card-meta .info-box-title';
        $this->start_controls_section(

            'title_style',
            [
                'label' 	=> __( 'Title', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'title_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => esc_html__( 'Spacing Bottom', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function description_style() {
        $selector = '.sabbi-thumlinepost-card-meta .info-box-description';
        $this->start_controls_section(

            'description_style',
            [
                'label' 	=> __( 'Description', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'description_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'description_bottom_space',
            [
                'label' => esc_html__( 'Spacing Bottom', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function button_style(){
        $selector = '.sabbi-thumlinepost-card .btn-action';
        $selectorHover = '.sabbi-thumlinepost-card .btn-action:hover';

        $this->start_controls_section(

            'button_style',
            [
                'label'     => __( 'Button', 'academix-core-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->start_controls_tabs( 'button_style_tabs' );

        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __( 'Normal', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );
        $this->end_controls_tab();
        # End Normal Style Tab
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'Hover', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selectorHover => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selectorHover,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selectorHover,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} '.$selectorHover,
            ]
        );
        $this->end_controls_tab();
        # End Hover Style Tab
        $this->end_controls_tabs();
        #End Tabs

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function wrapper_style(){
        $selector = '.sabbi-thumlinepost-card';
        $this->start_controls_section(

            'wrapper_style',
            [
                'label' 	=> __( 'Box', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_height',
            [
                'label' => __( 'Min Height', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );
        $this->add_control(
            'wrapper_border_radius',
            [
                'label' => __('Border Radius', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' .$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render buttons widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $has_content = ! Utils::is_empty( $settings['description_text'] );
        $has_title = ! Utils::is_empty( $settings['title_text'] );

        if ( ! empty( $settings['button_url']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['button_url'] );
            $this->add_render_attribute( 'button', 'class', ['btn', 'btn-unsolemn', 'btn-action', 'read-more'] );
        }

        $html = '';
        $html .= ' <article class="sabbi-thumlinepost-card solitude-bg__x">';

        if ( ! empty( $settings['image']['url'] ) ) {
            $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
            $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

            $image_html = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );

            $html .= '<figure class="sabbi-thumlinepost-card-figure">' . $image_html . '</figure>';
        }

        $html .= '<div class="sabbi-thumlinepost-card-meta">';

        if( $has_title ) {
            $this->add_render_attribute( 'title_text', 'class', ['info-box-title', 'ht-5'] );
            $html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $settings['title_text'] );
        }

        if( $has_content ){
            $html .= '<p class="info-box-description">'.$settings['description_text'].'</p>';
        }

        if( $settings['display_button'] == 'yes' ){
            $html .= '<a '.$this->get_render_attribute_string( 'button' ).'>'.esc_html($settings['button_text']).'</a>';
        }

        $html .= '</div></article>';

        echo $html;
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