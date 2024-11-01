<?php
/**
 * Plugin Name:   UVC digital clock
 * Description:   Simple digital clock
 * Version:       1.0
 * Author:        UVC
 */

class uvcd_clock extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $uvcd_widget_options = array( 'classname' => 'uvcd_clock', 'description' => 'Simple digital clock' );
    parent::__construct( 'uvcd_clock', 'UVC digital clock', $uvcd_widget_options );
  }





  // Create the widget output.
  public function widget( $args, $instance ) {
    $uvcd_title = apply_filters( 'widget_title', $instance[ 'title' ] );?>


<? $uvcd_dir = plugin_dir_url( __FILE__ );?>


<style>
@font-face {
  font-family: DS Digital;
src: url(<? echo $uvcd_dir;?>font.TTF) format("truetype");
}

.uvcd_base {font-family: 'DS Digital', sans-serif;font-size:34px !important; ;padding-top:22px !important; ;  width:100% !important; text-align:center !important; }

.uvcd_t1 {
color:  #FE0000;
text-shadow:0 0 3px #FE0000, 0 0 7px #FE0000, 0 0 20px #FE0000;}

.uvcd_backuvcd_t1 {width:211px !important; height:95px !important;background-image:url(<? echo $uvcd_dir;?>001.png);  margin: 0 auto !important ;}

.uvcd_t2 {
color:  #0061FE;
text-shadow:0 0 3px #0061FE, 0 0 7px #0061FE, 0 0 20px #0061FE;}

.uvcd_backuvcd_t2 {width:211px !important; height:95px;background-image:url(<? echo $uvcd_dir;?>002.png);  margin: 0 auto !important ;}

.uvcd_t3 {
color:  #65fe3f;
text-shadow:0 0 3px #65fe3f, 0 0 7px #65fe3f, 0 0 20px #65fe3f;}

.uvcd_backuvcd_t3 {width:211px !important; height:95px;background-image:url(<? echo $uvcd_dir;?>003.png);  margin: 0 auto !important ; }

.uvcd_t4 {
color:  #D000FE;
text-shadow:0 0 3px #D000FE, 0 0 7px #D000FE, 0 0 20px #D000FE;}

.uvcd_backuvcd_t4 {width:211px !important; height:95px;background-image:url(<? echo $uvcd_dir;?>004.png);  margin: 0 auto !important ; }

</style> 
    
<div class="uvcd_back<? echo $uvcd_title ?>">
<h1 id="uvcd_clock" class="uvcd_base <? echo $uvcd_title ?>"></h1>
</div>
<script type="text/javascript">
// Interactiveness now

(function() {

	var clock = document.querySelector('#uvcd_clock');
	
	// But there is a little problem
	// we need to pad 0-9 with an extra
	// 0 on the left for hours, seconds, minutes
	
	var pad = function(x) {
		return x < 10 ? '0'+x : x;
	};
	
	var ticktock = function() {
		var d = new Date();
		
		var h = pad( d.getHours() );
		var m = pad( d.getMinutes() );
		var s = pad( d.getSeconds() );
		
		var current_time = [h,m,s].join(':');
		
		clock.innerHTML = current_time;
		
	};
	
	ticktock();
	
	// Calling ticktock() every 1 second
	setInterval(ticktock, 1000);
}());
</script>





    <?php echo $args['after_widget'];
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
    $uvcd_title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Template:</label>
      
      
<select id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>">

<option <? if(esc_attr( $uvcd_title ) == "uvcd_t1"):?>
selected="selected"
<? endif;?>  value="uvcd_t1">Red</option>
<option  <? if(esc_attr( $uvcd_title ) == "uvcd_t2"):?>
selected="selected"
<? endif;?> value="uvcd_t2">Blue</option>
<option  <? if(esc_attr( $uvcd_title ) == "uvcd_t3"):?>
selected="selected"
<? endif;?> value="uvcd_t3">Green</option>
<option  <? if(esc_attr( $uvcd_title ) == "uvcd_t4"):?>
selected="selected"
<? endif;?> value="uvcd_t4">Pink</option>

</select>
    

    
    </p><?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }

}

// Register the widget.
function jpen_register_uvcd_clockwidget() { 
  register_widget( 'uvcd_clock' );
}
add_action( 'widgets_init', 'jpen_register_uvcd_clockwidget' );

?>

