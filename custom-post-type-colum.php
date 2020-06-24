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
