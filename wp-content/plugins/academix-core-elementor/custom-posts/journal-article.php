<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// journal article post type
add_action( 'init', 'academix_core_elementor_journal_article_custom_post' );
function academix_core_elementor_journal_article_custom_post(){

    $cpt_url_slug = 'journal_article';
    $cpt_url_slug = apply_filters('academix_journal_article_cpt_url_slug', $cpt_url_slug);

	$labels = array(
		'name'               => esc_html__( 'Journal Articles', 'academix' ),
		'singular_name'      => esc_html__( 'Journal Article', 'academix' ),
		'menu_name'          => esc_html__( 'Journal Articles', 'academix' ),
		'name_admin_bar'     => esc_html__( 'Journal Articles', 'academix' ),
		'add_new'            => esc_html__( 'Add Journal Article', 'academix' ),
		'add_new_item'       => esc_html__( 'Add New Journal Article', 'academix' ),
		'new_item'           => esc_html__( 'New Journal Article', 'academix' ),
		'edit_item'          => esc_html__( 'Edit Journal Article', 'academix' ),
		'view_item'          => esc_html__( 'View Journal Article', 'academix' ),
		'all_items'          => esc_html__( 'View Journal Articles', 'academix' ),
		'search_items'       => esc_html__( 'Search Journal Article', 'academix' ),
		'parent_item_colon'  => esc_html__( 'Parent Journal Article', 'academix' ),
		'not_found'          => esc_html__( 'No Journal Article found.', 'academix' ),
		'not_found_in_trash' => esc_html__( 'No Journal Article found in Trash', 'academix' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus'  => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
        'rest_base'             => 'journal_article',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'delete_with_user'   => false,
		'has_archive'        => false,
		'hierarchical'       => false,
		'can_export'         => true,
		'taxonomies'         => array( 'journal_article_cat' ),
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-welcome-write-blog',
		'rewrite'            => array( 
			'slug'       => $cpt_url_slug, 
			'with_front' => true, 
			'pages'      => true, 
			'feeds'      => false,
		),
		'supports'           => array( 
			'title',
			'author',
			'editor'
		)
	);

	register_post_type( 'journal_article', $args );
}

// Register Custom Taxonomy
function academix_core_elementor_journal_article_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Journal Article Sorting Year', 'Taxonomy General Name', 'academix' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'academix' ),
		'menu_name'                  => __( 'Category', 'academix' ),
		'all_items'                  => __( 'All Journal Article Categories', 'academix' ),
		'parent_item'                => __( 'Parent Journal Article', 'academix' ),
		'parent_item_colon'          => __( 'Parent Journal Article:', 'academix' ),
		'new_item_name'              => __( 'New Journal Article Category', 'academix' ),
		'add_new_item'               => __( 'Add New Category', 'academix' ),
		'edit_item'                  => __( 'Edit Category', 'academix' ),
		'update_item'                => __( 'Update Category', 'academix' ),
		'view_item'                  => __( 'View Item', 'academix' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'academix' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'academix' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'academix' ),
		'popular_items'              => __( 'Popular Items', 'academix' ),
		'search_items'               => __( 'Search Items', 'academix' ),
		'not_found'                  => __( 'Not Found', 'academix' ),
		'no_terms'                   => __( 'No items', 'academix' ),
		'items_list'                 => __( 'Items list', 'academix' ),
		'items_list_navigation'      => __( 'Items list navigation', 'academix' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_in_rest'               => true,
        'rest_base'                  => 'journal_article_cats',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'journal_article_cat', array( 'journal_article' ), $args );

}
add_action( 'init', 'academix_core_elementor_journal_article_custom_taxonomy', 0 );
