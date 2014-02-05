<?php
/*
	Section: ShareBar
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Adds ways to share content on pages/single posts
	Class Name: PageLinesShareBar
	Workswith: main
	Failswith: pagelines_special_pages()
	Cloning: true
	Filter: social
*/

/**
 * ShareBar Section
 *
 * @package PageLines DMS
 * @author PageLines
 */
class PageLinesShareBar extends PageLinesSection {

	/**
     * Section template.
     *
     * @version 2.2 - added conditional check for no social sites being chosen.
     */
    function section_template() {

        ?>

        <div class="pl-sharebar">
            <div class="pl-sharebar-pad">
				<div class="pl-social-counters pl-animation-group">
					<?php 
						$classes = 'pl-animation pla-from-top subtle';
						echo pl_karma( false, array('classes' => $classes ) ); 
						echo pl_get_social_button( array('btn' => 'facebook', 'classes' => $classes) ); 
						echo pl_get_social_button( array('btn' => 'twitter', 'classes' => $classes) ); 
						echo pl_get_social_button( array('btn' => 'linkedin', 'classes' => $classes) ); 
						echo pl_get_social_button( array('btn' => 'pinterest', 'classes' => $classes) ); 
					?>
				</div>
				
                <div class="clear"></div>
            </div>
        </div>
    <?php }

	function get_shares(){

		global $post;

		if( ! is_object( $post ) )
			return;
		$perm = get_permalink($post->ID);
		$title = wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb = (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';

		$desc = wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );

		$out = '';

		

		return $out;
	}



}