<?php
/* Template Name: Left Sidbar
*/

$main_catagory = "select * from reedemer_category where status = 1 && visibility = 1 && parent_id = 0";
$main_catagory_data = $wpdb->get_results($main_catagory ,ARRAY_A);

$result["status"] = "true";

$result["res_data"] = ""; 

$result["res_data"] .= "<h3>Category</h3>";
	if($_GET['cat_id'] != '') { 
$result["res_data"] .= '<ul id="cat_data" curr_cat_id="'.$_GET['cat_id'].'" curr_sub_cat_id="-">';
	}else {  
$result["res_data"] .= '<ul id="cat_data" curr_cat_id="-" curr_sub_cat_id="-">';
	} 
	if(count($main_catagory_data) > 0)
      { foreach ($main_catagory_data as $value1) {
			if($_GET['cat_id'] != '' && $_GET['cat_id'] == $value1['id']) {
              $result["res_data"] .= "<li >  <a href='#' class='catagory_section cat' cat_id=".$value1['id']." >".$value1['cat_name']."(".$value1[1].")</a>";
                         
                         if(count($value1[0]) > 0)
                         {  
                            $p = 0;
                            $result["res_data"] .= "<ul class='subcat-dropdown openSubcat'>";
                            foreach ($value1[0] as $sub_cat)
                            {
                                $result["res_data"] .= "<li >  <a href='#' class='catagory_section sub_cat' cat_id=".$value1['id']."  sub_cat_id=".$sub_cat['id']." >".$sub_cat['cat_name']."(".$sub_cat[0][0]['count'].")</a>"; 
                                $p + $sub_cat[0][0]['count'];
                            }
                            $result["res_data"] .= "</ul>";

                         }
                         $result["res_data"] .= "</li>";  
						}else{
							$result["res_data"] .= "<li >  <a href='#' class='catagory_section cat' cat_id=".$value1['id']." >".$value1['cat_name']."(".$value1[1].")</a>";
                         
                         if(count($value1[0]) > 0)
                         {  
                            $p = 0;
                            $result["res_data"] .= "<ul class='subcat-dropdown'>";
                            foreach ($value1[0] as $sub_cat)
                            {
                                $result["res_data"] .= "<li >  <a href='#' class='catagory_section sub_cat' cat_id=".$value1['id']."  sub_cat_id=".$sub_cat['id']." >".$sub_cat['cat_name']."(".$sub_cat[0][0]['count'].")</a>"; 
                                $p + $sub_cat[0][0]['count'];
                            }
                            $result["res_data"] .= "</ul>";

                         }
                         $result["res_data"] .= "</li>"; 
						}
                    }

                        } 
                    $result["res_data"] .= "</ul>";


echo json_encode($result);
?>


