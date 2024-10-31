<?php
/*
 * Plugin Name: Poker Widget
 * Version: 1.0b
 * Plugin URI: http://www.gamblingmodules.com/
 * Description: Poker Widget is the only wordpress widget that give your site visitors poker tournaments feeds

 * Author: Incomate
 * Author URI: http://www.incomate.com/
 */

	function activate(){
		$data = array( 'title' => 'Poker Widget', 'width' => '270px', 'height' => '150px');
	    if ( ! get_option('PokerWidget')){
	      add_option('PokerWidget' , $data);
	    } else {
	      update_option('PokerWidget' , $data);
	    }
	}
	  
	function deactivate(){
		delete_option('PokerWidget');
	}

	
	function control(){

		$data = get_option('PokerWidget');
						
		?>
  		<p><label>Title <input name="PokerWidget_title"
		type="text" value="<?php echo $data['title']; ?>" /></label></p>
  		<p><label>Width <input name="PokerWidget_width"
		type="text" value="<?php echo $data['width']; ?>" /></label></p>
		<p><label>Height <input name="PokerWidget_height"
		type="text" value="<?php echo $data['height']; ?>" /></label></p>
		<?php
		if (isset($_POST['PokerWidget_title'])){
			$data['title'] = attribute_escape($_POST['PokerWidget_title']);
			$data['width'] = attribute_escape($_POST['PokerWidget_width']);
			$data['height'] = attribute_escape($_POST['PokerWidget_height']);
			update_option('PokerWidget', $data);
		}
		
	}
	
	function widget($args) {
		
		extract($args);
	  
	  	# Widget internal parameters
		$feeds_url = 'http://feeds.incomate.com/?type=7499&asf=aptc:23x1;configID:Full&geo=true';
		$default_width = '270px';
		$default_height; // Set a value here if you wanna ensure a minimum height
		$bottom_html = '<p style="font-size: x-small">
        <b><a href="http://www.gamblingmodules.com" target="_blank" title="gambling widgets">poker widget</a></b></p>'; // Set HTML content here
		
		# Get stored configuration parameters
		$instance = get_option('PokerWidget');
		$title = empty($instance['title']) ? '&nbsp;' : $instance['title'];
		$width = empty($instance['width']) ? $default_width : $instance['width'];
		$height = empty($instance['height']) ? $default_height : $instance['height'];
		
		echo $before_widget;
		echo $before_title;?>Poker Widget<?php echo $after_title;
		echo '<iframe src="'.$feeds_url.'" width="'.$width;
		if ($height) echo '" height="'.$height;
		echo '" frameborder="0" marginheight="0px" marginwidth="0" scrolling="auto"><a href="'.$feeds_url.'">Hmm, you are using a very old browser. Click here to go directly to included content.</a>
			  </iframe>';
		echo $bottom_html;
		echo $after_widget;
	}

	
	/**
	* Register Poker Widget.
	*
	* Calls 'widgets_init' action after the Hello World widget has been registered.
	*/
	function PokerWidgetInit() {
		register_sidebar_widget('Poker Widget', 'widget');
		register_widget_control('Poker Widget', 'control');
	}	
	add_action('widgets_init', 'PokerWidgetInit');
	register_activation_hook( __FILE__, 'activate');
	register_deactivation_hook( __FILE__, 'deactivate');
?>
