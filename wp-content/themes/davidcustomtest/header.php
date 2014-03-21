<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body class="david-body">

        <header>
            <nav>

			<ul id="menu">
                <li id="nav-head"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="selected" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></li>


                <!-- <li id="nav-link1"><//?php wp_nav_menu(); ?></li> -->

                 <?php
                    $args = array( 'post_type' =>'page', 'parent' => 0 );
                    $pageQuery = new WP_Query( $args );

                    if ( $pageQuery -> have_posts() ) {
                        while ( $pageQuery->have_posts() ) {
                                $pageQuery->the_post();

                                echo '<li id=nav-link-2><a href=""' .get_permalink(). '">' . get_the_title() . '</li>';
                        }
                    } else {
                        return false;
                 } ?>

                <li id="nav-link-4"><a href="wp-login.php">Login</a></li>

                <li id="nav-link-5"><?php david_get_search_form(); ?></li>



            </ul>

		    <?php if ( get_header_image() ) : ?>
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		    <?php endif; ?>
           </nav>
        </header><!-- #site-navigation -->






 <div>