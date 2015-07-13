<?php
/**
 *  Plugin Name: Ls Gtrans Widget
 *  Author: lenasterg, NTS on cti.gr
 *  Version: 1.0
 * License:  GNU General Public License 3.0 or newer (GPL) http://www.gnu.org/licenses/gpl.html
 * Last Updated: July 9, 2015
 * Description:  Widget with selectbox to Google translation for the current page. Contains more than 25 European languages.
 *
 */
 
/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

class Ls_Gtrans_Widget extends WP_Widget {

    public function __construct() {
	$widget_ops = array( 'classname' => 'Ls_Gtrans_Widget', 'description' => __( 'Drop-down with more than 25 languages', 'ls_gtrans_widget' ) );
	$widget_ops = array( 'classname' => 'Ls_Gtrans_Widget', 'description' => __( 'Λίστα με πάνω από 25 γλώσσες για μετάφραση του ιστολογίου σας', 'ls_gtrans_widget' ) );
	$this->WP_Widget( 'Ls_Gtrans_Widget', 'Μετάφραση μέσω Google', $widget_ops );
    }

    function widget( $args, $instance ) {
	// PART 1: Extracting the arguments + getting the values
	extract( $args, EXTR_SKIP );
	$title = empty( $instance['title'] ) ? 'Translate' : apply_filters( 'widget_title', $instance['title'] );

	// Before widget code, if any
	echo (isset( $before_widget ) ? $before_widget : '');

	// PART 2: The title and the text output
	if ( ! empty( $title ) )
	    echo $before_title . $title . $after_title;
	?>
		<form name="ls_gtrans_form">
				    <select id="ls_gtrans_sel" onchange="window.top.location.href = 'http://translate.google.com/translate?hl=en&&sl=auto&tl=' + this.options[this.selectedIndex].value + '&u=' + window.location.href;"
				    style="width:200px;padding-left:20px;background-image:url(<?php echo plugins_url( '/images/google_logo.png', __FILE__ ); ?>);background-repeat: no-repeat;">
		<option value="">Select a language</option>
		<option value="sq">Albanian</option>
		<option value="bg">Bulgarian</option>
		<option value="hr">Croatian</option>
		<option value="cs">Czech</option>
		<option value="da">Danish</option>
		<option value="nl">Dutch</option>
		<option value="en">English</option>
		<option value="et">Estonian</option>
		<option value="fi">Finnish</option>
		<option value="fr">French</option>
		<option value="de">German</option>
		<option value="el">Greek</option>
		<option value="hu">Hungarian</option>
		<option value="it">Italian</option>
		<option value="lv">Lativian</option>
		<option value="lt">Lithuanian</option>
		<option value="mt">Maltese</option>
		<option value="no">Norwegian</option>
		<option value="pl">Polish</option>
		<option value="pt">Portuguese</option>
		<option value="ro">Romanian</option>
		<option value="ru">Russian</option>
		<option value="sr">Serbian</option>
		<option value="sk">Slovak</option>
		<option value="sl">Slovenian</option>
		<option value="es">Spanish</option>
		<option value="sv">Swedish</option>
		<option value="tr">Turkish</option>
		<option value="uk">Ukrainian</option>
	    </select>
	</form>
	<?php
	// After widget code, if any
	echo (isset( $after_widget ) ? $after_widget : '');
    }

    public function form( $instance ) {
	$instance = wp_parse_args( ( array ) $instance, array( 'title' => 'Translate' ) );
	$title = $instance['title'];
	?>
		<!-- PART 2: Widget Title field START -->
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ) ?>:
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
		       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
		       value="<?php echo attribute_escape( $title ); ?>" />
	    </label>
	</p>
	<!-- Widget Title field END -->
	<?php
    }

    function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = $new_instance['title'];
	return $instance;
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("Ls_Gtrans_Widget");' ) );
