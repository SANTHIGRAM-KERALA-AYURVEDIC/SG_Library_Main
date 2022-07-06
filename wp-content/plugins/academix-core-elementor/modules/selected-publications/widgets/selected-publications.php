<?php
namespace AcademixCoreElementor\Modules\SelectedPublications\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * ProfileCard Widget
 */
class SelectedPublications extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'selected-publications';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Selected Publications', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-document-file';
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
        return ['publications', 'selected publications', 'academix-core-elementor'];
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
            'section_selected_publications_settings',
            [
                'label' => __( 'Settings', 'academix-core-elementor' ),
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
                    'ion-ios-paper-outline' => esc_html__( 'paper outline', 'academix-core-elementor' ),
                ],
                'default' => 'ion-ios-paper-outline',
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

        $this->end_controls_section();

        $this->icon_style();
        $this->title_style();
        $this->authors_style();
        $this->publisher_url_style();
        $this->wrapper_style();
    }

    protected function icon_style(){
        $selector = '.pub-item.with-icon .elem-wrapper i';
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_background',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} '.$selector,
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

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'academix-core-elementor' ),
                'selector' => '{{WRAPPER}} '.$selector,
            ]
        );

        $this->add_responsive_control(
            'icon_right_space',
            [
                'label' => esc_html__( 'Spacing Right', 'academix-core-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
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
    protected function title_style() {
        $selector = '.pub-item .title';
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
    protected function authors_style() {
        $selector = '.slc_des';
        $this->start_controls_section(

            'slc_des_style',
            [
                'label' 	=> __( 'Authors', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slc_des_color',
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
                'name'                  => 'slc_des_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'slc_des_bottom_space',
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
    protected function publisher_url_style() {
        $selector = '.pub-item .description';
        $this->start_controls_section(

            'publishers_style',
            [
                'label' 	=> __( 'Publisher\'s URL', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'publishers_color',
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
                'name'                  => 'publishers_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'publishers_bottom_space',
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
        $selector = '.paper_cut';
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

        // custom post args
        $args = array(
            'post_type' => 'journal_article',
            'posts_per_page' => $settings['post_number'],
            'order' => $settings['order'],
            'orderby' => 'journal_article_cat, description',
            'meta_query' => array(
                array(
                    'key'     => '_academix_selected_publications',
                    'value'   => 'on',
                ),
            ),
        );

        $q = new \WP_Query( $args );

        if( $q->have_posts() ):
            ?>
            <div class="paper_cut">
                <?php
                while ( $q->have_posts() ) : $q->the_post();

                    $idd = get_the_ID();
                    $prefix = '_academix_';

                    $journal_article_authors_name = '';
                    if( get_post_meta( $idd , $prefix . 'journal_article_authors_name', true) ){
                        $journal_article_authors_name = get_post_meta( $idd , $prefix . 'journal_article_authors_name', true);
                    }

                    $journal_article_selecte_publication_btn_text = 'Publisher\'s website';
                    if( get_post_meta( $idd , $prefix . 'journal_article_selecte_publication_btn_text', true) ){
                        $journal_article_selecte_publication_btn_text = get_post_meta( $idd , $prefix . 'journal_article_selecte_publication_btn_text', true);
                    }

                    $journal_article_selecte_publication_btn_link = '';
                    if( get_post_meta( $idd , $prefix . 'journal_article_selecte_publication_btn_link', true) ){
                        $journal_article_selecte_publication_btn_link = get_post_meta( $idd , $prefix . 'journal_article_selecte_publication_btn_link', true);
                    }

                    ?>
                    <div class="pub-item with-icon">
                        <div class="elem-wrapper">
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
                        </div>
                        <div class="content-wrapper">
                            <h3 class="title mb_0"><?php echo get_the_title(); ?></h3>
                            <div class="slc_des">
                                <div class="authr"><?php echo wp_kses_post( $journal_article_authors_name ); ?></div>
                            </div>
                            <div class="description">
                                <a class="link-with-icon" href="<?php echo esc_url($journal_article_selecte_publication_btn_link); ?>" target="black"><i class="ion-ios-browsers-outline"></i><?php echo wp_kses_post( $journal_article_selecte_publication_btn_text ); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
        endif;
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