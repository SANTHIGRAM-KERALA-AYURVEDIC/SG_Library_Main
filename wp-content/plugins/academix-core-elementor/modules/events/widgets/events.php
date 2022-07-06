<?php
namespace AcademixCoreElementor\Modules\Events\Widgets;

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
class Events extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'events';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Events', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-calendar';
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
        return ['event', 'events', 'academix'];
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
            'event_cat',
            [
                'label' => __('Category', 'academix-core-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::get_event_categories(),
            ]
        );

        $this->add_control(
            'post_number',
            [
                'label'         => __( 'Number of Posts', 'academix-core-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 4,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => __( 'Order By', 'academix-core-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'date',
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
            'display_pagination',
            [
                'label' => __( 'Display Pagination', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->title_style();
        $this->meta_style();
        $this->pagination_style();
        $this->wrapper_style();
    }

    protected function title_style() {
        $selector = '.sabbi-events-item .sabbi-events-title';
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
            'title_margin',
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

    protected function meta_style() {
        $selector = '.sabbi-events-item .events-item-meta';
        $this->start_controls_section(

            'meta_style',
            [
                'label' 	=> __( 'Meta', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => __( 'Icon Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sabbi-events-item .events-item-meta .events-loc > i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_color',
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
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'meta_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'meta_margin',
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

    protected function pagination_style(){

        $this->start_controls_section(

            'pagination_style',
            [
                'label'     => __( 'Pagination', 'academix-core-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'pagination_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} .page-numbers > li > a,{{WRAPPER}} .page-numbers > li > span',
            ]
        );

        $this->start_controls_tabs( 'pagination_style_tabs' );

        $this->start_controls_tab(
            'pagination_normal',
            [
                'label' => __( 'Normal', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'pagination_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .page-numbers > li > a,{{WRAPPER}} .page-numbers > li > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .page-numbers > li > a,{{WRAPPER}} .page-numbers > li > span',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pagination_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .page-numbers > li > a,{{WRAPPER}} .page-numbers > li > span',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pagination_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .page-numbers > li > a,{{WRAPPER}} .page-numbers > li > span'
            ]
        );
        $this->end_controls_tab();
        # End Normal Style Tab
        $this->start_controls_tab(
            'pagination_hover',
            [
                'label' => __( 'Hover', 'academix-core-elementor' ),
            ]
        );
        $this->add_control(
            'pagination_hover_text_color',
            [
                'label' => __( 'Text Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .page-numbers > li a:hover, {{WRAPPER}} .page-numbers > li > .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pagination_hover_box_shadow',
                'label' => __( 'Box Shadow', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .page-numbers > li a:hover, {{WRAPPER}} .page-numbers > li > .current',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_hover_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} .page-numbers > li a:hover, {{WRAPPER}} .page-numbers > li > .current',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pagination_hover_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .page-numbers > li a:hover, {{WRAPPER}} .page-numbers > li > .current',
            ]
        );
        $this->end_controls_tab();
        # End Hover Style Tab
        $this->end_controls_tabs();
        #End Tabs

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __('Padding', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers > li > a, {{WRAPPER}} .page-numbers > li > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => __('Margin', 'academix-core-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers > li > a, {{WRAPPER}} .page-numbers > li > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function wrapper_style(){
        $selector = '.sabbi-events-item';
        $this->start_controls_section(

            'wrapper_style',
            [
                'label' 	=> __( 'Wrapper', 'academix-core-elementor' ),
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
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }

        // custom post args
        $args = array(
            'post_type' => 'event',
            'event_cat' => $settings['event_cat'],
            'posts_per_page' => $settings['post_number'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'] === 'date' ? 'meta_value_num' : $settings['orderby'],
            'paged' => $paged,
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => '_academix_event_date',
                    'compare' => 'EXISTS'
                )
            ),
            'meta_type' => 'text_date_timestamp',
        );

        $q = new \WP_Query( $args );

        if( $q->have_posts() ){ ?>
            <div class="rushmore-content-area page-events stage_events_post">
                <div class="container">
                    <div class="events_post-sagment">
                        <div class="row">
                            <?php
                            $i = 0;
                            while ( $q->have_posts() ) : $q->the_post();
                                $i++;
                                $idd = get_the_ID();
                                $prefix = '_academix_';
                                $event_image_key = get_post_meta( $idd, $prefix . 'event_image_id', true );

                                if( wp_get_attachment_image( $event_image_key, 'full', false ) ){
                                    $event_image = wp_get_attachment_image( $event_image_key, 'full', false);
                                } else{
                                    $event_image = '';
                                }

                                if( get_post_meta( $idd , $prefix . 'event_location', true) ){
                                    $event_location = get_post_meta( $idd , $prefix . 'event_location', true);
                                } else{
                                    $event_location = '';
                                }

                                if( get_post_meta( $idd , $prefix . 'event_date', true) ){
                                    $event_date = get_post_meta( $idd , $prefix . 'event_date', true);
                                } else{
                                    $event_date = '';
                                }
                                ?>
                                <div class="col-sm-6">
                                    <article class="sabbi-events-item">
                                        <a href="<?php esc_url( the_permalink() ); ?>" class="sabbi-events-link">
                                            <figure>
                                                <?php echo wp_kses_post( $event_image ); ?>
                                                <figcaption>
                                                    <h2 class="sabbi-events-title font-md__x"><?php the_title(); ?></h2>
                                                </figcaption>
                                            </figure>
                                        </a>
                                        <div class="events-item-meta">
                                            <?php if( !empty( $event_location ) ) { ?>
                                                <div class="events-loc"><i class="ion-location"></i><span class="text"><?php echo wp_kses_post($event_location); ?></span></div>
                                            <?php } ?>
                                            <?php if( !empty( $event_date ) ) { ?>
                                                <div class="events-date"><i class="ion-calendar"></i>
                                                    <span class="text"><?php echo date_i18n(get_option( 'date_format' ), $event_date); ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </article><!-- /.sabbi-events-item -->
                                </div>

                                <?php if( $i%2 === 0 ){ ?>
                                    <div class="event-clearfix"></div>
                                <?php } ?>
                            <?php endwhile; ?>
                        </div>

                    </div><!-- /.events_post-sagment -->
                    <?php if( $settings['display_pagination'] == 'yes' ) { ?>
                        <nav aria-label="Page navigation" class="pagination_wraper">
                            <?php
                                $numpages = $q->max_num_pages;
                                if( function_exists('academix_pagination') ):
                                    academix_pagination( $numpages );
                                endif;
                            ?>
                        </nav>
                    <?php } ?>
                </div>
            </div><!-- #primary -->
        <?php } else {
            echo __('No posts available!', 'academix-core-elementor');
        }
        wp_reset_postdata();
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