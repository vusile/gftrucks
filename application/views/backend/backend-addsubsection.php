                        <div class="span9">
                            <div class="content">
                                <h3>Add a Sub Section  </h3>
                                <p class="lead"> Add a New Subsection </p>
                                
                                <hr />

	   
		  
                                  
                                    <?php echo validation_errors(); ?>
                                <form id="form" enctype="multipart/form-data"  method="post">
                                                 
                                                        
                                                        
						    
						    <div class="row-fluid">
							  
                            <div class="span6">
                                <div class="control-group">
                                    <label for="SubSectionTitle" class="control-label">Name the Sub Section</label>
                                    <div class="controls">
                                        <input type="text" name="SubSectionTitle" id="SubSectionTitle" value="<?php echo set_value('SubSectionTitle'); ?>" class="span9" required />
                                    </div>
                                </div>
                            </div> 

                            <div class="span6">
								<div class="control-group">
								  <label class="control-label" for="Section">Choose a Section</label>
								  <div class="controls">
								    <select required  data-placeholder = "Choose one or multiple sections" id="Section" name="Section[]" class="input-xlarge chosen-select" multiple="multiple">
                                        <option value=""></option>
                                        <?php foreach($sections->result() as $section) :?>
                                            <option <?php echo set_select('Section', $section->SectionID); ?> value="<?php echo $section->SectionID ?>"><?php echo $section->SectionTitle  ?> </option>
                                        <?php endforeach; ?>
								    </select>
								  </div>
								</div>
                                                            
                            </div>
							

								</div>
                                                            

							   </div> 
						<div class="row-fluid">

    

                                                        <div class="span12">
                                                            <button formaction = "backend/savesubsection?Status=2" class="btn btn-primary">
                                                                Save
                                                            </button> 
                                                        
                                                    <button formaction = "backend/savesubsection?Status=1" class="btn btn-primary">
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