<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

	public $Logo;
	public $Catalogue;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	// public function brands()
	// {
	// 	try{
	// 		$crud = new grocery_CRUD();

	// 		$crud->set_theme('datatables');
			
	// 		$crud->set_subject('Brand');

	// 		$crud->set_field_upload('BrandLogo','Images');
			
			

	// 		$output = $crud->render();

	// 		$this->_example_output($output);

	// 	}catch(Exception $e){
	// 		show_error($e->getMessage().' --- '.$e->getTraceAsString());
	// 	}
	// }

	public function specifications()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			

			$crud->order_by('OrderID');
			
			

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function brands($function="")
	{


		if($function == "")
		{
			$data['brands'] = $this->db->query("select * FROM brands ORDER BY BrandTitle");

			// echo $this->db->last_query();

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-managebrands',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "add")
		{
			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-addbrand');
			$this->load->view('backend/backend-footer');
		}

		if($function == "edit")
		{

			$this->db->where('BrandID',$this->input->get('BrandID'));
			$data['brand'] = $this->db->get('brands');


			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-editbrand',$data);
			$this->load->view('backend/backend-footer');
		}
	}

    function checkBrandLogo()
    {
        if ($_FILES['BrandLogo']['name']=='')
        {
            $this->form_validation->set_message('checkBrandLogo', 'Please Upload a Logo');
            return FALSE;
        }
        else
        {
            $this->load->library('upload');
            $cvconfig['upload_path'] = 'img';
            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF';
            $cvconfig['max_size'] = '2048';

            $this->upload->initialize($cvconfig);
            $this->upload->do_upload('BrandLogo');
            $data = $this->upload->data();

            $this->Logo = $data['file_name'];

            return TRUE;
        }
    }

	function savebrand() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('BrandTitle', 'Brand Title', 'required');
		$this->form_validation->set_rules('BrandTagLine', 'Brand Tag Line', 'required');
		$this->form_validation->set_rules('BrandDescription', 'Brand Description', 'required');
		$this->form_validation->set_rules('BrandLogo', 'Brand Logo', 'callback_checkBrandLogo');


		if ($this->form_validation->run() == FALSE)
		{
			$this->brands('add');
		}
		else
		{

			$this->db->insert('brands',array(
				'BrandTitle'=>$this->input->post('BrandTitle'),
				'BrandTagLine'=>$this->input->post('BrandTagLine'),
				'BrandDescription'=>$this->input->post('BrandDescription'),
				'Featured'=>$this->input->post('Featured'),
				'BrandLogo'=>$this->Logo,
				'Active'=>$this->input->get('Status')
			));

			redirect('backend/brands');
		}
	}


    function checkUpdateBrandLogo()
    {
        if ($_FILES['BrandLogo']['name']=='')
        {
        	$this->db->where('BrandID',$this->input->get('BrandID'));
        	$brand=$this->db->get('brands');

        	if(!$brand->row()->BrandLogo){

	            $this->form_validation->set_message('checkUpdateBrandLogo', 'Please Upload a Logo');
	            return FALSE;
        	}

        	else {
        		$this->Logo = $brand->row()->BrandLogo;
        		return TRUE;
        	}
        }
        else
        {
            $this->load->library('upload');
            $cvconfig['upload_path'] = 'img';
            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF';
            $cvconfig['max_size'] = '2048';

            $this->upload->initialize($cvconfig);
            $this->upload->do_upload('BrandLogo');
            $data = $this->upload->data();

            $this->Logo = $data['file_name'];

            return TRUE;
        }
    }

	function updatebrand() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('BrandTitle', 'Brand Title', 'required');
		$this->form_validation->set_rules('BrandTagLine', 'Brand Tag Line', 'required');
		$this->form_validation->set_rules('BrandDescription', 'Brand Description', 'required');
		$this->form_validation->set_rules('BrandLogo', 'Brand Logo', 'callback_checkUpdateBrandLogo');


		if ($this->form_validation->run() == FALSE)
		{
			$this->brands('edit');
		}
		else
		{

			$this->db->where('BrandID',$this->input->get('BrandID'));
			$this->db->update('brands',array(
				'BrandTitle'=>$this->input->post('BrandTitle'),
				'BrandTagLine'=>$this->input->post('BrandTagLine'),
				'BrandDescription'=>$this->input->post('BrandDescription'),
				'Featured'=>$this->input->post('Featured'),
				'BrandLogo'=>$this->Logo,
				'Active'=>$this->input->get('Status')
			));

			redirect('backend/brands');
		}
	}



	public function catalogues($function="")
	{


		if($function == "")
		{
			$data['catalogues'] = $this->db->query("SELECT * FROM catalogues ORDER BY CatalogueTitle");

			

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-managecatalogues',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "add")
		{
			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-addcatalogue');
			$this->load->view('backend/backend-footer');
		}

		if($function == "edit")
		{

			$this->db->where('CatalogueID',$this->input->get('CatalogueID'));
			$data['catalogue'] = $this->db->get('catalogues');


			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-editcatalogue',$data);
			$this->load->view('backend/backend-footer');
		}
	}

    function checkCatalogue()
    {
        if ($_FILES['Catalogue']['name']=='')
        {
            $this->form_validation->set_message('checkCatalogue', 'Please Upload a Catalogue');
            return FALSE;
        }
        else
        {
            $this->load->library('upload');
            $cvconfig['upload_path'] = 'catalogues';
            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|pdf|PDF|doc|DOC|docx|DOCX';
            $cvconfig['max_size'] = '2048';

            $this->upload->initialize($cvconfig);
            $this->upload->do_upload('Catalogue');
            $data = $this->upload->data();

            $this->Catalogue = $data['file_name'];

            return TRUE;
        }
    }

	function savecatalogue() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('CatalogueTitle', 'Catalogue Title', 'required');
		$this->form_validation->set_rules('Catalogue', 'Catalogue', 'callback_checkCatalogue');


		if ($this->form_validation->run() == FALSE)
		{
			$this->catalogues('add');
		}
		else
		{

			$this->db->insert('catalogues',array(
				'CatalogueTitle'=>$this->input->post('CatalogueTitle'),
				'FileName'=>$this->Catalogue,
				'Active'=>$this->input->get('Status')
			));

			redirect('backend/catalogues');
		}
	}


    function checkUpdateCatalogue()
    {
        if ($_FILES['Catalogue']['name']=='')
        {
        	$this->db->where('CatalogueID',$this->input->get('CatalogueID'));
        	$catalogue=$this->db->get('catalogues');

        	if(!$catalogue->row()->FileName){

	            $this->form_validation->set_message('checkUpdateCatalogue', 'Please Upload a Catalogue');
	            return FALSE;
        	}

        	else {
        		$this->Catalogue = $catalogue->row()->FileName;
        		return TRUE;
        	}
        }
        else
        {
            $this->load->library('upload');
            $cvconfig['upload_path'] = 'catalogues';
            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|pdf|PDF|doc|DOC|docx|DOCX';
            $cvconfig['max_size'] = '2048';

            $this->upload->initialize($cvconfig);
            $this->upload->do_upload('Catalogue');
            $data = $this->upload->data();

            $this->Catalogue = $data['file_name'];

            return TRUE;
        }
    }

	function updatecatalogue() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CatalogueTitle', 'Catalogue Title', 'required');
		$this->form_validation->set_rules('Catalogue', 'Brand Logo', 'callback_checkUpdateCatalogue');


		if ($this->form_validation->run() == FALSE)
		{
			$this->catalogues('edit');
		}
		else
		{

			$this->db->where('CatalogueID',$this->input->get('CatalogueID'));
			$this->db->update('catalogues',array(
				'CatalogueTitle'=>$this->input->post('CatalogueTitle'),
				'FileName'=>$this->Catalogue,
				'Active'=>$this->input->get('Status')
			));

			redirect('backend/catalogues');
		}
	}

	public function subsections($function="")
	{


		if($function == "")
		{
			$data['subsections'] = $this->db->query("select *, (SELECT GROUP_CONCAT(SectionTitle SEPARATOR ', ') FROM sections inner join sectionsubsections on sections.SectionID =sectionsubsections.SectionID  where sectionsubsections.SubSectionID = sub.SubSectionID ) as ParentSections from subsections as sub Order By SubSectionTitle");

			// echo $this->db->last_query();

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-managesubsections',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "add")
		{
			$data['sections'] = $this->db->get('sections');
			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-addsubsection',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "edit")
		{
			$data['sections'] = $this->db->get('sections');

			$this->db->where('SubSectionID',$this->input->get('SubSectionID'));
			$section_subsections = $this->db->get('sectionsubsections');

			$section_subsections_array = array();

			foreach($section_subsections->result() as $section_subsection) {
				$section_subsections_array[] = $section_subsection->SectionID;
			}

			$data['section_subsections'] = $section_subsections_array;

			
			$this->db->where('SubSectionID',$this->input->get('SubSectionID'));
			$data['subsection'] = $this->db->get('subsections');

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-editsubsection',$data);
			$this->load->view('backend/backend-footer');
		}
	}

	function savesubsection() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('SubSectionTitle', 'Sub Section Title', 'required');
		$this->form_validation->set_rules('Section', 'Parent Section', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->subsections('add');
		}
		else
		{

	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle'))),TRUE);

	        $subsections = $this->db->get('subsections');

	        if($subsections->num_rows() > 0) {
	        	$num = $subsections->num_rows() + 1;
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle')) . $num;
	        	$URLSafeTitleDashed = url_title($this->input->post('SubSectionTitle')) . "-" . $num;
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('SubSectionTitle'));
	        }

			$this->db->insert('subsections',array('SubSectionTitle'=>$this->input->post('SubSectionTitle'),'Active'=>$this->input->get('Status'),'URLSafeTitle'=>$URLSafeTitle,'URLSafeTitleDashed'=>$URLSafeTitleDashed));

			$SubSectionID = $this->db->insert_id();

			$parentSectionsArray = array();
			foreach($this->input->post('Section') as $ParentSection) 
			{
				$parentSectionsArray[] = array('SectionID'=>$ParentSection,'SubSectionID'=>$SubSectionID);
			}

			$this->db->insert_batch('sectionsubsections',$parentSectionsArray);

			redirect('backend/subsections');
		}
	}

	function updatesubsection() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('SubSectionTitle', 'Sub Section Title', 'required');
		$this->form_validation->set_rules('Section', 'Parent Section', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->subsections('add');
		}
		else
		{
	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle'))),TRUE);
	        $this->db->where('SubSectionID <>',$this->input->get('SubSectionID'));
	        $subsections = $this->db->get('subsections');

	        if($subsections->num_rows() > 0) {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle')) . ($subsections->num_rows() + 2);
	        	$URLSafeTitleDashed = url_title($this->input->post('SubSectionTitle')) . '-' . ($subsections->num_rows() + 2);
	        	
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('SubSectionTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('SubSectionTitle'));
	        	
	        }

			$this->db->where('SubSectionID',$this->input->get('SubSectionID'));
			$this->db->update('subsections',array('SubSectionTitle'=>$this->input->post('SubSectionTitle'),'Active'=>$this->input->get('Status'),'URLSafeTitle'=>$URLSafeTitle,'URLSafeTitleDashed'=>$URLSafeTitleDashed));

			$SubSectionID = $this->input->get('SubSectionID');

			$parentSectionsArray = array();
			foreach($this->input->post('Section') as $ParentSection) 
			{
				$parentSectionsArray[] = array('SectionID'=>$ParentSection,'SubSectionID'=>$SubSectionID);
			}

			
			$this->db->where('SubSectionID',$this->input->get('SubSectionID'));
			$this->db->delete('sectionsubsections');

			$this->db->insert_batch('sectionsubsections',$parentSectionsArray);

			redirect('backend/subsections');
		}
	}


	public function products($function="")
	{


		if($function == "")
		{
			// $data['products'] = $this->db->query("select *, (SELECT GROUP_CONCAT(SectionTitle SEPARATOR ', ') FROM categories inner join categorysubsections on categories.CategoryID =categorysubsections.CategoryID  where sectionsubsections.SubSectionID = sub.SubSectionID ) as SubSections from products");
			$data['products'] = $this->db->query("select *, products.Active as ProductStatus, GROUP_CONCAT( DISTINCT(SectionTitle) SEPARATOR ', ' ) as ParentSections, GROUP_CONCAT( DISTINCT(SubSectionTitle) SEPARATOR ', ' ) as SubSections  from products inner join categories on products.CategoryID = categories.CategoryID inner join subsections  inner join sections where subsections.SubSectionID in (SELECT SubSectionID from categorysubsections WHERE CategoryID = categories.CategoryID) AND sections.SectionID in ( SELECT SectionID from sectionsubsections where SubSectionID = subsections.SubSectionID) group by products.ProductID");

			// echo $this->db->last_query();

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-manageproducts',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "add")
		{
			$data['categories'] = $this->db->get('categories');
			$data['brands'] = $this->db->get('brands');
			$data['catalogues'] = $this->db->get('catalogues');
			$data['specifications'] = $this->db->get('specifications');

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-addproduct',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "edit")
		{
			$data['categories'] = $this->db->get('categories');
			$data['brands'] = $this->db->get('brands');
			$data['catalogues'] = $this->db->get('catalogues');
			$data['specifications'] = $this->db->get('specifications');

			$this->db->where('ProductID',$this->input->get('ProductID'));
			$data['productimages'] = $this->db->get('productimages');

			$this->db->where('ProductID',$this->input->get('ProductID'));
			$productspecifications= $this->db->get('productspecifications');

			$data['productspecificationsarray'] = array();

			foreach($productspecifications->result() as $productspecification) {
				$data['productspecificationsarray'][$productspecification->SpecificationID] = $productspecification->Specification;
			}

			$this->db->where('ProductID',$this->input->get('ProductID'));
			$data['product'] = $this->db->get('products')->row();

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-editproduct',$data);
			$this->load->view('backend/backend-footer');
		}
	}

	function saveproduct() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ProductTitle', 'Product Title', 'required');
		$this->form_validation->set_rules('Features', 'Features', 'required');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		$this->form_validation->set_rules('BrandID', 'Brand', 'required');
		$this->form_validation->set_rules('CategoryID', 'CategoryID', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->products('add');
		}
		else
		{


			if ($_FILES['NewCatalogue']['name']=='')
	        {
	        	if($this->input->post('CatalogueID'))
	        		$CatalogueID = $this->input->post('CatalogueID');
	        }
	        else
	        {

	            $this->load->library('upload');
	            $cvconfig['upload_path'] = 'catalogues';
	            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|pdf|PDF|doc|DOC|docx|DOCX';
	            $cvconfig['max_size'] = '2048';

	            $this->upload->initialize($cvconfig);
	            $this->upload->do_upload('NewCatalogue');
	            $data = $this->upload->data();

	            $this->Catalogue = $data['file_name'];

	        	if($this->input->post('NewCatalogueName'))
	        		$CatalogueName = $this->input->post('NewCatalogueName');
	        	else
	        		$CatalogueName = $this->Catalogue;

	            $this->db->insert('catalogues',array('FileName'=>$this->Catalogue,'CatalogueTitle'=>$CatalogueName));

	            $CatalogueID = $this->db->insert_id();
	        }


	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle'))),TRUE);
	        
	        $products = $this->db->get('products');

	        if($products->num_rows() > 0) {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle')) . $products->num_rows() + 1;
	        	$URLSafeTitleDashed = url_title($this->input->post('ProductTitle')) . $products->num_rows() + 1;
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('ProductTitle'));
	        }

	        $product = array(

				'ProductTitle'=>$this->input->post('ProductTitle'),
				'Features'=>$this->input->post('Features'),
				'Description'=>$this->input->post('Description'),
				'BrandID'=>$this->input->post('BrandID'),
				'Featured'=>$this->input->post('Featured'),
				'CategoryID'=>$this->input->post('CategoryID'),
				'URLSafeTitle'=>$URLSafeTitle,
				'URLSafeTitleDashed'=>$URLSafeTitleDashed

			);

			if(isset($CatalogueID))
				$product['CatalogueID'] = $CatalogueID;

			$this->db->insert('products',$product);

			$ProductID = $this->db->insert_id();

			$imagesArray = array();

			for($i=1;$i<=5;$i++)
			{
		        if ($_FILES['Image' . $i]['name']!='')
		        {

		            $this->load->library('upload');
		            $cvconfig['upload_path'] = 'Images';
		            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF';
		            $cvconfig['max_size'] = '2048';

		            $this->upload->initialize($cvconfig);

		            if($this->upload->do_upload('Image' . $i)){
		            	$data = $this->upload->data();
		            	$imagesArray[] = array('OrderNum'=>$i,'ProductID'=>$ProductID,'ImageName'=>$data['file_name']);		            
		            }
		            
		        }
		    }

		    if(count($imagesArray) > 0){
		    	$this->db->insert_batch('productimages',$imagesArray);
		    }

			$specifications = $this->db->get('specifications');
			$specificationsArray = array();

			foreach($specifications->result() as $specification)
			{
				if($this->input->post('Specification' . $specification->SpecificationID)) {

					$specificationsArray[] = array(
							'SpecificationID' => $specification->SpecificationID,
							'ProductID' => $ProductID,
							'Specification'=>$this->input->post('Specification' . $specification->SpecificationID)

						);

				}
			}


			if(count($specificationsArray) > 0)
				$this->db->insert_batch('productspecifications',$specificationsArray);

			if(count($imagesArray) > 0)
				redirect('backend/resizeImages/' . $ProductID);
			else
				redirect('backend/products');
		}
	}

	function resizeImages($ProductID) {

		$this->db->where('ProductID',$ProductID);
		$data['images'] = $this->db->get('productimages');
		$data['ProductID']= $ProductID;



		$this->load->view('backend/backend-header');
		$this->load->view('backend/backend-navigation');
		$this->load->view('backend/backend-editimages',$data);
		$this->load->view('backend/backend-footer');

	}


	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$thumb_image_name); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
	    }
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}

	function generateNewImage( ) {

		$this->load->library('upload');
    	$this->load->library('image_moo');

		$this->db->where('ProductID',$this->input->post('ProductID'));
		$this->db->update('products',array('Active'=>$this->input->get('Status')));

		$this->db->where('ProductID',$this->input->post('ProductID'));
		$images = $this->db->get('productimages');

		foreach($images->result() as $image) {

			if($this->input->post($image->ProductImageID . 'x1'))
			{
				$x1 = $this->input->post($image->ProductImageID . 'x1');
				$y1 = $this->input->post($image->ProductImageID . 'y1');
				$x2 = $this->input->post($image->ProductImageID . 'x2');
				$y2 = $this->input->post($image->ProductImageID . 'y2');
				$w = $this->input->post($image->ProductImageID . 'w');
				$h = $this->input->post($image->ProductImageID . 'h');
				//Scale the image to the thumb_width set above
			}
			else {

				$x1 = 0;
				$y1 = 0;
				$x2 = 370;
				$y2 = 370;
				$w = 370;
				$h = 370;
				
			}
			
			$scale = 370/$w;
			$cropped = $this->resizeThumbnailImage("Images/370px-" . $image->ImageName, "Images/" . $image->ImageName,$w,$h,$x1,$y1,$scale);

			$this->image_moo->load("Images/370px-" . $image->ImageName)->resize(270,270)->save("Images/" . $image->ImageName,TRUE);

		}

		redirect("backend/products");

	}

	function updateproduct() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ProductTitle', 'Product Title', 'required');
		$this->form_validation->set_rules('Features', 'Features', 'required');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		$this->form_validation->set_rules('BrandID', 'Brand', 'required');
		$this->form_validation->set_rules('CategoryID', 'CategoryID', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->products('add');
		}
		else
		{


			if ($_FILES['NewCatalogue']['name']=='')
	        {
	        	if($this->input->post('CatalogueID'))
	        		$CatalogueID = $this->input->post('CatalogueID');
	        }
	        else
	        {

	            $this->load->library('upload');
	            $cvconfig['upload_path'] = 'catalogues';
	            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|pdf|PDF|doc|DOC|docx|DOCX';
	            $cvconfig['max_size'] = '2048';

	            $this->upload->initialize($cvconfig);
	            $this->upload->do_upload('NewCatalogue');
	            $data = $this->upload->data();

	            $this->Catalogue = $data['file_name'];

	        	if($this->input->post('NewCatalogueName'))
	        		$CatalogueName = $this->input->post('NewCatalogueName');
	        	else
	        		$CatalogueName = $this->Catalogue;

	            $this->db->insert('catalogues',array('FileName'=>$this->Catalogue,'CatalogueTitle'=>$CatalogueName));

	            $CatalogueID = $this->db->insert_id();
	        }

	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle'))),TRUE);
	        $this->db->where('ProductID <>',$this->input->get('ProductID'));
	        $products = $this->db->get('products');

	        if($products->num_rows() > 0) {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle')) . $products->num_rows() + 1;
	        	$URLSafeTitleDashed = url_title($this->input->post('ProductTitle')) . $products->num_rows() + 1;
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('ProductTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('ProductTitle')) ;
	        }

	        $product = array(

				'ProductTitle'=>$this->input->post('ProductTitle'),
				'Features'=>$this->input->post('Features'),
				'Description'=>$this->input->post('Description'),
				'BrandID'=>$this->input->post('BrandID'),
				'Featured'=>$this->input->post('Featured'),
				'CategoryID'=>$this->input->post('CategoryID'),
				'URLSafeTitle'=>$URLSafeTitle,
				'URLSafeTitleDashed'=>$URLSafeTitleDashed

			);

			if(isset($CatalogueID))
				$product['CatalogueID'] = $CatalogueID;


			$this->db->where('ProductID',$this->input->get('ProductID'));
			$this->db->update('products',$product);

			$ProductID = $this->input->get('ProductID');

			$imagesArray = array();
            $delete = array();

			for($i=1;$i<=5;$i++)
			{
		        if ($_FILES['Image' . $i]['name']!='')
		        {

		            $this->load->library('upload');
		            $cvconfig['upload_path'] = 'Images';
		            $cvconfig['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF';
		            $cvconfig['max_size'] = '2048';

		            $this->upload->initialize($cvconfig);

		            $delete[] = $i;


		            if($this->upload->do_upload('Image' . $i)){
		            	$data = $this->upload->data();
		            	$imagesArray[] = array('OrderNum'=>$i,'ProductID'=>$ProductID,'ImageName'=>$data['file_name']);		            
		            }
		            
		        }

		        if($this->input->post('DeleteImage' . $i)) {

		        	$this->db->where('OrderNum',$i);
		        	$this->db->where('ProductID',$ProductID);
		        	$Image = $this->db->get('productimages');


		        	unlink('Images/' . $Image->ImageName);

		        	$this->db->where('OrderNum',$i);
		        	$this->db->where('ProductID',$ProductID);
		        	$this->db->delete('productimages');

		        }
		    }

		    if(count($imagesArray) > 0){

		    	$this->db->where('ProductID',$ProductID);
		    	$this->db->where_in('OrderNum',$delete);
		    	$this->db->delete('productimages');

		    	$this->db->insert_batch('productimages',$imagesArray);
		    }

			$specifications = $this->db->get('specifications');

			$specificationsArray = array();

			foreach($specifications->result() as $specification)
			{
				if($this->input->post('Specification' . $specification->SpecificationID)) {

					$specificationsArray[] = array(
							'SpecificationID' => $specification->SpecificationID,
							'ProductID' => $ProductID,
							'Specification'=>$this->input->post('Specification' . $specification->SpecificationID)

						);

				}
			}



			if(count($specificationsArray) > 0){

		    	$this->db->where('ProductID',$this->input->get('ProductID'));
		    	$this->db->delete('productspecifications');



				$this->db->insert_batch('productspecifications',$specificationsArray);
			}

			if(count($imagesArray) > 0)
				redirect('backend/resizeImages/' . $ProductID);
			else
				redirect('backend/products');
		}
	}


	public function categories($function="")
	{


		if($function == "")
		{
			$data['categories'] = $this->db->query("select *, (SELECT GROUP_CONCAT(SubSectionTitle SEPARATOR ', ') FROM subsections inner join categorysubsections on subsections.SubSectionID =categorysubsections.SubSectionID  where categorysubsections.CategoryID = cat.CategoryID ) as SubSections from categories as cat Order By CategoryTitle");

			// echo $this->db->last_query();

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-managecategories',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "add")
		{
			$data['subsections'] = $this->db->get('subsections');
			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-addcategory',$data);
			$this->load->view('backend/backend-footer');
		}

		if($function == "edit")
		{
			$data['subsections'] = $this->db->get('subsections');

			$this->db->where('CategoryID',$this->input->get('CategoryID'));
			$sectioncategories = $this->db->get('categorysubsections');

			$subsections_categories_array = array();

			foreach($sectioncategories->result() as $sectioncategory) {
				$subsections_categories_array[] = $sectioncategory->SubSectionID;
			}

			$data['subsections_categories'] = $subsections_categories_array;

			
			$this->db->where('CategoryID',$this->input->get('CategoryID'));
			$data['category'] = $this->db->get('categories');

			$this->load->view('backend/backend-header');
			$this->load->view('backend/backend-navigation');
			$this->load->view('backend/backend-editcategory',$data);
			$this->load->view('backend/backend-footer');
		}
	}

	function savecategory() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CategoryTitle', 'Category Title', 'required');
		$this->form_validation->set_rules('SubSection', 'Sub Section', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->categories('add');
		}
		else
		{

	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle'))),TRUE);
	    
	        $categories = $this->db->get('categories');

	        if($categories->num_rows() > 0) {
	        	 
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle')) . ($categories->num_rows() + 1);
	        	$URLSafeTitleDashed = url_title($this->input->post('CategoryTitle')) . ($categories->num_rows() + 1);
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('CategoryTitle'));
	        }

			$this->db->insert('categories',array('CategoryTitle'=>$this->input->post('CategoryTitle'),'Active'=>$this->input->get('Status'),'URLSafeTitle'=>$URLSafeTitle,'URLSafeTitleDashed'=>$URLSafeTitleDashed));

			$CategoryID = $this->db->insert_id();

			$subSectionsArray = array();

			foreach($this->input->post('SubSection') as $SubSection) 
			{
				$subSectionsArray[] = array('SubSectionID'=>$SubSection,'CategoryID'=>$CategoryID);
			}

			$this->db->insert_batch('categorysubsections',$subSectionsArray);

			redirect('backend/categories');
		}
	}

	function updatecategory() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CategoryTitle', 'Category Title', 'required');
		$this->form_validation->set_rules('SubSection', 'Sub Section', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->categories('add');
		}
		else
		{

	        $this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle'))),TRUE);
	        $this->db->where('CategoryID <>',$this->input->get('CategoryID'));
	        $categories = $this->db->get('categories');

	        if($categories->num_rows() > 0) {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle')) . ($categories->num_rows() + 1);
	        	$URLSafeTitleDashed = url_title($this->input->post('CategoryTitle')) . "-" . ($categories->num_rows() + 1);	
	        }

	        else {
	        	$URLSafeTitle = preg_replace('/[\s\W]+/',"",$this->input->post('CategoryTitle'));
	        	$URLSafeTitleDashed = url_title($this->input->post('CategoryTitle'));	
	        }

			$this->db->where('CategoryID',$this->input->get('CategoryID'));
			$this->db->update('categories',array('CategoryTitle'=>$this->input->post('CategoryTitle'),'Active'=>$this->input->get('Status'),'URLSafeTitle'=>$URLSafeTitle,'URLSafeTitleDashed'=>$URLSafeTitleDashed));

			$CategoryID = $this->input->get('CategoryID');
			
			$this->db->where('CategoryID',$this->input->get('CategoryID'));
			$this->db->delete('categorysubsections');

			$subSectionsArray = array();

			foreach($this->input->post('SubSection') as $SubSection) 
			{
				$subSectionsArray[] = array('SubSectionID'=>$SubSection,'CategoryID'=>$CategoryID);
			}

			$this->db->insert_batch('categorysubsections',$subSectionsArray);

			redirect('backend/categories');
		}
	}
	public function sections()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			

			// $crud->unset_add();
			// $crud->unset_delete();
			// $crud->unset_edit();
			
			

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	// public function categories()
	// {
	// 	try{
	// 		$crud = new grocery_CRUD();

	// 		$crud->set_theme('datatables');

	// 		$crud->set_relation_n_n('sections','categorysections','sections','CategoryID','SectionID','SectionTitle','OrderNum');
			
	// 		$crud->field_type('Active','true_false');

	// 		// $crud->unset_add();
	// 		// $crud->unset_delete();
	// 		// $crud->unset_edit();
			
			

	// 		$output = $crud->render();

	// 		$this->_example_output($output);

	// 	}catch(Exception $e){
	// 		show_error($e->getMessage().' --- '.$e->getTraceAsString());
	// 	}
	// }

	public function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');

			$crud->required_fields('lastName');

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

		$this->_example_output($output);
	}

	public function film_management_twitter_bootstrap()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('film');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');

			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');

		$crud->set_field_upload('file_url','assets/uploads/files');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{

		$crud = new grocery_CRUD();

		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

}