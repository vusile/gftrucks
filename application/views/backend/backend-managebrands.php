

                                        <div class="span9">
                                            <div class="content">
                                                <h3>Manage Brands</h3>
                                                
                                                <hr />

                                              
                                                  <div class="row-fluid">
							  <div class="span6"><a href="backend/brands/add"><i class="fa fa-plus"></i> add a brand </a></div><div class="span3 pull-right"><i class="fa fa-download"></i> export <i class="fa fa-print"></i> print</div></div>
                                                    <div class="row-fluid">
							    <div class="span12">
							    <table border="1" cellspacing="2" cellpadding="2" width="100%">
							    	<tr>
										<th>Featured</th>
										<th>Brand Name</th>
										<th>Brand tag line</th>
										<th>Logo</th>
										<th>Active</th>
										<th>Manage</th>
									</tr>


									<?php foreach($brands->result() as $brand): ?>
							    	<tr>
									
							    	    	
									<td>
										<?php if($brand->Featured == 1): ?>
											Yes
										<?php else: ?>
											No
										<?php endif; ?>

									</td>
									<td><?php echo $brand->BrandTitle ?></td>
									<td><?php echo $brand->BrandTagLine ?></td>
									<td><img src = "img/<?php echo $brand->BrandLogo ?>" /></td>
									<td>
										<?php if($brand->Active == 1): ?>
											Online
										<?php else: ?>
											Offline
										<?php endif; ?>
										
									</td>
									<td>
										<a href="backend/brands/edit?BrandID=<?php echo $brand->BrandID ?>"><button class="btn btn-primary btn-mini ">
									Edit
                                                            			</button></a>
							    			
                                                            		    <a href="backend/brands/edit?BrandID=<?php echo $brand->BrandID ?>"><button class="btn btn-primary btn-mini">
                                                                Delete
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
