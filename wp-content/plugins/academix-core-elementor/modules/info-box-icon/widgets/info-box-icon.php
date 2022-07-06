<?php
namespace AcademixCoreElementor\Modules\InfoBoxIcon\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * LatestEvent Widget
 */
class InfoBoxIcon extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'info_box_icon';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Info Box Icon', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-icon-box';
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
        return ['info', 'info box', 'info box icon', 'academix'];
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
            'section_icon',
            [
                'label' => esc_html__( 'Icon Box', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'icon_library',
            [
                'label' => esc_html__( 'Icon Library', 'academix-core-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ion_icons' => esc_html__( 'Ionicons', 'academix-core-elementor' ),
                    'font_awesome' => esc_html__( 'Font Awesome', 'academix-core-elementor' ),
                ],
                'default' => 'ion_icons',
            ]
        );

        $this->add_control(
            'ion_icons',
            [
                'label' => esc_html__( 'Ionicons', 'academix-core-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ion-alert' => esc_html__( 'Alert', 'academix-core-elementor' ),
                    'ion-alert-circled' => esc_html__( 'Alert Circled', 'academix-core-elementor' ),
                    'ion-ios-flask-outline' => esc_html__( 'flask outline', 'academix-core-elementor' ),
                    'ion-ios-flame-outline' => esc_html__( 'flame outline', 'academix-core-elementor' ),
                    'ion-ios-lightbulb-outline' => esc_html__( 'lightbulb outline', 'academix-core-elementor' ),
                    'ion-ios-analytics-outline' => esc_html__( 'analytics outline', 'academix-core-elementor' ),
                ],
                'default' => 'ion-ios-flask-outline',
                'condition' => [
                    'icon_library' => 'ion_icons'
                ]
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'academix-core-elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_library' => 'font_awesome'
                ]
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
                'default' => esc_html__( 'Point-of-care (POC) devices', 'academix-core-elementor' ),
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
                'default' => 'h3',
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
                'default' => 'no',
                'separator'     => 'before',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'         => __( 'Button Text', 'academix-core-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => false,
                'default'       => __( 'Read More', 'academix-core-elementor' ),
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
                'condition'     => [
                    'display_button' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
        $this->icon_style();
        $this->title_style();
        $this->description_style();
        $this->button_style();
        $this->wrapper_style();
    }

    protected function icon_style(){
        $selector = '.icon-card .icon-card-limn > i';
        $this->start_controls_section(

            'icon_style',
            [
                'label' 	=> __( 'Icon', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bottom_space',
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
    protected function title_style() {
        $selector = '.icon-card .card-title';
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
        $selector = '.icon-card .card-meta';
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
        $selector = '.icon-card .btn-action';
        $selectorHover = '.icon-card .btn-action:hover';

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
        $selector = '.icon-card';
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

        if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['icon'] = 'fa fa-star';
        }

        $has_icon = ! empty( $settings['icon'] );
        if ( $has_icon ) {
            $this->add_render_attribute( 'i', 'class', $settings['icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }
        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }
        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( ! empty( $settings['button_url']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['button_url'] );
            $this->add_render_attribute( 'button', 'class', ['btn', 'btn-unsolemn', 'btn-action', 'read-more'] );
        }
        ?>
        <div class="icon-card text-center">
            <figure class="icon-card-limn">
                <?php if($settings['icon_library'] !== 'font_awesome'){ ?>
                    <i class="<?php echo $settings['ion_icons']; ?>"></i>
                <?php } else { ?>
                    <?php if ( $is_new || $migrated ) {
                        Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    }
                    if ( ! empty( $settings['icon'] ) ) { ?>
                        <i <?php echo $this->print_render_attribute_string('i'); ?>></i> ?>
                    <?php } ?>
                <?php } ?>
            </figure>
        <?php
            if( $has_title ) {
                $this->add_render_attribute( 'title_text', 'class', 'card-title' );
                echo sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $settings['title_text'] );
            }
        ?>

        <?php if( $has_content ){ ?>
            <p class="card-meta"> <?php echo $settings['description_text'] ?></p>
        <?php } ?>

        <?php if( $settings['display_button'] == 'yes' ){ ?>
            <a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo esc_html($settings['button_text']); ?></a>
        <?php } ?>
        </div>
    <?php
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