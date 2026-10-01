<?php
/**
 * Projects (portfolio) custom post type.
 *
 * Archive lives at /our-work/ and projects at /our-work/{slug}/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Project post type and its taxonomy.
 */
function wavex_register_project_type() {
	register_post_type( 'project', array(
		'labels'            => array(
			'name'               => __( 'Projects', 'wavex' ),
			'singular_name'      => __( 'Project', 'wavex' ),
			'add_new_item'       => __( 'Add New Project', 'wavex' ),
			'edit_item'          => __( 'Edit Project', 'wavex' ),
			'view_item'          => __( 'View Project', 'wavex' ),
			'all_items'          => __( 'All Projects', 'wavex' ),
			'search_items'       => __( 'Search Projects', 'wavex' ),
			'not_found'          => __( 'No projects found.', 'wavex' ),
			'menu_name'          => __( 'Our Work', 'wavex' ),
		),
		'public'            => true,
		'has_archive'       => 'our-work',
		'rewrite'           => array(
			'slug'       => 'our-work',
			'with_front' => false,
		),
		'menu_icon'         => 'dashicons-portfolio',
		'menu_position'     => 21,
		'show_in_rest'      => true,
		'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
	) );

	register_taxonomy( 'project_type', 'project', array(
		'labels'            => array(
			'name'          => __( 'Project Types', 'wavex' ),
			'singular_name' => __( 'Project Type', 'wavex' ),
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array(
			'slug'       => 'project-type',
			'with_front' => false,
		),
	) );
}
add_action( 'init', 'wavex_register_project_type' );

/**
 * Order the projects archive by menu order, then title.
 *
 * @param WP_Query $query Query.
 */
function wavex_project_archive_order( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'project' ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'posts_per_page', 24 );
	}
}
add_action( 'pre_get_posts', 'wavex_project_archive_order' );
