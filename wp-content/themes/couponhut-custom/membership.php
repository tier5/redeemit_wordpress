<?php 
/*
Template Name: Membership Page
*/
get_header(); 
global $wpdb;
$membership_query = "select * from reedemer_membership limit 0,3";
$results = $wpdb->get_results($membership_query);
?>
<div class="clear"></div> 

       
     <?php if(is_array($results) && count($results)>0): $i = 0;?>
<div class="container">
            <div class="page-content">
                <div class="premium">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Premium Membership</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elitsed ultricies lacus fermentum id</p>
            </div>
        </div>
        <div class="clear"></div>
        <div class="row">
			<?php foreach($results as $res):?> 

        
            <div class="col-md-4 col-sm-4">
                <div class="premium-box">
                    <div class="premium-box-head">
                        <h3><?php echo $res->membership_name;?></h3>
                        <h3>$<?php echo $res->membership_price;?>/month</h3>
                    </div>
                    <div class="premium-box-body">
						<?php if($i == 1):?>
						<div class="evrything">
                            <p>everything in basic plan</p>
                            <p>+</p>
                        </div>
						<?php endif;?>
                        <ul>
                            <li><?php echo $res->features;?></li>
                           
                        </ul>
                        <a href="<?php echo site_url();?>/index.php/payment?mem_id=<?php echo base64_encode($res->id);?>" class="upgrade">Upgrade</a>
                    </div>
                </div>
            </div>
           
       		<?php $i++;endforeach;?>
			
			 </div>
    </div>
</div>

<div class="clear"></div>
            </div>
        </div>
    <?php endif;?>
<!-- Product Grid End -->
<div class="clear"></div>
<?php get_footer(); ?>
