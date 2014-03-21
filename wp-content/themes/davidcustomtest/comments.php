<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
get_header();

if ( post_password_required() )
    return;
?>

<?php


$comments = get_comments();
foreach($comments as $comment) :
    echo($comment->comment_author . '<br />' . $comment->comment_content);
endforeach;

?>

<div>

    <?php comment_form(); ?>

</div><!-- #comments .comments-area -->