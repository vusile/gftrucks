<div class="span9">
                                            <div class="content">
                                                <h3>Manage Products</h3>
                                                
                                                <hr />

                                              
                                                  <div class="row-fluid">
							  <div class="span6"><a href="backend/products/add"><i class="fa fa-plus"></i> add a product </a></div><div class="span3 pull-right"><i class="fa fa-download"></i> export <i class="fa fa-print"></i> print</div></div>
                                                    <div class="row-fluid">
							    <div class="span12">
							    <table border="1" cellspacing="2" cellpadding="2" width="100%">

							    	<tr>
							    	<th>Id</th>
									<th>Featured</th>
									<th>Title</th>
									<th>Category</th>
									
									<th>Section(s)</th>
									<th>Sub Section(s)</th>
									
									<th>Status</th>
									<th>Manage</th>
									</tr>
							    <?php foreach($products->result() as $product): ?>
							    	<tr>
									<td><?php echo $product->ProductID ?></td>
							    	    	<td> 

										<?php if($product->Featured == 1): ?>
						    	    	<label class="checkbox" for="Featured<?php echo $product->ProductID ?>">
      										<input checked="checked" type="checkbox" name="Featured<?php echo $product->ProductID ?>" id="Featured<?php echo $product->ProductID ?>" value="1">
     
    										</label>
										<?php else: ?>
						    	    	<label class="checkbox" for="Featured<?php echo $product->ProductID ?>">
      										<input type="checkbox" name="Featured<?php echo $product->ProductID ?>" id="Featured<?php echo $product->ProductID ?>" value="1">
     
    										</label>
										<?php endif; ?>


    										</td>
									<td><?php echo $product->ProductTitle ?></td>
									<td><?php echo $product->CategoryTitle ?></td>
									<td><?php echo $product->ParentSections ?></td>
									<td><?php echo $product->SubSections ?></td>
									
									
									<td>
										<?php if($product->ProductStatus == 1): ?>
											Online
										<?php else: ?>
											Offline
										<?php endif; ?>
									</td>
									<td>
										<a href="backend/products/edit?ProductID=<?php echo $product->ProductID ?>"><button class="btn btn-primary btn-mini ">
									edit
                                                            			</button> </a>
							    			
                                                            		  <a href="backend/products/edit?ProductID=<?php echo $product->ProductID ?>">  <button class="btn btn-primary btn-mini">
                                                                delete
                                                            			</button></a>
							    	    	</td>
							    	    	</tr>
							   	<?php endforeach; ?>
		

							    </table>
                                                            
						    </div> 
                                                    </div>

                                           						
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>


                </section>    
                <!-- End Static page 1 -->
                
            </section>
            <!-- End class="main" -->
            
            
            

   
</div>
<!-- End class="options-panel" -->
            
         
        </div>