<?php
/*Template Name:AutoCompleteBox1
*/
?>
<?php
if(!empty($_POST["keyword"]))

 {
	  $query ="SELECT * FROM reedemer_category WHERE 
			cat_name like '" . $_POST["keyword"] . "%' && status = 1 GROUP BY cat_name LIMIT 0,4";
			$result = $wpdb->get_results($query);
			$query2 ="SELECT distinct(more_information) FROM reedemer_offer WHERE 
			LOWER(more_information) like '%" .strtolower($_POST['keyword']). "%'  && status = 1 && published='true' ORDER BY more_information LIMIT 0,5";
			//$query2 ="SELECT distinct(more_information) FROM reedemer_offer WHERE 
			//more_information REGEXP '[[:<:]][".strtolower($_POST['keyword'])."]' && status = 1 && published='true' ORDER BY more_information LIMIT 0,10";
			//echo $query2;
			
  			$tag_result = $wpdb->get_results($query2,ARRAY_N);
  			// for brand section
  
  			$query3 ="SELECT id,company_name FROM users WHERE 
			company_name LIKE '%".strtolower($_POST['keyword'])."%' && status = 1 GROUP BY company_name 			LIMIT 0,4";
  
			//echo $query2;
  			$brand_result = $wpdb->get_results($query3);
  			
  			// end of brand section query
 			
  			if(is_array($tag_result) && count($tag_result)>0){
				$my_array = array();
  			//$result2 = array_unique($tag_result);
				$i = 0;
				foreach($tag_result as $tag){
					if(strpos($tag, ',') !== FALSE){
						
						$get_tag_value = explode(",", "$tag[$i]");
						
						foreach($get_tag_value as $tag_value){
							array_push($my_array,$tag_value);
						}
					}else{
						array_push($my_array,$tag);
					}
					
				}
				
				
			}
  			$result2 = array_unique($my_array);
 
  
  
  			$data['list_data']='';
  			
			//if(!empty($result)) 
			//{ echo($result->id);

		$data['list_data'] .='<ul id="cat_list_id" class="cat-list">';
		foreach($result as $category) { 
		$newtest= "'".$category->cat_name."'";
		$newtest1= "'".$category->id."'";
		$newtest2= "'".$category->parent_id."'";
		//$newsub_sub= "'".$category->parent_id."'";
		$query33 ="SELECT parent_id  FROM reedemer_category WHERE id =".$newtest2;
		$result22 = $wpdb->get_results($query33);
		$result222 =count($result22);
		if($result222 > 0){
			foreach($result22 as $category22) {
			$newtest23= "'".$category22->parent_id."'";
		$data['list_data'].='<li class="" data-type="category" onClick="selectCategory('.$newtest.','.$newtest1.','.$newtest2.','.$newtest23.');" data-cat_id="'.$category->id.'" data-sub_catid="'.$category->parent_id.'"data-sub_sub_parent="'.$category22->parent_id.'">'.strtolower($category->cat_name)."</li>";
		}	
		}
		else{
			$data['list_data'].='<li class="" data-type="category" onClick="selectCategory('.$newtest.','.$newtest1.','.$newtest2.');" data-cat_id="'.$category->id.'" data-sub_catid="'.$category->parent_id.'">'.strtolower($category->cat_name)."</li>";
			}
		
		 } 
		foreach($result2 as $category2) {
			$new_cat = "'".$category2."'";
			if(strpos(strtolower($category2), strtolower($_POST['keyword'])) !== FALSE){
		$data['list_data'].='<li class="" data-type="tag" onClick="selecttag('.$new_cat.');" >'.strtolower($category2).'</li>';
			}
		
		 } 
		 //For brand
  		
  		foreach($brand_result as $brand) {
			$brand_name = "'".$brand->company_name."'";
			$created_by = "'".$brand->id."'";
			
		$data['list_data'].='<li class="" data-type="brand" data-created_by ='.$created_by.' onClick="selectbrand('.$created_by.','.$brand_name.');" >'.strtolower($brand->company_name).'</li>';
		}
$data['list_data'].='</ul>'; 

//}

 $data['search_key'] = $_POST["keyword"];
 }
$query2 ="SELECT * FROM reedemer_category WHERE 
cat_name = '" .$_POST["keyword"] . "' && status = 1 ORDER BY cat_name 
LIMIT 0,6";
$result2 = $wpdb->get_results($query2);
foreach($result2 as $category2) {
 $data['subcat_id']= $category2->id; 
 $data['cat_id']= $category2->parent_id;
 $query_match ="SELECT parent_id  FROM reedemer_category WHERE id =".$category2->parent_id;
		$result_match = $wpdb->get_results($query_match);
		$result_match2 =count($result_match);
		if($result222 > 0){
			foreach($result_match as $category_match) {
			$data['sub_sub_parent_id']= $category_match->parent_id;
		
		}	
	}
}
echo json_encode($data)
 ?>
