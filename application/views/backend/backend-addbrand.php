<div class="span9">
                    <div class="content">
                        <h3>Create a Brand</h3>
                        
                        <hr />
                        <?php echo validation_errors(); ?>
                        <?php if(isset($error)): ?>
                            <?php echo $error; ?>
                        <?php endif; ?>
                        <form id="form" enctype="multipart/form-data"  method="post">
                         
                            <div class="row-fluid">
                                

                                <div class="span6">
                                        <div class="control-group">
                                            <label for="BrandTitle" class="control-label">Name of the brand</label>
                                            <div class="controls">
                                                <input required type="text" name="BrandTitle" id="BrandTitle" value="<?php echo set_value('BrandTitle'); ?>" class="span12" />
                                            </div>
                                        </div>
                                    <div class="control-group">
                                        <label for="BrandTagLine" class="control-label">Tag line</label>
                                        <div class="controls">
                                            <textarea required name="BrandTagLine" id="BrandTagLine" class="span12"><?php echo set_value('BrandTagLine'); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                     

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="control-group">
                                        <label for="BrandDescription" class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea required name="BrandDescription" id="BrandDescription" class="span12"><?php echo set_value('BrandDescription'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="control-group">
                                        <label for="Featured" class="control-label">Featured</label>
                                        <div class="controls">
                                            <input required type="radio" name="Featured" value="1" <?php echo set_radio('Featured', '1'); ?> > Yes&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="Featured" value="2" <?php echo set_radio('Featured', '2'); ?> > No
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        <div class="row-fluid">
					    <legend>Brand Logo</legend> 
                        <div class="span6">
						<div class="control-group">
						  <label class="control-label" for="BrandLogo">Upload Image</label>
						  <div class="controls">
						    <input required id="BrandLogo" name="BrandLogo" class="input-file" type="file">
						  </div>
						</div>
                                                   
					</div>
						
                </div>

   </div> 
						   
                                               
						
						
					<div class="row-fluid">
                                <div class="span12">
                                    <button formaction = "backend/savebrand?Status=2" class="btn btn-primary">
		    Save
                                    </button>
                                    <button formaction = "backend/savebrand?Status=1" class="btn btn-primary">
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