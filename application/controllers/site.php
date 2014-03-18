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



	public function index($parentSection = "", $url="")
	{

		if($url == "" and $parentSection == ""){
			
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
		}
		else {

			if($parentSection != ""){

				$data['URL'] = $parentSection;

				switch($parentSection){
					case "commercial-trucks":

						$query = "SELECT *, (select count(ProductID) from products where CategoryID in ( SELECT CategoryID from categorysubsections where categorysubsections.SubSectionID = subsections.SubSectionID ) ) as ProdCount FROM subsections  WHERE subsections.SubSectionID IN (SELECT SubSectionID from sectionsubsections where SectionID = 1)";

						$data['subsections'] = $this->db->query($query);

						$data['Title'] = "COMMERCIAL TRUCKS";
					break;					

					case "construction-equipment":
						$query = "SELECT *, (select count(ProductID) from products where CategoryID in ( SELECT CategoryID from categorysubsections where categorysubsections.SubSectionID = subsections.SubSectionID ) ) as ProdCount FROM subsections  WHERE subsections.SubSectionID IN (SELECT SubSectionID from sectionsubsections where SectionID = 2)";
						$data['subsections'] = $this->db->query($query);

						$data['Title'] = "CONSTRUCTION EQUIPMENT";
					break;

					case "mining-equipment":
						$query = "SELECT *, (select count(ProductID) from products where CategoryID in ( SELECT CategoryID from categorysubsections where categorysubsections.SubSectionID = subsections.SubSectionID ) ) as ProdCount FROM subsections  WHERE subsections.SubSectionID IN (SELECT SubSectionID from sectionsubsections where SectionID = 3)";
						$data['subsections'] = $this->db->query($query);

						$data['Title'] = "MINING EQUIPMENT";
					break;
				}
				
				if($url == "")
					$url = $parentSection;
			}


			$data['brands'] = $this->db->get('brands');

			$this->db->where('UPPER(URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
			$sections = $this->db->get('sections');

			if($sections->num_rows())
			{
				$SectionID = $sections->row()->SectionID;

				$data['PageTitle'] = $sections->row()->SectionTitle;



				$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
				$this->db->from('sectionsubsections');
				$this->db->join('categorysubsections','sectionsubsections.SubSectionID=categorysubsections.SubSectionID');
				$this->db->join('categories','categorysubsections.CategoryID=categories.CategoryID');
				$this->db->join('products','products.CategoryID=categories.CategoryID');
				$this->db->join('brands','products.BrandID = brands.BrandID'); 
				$this->db->group_by('ProductID');
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


					$data['PageTitle'] = $subsections->row()->SubSectionTitle;


					$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
					$this->db->from('categorysubsections');
					$this->db->join('categories','categorysubsections.CategoryID=categories.CategoryID');
					$this->db->join('products','products.CategoryID=categories.CategoryID');
					$this->db->join('brands','products.BrandID = brands.BrandID'); 
					$this->db->group_by('ProductID');
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

						$data['PageTitle'] = $categories->row()->CategoryTitle;
						
						$this->db->select('*, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID  Limit 2) as Images');
						$this->db->where('products.CategoryID',$CategoryID);
						$this->db->where('products.Active',1);
						$this->db->from('products');
						$this->db->join('brands','products.BrandID = brands.BrandID');
						$this->db->group_by('ProductID');
						$data['products'] = $this->db->get();						

						$this->load->view('header');
						$this->load->view('products',$data);
						$this->load->view('footer');

					}
					else {
						$this->db->select('*, categories.URLSafeTitleDashed as CatURL, (SELECT GROUP_CONCAT(ImageName order by OrderNum SEPARATOR "GFIMGSEP") FROM productimages where  ProductID = products.ProductID ) as Images');
						$this->db->where('UPPER(products.URLSafeTitle)',strtoupper(preg_replace('/[\s\W]+/',"",$url)),TRUE);
						$this->db->from('products');
						$this->db->join('categories','products.CategoryID=categories.CategoryID');
						$this->db->join('productspecifications', 'products.ProductID=productspecifications.ProductID','left');
						$this->db->join('specifications','productspecifications.SpecificationID=specifications.SpecificationID');
						$this->db->join('catalogues', 'products.CatalogueID=catalogues.CatalogueID');
						// $this->db->group_by('products.ProductID');
						$data['products'] = $this->db->get();

						if($data['products']->num_rows())
						{

							$this->db->where('CategoryID',$data['products']->row()->CategoryID);
							$this->db->where('ProductID <>',$data['products']->row()->ProductID);
							$data['relatedProducts'] = $this->db->get('products');

							$this->load->view('header');
							$this->load->view('product',$data);
							$this->load->view('footer');
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