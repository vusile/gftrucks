		
            <section class="main">
                
                <!-- Category content -->
                <section class="category">

                    <div class="container">
                        <div class="row">

                            <div class="span3">
                                
                                <!-- Sidebar -->
                                <aside class="sidebar">

                                    <div class="children">
                                        <div class="box border-top">

                                            <div class="hgroup title">
                                                <h3>
                                                    <a href="<?php echo $URL ?>" title="Womens"><?php echo strtoupper($Title) ?></a>
                                                </h3>
                                            </div>

                                            <ul class="category-list secondary">
                                                <li >
                                                    <a href="GFproducts.html" title="Wheel Loaders">
                                                        <span class="count">4</span>
                                                        Wheel Loaders				
                                                    </a>
                                                </li>
                                                <li >
                                                    <a href="GFproducts.html" title="Motor Grades">
                                                        <span class="count">8</span>
                                                        Motor Graders		
                                                    </a>
                                                </li>
                                                <li >
                                                    <a href="GFproducts.html" title="Concrete Mixer">
                                                        <span class="count">2</span>
                                                        Concrete Mixer				
                                                    </a>
                                                </li>
                                                <li >
                                                    <a href="GFproducts.html" title="Road Construction Rollers">
                                                        <span class="count">3</span>
                                                        Road Construction Rollers			
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </div>

                                  
                                    <!-- Latest reviews -->
                                    <div class="widget LatestProductReviews">
                                        <h3 class="widget-title widget-title ">We are Sole Authorized Distributors in Tanzania</h3>
                                        <ul class="ratings-small">
                                            <?php foreach($brands->result() as $brand): ?>
                                                <li>
                                                    <div class="image">
                                                       
                                                            <img class="gravatar" src="img/<?php echo $brand->BrandLogo ?>" alt="<?php echo $brand->BrandTitle ?>" />
                                                       
                                                    </div>

                                                    <div class="desc">
                                                        <h6><?php echo $brand->BrandTitle ?></h6>
                                                        
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                           
                                        </ul>
                                    </div>
                                    <!-- end class="widget LatestProductReviews" -->
                                    
                                   
                                    <!-- End class="widget LatestProducts" -->
                                    
                                    <!-- Adverts -->
                                   
                                    
                                 								
                                    
                                    <!-- This month only! widget -->
<div class="widget Text">
    <h3 class="widget-title widget-title ">After Sale Service</h3>
    <h5>Our Customer care provide you assistance for any inquiries.</h5>
    

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque beatae tempore porro officiis!</p>
    <a class="btn btn-primary" href="#">
        Find out more 
    </a>
</div>
<!-- End class="widget Text" -->									
                                    
                                </aside>
                                
                                <!-- End sidebar -->
                                
                            </div>

                            
                            <div class="span9">
				    
				     <div class="span7"><h1><?php echo strtoupper($Title) ?></h1></div>

                                <!-- Products list -->
                        <ul class="product-list isotope">
                            <?php foreach($products->result() as $product): ?>

                                <?php $images = explode("GFIMGSEP", $product->Images); ?>
                                <li class="standard" data-price="58">
                                    <a href="<?php echo $product->URLSafeTitleDashed ?>" title="<?php echo $product->ProductTitle ?>">

                                        <?php if(count($images) > 0): ?>
                                            <div class="image">
                                                <img class="primary" src="Images/<?php echo $images[0] ?>" alt="<?php echo $product->ProductTitle ?>" />
                                                <?php if(isset($images[1])): ?>
                                                    <img class="secondary" src="Images/<?php echo $images[1] ?>" alt="<?php echo $product->ProductTitle ?>" />
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="title">
                                            <div class="prices">
                                                <span class="price"><?php echo $product->BrandTitle ?> </span>
                                            </div>
                                            <h3><?php echo $product->ProductTitle ?></h3>
                                        </div>

                                    </a>
                                </li>
                            <?php endforeach; ?>
                            
                        </ul>
<!-- End class="product-list isotope" -->                
                                
                                <!-- "Load More" Button 

                                <button id="load_more" class="btn btn-block" data-category="16" data-rows="20" data-page="1" data-featured="true">
                                    <span>Load more</span> &nbsp; <i class="icon-spinner icon-spin icon-large"></i>
                                </button>
                                
                             End "Load More" Button -->

                            </div>
                            

                        </div>
                    </div>

                </section>

	
                <!-- End class="category" -->
                
            </section>
            <!-- End class="main" -->

            
            
