<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}



	public function index($url="")
	{

		if($url == ""){
			
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
		}
		else {

			$data['brands'] = $this->db->get('brands');

			$this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
			$sections = $this->db->get('sections');

			if($sections->num_rows())
			{
				$SectionID = $sections->row()->SectionID;

				$data['Title'] = $sections->row()->SectionTitle;
				$data['URL'] = $sections->row()->URLSafeTitleDashed;

				$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
				$this->db->from('sectionsubsections');
				$this->db->join('categorysubsections','sectionsubsections.SubSectionID=categorysubsections.SubSectionID');
				$this->db->join('categories','categorysubsections.CategoryID=categories.CategoryID');
				$this->db->join('products','products.CategoryID=categories.CategoryID');
				$this->db->join('brands','products.BrandID = brands.BrandID'); 
				$this->db->where('sectionsubsections.SectionID',$SectionID);
				$this->db->where('products.Active',1);
				$data['products'] = $this->db->get();



				$this->load->view('header');
				$this->load->view('products',$data);
				$this->load->view('footer');
			}
			else {
				$this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
				$subsections = $this->db->get('subsections');

				if($subsections->num_rows())
				{
					$SubSectionID = $subsections->row()->SubSectionID;

					$data['Title'] = $subsections->row()->SubSectionTitle;
					$data['URL'] = $subsections->row()->URLSafeTitleDashed;

					$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
					$this->db->from('categorysubsections');
					$this->db->join('categories','categorysubsections.CategoryID=categories.CategoryID');
					$this->db->join('products','products.CategoryID=categories.CategoryID');
					$this->db->join('brands','products.BrandID = brands.BrandID'); 
					$this->db->where('categorysubsections.SubSectionID',$SubSectionID);
					$this->db->where('products.Active',1);
					$data['products'] = $this->db->get();

					$this->load->view('header');
					$this->load->view('products',$data);
					$this->load->view('footer');
					
				}
				else {
					$this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
					$categories = $this->db->get('categories');

					if($categories->num_rows())
					{
						$CategoryID = $categories->row()->CategoryID;

						$data['Title'] = $categories->row()->CategoryTitle;
						$data['URL'] = $categories->row()->URLSafeTitleDashed;

						
						$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
						$this->db->where('products.CategoryID',$CategoryID);
						$this->db->where('products.Active',1);
						$this->db->from('products');
						$this->db->join('brands','products.BrandID = brands.BrandID');
						$data['products'] = $this->db->get();						

						$this->load->view('header');
						$this->load->view('products',$data);
						$this->load->view('footer');

					}
					else {
						$this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
						$products = $this->db->get('products');

						if($products->num_rows())
						{

						}
						else {
							show_404();			
						}

					}
				}
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */