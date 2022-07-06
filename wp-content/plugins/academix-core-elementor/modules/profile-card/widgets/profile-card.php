<?php
namespace AcademixCoreElementor\Modules\ProfileCard\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use AcademixCoreElementor\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * ProfileCard Widget
 */
class ProfileCard extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'profile-card';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Profile Card', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-user-preferences';
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
        return ['profile', 'profile card', 'academix-core-elementor'];
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
            'section_profile_card_settings',
            [
                'label' => __( 'Settings', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'team_cat_slug',
            [
                'label' => __('Select a team slug', 'academix-core-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::get_team_slugs(),
                'default' => 'dr-rushmore'
            ]
        );
        $this->add_control(
            'display_contact_title',
            [
                'label' => __( 'Display Contact Title', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
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
                'default' => 'no',
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
                'default' => 'no',
            ]
        );
        $this->add_control(
            'display_social_icons',
            [
                'label' => __( 'Display Social Icons', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
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
            'display_description',
            [
                'label' => __( 'Display Description', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'content_length',
            [
                'label' => esc_html__( 'Content Length', 'academix-core-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default'       => 300,
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
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'         => __( 'Button Text', 'academix-core-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => false,
                'default'       => __( 'read more', 'academix-core-elementor' ),
                'separator'     => 'before',
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
        // custom post args
        $args = array(
            'post_type' => 'team',
            'name' => $settings['team_cat_slug']
        );

        $q = new \WP_Query( $args );

        if( $q->have_posts() ):
            $html = '';
            while ( $q->have_posts() ) : $q->the_post();

                $idd = get_the_ID();
                $prefix = '_academix_';

                $image_id = get_post_meta( get_the_ID(), $prefix . 'team_profile_picture_id', 1 );

                if( wp_get_attachment_image( $image_id, 'academix-single-team-thumb', false, array( 'class' => 'img-thumpost img-responsive' ) ) ){
                    $profile_image = wp_get_attachment_image( $image_id, 'academix-single-team-thumb', false, array( 'class' => 'img-thumpost img-responsive' ) );
                } else{
                    $profile_image = '';
                }

                if( get_post_meta( $idd , $prefix . 'contact_title', true) ){
                    $contact_title = get_post_meta( $idd , $prefix . 'contact_title', true);
                } else{
                    $contact_title = '';
                }

                if( get_post_meta( $idd , $prefix . 'phone_number', true) ){
                    $phone_number = get_post_meta( $idd , $prefix . 'phone_number', true);
                } else{
                    $phone_number = '';
                }

                if( get_post_meta( $idd , $prefix . 'email', true) ){
                    $email = get_post_meta( $idd , $prefix . 'email', true);
                } else{
                    $email = '';
                }

                $team_social = get_post_meta( $idd , $prefix . 'team_social', true);


                $html .= '<article class="sabbi-thumlinepost-card solitude-bg__x profile-card">';

                $html .= '<figure class="sabbi-thumlinepost-card-figure">'.$profile_image.'';
                    $html .= '<figcaption>';
                        if( $settings['display_contact_title'] === 'yes' ){
                            $html .= '<h3 class="fig-title">'.wp_kses_post( $contact_title ).'</h3>';
                        }
                        $html .= '<div class="fig-meta">';

                            if( $settings['display_phone_number'] === 'yes' ){
                                $html .= '<p class="fig-cal"><strong>'.__('Call', 'academix-core-elementor').':</strong> <span><a href="tel:'.$email.'">'.wp_kses_post( $phone_number ).'</a></span></p>';
                            }

                            if( $settings['display_email'] === 'yes' ){
                                $html .= '<p class="fig-mail"><strong>'.__('Email', 'academix-core-elementor').':</strong> <span><a href="mailto:'.$email.'">'.wp_kses_post( $email ).'</a></span></p>';
                            }

                        $html .= '</div>';
                    $html .= '</figcaption>';
                $html .= '</figure>';


                if( $settings['display_social_icons'] === 'yes' ){
                    if( isset($team_social) && is_array($team_social) ){
                        $html .= '<div class="profile-card-meta">
                            <ul class="pfofile-social list-unstyled list-inline">';
                                foreach ($team_social as $social) {
                                    $social_link = '';
                                    if( isset($social['_academix_socail_link']) || $social['_academix_socail_icon'] ){
                                        $social_link = $social['_academix_socail_link'];
                                    }

                                    $social_icon = '';
                                    if( isset($social['_academix_socail_icon']) && $social['_academix_socail_icon'] ){
                                        $social_icon = $social['_academix_socail_icon'];
                                    }

                                    if( $social_icon && $social_link ) {
                                        $html .= '<li><a href="' . esc_url( $social_link ) . '"> <img src="'
                                            . esc_url( $social_icon )
                                            . '" alt="sabbi-social" class="img-responsive"></a></li>';
                                    }
                                }
                            $html .= '</ul>
                        </div>';
                    }
                }

                if( $settings['display_name'] === 'yes' ){
                    $html .= '<h2 class="entry-title">'.get_the_title().'</h2>';
                }

                $html .= '<div class="card_st_fix">';
                    if( $settings['display_description'] === 'yes' ){
                        $html .= wpautop(Helper::excerpt($idd, $settings['content_length']));
                    }

                    if ( ! empty( $settings['button_url']['url'] ) ) {
                        $this->add_link_attributes( 'button', $settings['button_url'] );
                        $this->add_render_attribute( 'button', 'class', ['btn', 'btn-unsolemn', 'btn-action', 'read-more'] );
                    }
                    if( $settings['display_button'] === 'yes' ){
                        $html .= '<div class="action-wrap"><a '.$this->get_render_attribute_string( 'button' ).'>'.esc_html($settings['button_text']).'</a></div>';
                    }

                $html .= '</div>';

                $html .= '</article>';
            endwhile;
            wp_reset_postdata();
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