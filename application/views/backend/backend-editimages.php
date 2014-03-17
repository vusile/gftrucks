    <script type="text/javascript" src="js/jquery-pack.js"></script>
    <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>

    <script type="text/javascript">

<?php foreach($images->result() as $image): ?>

function preview<?php echo $image->ProductImageID ?>(img, selection) { 
    var scaleX = 270 / selection.width; 
    var scaleY = 270 / selection.height; 


    <?php $ImageSize = getimagesize('Images/' . $image->ImageName ); ?>

    
    $('#<?php echo $image->ProductImageID ?>thumbnail + div > img').css({ 
        width: Math.round(scaleX * <?php echo $ImageSize[0]; ?>) + 'px', 
        height: Math.round(scaleY * <?php echo $ImageSize[1]; ?>) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
    });

    
    $('#<?php echo $image->ProductImageID ?>x1').val(selection.x1);
    $('#<?php echo $image->ProductImageID ?>y1').val(selection.y1);
    $('#<?php echo $image->ProductImageID ?>x2').val(selection.x2);
    $('#<?php echo $image->ProductImageID ?>y2').val(selection.y2);
    $('#<?php echo $image->ProductImageID ?>w').val(selection.width);
    $('#<?php echo $image->ProductImageID ?>h').val(selection.height);
} 
<?php endforeach; ?>

$(document).ready(function () { 
    $('#save_thumb').click(function() {
        var x1 = $('#x1').val();
        var y1 = $('#y1').val();
        var x2 = $('#x2').val();
        var y2 = $('#y2').val();
        var w = $('#w').val();
        var h = $('#h').val();
        if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
            alert("You must make a selection first");
            return false;
        }else{
            return true;
        }
    });
}); 

$(window).load(function () { 

    <?php foreach($images->result() as $image): ?>
     $('#<?php echo $image->ProductImageID ?>thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview<?php echo $image->ProductImageID ?> }); 
    <?php endforeach; ?>
});

</script>
                        <div class="span9">
                            <div class="content">
                                <h3>Edit Images  </h3>
                                
                                
                                <hr />

	   
		  
                                  
                                
                                                 
                                                        
                        <form name="thumbnail" action="backend/generateNewImage" method="post">
                            <?php foreach($images->result() as $image): ?>

                                <div align="center">
                                    <img src="Images/<?php echo $image->ImageName ?>" style="float: left; margin-right: 10px;" id="<?php echo $image->ProductImageID ?>thumbnail" alt="Create Thumbnail" />

                                    <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:270px; height:270px;">
                                        <img src="Images/<?php echo $image->ImageName ?>" style="position: relative;" alt="Thumbnail Preview" />
                                    </div>
                                    <br style="clear:both;"/>
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>x1" value="" id="<?php echo $image->ProductImageID ?>x1" />
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>y1" value="" id="<?php echo $image->ProductImageID ?>y1" />
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>x2" value="" id="<?php echo $image->ProductImageID ?>x2" />
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>y2" value="" id="<?php echo $image->ProductImageID ?>y2" />
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>w" value="" id="<?php echo $image->ProductImageID ?>w" />
                                        <input type="hidden" name="<?php echo $image->ProductImageID ?>h" value="" id="<?php echo $image->ProductImageID ?>h" />
                                </div>
                            <?php endforeach; ?>          
                            <?php if(isset($ProductID)): ?>
                                 <input type="hidden" name="ProductID" value="<?php echo $ProductID ?>" id="ProductID" />
                                    <div class="span12">
                                        <button formaction = "backend/generateNewImage?Status=2&ProductID=<?php echo $ProductID ?>" class="btn btn-primary">
                                            Save
                                        </button> 
                                    
                                        <button formaction = "backend/generateNewImage?Status=1&ProductID=<?php echo $ProductID ?>" class="btn btn-primary">
                                    Save & Publish
                                </button> 
                            </div>

                            <?php else: ?>

                                   <div class="span12">
                                        <button formaction = "backend/generateNewImage?Status=2" class="btn btn-primary">
                                            Save
                                        </button> 
                                    
                                        <button formaction = "backend/generateNewImage?Status=1" class="btn btn-primary">
                                    Save & Publish
                                </button> 
                            </div>
                            <?php endif; ?>

                        </form>
						    
					    <div class="row-fluid">
							  
                             


							

								</div>
                                                            

							   
						<div class="row-fluid">

    

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

