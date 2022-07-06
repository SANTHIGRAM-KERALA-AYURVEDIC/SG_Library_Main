<?php
include TC_CAF_PATH.'includes/query-variables.php';
if ( $qry->have_posts() ) : while ( $qry->have_posts() ) : $qry->the_post();
global $post;
$caf_post_id=get_the_ID();
if(is_array($tax)) {
 $cats=array();
  foreach($tax as $tx) {
   $cats[]=get_the_terms($caf_post_id,$tx);
  }
 }
 else {
	$cats=get_the_terms($caf_post_id,$tax);
 }
//var_dump($cats);
$cats_class='';
if(is_array($cats)) {
if(isset($cats)) {
 if(class_exists("TC_CAF_PRO")) {
	 if(isset($cats[0][0]->name)) {
 $cats_class=$cats[0][0]->name;
	 }
 }
 else {
	 if(isset($cats[0]->name)) {
  $cats_class=$cats[0]->name;
	 }
 }
 $cats_class = str_replace(' ', '_', $cats_class);
 $cats_class="tp_".$cats_class;
} else {$cats_class='';} }
//$cats_class='';
?>
<article id="caf-post-layout3" class="caf-post-layout1 caf-col-md-<?php echo esc_attr($caf_desktop_col); ?> caf-col-md-tablet<?php echo esc_attr($caf_tablet_col); ?> caf-col-md-mobile<?php echo esc_attr($caf_mobile_col); ?> caf-mb-5 <?php echo esc_attr($caf_special_post_class); ?> <?php echo esc_attr($caf_post_animation); ?> <?php echo esc_attr($cats_class); ?> " data-post-id="<?php echo esc_attr(get_the_id()); ?>">
<?php 
$caf_post_id=get_the_ID();
$title= get_the_title();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $caf_image_size );
$link=get_the_permalink();
 $caf_content=$post->post_excerpt;
 if(empty($caf_content)) {
 $caf_content=$post->post_content; 
 }
 $caf_content= preg_replace('#\[[^\]]+\]#', '',$caf_content);
 $c_length=apply_filters('tc_caf_excerpt_length',30,$id);
 $caf_content=wp_trim_words($caf_content,$c_length);
if(isset( $image[0])) {
echo "<a href='".esc_url($link)."' target='".esc_attr($caf_link_target)."'><div class='caf-featured-img-box' style='background:url(".esc_attr($image[0]).")'></div></a>";
}
else{
$image=TC_CAF_URL.'assets/img/unnamed.jpg';
echo "<a href='".esc_url($link)."' target='".esc_attr($caf_link_target)."'><div class='caf-featured-img-box' style='background:url(".esc_url($image)."
)'></div></a>";
}	
echo "<div id='manage-post-area'>";
if((class_exists("TC_CAF_PRO") && $caf_post_cats=="show") ||  !class_exists("TC_CAF_PRO")) { 
echo "<div class='caf-meta-content-cats'>";
echo "<ul class='caf-mb-0'>";
	if(is_array($cats)) {
  foreach ($cats as $index=>$cat) {
		if($index<3) {
   if(class_exists("TC_CAF_PRO")) {
    if(isset($cat[0])) {
    $clink=get_category_link($cat[0]->term_id);
	echo "<li><a href='".esc_url($clink)."' target='_blank'>".esc_html($cat[0]->name)."</a></li>";
   }
   }
   else {
	$clink=get_category_link($cat->term_id);
	echo "<li><a href='".esc_url($clink)."' target='_blank'>".esc_html($cat->name)."</a></li>";
		}
  }
  }
}
echo "</ul>";
echo "</div>";
}
echo "<div class='caf-post-title'><h2><a href='".get_the_permalink()."'>".esc_html($title)."</a></h2></div>";
 if((class_exists("TC_CAF_PRO") && $caf_post_author=="show" || $caf_post_date=="show") ||  !class_exists("TC_CAF_PRO")) {
echo "<div class='caf-meta-content'>";
 }
 if((class_exists("TC_CAF_PRO") && $caf_post_author=="show") ||  !class_exists("TC_CAF_PRO")) { 
echo"<b><span class='author caf-pl-0'>By ".get_the_author()." - </span></b>";
 }
 if((class_exists("TC_CAF_PRO") && $caf_post_date=="show")) { 
	  $caf_post_date_format=apply_filters('tc_caf_post_date_format',$caf_post_date_format,$id); 
echo"<span class='date caf-pl-0'>".get_the_date($caf_post_date_format)."</span>";
 }
	if((!class_exists("TC_CAF_PRO") && $caf_post_date=="show")){
		$caf_post_date_format=apply_filters('tc_caf_post_date_format',$caf_post_date_format,$id); 
 echo"<span class='date caf-col-md-6 caf-pl-0'><i class='fa fa-calendar' aria-hidden='true'></i> ".get_the_date("d, M Y")."</span>";
	}
 if((class_exists("TC_CAF_PRO") && $caf_post_author=="show" || $caf_post_date=="show") ||  !class_exists("TC_CAF_PRO")) {
echo "</div>";
 }
echo "</div>";
?>	
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