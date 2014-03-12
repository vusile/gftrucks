<div class="span9">
                    <div class="content">
                        <h3>Edit a Brand</h3>
                        <p class="lead"> Edit the  "<?php echo $catalogue->row()->CatalogueTitle ?>" Catalogue</p>
                        
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
                                            <input required type="text" name="CatalogueTitle" id="CatalogueTitle" value="<?php if(isset($catalogue)) echo $catalogue->row()->CatalogueTitle; else echo set_value('CatalogueTitle'); ?>" class="span12" />
                                        </div>
                                    </div>
 
                                </div>

                            </div>
  
                        <div class="row-fluid">
					    <legend>Catalogue</legend> 
                        <div class="span6">
						<div class="control-group">
						  <label class="control-label" for="Catalogue">Change Catalogue</label>
						  <div class="controls">
                            <?php if($catalogue->row()->FileName): ?>
                              <a target="_blank" href = "catalogues/<?php echo $catalogue->row()->FileName ?>" >View Catalogue</a><br>
                              <input  id="Catalogue" name="Catalogue" class="input-file" type="file">
                            <?php else: ?>
						      <input required id="Catalogue" name="Catalogue" class="input-file" type="file">
                            <?php endif; ?>
						  </div>
						</div>
                                                   
					</div>
						
                </div>

   </div> 
						   
                                               
						
						
					<div class="row-fluid">
                                <div class="span12">
                                    <button formaction = "backend/updatecatalogue?Status=2&CatalogueID=<?php echo $catalogue->row()->CatalogueID ?>" class="btn btn-primary">
		    Save
                                    </button>
                                    <button formaction = "backend/updatecatalogue?Status=1&CatalogueID=<?php echo $catalogue->row()->CatalogueID ?>" class="btn btn-primary">
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