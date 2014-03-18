            <?php 

                $product = $products->row();

                if($product->Images)
                    $images = explode("GFIMGSEP", $product->Images);

            ?>


            <!-- Content section -->		
            <section class="main">
                
                <!-- Product content -->
                <section class="product">


                    <!-- Product info -->
                    <section class="product-info">
                        <div class="container">
                            <div class="row">
                                <?php if($product->Images): ?>
                                    <div class="span4">
                                        <div class="product-images">
                                            <div class="box">
                                                <div class="primary">
                                                    <img src="Images/370px-<?php echo $images[0] ?>" data-zoom-image="Images/370px-<?php echo $images[0] ?>" alt="<?php echo $product->ProductTitle ?>" />
                                                </div>

                                                <div class="thumbs" id="gallery">
                                                    <ul class="thumbs-list">
                                                        <?php foreach($images as $key => $image): ?>

                                                            <?php if($key ==0): ?>
                                                                <li>
                                                                    <a class="active" href="#" data-image="Images/370px-<?php echo $image ?>" title="<?php echo $product->ProductTitle ?>" data-zoom-image="Images/370px-<?php echo $image ?>">
                                                                        <img src="Images/<?php echo $image ?>" alt="<?php echo $product->ProductTitle ?>" />
                                                                    </a>
                                                                </li>
                                                            <?php else: ?>
                                                                <li>
                                                                    <a  href="#" data-image="Images/370px-<?php echo $image ?>" title="<?php echo $product->ProductTitle ?>" data-zoom-image="Images/370px-<?php echo $image ?>">
                                                                        <img src="Images/<?php echo $image ?>" alt="<?php echo $product->ProductTitle ?>" />
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
   
                                                    </ul>
                                                </div>

                                                <div class="social">
                                                    <div id="share">
                                                        <div class="facebook"> <i class="fa fa-facebook icon-large"></i> </div>
                                                        <div class="twitter"> <i class="fa fa-twitter icon-large"></i> </div>
                                                        <div class="googleplus"> <i class="fa fa-google-plus icon-large"></i> </div>                                                   
                                                        <div class="pinterest"> <i class="fa fa-pinterest icon-large"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="span8">
                                    
                                    <!-- Product content -->
                                    <div class="product-content">
                                        <div class="box">

                                            <!-- Tab panels' navigation -->
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#product" data-toggle="tab">
                                                        <i class="icon-reorder icon-large"></i>
                                                        <span class="hidden-phone"><?php echo $product->CategoryTitle ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#features" data-toggle="tab">
                                                        <i class="icon-info-sign icon-large"></i>
                                                        <span class="hidden-phone">features</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#specifications" data-toggle="tab">
                                                        <i class="icon-paperclip icon-large"></i>
                                                        <span class="hidden-phone">specifications</span>
                                                    </a>
                                                </li>

                                              <!--  <li>
                                                    <a href="#returns" data-toggle="tab">
                                                        <i class="icon-undo icon-large"></i>
                                                        <span class="hidden-phone">ENGINE</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#ratings" data-toggle="tab">
                                                        <i class="icon-heart icon-large"></i>
                                                        <span class="hidden-phone">Specifications</span>
                                                    </a>
                                                </li>-->
                                            </ul>
                                            <!-- End Tab panels' navigation -->
                                            

                                            <!-- Tab panels container -->
                                            
                                            <div class="tab-content">
                                                
                                                <!-- Product tab -->
                                                <div class="tab-pane active" id="product">
                                                    
                                                        
                                                        <div class="details">
                                                            <h1><?php echo $product->ProductTitle; ?></h1>
                                                            <!--<div class="prices"><span class="price">T110</span></div>-->

                                                            <div class="short-description">
                                                                <p><?php echo $product->Description; ?></p>
                                                            </div>
                                                            <div class="meta">

                                                                <?php if($relatedProducts->num_rows()): ?>
                                                                    <div class="sku">
                                                                        <i class="icon-pencil"></i> OTHER MODELS AVAILABLE<br>

                                                                        <?php foreach($relatedProducts->result() as $relatedProduct): ?>
                                                                            <span rel="tooltip" title="<?php echo $relatedProduct->ProductTitle ?>"><a href = "<?php echo $relatedProduct->URLSafeTitleDashed ?>"><?php echo $relatedProduct->ProductTitle ?></a></span><br>
                                                                        <?php endforeach; ?>

                                    								      <br>
                                    								       <br>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="categories">
                                                                    <span><i class="icon-tags"></i><a href="<?php echo $URL ?>" title=""><?php echo ucwords(strtolower($Title)) ?></a></span>, <a href="<?php echo $URL ?>/<?php echo $product->CatURL ?>" title="Womens"><?php echo $product->CategoryTitle ?></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                       

    						    <div class="add-to-cart">
        <a href="catalogues/<?php echo $product->FileName; ?>" target="_blank"><button class="btn btn-primary btn-large" >
            <i class="icon-plus"></i> &nbsp; download brochure
        </button></a>  <button class="btn btn-pumpkin btn-large" >
            <i class="icon-plus"></i> &nbsp; contact us
        </button>
    </div>
                                                  				
                                                </div>
                                                <!-- End id="product" -->
                                                
                                                <!-- Description tab -->
                                                <div class="tab-pane" id="features">
                                                    <p><span><?php echo $product->Features; ?></span><br /><br />
							    <div class="add-to-cart">
	    <a href="catalogues/<?php echo $product->FileName; ?>" target="_blank"><button class="btn btn-primary btn-large" >
	        <i class="icon-plus"></i> &nbsp; download brochure
	    </button></a>  <button class="btn btn-pumpkin btn-large" >
	        <i class="icon-plus"></i> &nbsp; contact us
	    </button>
	</div>
                                                    </p>						
                                                </div>
                                                <!-- End id="description" -->

                                                <!-- Specification tab -->
                                                <div class="tab-pane" id="specifications">
                                                    <h3><?php echo $product->ProductTitle; ?></h3>

                                                    <?php foreach($products->result() as $specification): ?>
							                             <h6><?php echo $specification->SpecificationTitle ?></h6><p><?php echo $specification->Specification ?></p>
                                                    <?php endforeach; ?>
                                

                                                    <span class="clearfix"></span>
	<div class="add-to-cart">
    <a href="catalogues/<?php echo $product->FileName; ?>" target="_blank"><button class="btn btn-primary btn-large" >
        <i class="icon-plus"></i> &nbsp; download brochure
    </button></a>  <button class="btn btn-pumpkin btn-large" >
        <i class="icon-plus"></i> &nbsp; contact us
    </button>
</div>
                                                </div>
                                                <!-- End id="Specification" -->

                                                
                                            </div>                                            
                                            <!-- End tab panels container -->
                                            
                                        </div>
                                        
                                    </div>                                    
                                    <!-- End class="product-content" -->
                                    
                                </div>


                            </div>
                        </div>
                    </section>
                    <!-- End class="product-info" -->

                   
                    
                   

                </section>
                <!-- End class="product-info" -->
                
            </section>
            <!-- End class="main" -->
            

            
                     