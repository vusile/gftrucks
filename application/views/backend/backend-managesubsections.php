

                                        <div class="span9">
                                            <div class="content">
                                                <h3>Manage Sub-Sections</h3>
                                                
                                                <hr />

                                              
                                                  <div class="row-fluid">
							  <div class="span6"><a href="backend/subsections/add"><i class="fa fa-plus"></i> add a sub sections </a></div><div class="span3 pull-right"><i class="fa fa-download"></i> export <i class="fa fa-print"></i> print</div></div>
                                                    <div class="row-fluid">
							    <div class="span12">
							    <table border="1" cellspacing="2" cellpadding="2" width="100%">
							    	<tr>
									<th>Sub Section</th>
									<th>Parent Section(s)</th>
									<th>Status</th>
									<th>Manage</th>
									</tr>


									<?php foreach($subsections->result() as $subsection): ?>
							    	<tr>
									
							    	    	
									<td><?php echo $subsection->SubSectionTitle ?></td>
									<td><?php echo $subsection->ParentSections ?></td>
									<td>
										<?php if($subsection->Active == 1): ?>
											Online
										<?php else: ?>
											Offline
										<?php endif; ?>
										
									</td>
									<td>
										<a href="backend/subsections/edit?SubSectionID=<?php echo $subsection->SubSectionID ?>"><button class="btn btn-primary btn-mini ">
									Edit
                                                            			</button></a>
							    			
                                                            		    <a href="backend/subsections/edit?SubSectionID=<?php echo $subsection->SubSectionID ?>"><button class="btn btn-primary btn-mini">
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
