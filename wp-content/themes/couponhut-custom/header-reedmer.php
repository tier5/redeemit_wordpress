 <header>
        <div class="header-top">
             <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo-new.png" alt="redeemar" title="redeemar"></a></div>
                        <div class="top-right-menu">
                        <?php
                if ( is_user_logged_in() ) {
                     $user_data = get_user_by("id",get_current_user_id());
                 $get_user_dtl = "SELECT * from  users  where email ='".$user_data->user_login."'";
                  $get_user_dtl1=$wpdb->get_results($get_user_dtl,ARRAY_A);
                 if( !empty($get_user_dtl1[0]['first_name']))
                 {
                    $usr = $get_user_dtl1[0]['first_name'];
                 }else
                 {
                    $usr = $user_data->user_login;
                 }
                   ?>
                    <ul>
                          
                                <li class="username-link"><a href="#">Welcome, <span id="disp_name"><?php echo  $usr; ?> </span><i class="fa fa-caret-up arrow-up" aria-hidden="true"></i><i class="fa fa-caret-down arrow-down" aria-hidden="true"></i></a>
                                    <ul class="user-details-link">
                                        <li><a href="<?php echo home_url(); ?>/index.php/my-deals/#tabs-1" id="tab_one_btn">My deals</a></li>
                                        <li><a href="<?php echo home_url(); ?>/index.php/my-deals/#tabs-2" id="tab_two_btn" >My profile</a></li>
                                        <li><a href="<?php echo home_url(); ?>/index.php/logout/">sign out</a></li>
                                    </ul>
                                </li>
                </ul>
                   <?php
                } else {
                    ?>
                            <ul>
                               <?php wp_nav_menu(array('theme_location'=>'top-menu'));  ?>
                            </ul>    
                    <?php   
                    }
                    ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-search">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <input class="search-txt" id="deal_cat" type="text" placeholder="How can we help you"/>
                        <input type="hidden" id="deal_catid"/>
                        <input type="hidden" id="deal_subcatid"/>
                        
                        
                        <div id="suggesstion-box-cat"></div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <input class="location" id="deal_loc" type="text" placeholder="Location"/>
                        <input type="hidden" id="deal_created"/>
                        
                        <div id="suggesstion-box-loc"></div>
                        <button class="search-btn-new" name="search_deal_btn" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>

                    </div>
                </div>    
            </div>
        </div>
        <div class="main-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="header_lt">
                       <div class="click">Menu</div>
                    </div>                
                    <div class="main_nav_deals main_nav">
                    <ul>
                        <?php wp_nav_menu(array('theme_location'=>'main-primary-menu'));  ?>
                    </ul>                                                
                    </div>
                </div>
            </div>
        </div>
    </header>