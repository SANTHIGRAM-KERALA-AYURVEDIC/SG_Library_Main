<?php
namespace AcademixCoreElementor\Modules\ConferenceList\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Slider Widget
 */
class ConferenceList extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'conference_list';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Conference List', 'academix-core-elementor');
    }

    /**
     * Retrieve buttons widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-headphones';
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
        return ['conference list', 'conference', 'academix'];
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
            'section_conference_list',
            [
                'label' => __( 'Content', 'academix-core-elementor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'conference_list_year', [
                'label' => __( 'Year', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '2016' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'conference_list_date', [
                'label' => __( 'Year', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '5th june' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'conference_list_title', [
                'label' => __( 'Title', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Fireside chat with Suzanne Smith' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'conference_list_title_url',
            [
                'label'             => __( 'Title URL', 'academix-core-elementor' ),
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

        $repeater->add_control(
            'conference_list_time', [
                'label' => __( 'Time', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '7:00pm' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'conference_list_location', [
                'label' => __( 'Location', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Dudley House, Harvard University' , 'academix-core-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'conference_list_content', [
                'label' => __( 'Content', 'academix-core-elementor' ),
                'description' => __( 'Your Content', 'academix-core-elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Fireside chat with Suzanne Smith, "Writer\'s Night,"Center for Writing and Communicating Ideas, Harvard Graduate School of Arts and Sciences.' , 'academix-core-elementor' ),
                'show_label' => true,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'conference_list_data',
            [
                'label' => __( 'Items', 'academix-core-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'conference_list_title' => __( 'Fireside chat with Suzanne Smith', 'academix-core-elementor' ),
                        'conference_list_content' => __( 'Fireside chat with Suzanne Smith, "Writer\'s Night,"Center for Writing and Communicating Ideas, Harvard Graduate School of Arts and Sciences.', 'academix-core-elementor' ),
                    ],
                    [
                        'conference_list_title' => __( 'Fireside chat with Suzanne Smith', 'academix-core-elementor' ),
                        'conference_list_content' => __( 'Fireside chat with Suzanne Smith, "Writer\'s Night,"Center for Writing and Communicating Ideas, Harvard Graduate School of Arts and Sciences.', 'academix-core-elementor' ),
                    ],
                    [
                        'conference_list_title' => __( 'Fireside chat with Suzanne Smith', 'academix-core-elementor' ),
                        'conference_list_content' => __( 'Fireside chat with Suzanne Smith, "Writer\'s Night,"Center for Writing and Communicating Ideas, Harvard Graduate School of Arts and Sciences.', 'academix-core-elementor' ),
                    ],
                    [
                        'conference_list_title' => __( 'Fireside chat with Suzanne Smith', 'academix-core-elementor' ),
                        'conference_list_content' => __( 'Fireside chat with Suzanne Smith, "Writer\'s Night,"Center for Writing and Communicating Ideas, Harvard Graduate School of Arts and Sciences.', 'academix-core-elementor' ),
                    ],
                ],
                'title_field' => '{{{ conference_list_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->conference_list_year_style();
        $this->conference_list_date_style();
        $this->conference_list_title_style();
        $this->conference_list_time_style();
        $this->conference_list_location_style();
        $this->conference_list_content_style();

    }

    protected function conference_list_year_style() {
        $selector = '.auth-deff_timeline > li .time-span .time-year';
        $this->start_controls_section(

            'conference_list_item_year_style',
            [
                'label' 	=> __( 'Year', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_year_color',
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
                'name'                  => 'conference_list_item_year_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_year_padding',
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

    protected function conference_list_date_style() {
        $selector = '.auth-deff_timeline > li .time-span .time-month';
        $this->start_controls_section(

            'conference_list_item_date_style',
            [
                'label' 	=> __( 'Date', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_date_color',
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
                'name'                  => 'conference_list_item_date_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_date_padding',
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

    protected function conference_list_title_style() {
        $selector = '.auth-deff_timeline > li .timeline-meta .staff-title';
        $this->start_controls_section(

            'conference_list_item_title_style',
            [
                'label' 	=> __( 'Title', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_title_color',
            [
                'label' => __( 'Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector .' a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'conference_list_item_title_color_hover',
            [
                'label' => __( 'Hover Color', 'academix-core-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} '.$selector .' a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'conference_list_item_title_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_title_padding',
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

    protected function conference_list_time_style() {
        $selector = '.timeline-meta .__time';
        $this->start_controls_section(

            'conference_list_item_time_style',
            [
                'label' 	=> __( 'Time', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_time_color',
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
                'name'                  => 'conference_list_item_time_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_time_padding',
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

    protected function conference_list_location_style() {
        $selector = '.timeline-meta .__loc';
        $this->start_controls_section(

            'conference_list_item_location_style',
            [
                'label' 	=> __( 'Location', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_location_color',
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
                'name'                  => 'conference_list_item_location_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_location_padding',
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

    protected function conference_list_content_style() {
        $selector = '.auth-deff_timeline_timeline-segment .auth-deff_timeline li .meta-text';
        $this->start_controls_section(

            'conference_list_item_content_style',
            [
                'label' 	=> __( 'Content', 'academix-core-elementor' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'conference_list_item_content_color',
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
                'name'                  => 'conference_list_item_content_typography',
                'label'                 => __( 'Typography', 'academix-core-elementor' ),
                'selector'              => '{{WRAPPER}} ' .$selector,
            ]
        );

        $this->add_responsive_control(
            'conference_list_item_content_padding',
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

        if( isset( $settings['conference_list_data'] ) && is_array( $settings['conference_list_data'] ) ){
            ?>
            <div class="auth-deff_timeline_timeline-segment">
                <ul class="auth-deff_timeline list-unstyled">
                    <?php foreach ( $settings['conference_list_data'] as $conference ) {
                        if ( ! empty( $conference['conference_list_data']['url'] ) ) {
                            $this->add_link_attributes( 'title_url', $conference['conference_list_data'] );
                        }
                        ?>
                        <li>
                            <div class="time-span">
                                <div class="time-year"><?php echo esc_html($conference['conference_list_year']); ?></div>
                                <div class="time-month"><?php echo esc_html($conference['conference_list_date']); ?></div>
                            </div>
                            <div class="timeline-meta">
                                <h3 class="staff-title"><a href="<?php echo esc_url($this->get_render_attribute_string( 'title_url' )); ?>"><?php echo esc_html($conference['conference_list_title']); ?></a></h3>
                                <div class="__time"><?php echo esc_html($conference['conference_list_time']); ?></div>
                                <?php if(isset($conference['conference_list_location'])){?>
                                <div class="__loc"><span><?php echo __('Location', 'academix-core-elementor');?>:</span> <?php echo esc_html($conference['conference_list_location']); ?></div>
                                <?php } ?>
                                <p class="meta-text"><?php echo esc_html($conference['conference_list_content']); ?></p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
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
