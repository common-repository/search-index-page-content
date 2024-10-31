<?php
/*
Plugin Name: Search & Index Page Content
Text Domain: search-index-page-content
Plugin URI: http://adaldesign.com/2013/09/search-and-index-page-content/
Description: Help visitors browse the content of very big pages by providing on-page search and contextual links to jump to the content they are interested in. This plugin allows you to save the trouble of creating anchor links by providing shortcodes and widgets that can be placed on any post or page.
Version: 1.4
Author: ADALDESIGN
Author URI: http://adaldesign.com
License: GPL2
*/

/*  Copyright 2014  Adal Bermann  (email : adal@adaldesign.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*  --------------------
 *	 Shortcode: [SIPC_Content] content goes here [/SIPC_Content]
 *	 Description: This shortcode is made to enclose the content that should be indexed by links and made searchable.
 *  -------------------- */
function sipc_content_shortcode( $atts , $content = null ) {

	// Code
	return '<div id="sipc-content">' . $content . '</div>';

}
add_shortcode( 'SIPC_Content', 'sipc_content_shortcode' );




/*  --------------------
 *	 Shortcode: [SIPC_Search_Box search_title="Search this page for:" submit="Search"]
 *   Reserved for release at later date
 *  -------------------- 
function sipc_search_box_shortcode($atts) {
	extract( shortcode_atts(
		array(
			'search_title' => 'Search this page for:',
			'submit' => 'Search',
		), $atts )
	);
	return $search_title . ' <input type="text" id="sipc-search" /> <button type="button" id="sipc-button">' . $submit . '</button>';
}
add_shortcode('SIPC_Search_Box', 'sipc_search_box_shortcode');
*/

/*  --------------------
 *	 Shortcode: [SIPC_Links_Index]
 *   Reserved for release at later date
 *  -------------------- 
function sipc_links_index_shortcode() { 
	return '<ul id="sipc-links"></ul>'; 
}
add_shortcode('SIPC_Links_Index', 'sipc_links_index_shortcode');
*/


/*  --------------------
 *	 Widget: SIPC_Links_Widget
 *   Code required to register and handle the sidebar widget
 *  -------------------- 
 */
class SIPC_Links_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sipc_links_widget', // Base ID
			__('Search & Index Page Content', 'search-index-page-content'),
			array( 'description' => __( 'Creates links to headers of a page for easy navigation.', 'search-index-page-content' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		if ( isset( $instance[ 'show_search' ] ) ) { $show_search = $instance[ 'show_search' ]; } else { $show_search = __( 'on', 'search-index-page-content' ); }
		if ( isset( $instance[ 'search_title' ] ) ) { $search_title = $instance[ 'search_title' ]; } else { $search_title = __( 'Search this page', 'search-index-page-content' ); }
		if ( isset( $instance[ 'show_index' ] ) ) { $show_index = $instance[ 'show_index' ]; } else { $show_index = __( 'on', 'search-index-page-content' ); }
		if ( isset( $instance[ 'index_title' ] ) ) { $index_title = $instance[ 'index_title' ]; } else { $index_title = __( 'Page Contents', 'search-index-page-content' ); }

		if ( has_shortcode(get_the_content(), 'SIPC_Content') ) { 
			echo $args['before_widget'];
			
			if ( $show_search == 'on' )
				echo '<input type="text" id="sipc-search" placeholder="'. $search_title .'" /> 
					  <button type="button" id="sipc-button">' . __('Search', 'search-index-page-content') . '</button><br /><br />';
			
			if ( $show_index == 'on' ) {
				if ( ! empty( $index_title ) ) echo $args['before_title'] . $index_title . $args['after_title'];
				echo '<ul id="sipc-links"></ul>';
			}
			echo $args['after_widget'];
		}
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'show_search' ] ) ) { $show_search = $instance[ 'show_search' ]; } else { $show_search = __( 'on', 'search-index-page-content' ); }
		if ( isset( $instance[ 'search_title' ] ) ) { $search_title = $instance[ 'search_title' ]; } else { $search_title = __( 'Search this page', 'search-index-page-content' ); }
		if ( isset( $instance[ 'show_index' ] ) ) { $show_index = $instance[ 'show_index' ]; } else { $show_index = __( 'on', 'search-index-page-content' ); }
		if ( isset( $instance[ 'index_title' ] ) ) { $index_title = $instance[ 'index_title' ]; } else { $index_title = __( 'Page Contents', 'search-index-page-content' ); }
		?>
		
		<p>
            <label for="<?php echo $this->get_field_id( 'show_search' ); ?>">
                <input 
                	id="<?php echo $this->get_field_id( 'show_search' ); ?>" 
                    name="<?php echo $this->get_field_name( 'show_search' ); ?>" 
                    type="checkbox" <?php echo $checked = ($show_search == "on") ? "checked" : ""; ?> />
                <?php _e( 'Show search field?', 'search-index-page-content' ); ?> 
            </label>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'search_title' ); ?>"><?php _e( 'Search field placeholder text:', 'search-index-page-content' ); ?></label> 
            <input class="widefat" 
                id="<?php echo $this->get_field_id( 'search_title' ); ?>" 
                name="<?php echo $this->get_field_name( 'search_title' ); ?>" 
                type="text" value="<?php echo esc_attr( $search_title ); ?>" />
		</p>
        
        <hr style="margin: 3em 0;" />
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_index' ); ?>">
                <input 
                	id="<?php echo $this->get_field_id( 'show_index' ); ?>" 
                    name="<?php echo $this->get_field_name( 'show_index' ); ?>" 
                    type="checkbox" <?php echo $checked = ($show_index == "on") ? "checked" : ""; ?> />
                <?php _e( 'Show contents index links?', 'search-index-page-content' ); ?> 
            </label>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'index_title' ); ?>"><?php _e( 'Index links title:', 'search-index-page-content' ); ?></label> 
            <input class="widefat" 
            	id="<?php echo $this->get_field_id( 'index_title' ); ?>" 
                name="<?php echo $this->get_field_name( 'index_title' ); ?>" 
                type="text" value="<?php echo esc_attr( $index_title ); ?>" />
		</p>
        <p>
            <br /><strong><?php _e( 'INSTRUCTIONS', 'search-index-page-content'); ?></strong><br />
			<?php _e( 'This widget will only appear on pages or posts when you surround the content to index or search with the shortcode as such:', 'search-index-page-content'); ?>
            <br /><br /><em>[SIPC_Content]<?php _e( 'This content will be searchable and/or indexed', 'search-index-page-content' ); ?>[/SIPC_Content]</em><br />
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['show_search'] = ( ! empty( $new_instance['show_search'] ) ) ? strip_tags( $new_instance['show_search'] ) : '';
		$instance['search_title'] = ( ! empty( $new_instance['search_title'] ) ) ? strip_tags( $new_instance['search_title'] ) : '';
		$instance['show_index'] = ( ! empty( $new_instance['show_index'] ) ) ? strip_tags( $new_instance['show_index'] ) : '';
		$instance['index_title'] = ( ! empty( $new_instance['index_title'] ) ) ? strip_tags( $new_instance['index_title'] ) : '';
		return $instance;
	}

} // class SIPC_Links_Widget

// register SIPC_Links_Widget widget
function register_sipc_links_widget() {
    register_widget( 'SIPC_Links_Widget' );
}
add_action( 'widgets_init', 'register_sipc_links_widget' );



/*  --------------------
 *  Conditionally enqueue jQuery
 *  -------------------- */

function conditional_jquery() {
	global $post;
	if( has_shortcode( $post->post_content, 'SIPC_Content') && !wp_script_is('jquery', 'enqueued') ) {
		wp_enqueue_script( 'jquery');
	}
}
add_action( 'wp_enqueue_scripts', 'conditional_jquery');



/*  --------------------
 *  Print Inline jQuery in footer
 *  -------------------- */

function sipc_inline_scripts() {

	if ( has_shortcode(get_the_content(), 'SIPC_Content') ) { ?>

		<style type="text/css">
			#sipc-links a { cursor: pointer; }
			#sipc-links .SIPC-H2 { margin-left: 5px; }
			#sipc-links .SIPC-H3 { margin-left: 10px; }
			#sipc-links .SIPC-H4 { margin-left: 15px; }
			#sipc-links .SIPC-H5 { margin-left: 20px; }
			#sipc-content span.label { font-weight: bold; border: 1px dotted; padding: 1px 4px; }
		</style>
		
		<script type="text/javascript">jQuery(document).ready(function($){
			
			jQuery.fn.extend({
				scrollThere: function () {
					nameTag = $('#' + $(this).attr('points') );
					$('html,body').animate({scrollTop: nameTag.offset().top - 100},'slow');
					return false;
				}
			});
				
			jQuery.fn.extend({
			  highlight: function (str, className) {
				if ( str != '' ) {
				  $('.' + className).removeClass(className);
				  var regex = new RegExp(str, "gi");
				  this.each(function () {
					$(this).contents().filter(function() {
					  return this.nodeType == 3 && regex.test(this.nodeValue);
					}).replaceWith(function() {
					  return (this.nodeValue || "").replace(regex, function(match) {
						return "<span class=\"" + className + "\">" + match + "</span>";
					  });
					});
				  });
				  return $('html,body').animate({scrollTop: $('.' + className + ':first').offset().top - 100},'slow');
				}
			  }
			});
			$('#sipc-button').click( function() { $("#sipc-content *").highlight($( '#sipc-search').val(), "label"); });
			$('#sipc-search').keypress( function(e) { if(e.keyCode == 13) { $("#sipc-content *").highlight($( '#sipc-search').val(), "label"); } } );
			
			$('#sipc-content h1, #sipc-content h2, #sipc-content h3, #sipc-content h4, #sipc-content h5').each(function( index, domEle ) {
				index = index + 1;
				var $class = 'SIPC-' + domEle.tagName;
				$('#sipc-links').append('<li><a points="h-' + index + '" class="' + $class + '">' + $(domEle).clone().text() + '</a></li>');
				$(this).attr('id', 'h-' + index );
			});
			$('#sipc-links a').click( function() { $(this).scrollThere(); });
				
		});</script>
	
	<?php }
	
}

add_action( 'wp_footer', 'sipc_inline_scripts' );



/*  --------------------
 *  Localize Plugin for Translations
 *  -------------------- */
 
function ap_action_init() {
	load_plugin_textdomain('search-index-page-content', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

// Add actions
add_action('init', 'ap_action_init');

?>