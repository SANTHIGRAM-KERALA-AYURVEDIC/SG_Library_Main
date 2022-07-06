<?php
namespace AcademixCoreElementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helper {

    public static function get_post_types(){
        $post_types = get_post_types(
            ['public' => true, 'show_in_nav_menus' => true],
            'objects'
        );

        $post_types = wp_list_pluck($post_types, 'label', 'name');

        return array_diff_key($post_types, ['elementor_library', 'attachment']);
    }

    public static function get_event_categories(){
        $categories = get_terms('event_cat', array( 'hide_empty' => false) );
        $cats = array( '' => esc_html__( '-- Select a category --', 'academix-core-elementor' ) );
        if ( !is_wp_error($categories) && !empty( $categories ) ) {
            foreach ($categories as $category) {
                $cats[$category->slug] = $category->name;
            }
        }
        return $cats;
    }

    public static function get_team_categories(){
        $categories = get_terms('team_cat', array( 'hide_empty' => false) );
        $cats = array( '' => esc_html__( '-- Select a category --', 'academix-core-elementor' ) );
        if ( !is_wp_error($categories) && !empty( $categories ) ) {
            foreach ($categories as $category) {
                $cats[$category->slug] = $category->name;
            }
        }
        return $cats;
    }

    public static function get_team_slugs(){
        $args = wp_parse_args( array(
            'post_type' => 'team',
            'numberposts' => -1,
        ));

        $posts = get_posts( $args );

        $post_options = array();
        if( $posts ) {
            foreach ( $posts as $post ) {
                $post_options[ $post->post_name ] = $post->post_name;
            }
        }

        return $post_options;
    }

    public static function get_books_categories() {

        $categories = get_terms('book_cat', array( 'hide_empty' => false) );

        $cats = array( '' => esc_html__( '-- Select a category --', 'academix-core-elementor' ) );

        if ( !is_wp_error($categories) && !empty( $categories ) ) {
            foreach ($categories as $category) {
                $cats[$category->slug] = $category->slug;
            }
        }

        return $cats;
    }

    public static function get_books_category_slugs($settings = [])
    {
        $terms = get_terms( 'book_cat', array(
            'hide_empty' => true,
        ) );

        $term_array = array();
        if( !empty( $terms ) && empty($settings['book_cat']) ){
            foreach ($terms as $term ) {
                $term_array[$term->name] = $term->slug;
            }
            arsort($term_array);
        }

        if( !empty($settings['book_cat']) ){
            $args = array(
                'post_type' => 'book',
                'posts_per_page' => -1,
                'book_cat' => $settings['book_cat'],
                'order' => $settings['order'],
                'orderby' => $settings['orderby'],
                'post_status' => 'publish',
            );

            $term_array = array();
            $q = new \WP_Query($args);

            while ($q->have_posts()) :
                $q->the_post();
                $categories = get_the_terms( $q->ID, 'book_cat' );
                foreach( $categories as $category ) {
                    if( $category->slug ){
                        $term_array[$category->slug] = $category->slug;
                    }
                }
            endwhile;
            arsort($term_array);
        }

        return $term_array;
    }

    public static function journal_article_term_sorter($key='description')
    {
        return function ($a, $b) use ($key) {
            return strnatcmp($a->$key, $b->$key);
        };
    }

    public static function excerpt( $id, $length = 200 ){
        return substr( get_the_content($id), 0, $length );
    }
}