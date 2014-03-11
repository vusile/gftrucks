                        <div class="span9">
                            <div class="content">
                                <h3>Edit a Category  </h3>
                                <p class="lead"> Edit the  "<?php echo $category->row()->CategoryTitle ?>" Category</p>
                                
                                <hr />

	   
		  
                                  
                                    <?php echo validation_errors(); ?>
                                <form id="form" enctype="multipart/form-data"  method="post">
                                                 
                                                        
                                                        
						    
						    <div class="row-fluid">
							  
                            <div class="span6">
                                <div class="control-group">
                                    <label for="CategoryTitle" class="control-label">Name the Category</label>
                                    <div class="controls">
                                        <input type="text" name="CategoryTitle" id="CategoryTitle" value="<?php if(isset($category)) echo $category->row()->CategoryTitle; else echo set_value('CategoryTitle'); ?>" class="span9" required />
                                    </div>
                                </div>
                            </div> 

                            <div class="span6">
								<div class="control-group">
								  <label class="control-label" for="SubSection">Choose a Sub Section</label>
								  <div class="controls">
								    <select required  data-placeholder = "Choose one or multiple sections" id="SubSection" name="SubSection[]" class="input-xlarge chosen-select" multiple="multiple">
                                        <option value=""></option>
                                        <?php foreach($subsections->result() as $subsection) :?>
                                            <?php if(in_array($subsection->SubSectionID, $subsections_categories)): ?>
                                                <option selected="selected" <?php echo set_select('SubSection', $subsection->SubSectionID); ?> value="<?php echo $subsection->SubSectionID ?>"><?php echo $subsection->SubSectionTitle  ?> </option>
                                            <?php else: ?>
                                                <option <?php echo set_select('SubSection', $subsection->SubSectionID); ?> value="<?php echo $subsection->SubSectionID ?>"><?php echo $subsection->SubSectionTitle  ?> </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
								    </select>
								  </div>
								</div>
                                                            
                            </div>
							

								</div>
                                                            

							   </div> 
						<div class="row-fluid">

    

                                                        <div class="span12">
                                                            <button formaction = "backend/updatecategory?Status=2&CategoryID=<?php echo $category->row()->CategoryID ?>" class="btn btn-primary">
                                                                Save
                                                            </button> 
                                                        
                                                    <button formaction = "backend/updatecategory?Status=1&CategoryID=<?php echo $category->row()->CategoryID ?>" class="btn btn-primary">
                                                        Save & Publish
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

<script type="text/javascript">
    $("#form").validate({ignore: []});

</script>