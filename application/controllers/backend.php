<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

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

	public function brands()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_subject('Brand');

			$crud->set_field_upload('BrandLogo','Images');
			
			

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

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

	public function subsections($function="")
	{


		if($function == "")
		{
			$data['subsections'] = $this->db->query("select *, (SELECT GROUP_CONCAT(SectionTitle SEPARATOR ', ') FROM sections inner join sectionsubsections on sections.SectionID =sectionsubsections.SectionID  where sectionsubsections.SubSectionID = sub.SubSectionID ) as ParentSections from subsections as sub");

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
			$this->db->insert('subsections',array('SubSectionTitle'=>$this->input->post('SubSectionTitle'),'Active'=>$this->input->get('Status')));

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
			$this->db->where('SubSectionID',$this->input->get('SubSectionID'));
			$this->db->update('subsections',array('SubSectionTitle'=>$this->input->post('SubSectionTitle'),'Active'=>$this->input->get('Status')));

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

	public function categories($function="")
	{


		if($function == "")
		{
			$data['categories'] = $this->db->query("select *, (SELECT GROUP_CONCAT(SubSectionTitle SEPARATOR ', ') FROM subsections inner join categorysubsections on subsections.SubSectionID =categorysubsections.SubSectionID  where categorysubsections.CategoryID = cat.CategoryID ) as SubSections from categories as cat");

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
				$subsections_categories_array[] = $sectioncategory->CategoryID;
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
			$this->db->insert('categories',array('CategoryTitle'=>$this->input->post('CategoryTitle'),'Active'=>$this->input->get('Status')));

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
			$this->db->where('CategoryID',$this->input->get('CategoryID'));
			$this->db->update('categories',array('CategoryTitle'=>$this->input->post('CategoryTitle'),'Active'=>$this->input->get('Status')));

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