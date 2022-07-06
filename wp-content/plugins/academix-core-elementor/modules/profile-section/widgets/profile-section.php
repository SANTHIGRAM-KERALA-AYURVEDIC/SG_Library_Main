<?php
namespace AcademixCoreElementor\Modules\ProfileSection\Widgets;

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
class ProfileSection extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'profile-section';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Profile Section', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-time-line';
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
        return ['profile', 'profile section', 'academix-core-elementor'];
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
            'section_type',
            [
                'label' => __('Select a Profile Section', 'academix-core-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    ''  => esc_html__('Select a profile section', 'academix-core-elementor'),
                    'basic_and_bio'  => esc_html__('Basic Info And Biography', 'academix-core-elementor'),
                    'education' => esc_html__('Education', 'academix-core-elementor'),
                    'pro_experience' => esc_html__('Professional Experience', 'academix-core-elementor'),
                    'awards_prizes' => esc_html__('Awards Prizes', 'academix-core-elementor'),
                ),
                'default' => 'education'
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

                $member_designation = '';
                if( get_post_meta( $idd , $prefix . 'member_designation', true) ){
                    $member_designation = get_post_meta( $idd , $prefix . 'member_designation', true);
                }

                $member_institute = '';
                if( get_post_meta( $idd , $prefix . 'member_institute', true) ){
                    $member_institute = get_post_meta( $idd , $prefix . 'member_institute', true);
                }

                $team_education = get_post_meta( $idd , $prefix . 'team_education', true);
                $team_professional_experience = get_post_meta( $idd , $prefix . 'team_professional_appoinments', true);
                $team_awards_prizes = get_post_meta( $idd , $prefix . 'team_awards_prizes', true);

                if( $settings['section_type'] == 'basic_and_bio' ){
                    $html .= '<article class="profile-glimps">';

                    $html .= '<h2 class="entry-title title-foc-md">'.get_the_title().'</h2>
                            <p class="text-foc-md">'.wp_kses_post( $member_designation ).'</p>
                            <p class="text-foc-md">'.wp_kses_post( $member_institute ).'</p>';

                    $html .= '<div class="stage-content-biog">'.get_the_content($idd).'</div>';
                    $html .= '</article>';
                }

                if( $settings['section_type'] == 'education' ){
                    if( isset($team_education) && is_array($team_education) ){
                        $html .= '<div class="education_timeline_wrap">
                        <ol class="ol-timeline">';
                        foreach ($team_education as $education) {
                            $education_year = '';
                            if( isset( $education['_academix_education_year'] ) || !empty( $education['_academix_education_year'] ) ){
                                $education_year = $education['_academix_education_year'];
                            }

                            $education_institute = '';
                            if( isset( $education['_academix_education_institute'] ) || !empty( $education['_academix_education_institute'] ) ){
                                $education_institute = $education['_academix_education_institute'];
                            }

                            $education_degree = '';
                            if( isset( $education['_academix_education_degree'] ) || !empty( $education['_academix_education_degree'] ) ){
                                $education_degree = $education['_academix_education_degree'];
                            }

                            $html .= '<li class="tl-item with-icon">
                                <p><span class="item-section">'.wp_kses_post( $education_year ).'</span></p>
                                <div class="content-wrapper">
                                    <h3 class="title">'.wp_kses_post( $education_degree ).'</h3>
                                    <div class="description">'.wp_kses_post( $education_institute ).'</div>
                                </div>
                            </li>';
                        }
                        $html .= '</ol>
                    </div>';
                    }
                }

                if( $settings['section_type'] == 'pro_experience' ){
                    if( isset($team_professional_experience) && is_array($team_professional_experience) ){
                        $html .= '<div class="pro-experience">
                        <ol class="appoint-timeline  list-unstyled">';
                            foreach ($team_professional_experience as $pro_experience) {
                                $pe_year = '';
                                if( isset( $pro_experience['_academix_pa_year'] ) || !empty( $pro_experience['_academix_pa_year'] ) ){
                                    $pe_year = $pro_experience['_academix_pa_year'];
                                }

                                $pe_designation = '';
                                if( isset( $pro_experience['_academix_pa_designation'] ) || !empty( $pro_experience['_academix_pa_designation'] ) ){
                                    $pe_designation = $pro_experience['_academix_pa_designation'];
                                }

                                $pe_institute = '';
                                if( isset( $pro_experience['_academix_pa_institute'] ) || !empty( $pro_experience['_academix_pa_institute'] ) ){
                                    $pe_institute = $pro_experience['_academix_pa_institute'];
                                }
                                $html .= '<li>
                                <span class="year">'.wp_kses_post( $pe_year ).'</span>
                                <div class="appoint-meta">
                                    <h5 class="pex-title">'.wp_kses_post( $pe_designation ).'</h5>
                                    <div class="meta-span">'.wp_kses_post( $pe_institute ).'</div>
                                </div></li>';
                            }
                        $html .= '</ol>
                        </div>';
                    }
                }

                if( $settings['section_type'] == 'awards_prizes' ){
                    if( isset($team_awards_prizes) && is_array($team_awards_prizes) ){
                        $html .='<div class="awards-prizes">
                        <ul class="awards-list list-unstyled">';
                        foreach ($team_awards_prizes as $team_award_prize) {
                            if( isset( $team_award_prize['_academix_award_prize_year'] ) || !empty( $team_award_prize['_academix_award_prize_year'] ) ){
                                $award_prize_year = $team_award_prize['_academix_award_prize_year'];
                            } else{
                                $award_prize_year = '';
                            }

                            if( isset( $team_award_prize['_academix_award_prize_designation'] ) || !empty( $team_award_prize['_academix_award_prize_designation'] ) ){
                                $award_prize_designation = $team_award_prize['_academix_award_prize_designation'];
                            } else{
                                $award_prize_designation = '';
                            }

                            if( isset( $team_award_prize['_academix_award_prize_organization'] ) || !empty( $team_award_prize['_academix_award_prize_organization'] ) ){
                                $award_prize_organization = $team_award_prize['_academix_award_prize_organization'];
                            } else{
                                $award_prize_organization = '';
                            }
                            $html .='<li>
                                <span class="year">'.wp_kses_post( $award_prize_year ).'</span>
                                <div class="awards-meta">
                                    <h5 class="awards-title">'.wp_kses_post( $award_prize_designation ).'</h5>
                                    <div class="awards-meta"><span>'.wp_kses_post( $award_prize_organization ).'</span></div>
                                </div>
                            </li>';
                        }
                        $html .='</ul>
                        </div>';
                    }
                }
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