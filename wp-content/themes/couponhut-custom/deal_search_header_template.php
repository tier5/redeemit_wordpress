<?php 
/*Template Name:Deal Search Results
*/
echo $_POST['deal_category'];
?>

<?php



if($_POST['deal_category']!="" || $_POST['deal_location']!="" || $_POST['deals_data']=="alldeals"){
?>

        <div class="col-md-12 search-result">
            <h2>Here are your results 'ALL'</h2>
            <div class="col-md-3 col-sm-3 search-widget-area">
                <?php get_sidebar(); ?>
            </div>
            
            <div class="col-md-9 col-sm-9 search-result-view nopadding">
                <div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="<?php bloginfo('template_directory'); ?>/images/search1.jpg" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">Famiglia’s Famous dinner for 2</div>
                            <div class="product-savings">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">$3 SAVINGS</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="<?php bloginfo('template_directory'); ?>/images/search2.jpg" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">Famiglia’s Famous dinner for 2</div>
                            <div class="product-savings">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">$3 SAVINGS</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>
                <div class="clear">&nbsp</div>
            
            </div>
        </div>
<?php } 

    else { ?>

<div class="col-md-12 search-result">
            <h2>No results 'FOUND'!</h2>
            

<?php }

?>
<div class="clear"></div>