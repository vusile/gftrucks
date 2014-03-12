<div class="span9">
                    <div class="content">
                        <h3>Add a Catalogue</h3>
                        
                        <hr />
                        <?php echo validation_errors(); ?>
                        <?php if(isset($error)): ?>
                            <?php echo $error; ?>
                        <?php endif; ?>
                        <form id="form" enctype="multipart/form-data"  method="post">
                         
                            <div class="row-fluid">
                                

                                <div class="span6">
                                        <div class="control-group">
                                            <label for="CatalogueTitle" class="control-label">Name of the catalogue</label>
                                            <div class="controls">
                                                <input required type="text" name="CatalogueTitle" id="CatalogueTitle" value="<?php echo set_value('CatalogueTitle'); ?>" class="span12" />
                                            </div>
                                        </div>

                                </div>

                            </div>

                     



                            
                        <div class="row-fluid">
					    <legend>Catalogue</legend> 
                        <div class="span6">
						<div class="control-group">
						  <label class="control-label" for="Catalogue">Upload Catalogue</label>
						  <div class="controls">
						    <input required id="Catalogue" name="Catalogue" class="input-file" type="file">
						  </div>
						</div>
                                                   
					</div>
						
                </div>

   </div> 
						   
                                               
						
						
					<div class="row-fluid">
                                <div class="span12">
                                    <button formaction = "backend/savecatalogue?Status=2" class="btn btn-primary">
		    Save
                                    </button>
                                    <button formaction = "backend/savecatalogue?Status=1" class="btn btn-primary">
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