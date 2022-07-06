<?php
namespace AcademixCoreElementor\Modules\Books\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use AcademixCoreElementor\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Events Widget
 */
class Books extends Widget_Base {

    /**
     * Retrieve buttons widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'books';
    }

    /**
     * Retrieve buttons widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Books', 'academix-core-elementor');
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
        return ['books', 'book', 'academix'];
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
        return ['academix-core-elementor'];
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
            'section_books_post',
            [
                'label' => __( 'Post Element', 'academix-core-elementor' ),
            ]
        );

        $this->add_control(
            'book_cat',
            [
                'label' => __('Category', 'academix-core-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::get_books_categories(),
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
        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => __( 'Settings', 'academix-core-elementor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_image',
                'label' => __( 'Background', 'academix-core-elementor' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .sabbi-book_timeline-segment',
            ]
        );

        $this->add_control(
            'display_button',
            [
                'label' => __( 'Display Button?', 'academix-core-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'academix-core-elementor' ),
                'label_off' => __( 'No', 'academix-core-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __( 'Button Text', 'academix-core-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Explore More' , 'academix-core-elementor' ),
                'label_block' => true,
                'condition' => [
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
                'condition' => [
                    'display_button' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
        $this->title_style();
        $this->description_style();
        $this->author_name_style();
    }

    protected function title_style() {
        $selector = '.sabbi-book_timeline .book-list-title';
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
                    '{{WRAPPER}} '.$selector.' a' => 'color: {{VALUE}};',
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
        $selector = '.sabbi-book_timeline .book-list-brand';
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
    protected function author_name_style() {
        $selector = '.sabbi-book_timeline .book-author';
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

    public function renderElements($idd, $j)
    {
        $settings = $this->get_settings_for_display();
        $prefix = '_academix_';

        if (wp_get_attachment_image(get_post_meta($idd, $prefix . 'book_image_id', true), 'rushmore-book-thumbnail', false, array('class' => 'img-responsive'))) {
            $book_image = wp_get_attachment_image(get_post_meta($idd, $prefix . 'book_image_id', true), 'rushmore-book-thumbnail', false, array('class' => 'img-responsive'));
        } else {
            $book_image = '';
        }

        if (get_post_meta($idd, $prefix . 'book_link', true)) {
            $book_link = get_post_meta($idd, $prefix . 'book_link', true);
        } else {
            $book_link = '';
        }

        if (get_post_meta($idd, $prefix . 'book_link_target', true)) {
            $book_link_target = get_post_meta($idd, $prefix . 'book_link_target', true);
        } else {
            $book_link_target = '';
        }

        $link_target = ($book_link_target == 0) ? '_self' : '_blank';

        if (get_post_meta($idd, $prefix . 'book_description', true)) {
            $book_description = get_post_meta($idd, $prefix . 'book_description', true);
        } else {
            $book_description = '';
        }

        if (get_post_meta($idd, $prefix . 'book_author_name', true)) {
            $book_author_name = get_post_meta($idd, $prefix . 'book_author_name', true);
        } else {
            $book_author_name = '';
        }

        $onexpan = ($j > 3 && $settings['display_button'] == 'yes') ? ' class=onexpan' : '';

        return '<li' . esc_attr($onexpan) . '>
                                    <figure>' . wp_kses_post($book_image) . '</figure>
                                    <div class="book-list-meta">
                                        <h3 class="book-list-title"><a href="' . esc_url($book_link) . '" target="' . esc_attr($link_target) . '">' . get_the_title() . '</a> </h3>
                                        <div class="book-list-brand"><em>' . wp_kses_post($book_description) . '</em></div>
                                        <p class="book-author">' . wp_kses_post($book_author_name) . '</p>
                                    </div>
                                </li>';
    }
    public function renderButton($index, $settings)
    {
        if ( ! empty( $settings['button_url']['url'] ) && $settings['button_url']['url'] !== '#' ) {
            $this->add_link_attributes( 'button', $settings['button_url'] );
            $this->add_render_attribute( 'button', 'class', ['btn', 'btn-unsolemn'] );
        }

        $html = '';
        if (($index > 3 && $settings['display_button'] == 'yes') && ($settings['button_url']['url'] === '' || $settings['button_url']['url'] === '#')) {
            $html .= '<a href="#" class="btn btn-unsolemn btn-expand" data-text="' . esc_attr($settings['button_text']) . '">' . esc_html($settings['button_text']) . '</a>';
        }

        if (($index > 3 && $settings['display_button'] == 'yes') && ($settings['button_url']['url'] && $settings['button_url']['url'] !== '#')) {
            $html .= '<a '.$this->get_render_attribute_string( 'button' ).'>' . esc_html($settings['button_text']) . '</a>';
        }
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
        $term_array = Helper::get_books_category_slugs($settings);

        $html = '';
        $html .= '<div class="sabbi-book_timeline-segment">
                    <ul class="sabbi-book_timeline list-unstyled">';
        foreach ($term_array as $key => $year) {
            $args = array(
                'post_type' => 'book',
                'posts_per_page' => -1,
                'book_cat' => $year,
                'order' => $settings['order'],
                'orderby' => $settings['orderby'],
                'post_status' => 'publish',
            );

            $q = new \WP_Query($args);
            if ($q->have_posts()) {
                $yearName = $settings['book_cat'] ? $year : $key;
                $html .= '<li>';
                $html .= '<span class="year">' . wp_kses_post($yearName) . '</span>';
                $html .= '<ul class="book-list list-unstyled">';
                $j = 0;
                while ($q->have_posts()) : $q->the_post();
                    $j++;
                    $idd = get_the_ID();
                    $html .= $this->renderElements($idd, $j);
                endwhile;
                $html .= '</ul>';
                $html .= $this->renderButton($j, $settings);
                $html .= '</li>';
            }
        }
        $html .='</ul></div>';
        wp_reset_postdata();
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