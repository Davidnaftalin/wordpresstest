<?php

    // Loads our main stylesheet.
    function davidcustomtest_scripts_styles() {

        wp_enqueue_style( 'davidcustomtest-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'davidcustomtest_scripts_styles' );



    function create_post_type() {
        register_post_type( 'people',
            //creates post type People
            array(
                'labels' => array(
                    'name' => __( 'People' ),
                    'singular_name' => __( 'Person' )
                ),
                'public' => true,
                'has_archive' => true,
        )
    );

        register_post_type( 'projects',
            //creates post type projects
            array(
                'labels' => array(
                    'name' => __( 'Projects' ),
                    'singular_name' => __( 'Project' )
                ),
                'public' => true,
                'has_archive' => true,
            )
        );

    }
add_action( 'init', 'create_post_type' );



    function my_connection_types() {
        p2p_register_connection_type( array(
            'name' => 'people_to_projects',
            'from' => 'people',
            'to' => 'projects'
        )
    );

}
add_action( 'p2p_init', 'my_connection_types' );


    function skills_init() {
        // creates new taxonomy called 'skills'
    register_taxonomy(
        'skills',
        'people',
        array(
            'label' => __( 'Skills' ),
            'rewrite' => array( 'slug' => 'skill' ),
        )
    );
}
add_action( 'init', 'skills_init' );


// this function will return the person post associated via the user to the blog post
function get_author_post($id){
    //create args for WP_Query to get person posts with meta_value of user_id
    $args = array('post_type' => 'people', 'meta_key' => 'user', 'meta_value' => $id);

    //run query
    $userQuery = new WP_Query( $args );

    //return person post if found
    if ( $userQuery->found_posts > 0) {
        return $userQuery->post;
    } else {
        return false;
    }


}



function clean_twitter_url($arg){
    $replacements = array('http://', 'www.', 'twitter.com/', '@');
    foreach($replacements as $replacement){
        $arg = str_replace($replacement,'', $arg);
    }
    return $arg;
}


function david_get_search_form( $echo = true ) {
    do_action( 'pre_get_search_form' );

    $format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
    $format = apply_filters( 'search_form_format', $format );

    $search_form_template = locate_template( 'searchform.php' );
    if ( '' != $search_form_template ) {
        ob_start();
        require( $search_form_template );
        $form = ob_get_clean();
    } else {
        if ( 'html5' == $format ) {
            $form = '<form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<input type="search"  placeholder="Search"' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />
				</label>
				<input type="submit"  value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
			</form>';
        } else {
            $form = '<form role="search" method="get" class="david-search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<input type="text" placeholder="Search" value="' . get_search_query() . '" name="s"  />
				</div>
			</form>';
        }
    }

    $result = apply_filters( 'get_search_form', $form );
    if ( null === $result )
        $result = $form;

    if ( $echo )
        echo $result;
    else
        return $result;
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function add_my_script() {
    wp_enqueue_script(
        'script', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/JS/script.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
}