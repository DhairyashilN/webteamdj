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
	public function index() {
		$data = array('title' => 'Home');
		$this->load->view('home', $data);
	}

	public function about() {
		$data = array('title' => 'About');
		$this->load->view('about', $data);
	}

	public function services() {
		$data = array('title' => 'Services');
		$this->load->view('services', $data);
	}

	public function spares() {
		$this->db->where('category_type','1');
		$this->db->where('isdelete','0');
		$ArrCat = $this->db->get('category_tbl')->result_array();
		$this->db->where('isdelete','0');
		$ArrProduct = $this->db->get('products_tbl')->result_array();
		$this->db->where('isdelete','0');
		$ArrProductImage = $this->db->get('productimages_tbl')->result_array();
		$data = array('title'=>'Spares and Accessories','categories'=>$ArrCat,'products'=>$ArrProduct,'proimages'=>$ArrProductImage);
		$this->load->view('spares', $data);
	}

	public function getProductbycat($id='')
	{
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

	public function contact() {
		$data = array('title' => 'Contact');
		$this->load->view('contact', $data);
	}

	public function create_contact() {
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

	public function create_contact() {
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
}
