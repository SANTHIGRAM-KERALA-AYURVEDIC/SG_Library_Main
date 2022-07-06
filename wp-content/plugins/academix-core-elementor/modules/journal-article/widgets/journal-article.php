<?php
namespace AcademixCoreElementor\Modules\JournalArticle\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use AcademixCoreElementor\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Events Widget
 */
class JournalArticle extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'journal-article';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('JournalArticle', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-post-content';
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
        return ['journal article', 'journal', 'article', 'academix'];
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
            'section_events_post',
            [
                'label' => __( 'Post Element', 'academix-core-elementor' ),
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
        $this->end_controls_section();

        $this->tab_style();
        $this->title_style();
        $this->text_style();
        $this->author_name_style();
        $this->doi_style();
    }

    protected function tab_style(){

        $this->start_controls_section(
            'tab_style',
            [
                'label'     => __( 'Tab', 'academix-core-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'tab_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} .journal-papers-nav-list > li a',
            ]
        );

        $this->start_controls_tabs( 'tab_style_tabs' );

        $this->start_controls_tab(
            'tab_normal',
            [
                'label' => __( 'Normal', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .journal-papers-nav-list > li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a'
            ]
        );
        $this->end_controls_tab();
        # End Normal Style Tab
        $this->start_controls_tab(
            'tab_hover',
            [
                'label' => __( 'Hover', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'tab_hover_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .journal-papers-nav-list > li a.active,{{WRAPPER}} .journal-papers-nav-list > li a:hover,{{WRAPPER}} .journal-papers-nav-list > li a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_hover_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a.active,{{WRAPPER}} .journal-papers-nav-list > li a:hover,{{WRAPPER}} .journal-papers-nav-list > li a:focus',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_hover_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a.active,{{WRAPPER}} .journal-papers-nav-list > li a:hover,{{WRAPPER}} .journal-papers-nav-list > li a:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_hover_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li a.active,{{WRAPPER}} .journal-papers-nav-list > li a:hover,{{WRAPPER}} .journal-papers-nav-list > li a:focus',
            ]
        );
        $this->end_controls_tab();
        # End Normal Style Tab

        $this->start_controls_tab(
            'tab_active',
            [
                'label' => __( 'Active', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'tab_active_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .journal-papers-nav-list > li.active a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_active_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li.active a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_active_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li.active a',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_active_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .journal-papers-nav-list > li.active a',
            ]
        );
        $this->end_controls_tab();

        # End Hover Style Tab
        $this->end_controls_tabs();
        #End Tabs

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .journal-papers-nav-list > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .journal-papers-nav-list > li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function title_style() {
        $selector = '.tab-content .nav-title';
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
    protected function text_style() {
        $selector = '.journal-papers-meta';
        $this->start_controls_section(

            'description_style',
            [
                'label' 	=> __( 'Text', 'academix-core-elementor' ),
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
    protected function author_name_style() {
        $selector = '.journal-papers .jp-name';
        $this->start_controls_section(

            'author_style',
            [
                'label' 	=> __( 'Author Name', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_color',
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
                'name'                  => 'author_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'author_bottom_space',
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
    protected function doi_style() {
        $selector = '.journal-papers-doi a';
        $this->start_controls_section(

            'doi_style',
            [
                'label' 	=> __( 'DOI', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'doi_color',
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
                'name'                  => 'doi_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'doi_bottom_space',
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

    protected function renderTabs($term_array)
    {
        $html = '';
        $html .= '<nav class="journal-papers-nav">';
        $html .= '<ul class="journal-papers-nav-list list-inline" role="tablist">';
                $i = 0;
                foreach ( $term_array as $key => $year ) {
                    $i++;
                    $class_active = ( $i == 1 ) ? 'class=active' : '';
                    $html .= '<li role="presentation" '.esc_attr( $class_active ).'><a href="#'.esc_attr( $year ).'" class="link-prev_def" aria-controls="'.esc_html( $year ).'" role="tab" data-toggle="tab">'.esc_html($key ).'</a></li>';

                }
        $html .= '</ul>';
        $html .= '</nav>';
        return $html;
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

        $terms = get_terms( 'journal_article_cat', array(
            'hide_empty' => true,
            'parent' => 0
        ) );

        usort($terms, Helper::journal_article_term_sorter('description'));

        $term_array = array();
        if( !empty( $terms ) && !is_wp_error( $terms ) ){
            foreach ($terms as $term ) {
                $term_array[$term->name] = $term->slug;
            }
        }

        $html = '';
        $html .= '<div class="rushmore-content-area section-journal-papers">';

        if( !empty( $term_array ) && is_array( $term_array ) ) {
            $html .= $this->renderTabs($term_array);
        }

        $html .= '<div class="journal-papers-mound-wrap tab-content">';
        $i = 0;

        foreach ( $term_array as $key => $year ) {
            $i++;
            $active = ( $i == 1 ) ? 'in active' : '';
            $html .= '<div class="journal-papers-mound tab-pane fade '.esc_attr( $active ).'" id="'.esc_attr($year).'" role="tabpanel">';
            $args = array(
                'post_type'       => 'journal_article',
                'posts_per_page'  => -1,
                'journal_article_cat' => $year,
                'post_status' => 'publish',
                'order' => $settings['order'],
            );

            $q = new \WP_Query( $args );

            if( $q->have_posts() ){
                $year_match = 1;
                while ( $q->have_posts() ) : $q->the_post();
                    $idd = get_the_ID();
                    $prefix = '_academix_';

                    if( get_post_meta( $idd , $prefix . 'journal_article_authors_name', true) ){
                        $journal_article_authors_name = get_post_meta( $idd , $prefix . 'journal_article_authors_name', true);
                    } else{
                        $journal_article_authors_name = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'journal_article_research_topic', true) ){
                        $journal_article_research_topic = get_post_meta( $idd , $prefix . 'journal_article_research_topic', true);
                    } else{
                        $journal_article_research_topic = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'journal_article_publication_identity', true) ){
                        $journal_article_publication_identity = get_post_meta( $idd , $prefix . 'journal_article_publication_identity', true);
                    } else{
                        $journal_article_publication_identity = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'journal_article_doi', true) ){
                        $journal_article_doi = get_post_meta( $idd , $prefix . 'journal_article_doi', true);
                    } else{
                        $journal_article_doi = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'journal_article_doi_link', true) ){
                        $journal_article_doi_link = get_post_meta( $idd , $prefix . 'journal_article_doi_link', true);
                    } else{
                        $journal_article_doi_link = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'ja_link_target', true) ){
                        $book_link_target = get_post_meta( $idd , $prefix . 'ja_link_target', true);
                    } else{
                        $book_link_target = '';
                    }

                    $doi_link_target = ( $book_link_target == 0 ) ? '_self' : '_blank';

                    if( get_post_meta( $idd , $prefix . 'journal_article_pdf_title', true) ){
                        $journal_article_pdf_title = get_post_meta( $idd , $prefix . 'journal_article_pdf_title', true);
                    } else{
                        $journal_article_pdf_title = '';
                    }

                    if( get_post_meta( $idd , $prefix . 'journal_article_pdf_link', true) ){
                        $journal_article_pdf_link = get_post_meta( $idd , $prefix . 'journal_article_pdf_link', true);
                    } else{
                        $journal_article_pdf_link = '';
                    }

                    $html .= '<nav class="journal-papers-mound-nav">';
                        if( $key != $year_match ){
                            $html .= '<h3 class="nav-title">'.wp_kses_post($key).'</h3>';
                            $year_match = $key;
                        }
                    $html .= '</nav>';

                    $html .= '<div class="journal-papers-list">
                    <div class="journal-papers">
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <p class="jp-name">'.wp_kses_post( $journal_article_authors_name ).'</p>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="journal-papers-meta">
                                    <p>'.get_the_title().'<em> '.wp_kses_post($journal_article_research_topic).'</em> '.wp_kses_post($journal_article_publication_identity).'';
                                    if( $journal_article_pdf_link ){
                                        $html .= '<a href="'.esc_url( $journal_article_pdf_link ).'" class="pdf-link" target="_blank">'.wp_kses_post( $journal_article_pdf_title ).'</a>';
                                    }
                                    $html .= '</p>
                                </div>
                            </div>';

                            if( $journal_article_doi ){
                                $html .= '<div class="col-sm-3">
                                        <div class="journal-papers-doi"><span>'.__('DOI', 'academix-core-elementor').':</span> <a href="'.esc_url($journal_article_doi_link).'" target="'.esc_attr($doi_link_target).'">'.wp_kses_post( $journal_article_doi ).'</a></div>
                                    </div>';
                            }

                            $html .= '</div>
                    </div><!-- /.journal-papers -->
                </div>';
                endwhile;
                wp_reset_postdata();
            }

            $html .= '</div>';
        }

        $html .= '</div>'; // end journal-papers-mound-wrap
        $html .= '</div>'; // end rushmore-content-area
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