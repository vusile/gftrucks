<div class="span9">
                                            <div class="content">
                                                <h3>Create a Product</h3>
                                                
                                                <hr />

                                                <form id="form" enctype="multipart/form-data" action="backend/saveproduct" method="post">
                                                 
                                                        <div class="row-fluid">
                                                        

                                                            <div class="span6">
    								<div class="control-group">
    								  <label class="control-label" for="CategoryID"><i class="fa fa-asterisk"></i> Choose the Category</label>
    								  <div class="controls">
    								    <select required id="CategoryID" name="CategoryID" class="input-xlarge">
    								      <option value="">Select Category</option>

    								      <?php foreach($categories->result() as $category): ?>
    								      	<option value=<?php echo $category->CategoryID ?>><?php echo $category->CategoryTitle ?></option>
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
    								      	<option value=<?php echo $brand->BrandID ?>><?php echo $brand->BrandTitle ?></option>
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
                                                                        <input required type="text" name="ProductTitle" id="ProductTitle" value="" class="span12" />
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="Features" class="control-label"><i class="fa fa-asterisk"></i> Features</label>
                                                                    <div class="controls">
                                                                        <textarea required name="Features" id="Features" class="span12"></textarea>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                            
                                                   </div>
                                                  
                                                    
                                             

                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="control-group">
                                                                <label for="Description" class="control-label"><i class="fa fa-asterisk"></i> Description</label>
                                                                <div class="controls">
                                                                    <textarea required name="Description" id="Description" class="span12"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="control-group">
                                                                <label for="Featured" class="control-label"><i class="fa fa-asterisk"></i> Featured</label>
                                                                <div class="controls">
                                                                    <input type="radio" name = "Featured" id = "Featured1" value="1"> Yes
                                                                    <input checked type="radio" name = "Featured" id = "Featured2" value="2"> No
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
	                                                                    <input type="text" name="Specification<?php echo $specification->SpecificationID ?>" id="Specification<?php echo $specification->SpecificationID ?>" value="" class="span6" />
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
                                                        <div class="span6">
								<div class="control-group">
								  <label class="control-label" for="Image1"><i class="fa fa-asterisk"></i> Main Image </label>
								  <div class="controls">
								    <input required id="Image1" name="Image1" class="input-file" type="file">
								  </div>
								</div>
                                                           
                                                        
								<div class="control-group">
								  <label class="control-label" for="Image2"><i class="fa fa-asterisk"></i> On Rollover Image </label>
								  <div class="controls">
								    <input id="Image2" name="Image2" class="input-file" type="file">
								  </div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span6">
								<div class="control-group">
								  <label class="control-label" for="Image3">Another Image</label>
								  <div class="controls">
								    <input id="Image3" name="Image3" class="input-file" type="file">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="Image4">Another Image</label>
								  <div class="controls">
								    <input id="Image4" name="Image4" class="input-file" type="file">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="Image5">Another Image</label>
								  <div class="controls">
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
							      	<option value=<?php echo $catalogue->CatalogueID ?>><?php echo $catalogue->CatalogueTitle ?></option>
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