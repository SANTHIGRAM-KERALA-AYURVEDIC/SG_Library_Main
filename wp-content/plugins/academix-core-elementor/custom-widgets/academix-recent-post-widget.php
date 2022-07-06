<?php 
// Do not allow directly accessing this file.
if ( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

class Academix_Recent_Posts_Widget extends WP_Widget{
     
    //setup the widget name, description , etc.
    public function __construct(){

		$widget_ops = array(
			'calssname' => 'academix_recent_posts_widget',
			'description' => esc_html__('Display Recent Posts Widget', 'academix')
		);

		parent::__construct('academix_recent_posts', esc_html__('Academix Recent Posts', 'academix'), $widget_ops);
    }

    //back-end display of widget
    public function form( $instance ){

    	$title = ( !empty( $instance['title'] ) ? $instance['title'] : 'Recent Posts' );
    	$total = ( !empty( $instance['total'] ) ? absint( $instance['total'] ) : 3 );
?>
    	<p>
	        <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php echo esc_html('Title:', 'academix');?></label>
	        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr( $title );?>">
	        <label for="<?php echo esc_attr($this->get_field_id('total'));?>"><?php echo esc_html('Number of Posts:', 'academix');?></label>
	        <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('total'));?>" name="<?php echo esc_attr($this->get_field_name('total'));?>" value="<?php echo esc_attr( $total );?>">
    	</p>
	    
<?php
    }


    //update widget
     public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'total' ] = ( !empty( $new_instance[ 'total' ] ) ? absint( strip_tags( $new_instance[ 'total' ] ) ) : 0 );
		
		return $instance;
		
	}

	//front-end display of widget 
    public function widget( $args, $instance){

    	$total = absint( $instance['total'] );

    	$post_args = array(
    		'post_type' => 'post',
    		'posts_per_page' => $total,
    		'order' => 'DESC'
    	);
	    $allowed_tags = array(
		    'div' => array(
			    'id' => array(),
			    'class' => array()
		    ),
		    'h4' => array(
			    'class' => array()
		    )
	    );

    	$post_query = new WP_Query( $post_args );
        echo '<div class="recent-post">';
	    echo wp_kses($args['before_widget'], $allowed_tags);

	    if( !empty( $instance['title'] )){
		    echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
	    }

    	if ( $post_query->have_posts() ):
         
            echo '<div class="related-post">';

    		while( $post_query->have_posts() ) : $post_query->the_post();
            
    			echo '<div class="media">';
                echo '<div class="media-left">';
                if( has_post_thumbnail() ){
                echo '<a href="'.esc_url(get_permalink()).'">';
                the_post_thumbnail( 'academix-blog-thumb' , array( 'class' => 'media-object') );
                echo '</a>';
                }
                echo '</div>';
                echo '<div class="media-body">';
                echo '<p class="media-heading"><i class="ion-calendar"> '.date_i18n(get_option( 'date_format' )).'</i></p>';
                echo ' <p class="post-text">
                 <a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a>
                </p>';
                echo '</div>';
                echo '</div>';

    		endwhile;

            echo '</div>';

    	endif;
        
        wp_reset_postdata();

	    echo wp_kses($args['after_widget'], $allowed_tags);
        echo '</div>';
    }
}

function academix_register_recent_post_widget(){
    register_widget( 'Academix_Recent_Posts_Widget' );
}
add_action('widgets_init', 'academix_register_recent_post_widget');