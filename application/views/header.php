<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-js">

<head>
<base href="<?php echo base_url(); ?>" />
<meta charset="UTF-8">

<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="GF Trucks and Equipment HTML v1.0" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>Home | GF Trucks &amp; Equipment</title>


<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="css/fonts/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="css/flexslider.css" />
<link rel="stylesheet" type="text/css" href="css/tfingi-megamenu-frontend.css" />


<!-- Comment following two lines to use LESS -->
<link rel="stylesheet" type="text/css" href="css/core.css" />
<link rel="stylesheet" type="text/css" href="css/turquoise.css" id="color_scheme" />

<!-- Uncomment following three lines to use LESS -->
<!--<link rel="stylesheet/less" type="text/css" href="css/less/core.less">
<link rel="stylesheet/less" type="text/css" href="css/less/turquoise.less" id="color_scheme" >
<script src="js/less.js" type="text/javascript"></script>-->

<!--
<meta http-equiv="X-UA-Compatible" content="IE=7; IE=8" />-->
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="http://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic|Shadows+Into+Light" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="wrapper">

            <!-- Header -->
<div class="header">
<!-- Top bar -->
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <p>
                         
                    </p>
                </div>
                <div class="span6 hidden-phone">
                    <ul class="inline pull-right">
                        <li>
                            <a href="<?php echo base_url(); ?>" title="Home">Home</a> | <a href="about-us.html" title="Home">About us</a>	 | <a href="contact-us.html" title="Home">Contact Us</a>									
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End class="top" -->

    <!-- Logo & Search bar -->
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="span8">							
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>" title="&larr; Back home">
                            <img src="img/logo-GF.png" alt="GF Trucks &amp; Equipment" />
                        </a>
                    </div>
                </div>

                <div class="span4">
                    <div class="row-fluid">
                        <div class="span10">
           
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- End class="bottom" -->
    
</div>
<!-- End class="header" -->            

<?php 

    
    $this->db->from('sectionsubsections');
    $this->db->join('subsections','subsections.SubSectionID = sectionsubsections.SubSectionID');

    $this->db->where('Active',1);
    $subsections = $this->db->get();


?>


<!-- Navigation -->
<nav class="navigation">
    <div class="container">
     
        <div class="row">
            <div class="span12">
                
<a href="#" class="main-menu-button">Navigation</a>

<!-- Begin Menu Container -->
<div class="megamenu_container">
    <div class="menu-main-navigation-container">
        <ul id="menu-main-navigation" class="main-menu">
		 <li><a href="<?php echo base_url(); ?>"><i class="icon-home icon-large"></i> </a></li>

            <li class="menu-item-has-children"><a href="commercial-trucks">Commercial Trucks</a>

                <?php if($subsections->num_rows() > 0): ?>
                    <ul class="sub-menu">
                        <?php foreach($subsections->result() as $subsection): ?>

                            <?php if($subsection->SectionID==1): ?>
                            <li class="menu-item-has-children"><a href="<?php echo $subsection->URLSafeTitleDashed ?>"><?php echo $subsection->SubSectionTitle ?></a>

                                <?php 
                                    $this->db->from('categorysubsections');
                                    $this->db->join('categories','categories.CategoryID = categorysubsections.CategoryID');
                                    $this->db->where('Active',1);
                                    $this->db->where('categorysubsections.SubSectionID',$subsection->SubSectionID);
                                    $categories = $this->db->get();
                                ?>

                                <?php if($categories->num_rows()): ?>
                                    <ul class="sub-menu">
                                        <?php foreach($categories->result() as $category): ?>
                                            <li><a href="<?php echo $category->URLSafeTitleDashed ?>"><?php echo $category->CategoryTitle ?></a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <?php endif; ?>
                        
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
	    

            <li class="menu-item-has-children"><a href="Construction-Equipment">Construction Equipment</a>
                <?php if($subsections->num_rows() > 0): ?>
                    <ul class="sub-menu">
                        <?php foreach($subsections->result() as $subsection): ?>

                            <?php if($subsection->SectionID==2): ?>
                            <li class="menu-item-has-children"><a href="<?php echo $subsection->URLSafeTitleDashed ?>"><?php echo $subsection->SubSectionTitle ?></a>

                                <?php 
                                    $this->db->from('categorysubsections');
                                    $this->db->join('categories','categories.CategoryID = categorysubsections.CategoryID');
                                    $this->db->where('Active',1);
                                    $this->db->where('categorysubsections.SubSectionID',$subsection->SubSectionID);
                                    $categories = $this->db->get();
                                ?>

                                <?php if($categories->num_rows()): ?>
                                    <ul class="sub-menu">
                                        <?php foreach($categories->result() as $category): ?>
                                            <li><a href="<?php echo $category->URLSafeTitleDashed ?>"><?php echo $category->CategoryTitle ?></a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <?php endif; ?>
                        
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
	     <!-- Construction Equipment END-->
	     
	    <!-- Mining Equipment START-->
            <li class="menu-item-has-children"><a href="Mining-Equipment">Mining Equipment</a>
                <?php if($subsections->num_rows() > 0): ?>
                    <ul class="sub-menu">
                        <?php foreach($subsections->result() as $subsection): ?>

                            <?php if($subsection->SectionID==3): ?>
                            <li class="menu-item-has-children"><a href="<?php echo $subsection->URLSafeTitleDashed ?>"><?php echo $subsection->SubSectionTitle ?></a>

                                <?php 
                                    $this->db->from('categorysubsections');
                                    $this->db->join('categories','categories.CategoryID = categorysubsections.CategoryID');
                                    $this->db->where('Active',1);
                                    $this->db->where('categorysubsections.SubSectionID',$subsection->SubSectionID);
                                    $categories = $this->db->get();
                                ?>

                                <?php if($categories->num_rows()): ?>
                                    <ul class="sub-menu">
                                        <?php foreach($categories->result() as $category): ?>
                                            <li><a href="<?php echo $category->URLSafeTitleDashed ?>"><?php echo $category->CategoryTitle ?></a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <?php endif; ?>
                        
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
	    <!-- Mining Equipment END-->
  	    
	      
            <li ><a href="products.html">Weichai Power Engines</a></li>
            <li ><a href="aboutus.html">Services and Parts</a></li>
    
            <li class="menu-item-has-children megamenu-parent" data-width="400">
                <a href="contact-us.html">Contact Us</a>
                <ul class="sub-menu">
                    <li class="megamenu-column"><a href="#MegaMenuColumn">Mega Menu Column</a></li>
                    <li class="megamenu-heading"><a href="#MegaMenuHeading">Contact Us</a></li>
                    <li class="megamenu-content">
                        <div class="wpcf7">
                            <form action="" method="post" class="wpcf7-form" novalidate="novalidate">
                                <label>Your Name (required)</label>
                                <input type="text" name="your-name" value="" size="40"  aria-required="true" />
                                <label>Your Email (required)</label>
                                <input type="email" name="your-email" value="" size="40" aria-required="true" />
                                <label>Subject</label>
                                <input type="text" name="your-subject" value="" size="40"  />
                                <label>Your Message</label>
                                <textarea name="your-message" cols="40" rows="10" ></textarea>

                                <input type="submit" value="Send" class="btn btn-primary" />
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>    
</div>    


            </div>

            
        </div>        
    
    </div>
</nav>
<!-- End class="navigation" -->