<?php
add_action( 'manage_jobapplication_posts_custom_column', 'my_manage_jobapplication_columns', 10, 2 );

function my_manage_jobapplication_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        /* If displaying the 'duration' column. */
        case 'email' :

            /* Get the post meta. */
            $email = get_post_meta( $post_id, 'email', true );

            /* If no duration is found, output a default message. */
            if ( empty( $email ) )
                echo __( 'Unknown' );

            /* If there is a duration, append 'minutes' to the text string. */
            else
                echo $email;

            break;

        case 'phone' :

            /* Get the post meta. */
            $phone = get_post_meta( $post_id, 'phone', true );

            /* If no duration is found, output a default message. */
            if ( empty( $phone ) )
                echo __( 'Unknown' );

            /* If there is a duration, append 'minutes' to the text string. */
            else
                echo $phone;

            break;    

        /* Just break out of the switch statement for everything else. */
        default :
            break;
    }
}


// here is for custom taxonomy coloum show on custom post type wordpress data table
add_action( 'admin_init', 'my_admin_init' );
function my_admin_init() {
    add_filter( 'manage_edit-banner_columns', 'my_new_custom_post_column');
    add_action( 'manage_banner_custom_column', 'location_tax_column_info', 10, 2);
}

function my_new_custom_post_column( $column ) {
    $column['location'] = 'Location';

    return $column;
}

function location_tax_column_info( $column_name, $post_id ) {
        $taxonomy = $column_name;
        $post_type = get_post_type($post_id);
        $terms = get_the_terms($post_id, $taxonomy);

        if (!empty($terms) ) {
            foreach ( $terms as $term )
            $post_terms[] ="<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " .esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
            echo join('', $post_terms );
        }
         else echo '<i>No Location Set. </i>';
}





//here is for my prvious custom colum on data table for jobapplication post type

/**
 * meta box colum
 */
add_filter( 'manage_edit-jobapplication_columns', 'my_edit_jobapplication_columns' ) ;

function my_edit_jobapplication_columns( $columns ) {

    $columns = array(
        'cb' => '&lt;input type="checkbox" />',
        'title' => __( 'Candidate Name' ),
        'email' => __( 'Email' ),
        'phone' => __( 'Phone' ),
        'employee_type' => __( 'Employee Type' ),
        'date' => __( 'Date' )
    );

    return $columns;
}



add_action( 'manage_jobapplication_posts_custom_column', 'my_manage_jobapplication_columns', 10, 2 );

function my_manage_jobapplication_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        /* If displaying the 'duration' column. */
        case 'email' :

            /* Get the post meta. */
            $email = get_post_meta( $post_id, 'email', true );

            /* If no duration is found, output a default message. */
            if ( empty( $email ) )
                echo __( 'Unknown' );

            /* If there is a duration, append 'minutes' to the text string. */
            else
                echo $email;

            break;

        case 'phone' :

            /* Get the post meta. */
            $phone = get_post_meta( $post_id, 'phone', true );

            /* If no duration is found, output a default message. */
            if ( empty( $phone ) )
                echo __( 'Unknown' );

            /* If there is a duration, append 'minutes' to the text string. */
            else
                echo $phone;

            break;

            /* Taxonomy 'job type category' column. */
        case 'employee_type' :

            /* Get the genres for the post. */
            $taxonomy = $employee_type;
            $post_type = get_post_type($post_id);

            $terms = get_the_terms( $post_id, 'employee_type' );

            /* If terms were found. */
            if ( !empty( $terms ) ) {

                // echo $terms;
                foreach ( $terms as $term )
            $post_terms[] ="<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " .esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
            echo join('', $post_terms );
            }

            /* If no terms were found, output a default message. */
            else {
                _e( 'No Type' );
            }

            break;    

        /* Just break out of the switch statement for everything else. */
        default :
            break;
    }
}


// here is for CPT code and custom taxonomy code
/**
* CPT on dashboard
*/
function rz_job_application_form() {

    $labels = array(
        'name'                  => _x( 'Job Applications', 'Job Application Admin Menu Name', 'Job Application' ),
        'singular_name'         => _x( 'Job Application', 'Job Application singular name', 'Job Application' ),
        'menu_name'             => _x( 'Job Application ', 'Admin Menu text', 'Job Application' ),
        'name_admin_bar'        => _x( 'Job Application', 'Add New on admin bar', 'Job Application' ),
        'add_new'               => __( 'Add New', 'Job Application' ),
        'add_new_item'          => __( 'Add New Job Application', 'Job Application' ),
        'new_item'              => __( 'New Job Application', 'Job Application' ),
        'edit_item'             => __( 'Edit Job Application', 'Job Application' ),
        'view_item'             => __( 'View Job Application', 'Job Application' ),
        'all_items'             => __( 'All Job Applications', 'Job Application' ),
        'search_items'          => __( 'Search Job Application', 'Job Application' ),
        'parent_item_colon'     => __( 'Parent Job Application:', 'Job Application' ),
        'not_found'             => __( 'No Job Application found.', 'Job Application' ),
        'not_found_in_trash'    => __( 'No Job Application found in Trash.', 'Job Application' ),
        'featured_image'        => _x( 'Job Application candidate Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Job Application' ),
        'set_featured_image'    => _x( 'Set candidate image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Job Application' ),
        'remove_featured_image' => _x( 'Remove candidate image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Job Application' ),
        'use_featured_image'    => _x( 'Use as candidate image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Job Application' ),
        'archives'              => _x( 'Job Application archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Job Application' ),
        'insert_into_item'      => _x( 'Insert into Job Application', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Job Application' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Job Application', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Job Application' ),
        'filter_items_list'     => _x( 'Filter Job Application list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Job Application' ),
        'items_list_navigation' => _x( 'Job Application list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Job Application' ),
        'items_list'            => _x( 'Job Application list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Job Application' ),
    );  

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Job Application.', 'Job Application' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Job Application' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 2,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        // 'taxonomies'         => array( 'category' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Job Application', $args );


    // employee types taxonomy

    $labels = array(
        'name'              => _x( 'Employee Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Employee Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Employee Types' ),
        'all_items'         => __( 'All Employee Types' ),
        'parent_item'       => __( 'Parent Employee Type' ),
        'parent_item_colon' => __( 'Parent Employee Type:' ),
        'edit_item'         => __( 'Edit Employee Type' ),
        'update_item'       => __( 'Update Employee Type' ),
        'add_new_item'      => __( 'Add New Employee Type' ),
        'new_item_name'     => __( 'New Employee Type Name' ),
        'menu_name'         => __( 'Employee Type' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'type' ),
    );

    register_taxonomy( 'employee_type', array( 'jobapplication' ), $args );
}

add_action('init','rz_job_application_form');
