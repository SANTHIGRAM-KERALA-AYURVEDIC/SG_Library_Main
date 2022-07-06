<?php
namespace AcademixCoreElementor\Modules\Slider\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Slider Widget
 */
class Slider extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'slider';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Slider', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slides';
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
        return ['slider', 'academix'];
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
        return ['sequence-min', 'academix-core-elementor'];
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
            'section_slider',
            [
                'label' => __( 'Content', 'academix-core-elementor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slider_title', [
                'label' => __( 'Title', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Your conference title here' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_content', [
                'label' => __( 'Content', 'academix-core-elementor' ),
                'description' => __( 'Your Content', 'academix-core-elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a ' , 'academix-core-elementor' ),
                'show_label' => true,
                'separator'     => 'before',
            ]
        );

        $repeater->add_control(
            'slider_button_text', [
                'label' => __( 'Button Text', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'READ MORE' , 'academix-core-elementor' ),
                'label_block' => true,
                'separator'     => 'before',
            ]
        );

        $repeater->add_control(
            'slider_button_url',
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

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_background',
                'label' => __( 'Slider Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );
        $this->add_control(
            'slider_data',
            [
                'label' => __( 'Slider Items', 'academix-core-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_title' => __( 'Where it all began', 'academix-core-elementor' ),
                        'slider_content' => __( 'Congratulations Dr Rushmore : his research to develop a new detection strategy for cancer has received a new National Health and Medical Research Council', 'academix-core-elementor' ),
                    ],
                    [
                        'slider_title' => __( 'Polymeric microvalves', 'academix-core-elementor' ),
                        'slider_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat est adipisci sapiente ab unde nam facilis rem atque deleniti dolor!', 'academix-core-elementor' ),
                    ],
                    [
                        'slider_title' => __( 'DR. Rushmore’s Research', 'academix-core-elementor' ),
                        'slider_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat est adipisci sapiente ab unde nam facilis rem atque deleniti dolor!', 'academix-core-elementor' ),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );
        $this->add_control(
            'slider_autoplay',
            [
                'label' => __( 'Enable Auto Play', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => true,
                'default' => true,
            ]
        );
        $this->add_control(
            'slider_autoplay_interval',
            [
                'label' => __( 'Interval Time', 'academix-core-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15000,
                'step' => 1,
                'default' => 3000,
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]
        );
        $this->end_controls_section();

        $this->slider_item_style();
        $this->slider_item_info_box_style();
        $this->slider_item_info_box_title_style();
        $this->slider_item_info_box_des_style();
        $this->slider_nav_style();
    }

    protected function slider_item_style() {
        $selector = '.sabbi-site-header-meta .seq--kawsa';
        $this->start_controls_section(

            'slider_item_style',
            [
                'label' 	=> __( 'Slider Item', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'slider_height',
            [
                'label' => __( 'Height', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'vh','px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 85,
                    'unit' => 'vh',
                ],
                'tablet_default' => [
                    'size' => 55,
                    'unit' => 'vh',
                ],
                'mobile_default' => [
                    'size' => 55,
                    'unit' => 'vh',
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_min_height',
            [
                'label' => __( 'Min Height', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'vh','px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 600,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 420,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 385,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_item_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slider_item_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_responsive_control(
            'slider_item_padding',
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

    protected function slider_item_info_box_style() {
        $selector = '.seq--kawsa.seq-active .seq-content';
        $this->start_controls_section(

            'slider_item_info_box_style',
            [
                'label' 	=> __( 'Item Info Box', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_item_info_box_bg_color',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .seq--kawsa.seq-active .seq-content::before',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_item_info_box_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slider_item_info_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_responsive_control(
            'slider_item_info_box_padding',
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

    protected function slider_item_info_box_title_style() {
        $selector = '.seq--kawsa.seq-active .seq-content .seq-title';
        $this->start_controls_section(

            'slider_item_info_box_title_style',
            [
                'label' 	=> __( 'Info Box Title', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_item_info_box_title_color',
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
                'name'                  => 'slider_item_info_box_title_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'slider_item_info_box_title_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function slider_item_info_box_des_style() {
        $selector = '.seq--kawsa.seq-active .seq-content .seq-meta-text';
        $this->start_controls_section(

            'slider_item_info_box_des_style',
            [
                'label' 	=> __( 'Info Box Description', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_item_info_box_des_color',
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
                'name'                  => 'slider_item_info_box_des_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'slider_item_info_box_des_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function slider_nav_style() {
        $selector = '.sec-navigate-wrap .seq-next, .sec-navigate-wrap .seq-prev';
        $selectorHover = '.sec-navigate-wrap .seq-next:hover, .sec-navigate-wrap .seq-prev:hover';

        $this->start_controls_section(

            'slider_nav_style',
            [
                'label'     => __( 'Navigation', 'academix-core-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'slider_nav_style_tabs' );

        $this->start_controls_tab(
            'slider_nav_normal',
            [
                'label' => __( 'Normal', 'academix-core-elementor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_nav_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_control(
            'slider_nav_border_radius',
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
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_nav_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slider_nav_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );
        $this->end_controls_tab();
        # End Normal Style Tab
        $this->start_controls_tab(
            'slider_nav_hover',
            [
                'label' => __( 'Hover', 'academix-core-elementor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slider_nav_hover_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selectorHover,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_nav_hover_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selectorHover,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_nav_hover_background',
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
            'slider_nav_padding',
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
            'slider_nav_margin',
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



    protected function sliderNavigation()
    {
        return '<div class="sec-navigate-wrap pos-y_center">
            <button type="button" class="seq-next"></button>
            <button type="button" class="seq-prev"></button>
        </div>';
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
        $slider_autoplay = isset($settings['slider_autoplay']) ? $settings['slider_autoplay'] : null;
        $slider_autoplay_interval = isset($settings['slider_autoplay_interval']) ? $settings['slider_autoplay_interval'] : null;

        $html = '';
        if( !empty( $settings['slider_data'] ) && is_array( $settings['slider_data'] ) ) {

            $html .= '<div class="sabbi-site-head"><div class="sabbi-site-header-meta" >
            <div class="site-hmsl-content text-center pt_60">
                <div class="seq seq--kawsa" id="sequence" data-slideautoPlay="'.$slider_autoplay.'" data-slideautoPlayInterval="'.$slider_autoplay_interval.'">
                    <div class="seq-screen">
                        <ul class="seq-canvas">';
            $i = 0;
            foreach ( $settings['slider_data'] as $slide ) {
                $i++;
                if ( ! empty( $slide['slider_button_url']['url'] ) ) {
                    $this->add_link_attributes( 'button', $slide['slider_button_url'] );
                    $this->add_render_attribute( 'button', 'class', ['btn-link', 'btn-more'] );
                }

                $html .= '<li class="seq-step1 '.esc_attr('elementor-repeater-item-'.$slide['_id']) .'" id="step'.esc_attr($i).'">
                        <div class="bg-blend"></div>
                <div class="seq-content" >';

                if(!empty($slide['slider_title'])){
                    $html .= '<h2 class="seq-title tt_up" data-seq="">'.esc_html($slide['slider_title']).'</h2>';
                }

                if(!empty($slide['slider_content'])){
                    $html .= '<div class="seq-meta" data-seq="">
                        <p class="seq-meta-text">'.$slide['slider_content'].'</p>
                    </div>';
                }
                if( !empty($slide['slider_button_text']) ) {
                    $html .= '<a '.$this->get_render_attribute_string( 'button' ).'>' . esc_html( $slide['slider_button_text'] ) . '</a>';
                }
                $html .= '</div></li>';
            }
            $html .= '</ul>';
            $html  .= $this->sliderNavigation();
            $html .= '</div>
                </div>
            </div>
        </div>
        </div>';
        }
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
