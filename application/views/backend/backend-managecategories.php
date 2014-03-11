

                                        <div class="span9">
                                            <div class="content">
                                                <h3>Manage Categories</h3>
                                                
                                                <hr />

                                              
                                                  <div class="row-fluid">
							  <div class="span6"><a href="backend/categories/add"><i class="fa fa-plus"></i> add a category </a></div><div class="span3 pull-right"><i class="fa fa-download"></i> export <i class="fa fa-print"></i> print</div></div>
                                                    <div class="row-fluid">
							    <div class="span12">
							    <table border="1" cellspacing="2" cellpadding="2" width="100%">
							    	<tr>
									<th>Category</th>
									<th>Sub Section(s)</th>
									<th>Status</th>
									<th>Manage</th>
									</tr>


									<?php foreach($categories->result() as $category): ?>
							    	<tr>
									
							    	    	
									<td><?php echo $category->CategoryTitle ?></td>
									<td><?php echo $category->SubSections ?></td>
									<td>
										<?php if($category->Active == 1): ?>
											Online
										<?php else: ?>
											Offline
										<?php endif; ?>
										
									</td>
									<td>
										<a href="backend/categories/edit?CategoryID=<?php echo $category->CategoryID ?>"><button class="btn btn-primary btn-mini ">
									Edit
                                                            			</button></a>
							    			
                                                            		    <a href="backend/categories/edit?CategoryID=<?php echo $category->CategoryID ?>"><button class="btn btn-primary btn-mini">
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
