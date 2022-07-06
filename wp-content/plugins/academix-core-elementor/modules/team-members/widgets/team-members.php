<?php
namespace AcademixCoreElementor\Modules\TeamMembers\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use AcademixCoreElementor\helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * TeamMembers Widget
 */
class TeamMembers extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'team_members';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Team Members', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-lock-user';
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
        return ['team', 'team members', 'academix-core-elementor'];
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
            'section_team_members_post',
            [
                'label' => __( 'Post Element', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'post_number',
            [
                'label'         => __( 'Number of Posts', 'academix-core-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 3,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => __( 'Order By', 'academix-core-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ID',
                'options'   => [
                    'none' 		=> __( 'None', 'academix-core-elementor' ),
                    'ID' 		=> __( 'ID', 'academix-core-elementor' ),
                    'title' 	=> __( 'Title', 'academix-core-elementor' ),
                    'date' 		=> __( 'Date', 'academix-core-elementor' ),
                    'rand' 		=> __( 'Random', 'academix-core-elementor' ),
                ],
            ]
        );
        $this->add_control(
            'order',
            [
                'label'     => __( 'Order', 'academix-core-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                    'DESC' 		=> __( 'Descending', 'academix-core-elementor' ),
                    'ASC' 		=> __( 'Ascending', 'academix-core-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'team_categories',
            [
                'label' => __('Category', 'academix-core-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::get_team_categories(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_team_members_settings',
            [
                'label' => __( 'Settings', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'column',
            [
                'label'         => __( 'Number of Column', 'academix-core-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'options'   => [
                    '12' 		=> __( '1', 'academix-core-elementor' ),
                    '6' 		=> __( '2', 'academix-core-elementor' ),
                    '4' 	    => __( '3', 'academix-core-elementor' ),
                    '3' 		=> __( '4', 'academix-core-elementor' ),
                ],
                'default'       => '4',
            ]
        );
        
        $this->add_control(
            'display_name',
            [
                'label' => __( 'Display Name', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'display_designation',
            [
                'label' => __( 'Display Designation', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'link_to_profile',
            [
                'label' => __( 'Link To Profile Page?', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'profile_in_new_tab',
            [
                'label' => __( 'Open Profile in new Tab?', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'link_to_profile' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'display_phone_number',
            [
                'label' => __( 'Display Phone Number', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'display_email',
            [
                'label' => __( 'Display Email', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'display_social_icon',
            [
                'label' => __( 'Display Social icon', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'display_view_all_btn',
            [
                'label' => __( 'Display View All Button', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'team_button_text',
            [
                'label'         => __( 'Button Text', 'academix-core-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => false,
                'default'       => __( 'View All', 'academix-core-elementor' ),
                'separator'     => 'before',
                'condition'     => [
                    'display_view_all_btn' => 'yes'
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
                    'url' => '#'
                ],
                'condition'     => [
                    'display_view_all_btn' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();
       
        $this->image_style();
        $this->team_name_style();
        $this->team_designation_style();
        $this->team_phone_style();
        $this->team_email_style();
        $this->wrapper_style();
    }

    protected function image_style()
    {
        $selector = '.profile-card figure img';
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'academix-core-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_width',
            [
                'label' => __( 'Width', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_height',
            [
                'label' => __( 'Height', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Image Radius', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
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
        $this->end_controls_section();
    }

    protected function team_name_style() {
        $selector = '.profile-card .fig-title';
        $this->start_controls_section(

            'team_name_style',
            [
                'label' 	=> __( 'Name', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_title_color',
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
                'name'                  => 'team_title_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'team_title_space',
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

    protected function team_designation_style() {
        $selector = '.profile-card .fig-title-des';
        $this->start_controls_section(

            'team_designation_style',
            [
                'label' 	=> __( 'Designation', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_designation_color',
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
                'name'                  => 'team_designation_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'team_designation_space',
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

    protected function team_phone_style() {
        $selector = '.profile-card .fig-cal';
        $this->start_controls_section(

            'team_phone_style',
            [
                'label' 	=> __( 'Phone', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_phone_Level_color',
            [
                'label' => __( 'Level Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector.' strong' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'team_phone_color',
            [
                'label' => __( 'Number Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector. ' span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'team_phone_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'team_phone_space',
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

    protected function team_email_style() {
        $selector = '.profile-card .fig-mail';
        $this->start_controls_section(

            'team_email_style',
            [
                'label' 	=> __( 'Email', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_email_Level_color',
            [
                'label' => __( 'Level Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector.' strong' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'team_email_color',
            [
                'label' => __( 'Email Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector. ' span'=> 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'team_email_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'team_email_space',
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

    protected function wrapper_style(){
        $selector = '.profile-card';
        $this->start_controls_section(

            'wrapper_style',
            [
                'label' 	=> __( 'Box', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
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
    
        if ( ! empty( $settings['button_url']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['button_url'] );
            $this->add_render_attribute( 'button', 'class', ['btn', 'btn-unsolemn', 'btn-action', 'read-more'] );
        }

        // custom post args
        $args = array(
            'post_type' => 'team',
            'posts_per_page' => $settings['post_number'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'team_cat' => $settings['team_categories']
        );

        $q = new \WP_Query( $args );

        if ( $q->have_posts() ):
        $html = '';
        $html .= '<div class="ace-section-team"><div class="row">';
        $i = 0;
        while ( $q->have_posts() ) : $q->the_post();
        $i++;
        $idd = get_the_ID();
        
        $prefix = '_academix_';

        $image_id = get_post_meta( get_the_ID(), $prefix . 'team_profile_picture_id', 1 );

        if ( wp_get_attachment_image( $image_id, 'academix-single-team-thumb', false, array( 'class' => 'img-responsive' ) ) ){
            $profile_image = wp_get_attachment_image( $image_id, 'academix-single-team-thumb', false, array( 'class' => 'img-responsive' ) );

        } else{
            $profile_image = '';
        }
            
        if ( get_post_meta( $idd , $prefix . 'member_designation', true) ){
            $member_designation = get_post_meta( $idd , $prefix . 'member_designation', true);
        } else{
            $member_designation = '';
        }

        if ( get_post_meta( $idd , $prefix . 'phone_number', true) ){
            $phone_number = get_post_meta( $idd , $prefix . 'phone_number', true);
        } else{
            $phone_number = '';
        }

        if ( get_post_meta( $idd , $prefix . 'email', true) ){
            $email = get_post_meta( $idd , $prefix . 'email', true);
        } else{
            $email = '';
        }
        
        $column = ( !empty($settings['column']) ) ? $settings['column'] : '4';
    
        $team_social = get_post_meta( $idd , $prefix . 'team_social', true);
        $html .= '<div class="col-sm-6 col-md-'.esc_attr($column).'">
                        <div class="profile-card profile-card-meta_classic">
                            <figure>
                                '.$profile_image.'
                                <figcaption>';

                                if ( $settings['display_name'] == 'yes' ){
                                    if ( $settings['link_to_profile'] === 'yes'){
                                        $target = $settings['profile_in_new_tab'] ? '_blank' : '_self';
                                        $html .= '<a href="'.esc_url(get_permalink()).'" target="'.esc_attr($target).'"><h3 class="fig-title">'.get_the_title().'</h3></a>';
                                    } else {
                                        $html .= '<h3 class="fig-title">'.get_the_title().'</h3>';
                                    }
                                }

                                if ( $settings['display_designation'] == 'yes' ){
                                    $html .= '<div class="fig-title-des">'.wp_kses_post($member_designation).'</div>';
                                }

                                $html .= '<div class="fig-meta">';

                                if ( $settings['display_phone_number'] == 'yes' ){
                                    $html .= '<p class="fig-cal"><strong>'.__('Call', 'academix-core-elementor').':</strong> <span>'.wp_kses_post($phone_number).'</span></p>';
                                }

                                if ( $settings['display_email'] == 'yes' ){
                                    $html .= '<p class="fig-mail"><strong>'.__('Email', 'academix-core-elementor').':</strong> <span>'.wp_kses_post($email).'</span></p>';
                                }

                                $html .= '</div>
                                </figcaption>
                            </figure>';

                    if( $settings['display_social_icon'] == 'yes' ){

                        if( isset($team_social) && is_array($team_social) ){

                        $html .= '<div class="profile-card-meta">
                                    <ul class="pfofile-social list-unstyled list-inline">';
                                    foreach ($team_social as $social) {
                                        if( isset($social['_academix_socail_link']) || $social['_academix_socail_icon'] ){
                                            $social_link = $social['_academix_socail_link'];
                                        } else{
                                            $social_link = '';
                                        }

                                        if( isset($social['_academix_socail_icon']) && $social['_academix_socail_icon'] ){
                                            $social_icon = $social['_academix_socail_icon'];
                                        } else{
                                            $social_icon = '';
                                        }
                                    if( $social_icon && $social_link ){
                                    $html .= '<li><a href="'.esc_url($social_link).'"> <img src="'.esc_url($social_icon).'" alt="sabbi-social" class="img-responsive"></a></li>';
                                    }
                                    }
                                $html .= '</ul>
                                </div>';
                        }
                    }

                    $html .= '</div>
                    </div>';

                    if( $i%2 === 0 ){
                        $html .= '<div class="team-clearfix"></div>';
                    }
                    
        endwhile;   

        wp_reset_postdata();

        if( $settings['display_view_all_btn'] == 'yes' ){
            $html .= '<div class="action-wrap text-right-sm"><a href="'.esc_url($settings['button_url']['url']).'" title="'. esc_attr($settings['team_button_text']) .'" target="_blank" class="btn btn-unsolemn btn-action">'.esc_html($settings['team_button_text']).'</a></div>';
        }
        $html .= '</div></div>';
        echo $html;
        endif;

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