                        <div class="span9">
                            <div class="content">
                                <h3>Add a Sub Section  </h3>
                                <p class="lead"> Add a New Category </p>
                                
                                <hr />

	   
		  
                                  
                                    <?php echo validation_errors(); ?>
                                <form id="form" enctype="multipart/form-data"  method="post">
                                                 
                                                        
                                                        
						    
						    <div class="row-fluid">
							  
                            <div class="span6">
                                <div class="control-group">
                                    <label for="CategoryTitle" class="control-label">Name the Category</label>
                                    <div class="controls">
                                        <input type="text" name="CategoryTitle" id="CategoryTitle" value="<?php echo set_value('CategoryTitle'); ?>" class="span9" required />
                                    </div>
                                </div>
                            </div> 

                            <div class="span6">
								<div class="control-group">
								  <label class="control-label" for="SubSection">Choose Sub Section(s)</label>
								  <div class="controls">
								    <select required  data-placeholder = "Choose one or multiple Sub sections" id="SubSection" name="SubSection[]" class="input-xlarge chosen-select" multiple="multiple">
                                        <option value=""></option>
                                        <?php foreach($subsections->result() as $subsection) :?>
                                            <option <?php echo set_select('SubSection', $subsection->SubSectionID); ?> value="<?php echo $subsection->SubSectionID ?>"><?php echo $subsection->SubSectionTitle  ?> </option>
                                        <?php endforeach; ?>
								    </select>
								  </div>
								</div>
                                                            
                            </div>
							

								</div>
                                                            

							   </div> 
						<div class="row-fluid">

    

                                                        <div class="span12">
                                                            <button formaction = "backend/savecategory?Status=2" class="btn btn-primary">
                                                                Save
                                                            </button> 
                                                        
                                                    <button formaction = "backend/savecategory?Status=1" class="btn btn-primary">
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