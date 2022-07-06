<?php
include TC_CAF_PATH.'includes/query-variables.php';
if ( $qry->have_posts() ) : while ( $qry->have_posts() ) : $qry->the_post();
global $post;
?>
<article id="caf-post-layout1" class="caf-post-layout1 caf-col-md-<?php echo esc_attr($caf_desktop_col); ?> caf-col-md-tablet<?php echo esc_attr($caf_tablet_col); ?> caf-col-md-mobile<?php echo esc_attr($caf_mobile_col); ?> caf-mb-5 <?php echo esc_attr($caf_special_post_class); ?> <?php echo esc_attr($caf_post_animation); ?>" data-post-id="<?php echo esc_attr(get_the_id()); ?>">
<div class="manage-layout1">
<?php
	$caf_post_id=get_the_ID();
	$title= get_the_title();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $caf_image_size );
	//var_dump($image);
	$link=get_the_permalink();
 //var_dump($post);
 $caf_content=$post->post_excerpt;
 if(empty($caf_content)) {
 $caf_content=$post->post_content; 
 }
 $caf_content= preg_replace('#\[[^\]]+\]#', '',$caf_content);
 $c_length=apply_filters('tc_caf_excerpt_length',30,$id);
 $caf_content=wp_trim_words($caf_content,$c_length);
 $pcl='';
 if($caf_link_target=='popup') {$pcl='caf-popup'; $target='';}
 else {$target="target='".$caf_link_target."'"; }
	if(isset($image[0])) {
	echo "<a href='".esc_url($link)."' $target class='$pcl' data-id='".esc_attr($post->ID)."'><span class='caf-featured-img-box' style='background:url(".esc_url($image[0]).")'></span></a>";
}
else{
$image=TC_CAF_URL.'assets/img/unnamed.jpg';
echo "<a href='".esc_url($link)."' $target class='".esc_attr($pcl)."' data-id='".esc_attr($post->ID)."'><span class='caf-featured-img-box' style='background:url(".esc_url($image).")'></span></a>";
}
echo "<div id='manage-post-area'>";
echo "<div class='caf-post-title'><a href='".esc_url($link)."' $target class='".esc_attr($pcl)."' data-id='".esc_attr($post->ID)."'><h2>".esc_attr($title)."</h2></a></div>";	
 if((class_exists("TC_CAF_PRO") && $caf_post_author=="show" || $caf_post_date=="show" || $caf_post_comments=="show") ||  !class_exists("TC_CAF_PRO")) { 
  echo "<div class='caf-meta-content'>";
 }
  if((class_exists("TC_CAF_PRO") && $caf_post_author=="show") ||  !class_exists("TC_CAF_PRO")) { 
echo"<span class='author caf-col-md-4 caf-pl-0'><i class='fa fa-user' aria-hidden='true'></i> ".get_the_author()."</span>";
  }
 if((class_exists("TC_CAF_PRO") && $caf_post_date=="show")) { 
 $caf_post_date_format=apply_filters('tc_caf_post_date_format',$caf_post_date_format,$id); 
 echo"<span class='date caf-col-md-6 caf-pl-0'><i class='fa fa-calendar' aria-hidden='true'></i> ".get_the_date($caf_post_date_format)."</span>";
 }
	if((!class_exists("TC_CAF_PRO") && $caf_post_date=="show")){
		$caf_post_date_format=apply_filters('tc_caf_post_date_format',$caf_post_date_format,$id); 
 echo"<span class='date caf-col-md-6 caf-pl-0'><i class='fa fa-calendar' aria-hidden='true'></i> ".get_the_date("d, M Y")."</span>";
	}
	
	
	
 if((class_exists("TC_CAF_PRO") && $caf_post_comments=="show") ||  !class_exists("TC_CAF_PRO")) { 
echo"<span class='comment caf-col-md-3 caf-pl-0'><i class='fa fa-comment' aria-hidden='true'></i> ".get_comments_number()."</span>";
 }
 if((class_exists("TC_CAF_PRO") && $caf_post_author=="show" || $caf_post_date=="show" || $caf_post_comments=="show") ||  !class_exists("TC_CAF_PRO")) { 
  echo "</div>";
 }
 if((class_exists("TC_CAF_PRO") && $caf_post_dsc=="show") ||  !class_exists("TC_CAF_PRO")) { 
echo "<div class='caf-content'>".wp_kses_post($caf_content)."</div>";
 }
if($caf_content) {
 if((class_exists("TC_CAF_PRO") && $caf_post_rd=="show") ||  !class_exists("TC_CAF_PRO")) { 
 $rd_more=esc_html('Read More');
echo "<div class='caf-content-read-more'><a class='caf-read-more $pcl' href='".esc_url($link)."' $target data-id='".esc_attr($post->ID)."'>".apply_filters('tc_caf_post_layout_read_more',$rd_more,$id)."</a></div>";
}
}
echo "</div>";
?>		
</div>
</article>
<?php
endwhile;
/**** Pagination*****/
if(isset($_POST["params"]["load_more"])) {
 //do something
}
else {
$caf_pagination->caf_ajax_pager($qry,$page,$caf_post_layout,$caf_pagi_type,$filter_id);
}
$response = [
                'status'=> 200,
                'found' => $qry->found_posts,
	            'message'=>'ok'
            ];
 wp_reset_postdata();
 else :
echo "<div class='error-of-empty-result error-caf'>".esc_html($caf_empty_res)."</div>";	
//$empty_res.='<div class="empty-response">No Posts Found.</div>';
//echo $empty_res;
$response = [
'status'  => 201,
'message' => 'No posts found',
'content' =>'' ,
];
 endif;
do_action("tc_caf_additional_css_layout1");