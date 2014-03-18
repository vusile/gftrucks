<div class="span9">
                                            <div class="content">
                                                <h3>Create a Product</h3>
                                                
                                                <hr />

                                                <form id="form" enctype="multipart/form-data" action="backend/updateproduct?ProductID=<?php echo $product->ProductID ?>" method="post">
                                                 
                                                        <div class="row-fluid">
                                                        

                                                            <div class="span6">
    								<div class="control-group">
    								  <label class="control-label" for="CategoryID"><i class="fa fa-asterisk"></i> Choose the Category</label>
    								  <div class="controls">
    								    <select required id="CategoryID" name="CategoryID" class="input-xlarge">
    								      <option value="">Select Category</option>

    								      <?php foreach($categories->result() as $category): ?>
    								      	<?php if($product->CategoryID == $category->CategoryID): ?>
    								      		<option  selected value=<?php echo $category->CategoryID ?>><?php echo $category->CategoryTitle ?></option>
    								      	<?php else: ?>
    								      		<option value=<?php echo $category->CategoryID ?>><?php echo $category->CategoryTitle ?></option>
    								      	<?php endif; ?>
    								      <?php endforeach; ?>
    								      
    								    </select>
    								  </div>
    								</div>
                                                            </div>
							
                                                            <div class="span6">
    								<div class="control-group">
    								  <label class="control-label" for="BrandID"> <i class="fa fa-asterisk"></i> Choose the Brand</label>
    								  <div class="controls">
    								    <select required id="BrandID" name="BrandID" class="input-xlarge">
    								      <option value="">Select Brand</option>

    								      <?php foreach($brands->result() as $brand): ?>
    								      	<?php if($product->BrandID == $brand->BrandID): ?>
    								      		<option selected value=<?php echo $brand->BrandID ?>><?php echo $brand->BrandTitle ?></option>
    								      	<?php else: ?>
    								      		<option value=<?php echo $brand->BrandID ?>><?php echo $brand->BrandTitle ?></option>
    								      	<?php endif; ?>
    								      <?php endforeach; ?>
    								    </select>
    								  </div>
    								</div>
                                                            
                                                            </div>
                                                        </div>
                                                    
						    <div class="row-fluid">
                                                        

                                                        <div class="span12">
                                                                <div class="control-group">
                                                                    <label for="ProductTitle" class="control-label"> <i class="fa fa-asterisk"></i> Title of the product</label>
                                                                    <div class="controls">
                                                                        <input required type="text" name="ProductTitle" id="ProductTitle" value="<?php echo $product->ProductTitle ?>" class="span12" />
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="Features" class="control-label"><i class="fa fa-asterisk"></i> Features</label>
                                                                    <div class="controls">
                                                                        <textarea required name="Features" id="Features" class="span12"><?php echo $product->Features ?></textarea>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                            
                                                   </div>
                                                  
                                                    
                                             

                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="control-group">
                                                                <label for="Description" class="control-label"><i class="fa fa-asterisk"></i> Description</label>
                                                                <div class="controls">
                                                                    <textarea required name="Description" id="Description" class="span12"><?php echo $product->Description ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="control-group">
                                                                <label for="Featured" class="control-label"><i class="fa fa-asterisk"></i> Featured</label>
                                                                <div class="controls">
                                                                <?php if($product->Featured == 2): ?>
                                                                    <input type="radio" name = "Featured" id = "Featured1" value="1"> Yes
                                                                    <input checked type="radio" name = "Featured" id = "Featured2" value="2"> No
                                                                <?php else: ?>
                                                                    <input checked type="radio" name = "Featured" id = "Featured1" value="1"> Yes
                                                                    <input type="radio" name = "Featured" id = "Featured2" value="2"> No
                                                                <?php endif; ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                          		   
                                                            
	                                                    <div class="row-fluid">

	                                                    <?php $flag = 0; ?>
	                                                    <?php $counter = 0; ?>

	                                                    <?php foreach($specifications->result() as $specification): ?>


	                                                        <div class="span6">
	                                                            <div class="control-group">
	                                                                <label for="Specification<?php echo $specification->SpecificationID ?>" class="control-label"><?php echo $specification->SpecificationTitle ?></label>
	                                                                <div class="controls">

	                                                                	<?php if(count($productspecificationsarray)): ?>
	                                                                		<?php if(isset($productspecificationsarray[$specification->SpecificationID])): ?>
	                                                                    		<input type="text" name="Specification<?php echo $specification->SpecificationID ?>" id="Specification<?php echo $specification->SpecificationID ?>" value="<?php echo $productspecificationsarray[$specification->SpecificationID]; ?>" class="span6" />
	                                                                    	<?php else: ?>
	                                                                    		<input type="text" name="Specification<?php echo $specification->SpecificationID ?>" id="Specification<?php echo $specification->SpecificationID ?>" value="" class="span6" />
	                                                                    	<?php endif; ?>
	                                                                    <?php else: ?>
	                                                                    	<input type="text" name="Specification<?php echo $specification->SpecificationID ?>" id="Specification<?php echo $specification->SpecificationID ?>" value="" class="span6" />
	                                                                	<?php endif; ?>
	                                                                </div>
	                                                            </div>
	                                                        </div>


	                                                        <?php if($flag==1 or $counter == $specifications->num_rows()): ?>
	                                                    		<?php $flag = 0; ?>
	                                                    		</div><div class="row-fluid">

	                                                        <?php else: ?>
	                                                        	<?php $flag++; ?>
	                                                        <?php endif; ?>

	                                                        <?php $counter++; ?>


	                                                  	<?php endforeach; ?>
	                                                    
							    
	             
							    

							    

							    
	                                                    <div class="row-fluid">
								     
	                                                       

	                                                        <div class="span6">
	                                                            <div class="control-group">
	                                                                Add Another Spec
	                                                                <div class="controls"><i class="fa fa-plus"></i>
	                                                                   </div>
	                                                            </div>
	                                                        </div>
	
							   				</div> 
							   
							   
                                                    <div class="row-fluid">
							    <legend>Image Gallery - size 300x300</legend>

							<?php if(count($productimages->num_rows() > 0)): ?>
								<?php foreach($productimages->result() as $productimage): ?>
									<?php $productimagesarray[$productimage->OrderNum] = $productimage->ImageName; ?>
								<?php endforeach; ?>
							<?php endif; ?>


                            <div class="span6">
								<div class="control-group">
								  <label class="control-label" for="Image1"><i class="fa fa-asterisk"></i> Main Image </label>
								  <div class="controls">
								  	<?php if(isset($productimagesarray[1])): ?>Current Image: <img src = "Images/<?php echo $productimagesarray[1] ?>" width="100" height="100"></a><?php endif; ?>
								  	<input type="checkbox" value="1" name="DeleteImage1"> Delete This Image
								    <input  id="Image1" name="Image1" class="input-file" type="file">
								  </div>
								</div>
                                                           
                                                        
								<div class="control-group">
								  <label class="control-label" for="Image2"><i class="fa fa-asterisk"></i> On Rollover Image </label>
								  <div class="controls">
								  <?php if(isset($productimagesarray[2])): ?>Current Image: <img src = "Images/<?php echo $productimagesarray[2] ?>" width="100" height="100"></a><?php endif; ?>
								  <input type="checkbox" value="1" name="DeleteImage2"> Delete This Image
								    <input id="Image2" name="Image2" class="input-file" type="file">
								  </div>
								</div>
							</div>
								<div class="row-fluid">
									<div class="span6">
									<div class="control-group">
									  <label class="control-label" for="Image3">Another Image</label>
									  <div class="controls">
									  <?php if(isset($productimagesarray[3])): ?>Current Image: <img src = "Images/<?php echo $productimagesarray[3] ?>" width="100" height="100"></a><?php endif; ?>
								  		<input type="checkbox" value="1" name="DeleteImage3"> Delete This Image
									    <input id="Image3" name="Image3" class="input-file" type="file">
									  </div>
									</div>
									<div class="control-group">
									  <label class="control-label" for="Image4">Another Image</label>
									  <div class="controls">
									  <?php if(isset($productimagesarray[4])): ?>Current Image: <img src = "Images/<?php echo $productimagesarray[4] ?>" width="100" height="100"></a><?php endif; ?>
								  		<input type="checkbox" value="1" name="DeleteImage4"> Delete This Image
									    <input id="Image4" name="Image4" class="input-file" type="file">
									  </div>
									</div>
									<div class="control-group">
									  <label class="control-label" for="Image5">Another Image</label>
									  <div class="controls">
									  <?php if(isset($productimagesarray[5])): ?>Current Image: <img src = "Images/<?php echo $productimagesarray[5] ?>" width="100" height="100"></a><?php endif; ?>
								  		<input type="checkbox" value="1" name="DeleteImage5"> Delete This Image
									    <input id="Image5" name="Image5" class="input-file" type="file">
									  </div>
									</div>
							  
							</div>
									
	                    </div>

						   </div> 
						   
                                                   <div class="row-fluid">
						    <legend>Catalogue for this product</legend> 
                                                    <div class="span6">
							<div class="control-group">
							  <label class="control-label" for="CatalogueID">Choose a Catalogue</label>
							  <div class="controls">
							    <select id="CatalogueID" name="CatalogueID" class="input-xlarge">
								      <option value="">Select Catalogue</option>

							      <?php foreach($catalogues->result() as $catalogue): ?>
							      	<?php if($product->CatalogueID == $catalogue->CatalogueID): ?>
							      		<option selected value=<?php echo $catalogue->CatalogueID ?>><?php echo $catalogue->CatalogueTitle ?></option>
							      	<?php else: ?>
							      		<option value=<?php echo $catalogue->CatalogueID ?>><?php echo $catalogue->CatalogueTitle ?></option>
							      	<?php endif; ?>
							      <?php endforeach; ?>
							    </select>
							  </div>
							</div>
                                                       
                                                          
                                                       
						</div>
                                                <div class="row-fluid">
						   
                                                        <div class="span6">
 							<div class="control-group">
 							  <label class="control-label" for="NewCatalogue">Upload a new catalogue</label>
 							  <div class="controls">
 							    <input id="NewCatalogue" name="NewCatalogue" class="input-file" type="file">
 							  </div>
 							</div>
 							<div class="control-group">
 							  <label class="control-label" for="NewCatalogueName">Name the Catalogue</label>
 							  <div class="controls">
 							    <input type="text" name="NewCatalogueName" id="NewCatalogueName" value="" class="span6" />
 							  </div>
 							</div>
 							</div>
                                                   
						</div>
						
						
						<div class="row-fluid">
                                                        <div class="span12">
                                                            <button class="btn btn-primary">
                                                                Next
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>							
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

        <script type="text/javascript">
    $("#form").validate({ignore: []});

</script>