<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// team post type
add_action( 'init', 'academix_core_elementor_team_custom_post' );
function academix_core_elementor_team_custom_post(){
    
    $cpt_url_slug = 'rushmore_teams';
    $cpt_url_slug = apply_filters('academix_rushmore_teams_cpt_url_slug', $cpt_url_slug);
    

	$labels = array(
		'name'               => esc_html__('Teams', 'academix'),
		'singular_name'      => esc_html__( 'Team', 'academix' ),
		'menu_name'          => esc_html__( 'Teams', 'academix' ),
		'name_admin_bar'     => esc_html__( 'Teams', 'academix' ),
		'add_new'            => esc_html__( 'Add Team Member', 'academix' ),
		'add_new_item'       => esc_html__( 'Add New Member', 'academix' ),
		'new_item'           => esc_html__( 'New Member', 'academix' ),
		'edit_item'          => esc_html__( 'Edit Member', 'academix' ),
		'view_item'          => esc_html__( 'View Member', 'academix' ),
		'all_items'          => esc_html__( 'View Members', 'academix' ),
		'search_items'       => esc_html__( 'Search Member', 'academix' ),
		'parent_item_colon'  => esc_html__( 'Parent Member', 'academix' ),
		'not_found'          => esc_html__( 'No Member found.', 'academix' ),
		'not_found_in_trash' => esc_html__( 'No Member found in Trash', 'academix' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus'  => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
        'rest_base'             => 'team',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'delete_with_user'   => false,
		'has_archive'        => false,
		'hierarchical'       => false,
		'can_export'         => true,
		'taxonomies'         => array( 'team_cat' ),
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-groups',
		'rewrite'            => array( 
			'slug'       => $cpt_url_slug, 
			'with_front' => true, 
			'pages'      => true, 
			'feeds'      => false,
		),
		'supports'           => array( 
			'title',
			'thumbnail',
			'editor',
		)
	);

	register_post_type( 'team', $args );
}

// Register Custom Taxonomy
function academix_core_elementor_team_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'academix' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'academix' ),
		'menu_name'                  => __( 'Category', 'academix' ),
		'all_items'                  => __( 'All Team Categories', 'academix' ),
		'parent_item'                => __( 'Parent Item', 'academix' ),
		'parent_item_colon'          => __( 'Parent Item:', 'academix' ),
		'new_item_name'              => __( 'New Team Category', 'academix' ),
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
        'rest_base'                  => 'team_cats',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'team_cat', array( 'team' ), $args );

}
add_action( 'init', 'academix_core_elementor_team_custom_taxonomy', 0 );

// modify featured image title
add_action( 'admin_head', 'academix_core_elementor_team_replace_default_featured_image_meta_box_title', 100 );
function academix_core_elementor_team_replace_default_featured_image_meta_box_title() {
    remove_meta_box( 'postimagediv', 'team', 'side' );
    add_meta_box('postimagediv', esc_html__('Upload Banner Image', 'academix'), 'post_thumbnail_meta_box', 'team', 'side', 'default');
}
