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

	function section_opts(){

		$the_urls = array();

		$icons = $this->the_icons();

		foreach($icons as $icon){
			$the_urls[] = array(
				'label'	=> ui_key($icon) . ' Disable?',
				'key'	=> $this->id.'_disable_'.$icon,
				'type'	=> 'check',
				'scope'	=> 'global',
			);
		}

		$opts = array(

			array(
				'type'	=> 'multi',
				'key'	=> 'config',
				'title'	=> 'Config',
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'text',
						'key'	=> 'text',
						'label'	=> 'Description Text',

					),
					array(
						'type'	=> 'select',
						'key'	=> 'align',
						'label'	=> 'Alignment',
						'opts'	=> array(
							'right'		=> array( 'name' => 'Social links on right'),
							'center'	=> array( 'name' => 'Social links on right'),
							'left'		=> array( 'name' => 'Social links on left'),
						),
					),
				)

			),
			array(
				'type'	=> 'multi',
				'key'	=> 'sl_urls',
				'title'	=> 'Share Button Disable',

				'col'	=> 2,
				'opts'	=> $the_urls

			)


		);

		return $opts;

	}

	function the_icons( ){

		$icons = array(
			'facebook',
			'linkedin',
			'twitter',
			'pinterest',
		);



		return $icons;

	}
    function section_template() {

		$align = $this->opt('align');

		if( $align == 'left' )
			$align_class = 'alignleft';
		elseif( $align == 'right' )
			$align_class = 'alignright';
		else
			$align_class = '';

		$txt = $this->opt('text');

		$txt = ( $txt ) ? sprintf('<div class="txt-wrap pla-from-bottom pl-animation subtle"><div class="txt">%s</div></div>', $txt) : '';

        ?>

        <div class="pl-sharebar">
            <div class="pl-sharebar-pad">
				<div class="pl-social-counters pl-animation-group <?php echo $align_class;?>">
					<?php
						$classes = 'pl-animation pla-from-top subtle icon';
						echo pl_karma( false, array('classes' => $classes ) );

						foreach( $this->the_icons() as $key => $icon ){
							if( ! pl_setting( $this->id.'_disable_'.$icon ) )
								echo pl_get_social_button( array('btn' => $icon, 'classes' => $classes) );
						}

					?>

				</div>
				<?php echo $txt; ?>
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