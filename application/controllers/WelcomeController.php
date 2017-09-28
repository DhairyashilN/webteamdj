<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WelcomeController extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$data = array('title' => 'Home');
		$this->load->view('home', $data);
	}

	public function about(){
		$data = array('title' => 'About');
		$this->load->view('about', $data);
	}

	public function services(){
		$data = array('title' => 'Services');
		$this->load->view('services', $data);
	}

	public function media(){
		$data = array('title' => 'Media');
		$this->load->view('media', $data);
	}

	public function events(){
		$this->db->select('title,url,poster_image');
		$this->db->from('events_tbl');
		$this->db->where('isdelete',0);
		$ArrEvents = $this->db->get()->result_array();
		$data = array('title'=>'Events','ArrEvents'=>$ArrEvents);
		$this->load->view('event', $data);
	}

	public function spares(){
		$this->db->where('category_type','1');
		$this->db->where('isdelete','0');
		$ArrCat = $this->db->get('category_tbl')->result_array();
		$this->db->where('isdelete','0');
		$this->db->where('	isvisible','1');
		$ArrProduct = $this->db->get('products_tbl')->result_array();
		$this->db->where('isdelete','0');
		$ArrProductImage = $this->db->get('productimages_tbl')->result_array();
		$data = array('title'=>'Spares and Accessories','categories'=>$ArrCat,'products'=>$ArrProduct,'proimages'=>$ArrProductImage);
		$this->load->view('spares', $data);
	}

	public function getProductbycat($id=''){
		$ArrProductImage = array();
		$this->db->where('category_type','1');
		$this->db->where('isdelete','0');
		$ArrCat = $this->db->get('category_tbl')->result_array();
		$this->db->where('category',$id);
		$this->db->where('isdelete','0');
		$ArrProduct = $this->db->get('products_tbl')->result_array();
		foreach ($ArrProduct as $value) {
			$this->db->select('product_id,image');
			$this->db->from('productimages_tbl');
			$this->db->where('product_id',$value['id']);
			$this->db->where('isdelete','0');
			$ArrProductImages= $this->db->get()->row_array();
			array_push($ArrProductImage, $ArrProductImages);
		}
		//echo '<pre/>';print_r($ArrProductImages);die;
		$data = array('title'=>'Spares and Accessories','categories'=>$ArrCat,'products'=>$ArrProduct,'proimages'=>$ArrProductImage);
		$this->load->view('spares', $data);
	}

	public function contact(){
		$data = array('title' => 'Contact');
		$this->load->view('contact', $data);
	}

	public function create_contact(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Contact', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model('Contact_model');
			$result = $this->Contact_model->add_contact();
			if ($result) {
				require_once(APPPATH.'PHPMailer/PHPMailerAutoload.php');
				$mail = new PHPMailer();
        		$mail->IsSMTP(); // we are going to use SMTP
		        $mail->SMTPAuth   = true; // enabled SMTP authentication
		        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
		        $mail->Port       = 465;                   // SMTP port to connect to GMail
		        $mail->Username   = "dhairsheel32@gmail.com";  // user email address
		        $mail->Password   = "dhairya@92";            // password in GMail
		        $mail->SetFrom('dhairsheel32@gmail.com', 'Team DJ');  //Who is sending 
		        $mail->isHTML(true);
		        $mail->Subject    = "Thank You for contacting us";
		        $mail->Body      = '
		        <html>
		        <head>
		        	<title>Email</title>
		        </head>
		        <body>
		        	<div style="padding:0px 15px">
		        		<h3 style="text-align:center;background-color:#0a0b0c;color:#fff;padding:20px 0px">TEAM DJ Customs</h3>
		        		<p>Dear '.$this->input->post('name').',</p>
		        		<p>Thank You for contacting with us.We will reach to you soon.</p><br>
		        		<p>Regards,</p>
		        		<p>Team DJ Customs,<br>Kolhapur.</p>
		        	</div>
		        </body>
		        </html>';
		        $destino = $this->input->post('email'); // Who is addressed the email to
		        $mail->AddAddress($destino, "Receiver");
		        if(!$mail->Send()) {
		        	echo json_encode(array('success' => 0));
		        } else {
		        	echo json_encode(array('success' => 1));
		        }
		    }
		}
	}

	public function create_enquiry(){
		/*echo 'a';die;
		print_r($_POST);die;*/
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Contact', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model('Contact_model');
			$result = $this->Contact_model->add_enquiry();
			if ($result) {
				$this->session->set_flashdata('msg','Enquiry Sent. We will contact to you soon.');
				redirect('spares-and-accessories');
			}
			/*if ($result) {
				require_once(APPPATH.'PHPMailer/PHPMailerAutoload.php');
				$mail = new PHPMailer();
        		$mail->IsSMTP(); // we are going to use SMTP
		        $mail->SMTPAuth   = true; // enabled SMTP authentication
		        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
		        $mail->Port       = 465;                   // SMTP port to connect to GMail
		        $mail->Username   = "dhairsheel32@gmail.com";  // user email address
		        $mail->Password   = "dhairya@92";            // password in GMail
		        $mail->SetFrom('dhairsheel32@gmail.com', 'Team DJ');  //Who is sending 
		        $mail->isHTML(true);
		        $mail->Subject    = "Enquiry for Spare & Accessories";
		        $mail->Body      = '
		        <html>
		        <head>
		        	<title>Email</title>
		        </head>
		        <body>
		        	<div style="padding:0px 15px">
		        		<h3 style="text-align:center;background-color:#0a0b0c;color:#fff;padding:20px 0px">TEAM DJ Customs</h3>
		        		<p>Dear Admin,</p>
		        		<p>One enquiry is submitted from website.</p><br>
		        		<p>Regards,</p>
		        		<p>Team DJ Customs,<br>Kolhapur.</p>
		        	</div>
		        </body>
		        </html>';
		        $destino = $this->input->post('email'); // Who is addressed the email to
		        $mail->AddAddress($destino, "Receiver");
		        if(!$mail->Send()) {
		        	echo json_encode(array('success' => 0));
		        } else {
		        	echo json_encode(array('success' => 1));
		        }
		    }*/
		}
	}

	public function getProductDetails(){
		$url = $this->uri->segment(3);
		$this->db->where('url', $url);
		$data['ObjProduct'] = $this->db->get('products_tbl')->result();
		$product_id = lookup_value('products_tbl', 'id',array('url'=>$url));
		$this->db->where('product_id', $product_id);
		$data['ArrProductImage'] = $this->db->get('productimages_tbl')->result_array();
		$this->db->select('view_count');
		$this->db->from('products_tbl');
		$this->db->where('id', $product_id);
		$view_count = $this->db->get()->result();
		foreach ($view_count as $value) {
			$view_count = $value->view_count;
		}
		(int)$new_count=(int)$view_count+1;
		$this->db->where('id', $product_id);
		$this->db->update('products_tbl',['view_count'=>$new_count]);
		$this->load->view('spare_details', $data);
	}

	public function getEventDetails(){
		$url = $this->uri->segment(2);
		$this->db->where('url', $url);
		$data['ObjEvent'] = $this->db->get('events_tbl')->result();
		$product_id = lookup_value('events_tbl', 'id',array('url'=>$url));
		$this->db->where('event_id', $product_id);
		$data['ArrEventImage'] = $this->db->get('eventimages_tbl')->result_array();
		// echo('<pre/>');print_r($ArrProductImage);die;
		$this->load->view('event_details', $data);
	}

	public function getPortfolios(){
		$url = $this->uri->segment(2);
		$cat_id = lookup_value('category_tbl', 'id',array('url'=>$url));
		$this->db->where('pcategory',$cat_id);
		$data['ArrPortfolio'] = $this->db->get('portfolio_tbl')->result_array();
		$data['title'] = 'Work | '.$url;
		$this->load->view('portfolio_grid', $data);
	}

	public function getPortfolioDetails(){
		$url = $this->uri->segment(3);
		$this->db->where('purl',$url);
		$data['ObjPortfolio'] = $this->db->get('portfolio_tbl')->result();
		$portfolio_id = lookup_value('portfolio_tbl','id',array('purl'=>$url));
		$this->db->where('portfolio_id', $portfolio_id);
		$data['ArrPortfolioImage'] = $this->db->get('portfolioimages_tbl')->result_array();
		$data['title'] = 'Work | '.$url;
		$this->load->view('portfolio_details', $data);
	}


}
