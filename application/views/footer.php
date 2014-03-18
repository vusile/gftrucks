<?php 

    
    $this->db->from('sectionsubsections');
    $this->db->join('subsections','subsections.SubSectionID = sectionsubsections.SubSectionID');

    $this->db->where('Active',1);
    $subsections = $this->db->get();


?>

<div class="footer">
    <div class="container">
        <div class="row">	
                        
            <div class="span2">
                <!-- Support -->
                <div class="support">
                    <h6>Main</h6>

                    <ul class="links">
                        <li>
                            <a href="about-us.html" title="About us" class="title">About us</a>
                        </li>
                        <li>
                            <a href="events.html" title="Typography" class="title">Events</a>
                        </li>
                        
                      
                        <li>
                            <a href="contact-us.html" title="Contact us" class="title">Contact us</a>
                        </li>											
                    </ul>
                </div>
                <!-- End class="support" -->

                <hr />

            
                
            </div>

            <div class="span2">
                
                <!-- Categories -->
                <div class="categories">
                    <h6>Commercial Trucks</h6>

                    <ul class="links">
                        <?php foreach($subsections->result() as $subsection): ?>

                            <?php if($subsection->SectionID==1): ?>
                            <li >
                                <a href="<?php echo $subsection->URLSafeTitleDashed ?>" title = "<?php echo $subsection->SubSectionTitle ?>"><?php echo $subsection->SubSectionTitle ?></a>

                            </li>
                            <?php endif; ?>
                        
                        <?php endforeach; ?>
                      
                    </ul>
                </div>
		</div>
                <div class="span2">
                
                    <!-- Categories -->
                    <div class="categories">
                        <h6>Construction Equipment</h6>

                        <ul class="links">
                            <?php foreach($subsections->result() as $subsection): ?>

                                <?php if($subsection->SectionID==2): ?>
                                <li >
                                    <a href="<?php echo $subsection->URLSafeTitleDashed ?>" title = "<?php echo $subsection->SubSectionTitle ?>"><?php echo $subsection->SubSectionTitle ?></a>

                                </li>
                                <?php endif; ?>
                            
                            <?php endforeach; ?>
                      
                        </ul>
                    </div>
    		</div>
                
                <div class="span2">
                
                    <!-- Categories -->
                    <div class="categories">
                        <h6>Mining Equipment</h6>

                        <ul class="links">
                            <?php foreach($subsections->result() as $subsection): ?>

                                <?php if($subsection->SectionID==3): ?>
                                <li >
                                    <a href="<?php echo $subsection->URLSafeTitleDashed ?>" title = "<?php echo $subsection->SubSectionTitle ?>"><?php echo $subsection->SubSectionTitle ?></a>

                                </li>
                                <?php endif; ?>
                            
                            <?php endforeach; ?>
                           
                        </ul>
                    </div>
    		</div>
                <!-- End class="categories" -->

          
            <div class="span4">				

          
                

               
                
                <!-- Social icons -->
                <div class="social">
                    <h6>Socialize with us</h6>

                    <ul class="social-icons">

                        <li>
                            <a class="twitter" href="#" title="Twitter">Twitter</a>								
                        </li>

                        <li>
                            <a class="facebook" href="#" title="Facebook">Facebook</a>								
                        </li>

                        <li>
                            <a class="pinterest" href="#" title="Pinterest">Pinterest</a>								
                        </li>

                        <li>
                            <a class="youtube" href="#" title="YouTube">YouTube</a>								
                        </li>

                        


                        <li>
                            <a class="googleplus" href="#" title="Google+">Google+</a>								
                        </li>


                      


                        <li>
                            <a class="linkedin" href="#" title="LinkedIn">LinkedIn</a>								
                        </li>

                        <li>
                            <a class="instagram" href="#" title="Instagram">Instagram</a>								
                        </li>

                    </ul>
                </div>
                <!-- End class="social" -->

            </div>
        </div>
    </div>
</div>
<!-- End id="footer" -->
            <!-- Credits bar -->
<div class="credits">
    <div class="container">
        <div class="row">
            <div class="span8">
                <p>&copy; 2013 <a href="#" title="GF Trucks &amp; equipment">GF Trucks and Equipment</a> &middot; <a href="#" title="Terms &amp; Conditions">Terms &amp; Conditions</a> &middot; All Rights Reserved. </p>
            </div>
            <div class="span4 text-right hidden-phone">
                <p>web design ZoomTanzania.com</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End class="credits" -->            <!-- Options panel -->

    <div class="options-panel-toggle">
        <a href="#" title=""><i class="icon-cog"></i></a>
    </div>
</div>
<!-- End class="options-panel" -->
            
         
        </div>
        <!-- BEGIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript" src="js/la_boutique.js"></script>
<!--
<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>

<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>







<script type="text/javascript" src="js/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="js/jquery.sharrre-1.3.4.js"></script>
<script type="text/javascript" src="js/jquery.gmap3.js"></script>
<script type="text/javascript" src="js/jquery.tweet.js"></script>


<script type="text/javascript" src="js/tfingi-megamenu-frontend.js"></script>-->



<!--preview only-->

<!-- END JAVASCRIPTS -->    </body>
</html>