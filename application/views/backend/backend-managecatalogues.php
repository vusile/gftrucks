

                                        <div class="span9">
                                            <div class="content">
                                                <h3>Manage Catalogues</h3>
                                                
                                                <hr />

                                              
                                                  <div class="row-fluid">
							  <div class="span6"><a href="backend/catalogues/add"><i class="fa fa-plus"></i> add a catalogue </a></div><div class="span3 pull-right"><i class="fa fa-download"></i> export <i class="fa fa-print"></i> print</div></div>
                                                    <div class="row-fluid">
							    <div class="span12">
							    <table border="1" cellspacing="2" cellpadding="2" width="100%">
							    	<tr>
										<th>Catalogue Name</th>
										<th>File</th>

										<th>Active</th>
										<th>Manage</th>
									</tr>


									<?php foreach($catalogues->result() as $catalogue): ?>
							    	<tr>
									
							    	   
									<td><?php echo $catalogue->CatalogueTitle ?></td>
									
									<td><a target="_blank" href = "catalogues/<?php echo $catalogue->FileName ?>" >View Catalogue</a></td>
									<td>
										<?php if($catalogue->Active == 1): ?>
											Online
										<?php else: ?>
											Offline
										<?php endif; ?>
										
									</td>
									<td>
										<a href="backend/catalogues/edit?CatalogueID=<?php echo $catalogue->CatalogueID ?>"><button class="btn btn-primary btn-mini ">Edit</button></a>
							    			
                        		    	<a href="backend/catalogues/edit?CatalogueID=<?php echo $catalogue->CatalogueID ?>"><button class="btn btn-primary btn-mini">Delete</button></a>
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
