<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->helper('string');
		$this->load->model('property_model');
		$this->load->model('type_model');
		$this->load->model('images_model');
		$this->load->model('province_model');
		$this->load->model('user_model');
	}

	// List Property
	public function index()
	{
			$id = $this->session->userdata('id');
			$user = $this->user_model->user_detail($id);
			$meta = $this->meta_model->get_meta();


			$config['base_url']       = base_url('myaccount/property/index/');
			$config['total_rows']     = count($this->property_model->total_row_user());
			$config['per_page']       = 10;
			$config['uri_segment']    = 4;

			//Membuat Style pagination untuk BootStrap v4
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';


			//Limit dan Start
			$limit                    = $config['per_page'];
			$start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
			//End Limit Start
			$this->pagination->initialize($config);
			$property = $this->property_model->get_property_user($limit, $start, $id);

			// End Listing Berita dengan paginasi
			$data = array(
					'title'       => 'Iklan Saya',
					'user'        => $user,
					'meta'        => $meta,
					'property'    => $property,
					'pagination'    => $this->pagination->create_links(),
					'content'     => 'myaccount/property/index_property'
			);
			$this->load->view('myaccount/layout/wrapp', $data, FALSE);
	}

	// Create Iklan Property
	public function create(){
		$id = $this->session->userdata('id');
		$user = $this->user_model->user_detail($id);
		if ($user->post_count == 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Sayangnya Paket Iklan Anda sudah Habis Silahkan Order Paket di bawah ini<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
			redirect(base_url('myaccount/package'), 'refresh');
		}else{

		// Get type
		$type = $this->type_model->get_type();
		$province = $this->province_model->get_province();
			// Validasi
			$this->form_validation->set_rules('property_title','Judul Property','required',
				['required'      => 'Judul Property harus di isi',]
			);
			$this->form_validation->set_rules('province_id','Provinsi','required',
				['required'      => 'Anda harus memilih Provinsi',]
			);
			$this->form_validation->set_rules('property_city','Kota','required',
				['required'      => 'Kota harus di isi',]
			);
			$this->form_validation->set_rules('property_address','Provinsi','required',
				['required'      => 'Alamat harus di isi',]
			);
			$this->form_validation->set_rules('property_market','Kota','required',
				['required'      => 'Anda harus memilih Status',]
			);
			$this->form_validation->set_rules('type_id','Tipe','required',
				['required'      => 'Anda harus memilih Type',]
			);

			$this->form_validation->set_rules('property_surfacearea','Luas Tanah','required',
				['required'      => 'Luas tanah Harus di isi',]
			);
			$this->form_validation->set_rules('property_buildingarea','Luas Bangunan','required',
				['required'      => 'Luas Bangunan Harus di isi',]
			);
			$this->form_validation->set_rules('property_floor','Jumlah lantai','required',
				['required'      => 'Jumlah lantai Harus di isi',]
			);
			$this->form_validation->set_rules('property_bed','Jumlah Kamar Tidur','required',
				['required'      => 'Jumlah Kamar Tidur Harus di isi',]
			);
			$this->form_validation->set_rules('property_bath','Jumlah Kamar mandi','required',
				['required'      => 'Jumlah Kamar mandi Harus di isi',]
			);
			$this->form_validation->set_rules('property_bed_maid','Jumlah Kamar Tidur','required',
				['required'      => 'Jumlah Kamar Tidur Pembantu Harus di isi',]
			);
			$this->form_validation->set_rules('property_bath_maid','Jumlah Kamar mandi','required',
				['required'      => 'Jumlah Kamar mandi Pembantu Harus di isi',]
			);
			$this->form_validation->set_rules('property_garage','Daya Listrik','required',
				['required'      => 'Jumlah Garasi Harus di isi',]
			);
			$this->form_validation->set_rules('property_electrical','Daya Listrik','required',
				['required'      => 'Daya Listrik Harus di isi',]
			);
			$this->form_validation->set_rules('property_certificate','Jenis Sertifikat','required',
				['required'      => 'Jenis Sertifikat Harus di isi',]
			);
			$this->form_validation->set_rules('property_price','Harga','required',
				['required'      => 'Harga Property Harus di isi',]
			);
			$this->form_validation->set_rules('property_negotiable','Nego','required',
				['required'      => 'Pilih Jenis Harga',]
			);
			$this->form_validation->set_rules('property_desc','Deskripsi','required',
				['required'      => 'Deskripsi Harus di isi',]
			);
			$this->form_validation->set_rules('property_keywords','Kata Kunci','required',
				['required'      => 'Kata Kunci Harus di isi',]
			);
			$this->form_validation->set_rules('property_city','Kota','required',
				['required'      => 'Kota Harus di isi',]
			);


			if ($this->form_validation->run()) {

				$config['upload_path']          = './assets/img/property/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
				$config['max_size']             = 5000000; //Dalam Kilobyte
				$config['max_width']            = 5000000; //Lebar (pixel)
				$config['max_height']           = 5000000; //tinggi (pixel)
				$config['encrypt_name'] 				= TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('property_image')) {

				$data = [
						'title'        => 'Buat Iklan',
						'error_upload' => $this->upload->display_errors(),
						'type'          => $type,
						'province'      => $province,
						'content'       => 'myaccount/property/create_property'
				];
				$this->load->view('myaccount/layout/wrapp', $data, FALSE);
			}else{

				//Proses Manipulasi Gambar
				$upload_data    = array('uploads'  => $this->upload->data());
				//Gambar Asli disimpan di folder assets/upload/image
				//lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs
				$config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];
            $filename = $_FILES['property_image']['tmp_name'];

            $imgdata=exif_read_data($this->upload->upload_path.$this->upload->file_name, 'IFD0');


            list($width, $height) = getimagesize($filename);
            if ($width >= $height){
                $config['width'] = 600;
            }
            else{
                $config['height'] = 600;
            }
            $config['master_dim'] = 'auto';



            $this->load->library('image_lib',$config);

            if (!$this->image_lib->resize()){
                echo "error";
            }else{

                $this->image_lib->clear();
                $config=array();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];


                switch($imgdata['Orientation']) {
                    case 3:
                        $config['rotation_angle']='180';
                        break;
                    case 6:
                        $config['rotation_angle']='270';
                        break;
                    case 8:
                        $config['rotation_angle']='90';
                        break;
                }

                $this->image_lib->initialize($config);
                $this->image_lib->rotate();
							}

				// Watermark Image
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/property/' . $upload_data['uploads']['file_name'];
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = './assets/img/logo/logo-watermark.png';
        $config['wm_opacity'] = 50;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();

				$price 				= $this->input->post('property_price');
				$price_final 	= preg_replace('/\D/','',$price);

				$slugcode       = random_string('numeric', 5);
				$property_slug  = url_title($this->input->post('property_title'), 'dash', TRUE);
				$id_iklan =  random_string('numeric', 7);
				$data = [
					'user_id'                   => $this->session->userdata('id'),
					'id_iklan'									=> $id_iklan,
					'province_id'               => $this->input->post('province_id'),
					'property_city'             => $this->input->post('property_city'),
					'type_id'                   => $this->input->post('type_id'),
					'property_address'          => $this->input->post('property_address'),
					'property_slug'             => $property_slug . '-' . $slugcode,
					'property_title'            => $this->input->post('property_title'),
					'property_market'           => $this->input->post('property_market'),
					'property_surfacearea'      => $this->input->post('property_surfacearea'),
					'property_buildingarea'     => $this->input->post('property_buildingarea'),
					'property_floor'            => $this->input->post('property_floor'),
					'property_bed'              => $this->input->post('property_bed'),
					'property_bath'             => $this->input->post('property_bath'),
					'property_bath_maid'        => $this->input->post('property_bath_maid'),
					'property_bed_maid'         => $this->input->post('property_bed_maid'),
					'property_electrical'       => $this->input->post('property_electrical'),
					'property_garage'           => $this->input->post('property_garage'),
					'property_certificate'      => $this->input->post('property_certificate'),
					'property_price'            => $price_final,
					'property_negotiable'       => $this->input->post('property_negotiable'),
					'property_desc'             => $this->input->post('property_desc'),
					'property_image'            => $upload_data['uploads']['file_name'],
					'property_keywords'         => $this->input->post('property_keywords'),
					'start_date'								=> date('Y-m-d'),
					'expired_date'							=> date('Y-m-d', strtotime('+1 year')),
					'property_status'						=> 'Pending',
					'date_created'              => time()
				];
				$insert_id = $this->property_model->create($data);
				$this->upload_images($insert_id);
				$this->user_model->update_post_count($id);
				$this->session->set_flashdata('message', 'Data Iklan telah ditambahkan');
				redirect(base_url('myaccount/property'), 'refresh');

			}
		}

			$data = [
					'title'        => 'Buat Iklan',
					'deskripsi'     => 'deskripsi',
					'keywords'      => 'keywords',
					'type'          => $type,
					'province'      => $province,
					'content'       => 'myaccount/property/create_property'
			];
			$this->load->view('myaccount/layout/wrapp', $data, FALSE);


	}
}

public function update($id)
{
		$type = $this->type_model->get_type();
		$province = $this->province_model->get_province();
		$property = $this->property_model->property_detail($id);
		//Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
				'property_title',
				'Judul Property',
				'required',
				['required'      => '%s harus diisi']
		);

		$valid->set_rules(
				'property_desc',
				'Deskripsi Property',
				'required',
				['required'      => '%s harus diisi']
		);


		if ($valid->run()) {
				//Kalau nggak Ganti gambar
				if (!empty($_FILES['property_image']['name'])) {

						$config['upload_path']          = './assets/img/property/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg';
						$config['max_size']             = 500000; //Dalam Kilobyte
						$config['max_width']            = 500000; //Lebar (pixel)
						$config['max_height']           = 500000; //tinggi (pixel)
						$config['encrypt_name'] 				= TRUE;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('property_image')) {

								//End Validasi
								$data = [
										'title'        		=> 'Edit Property',
										'property'       	=> $property,
										'type'						=> $type,
										'province'				=> $province,
										'error_upload' 		=> $this->upload->display_errors(),
										'content'          => 'myaccount/property/update_property'
								];
								$this->load->view('myaccount/layout/wrapp', $data, FALSE);

								//Masuk Database

						} else {

								//Proses Manipulasi Gambar
								$upload_data    = array('uploads'  => $this->upload->data());
								//Gambar Asli disimpan di folder assets/upload/image
								$config['image_library'] = 'gd2';
				            $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];
				            $filename = $_FILES['property_image']['tmp_name'];

				            $imgdata=exif_read_data($this->upload->upload_path.$this->upload->file_name, 'IFD0');


				            list($width, $height) = getimagesize($filename);
				            if ($width >= $height){
				                $config['width'] = 600;
				            }
				            else{
				                $config['height'] = 600;
				            }
				            $config['master_dim'] = 'auto';
										$config['encrypt_name'] = TRUE;


				            $this->load->library('image_lib',$config);

				            if (!$this->image_lib->resize()){
				                echo "error";
				            }else{

				                $this->image_lib->clear();
				                $config=array();

				                $config['image_library'] = 'gd2';
				                $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];


				                switch($imgdata['Orientation']) {
				                    case 3:
				                        $config['rotation_angle']='180';
				                        break;
				                    case 6:
				                        $config['rotation_angle']='270';
				                        break;
				                    case 8:
				                        $config['rotation_angle']='90';
				                        break;
				                }

				                $this->image_lib->initialize($config);
				                $this->image_lib->rotate();
											}

								// Watermark Image
				        $config['image_library']    = 'gd2';
				        $config['source_image']     = './assets/img/property/' . $upload_data['uploads']['file_name'];
				        $config['wm_type'] = 'overlay';
				        $config['wm_overlay_path'] = './assets/img/logo/logo-watermark.png';
				        $config['wm_opacity'] = 50;
				        $config['wm_vrt_alignment'] = 'middle';
				        $config['wm_hor_alignment'] = 'center';
				        $this->load->library('image_lib', $config);
				        $this->image_lib->initialize($config);
				        $this->image_lib->watermark();

								// Hapus Gambar Lama Jika Ada upload gambar baru
								if ($property->property_image != "") {
										unlink('./assets/img/property/' . $property->property_image);

								}
								//End Hapus Gambar

								$data  = [
										'id'                				=> $id,
										'user_id'                   => $this->session->userdata('id'),
										'province_id'               => $this->input->post('province_id'),
										'property_city'             => $this->input->post('property_city'),
										'type_id'                   => $this->input->post('type_id'),
										'property_address'          => $this->input->post('property_address'),
										// 'property_slug'             => $property_slug . '-' . $slugcode,
										'property_title'            => $this->input->post('property_title'),
										'property_market'           => $this->input->post('property_market'),
										'property_surfacearea'      => $this->input->post('property_surfacearea'),
										'property_buildingarea'     => $this->input->post('property_buildingarea'),
										'property_floor'            => $this->input->post('property_floor'),
										'property_bed'              => $this->input->post('property_bed'),
										'property_bath'             => $this->input->post('property_bath'),
										'property_bath_maid'        => $this->input->post('property_bath_maid'),
										'property_bed_maid'         => $this->input->post('property_bed_maid'),
										'property_electrical'       => $this->input->post('property_electrical'),
										'property_garage'           => $this->input->post('property_garage'),
										'property_certificate'      => $this->input->post('property_certificate'),
										'property_price'            => $this->input->post('property_price'),
										'property_negotiable'       => $this->input->post('property_negotiable'),
										'property_desc'             => $this->input->post('property_desc'),
										'property_image'            => $upload_data['uploads']['file_name'],
										'property_keywords'         => $this->input->post('property_keywords'),
										// 'start_date'								=> date('Y-m-d'),
										// 'expired_date'							=> date('Y-m-d', strtotime('+1 year')),
										// 'property_status'						=> 'Pending',
										'date_updated'              => time()
								];
								$this->property_model->update($data);
								$this->session->set_flashdata('message', 'Data telah di Update');
								redirect(base_url('myaccount/property'), 'refresh');
						}
				} else {
						//Update Berita Tanpa Ganti Gambar
						// Hapus Gambar Lama Jika ada upload gambar baru
						if ($property->property_image != "")
								$data  = [
										'id'         => $id,
										'user_id'                   => $this->session->userdata('id'),
										'province_id'               => $this->input->post('province_id'),
										'property_city'             => $this->input->post('property_city'),
										'type_id'                   => $this->input->post('type_id'),
										'property_address'          => $this->input->post('property_address'),
										// 'property_slug'             => $property_slug . '-' . $slugcode,
										'property_title'            => $this->input->post('property_title'),
										'property_market'           => $this->input->post('property_market'),
										'property_surfacearea'      => $this->input->post('property_surfacearea'),
										'property_buildingarea'     => $this->input->post('property_buildingarea'),
										'property_floor'            => $this->input->post('property_floor'),
										'property_bed'              => $this->input->post('property_bed'),
										'property_bath'             => $this->input->post('property_bath'),
										'property_bath_maid'        => $this->input->post('property_bath_maid'),
										'property_bed_maid'         => $this->input->post('property_bed_maid'),
										'property_electrical'       => $this->input->post('property_electrical'),
										'property_garage'           => $this->input->post('property_garage'),
										'property_certificate'      => $this->input->post('property_certificate'),
										'property_price'            => $this->input->post('property_price'),
										'property_negotiable'       => $this->input->post('property_negotiable'),
										'property_desc'             => $this->input->post('property_desc'),
										// 'property_image'            => $upload_data['uploads']['file_name'],
										'property_keywords'         => $this->input->post('property_keywords'),
								];
						$this->property_model->update($data);
						$this->session->set_flashdata('message', 'Data telah di Update');
						redirect(base_url('myaccount/property'), 'refresh');
				}
		}
		//End Masuk Database
		$data = [
				'title'        			=> 'Update Property',
				'property'       		=> 	$property,
				'type'							=> $type,
				'province'					=> $province,
				'content'          	=> 'myaccount/property/update_property'
		];
		$this->load->view('myaccount/layout/wrapp', $data, FALSE);
}

public function perpanjang($property_id)
{
	$id = $this->session->userdata('id');
	$user = $this->user_model->user_detail($id);
	if ($user->post_count == 0) {
		$this->session->set_flashdata('message', '<div class="alert alert-danger"> Sayangnya Paket Iklan Anda sudah Habis Silahkan Order Paket di bawah ini<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
		redirect(base_url('myaccount/package'), 'refresh');
	}else{
	$data  = [
			'id'         					=> $property_id,
			'start_date'					=> date('Y-m-d'),
			'expired_date'				=> date('Y-m-d', strtotime('+1 year')),
		];
	$this->property_model->perpanjangan($data);
	$this->user_model->update_post_count($id);
	$this->session->set_flashdata('message', 'Data telah di Perpanjang');
	redirect(base_url('myaccount/property'), 'refresh');
}
}



	public function upload_images($insert_id){

    $config['upload_path']          = './assets/img/property/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 5000; //Dalam Kilobyte
    $config['max_width']            = 5000; //Lebar (pixel)
    $config['max_height']           = 5000; //tinggi (pixel)
    $config['encrypt_name']         = TRUE;
    $this->load->library('upload', $config);

    for ($i=1; $i <=3 ; $i++) {
      if(!empty($_FILES['images'.$i]['name'])){
        if(!$this->upload->do_upload('images'.$i));
        // $data2 = $this->upload->data();



        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());

        // Resize Image
				$config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];
            $filename2 = $_FILES['property_image']['tmp_name'];

            $imgdata=exif_read_data($this->upload->upload_path.$this->upload->file_name, 'IFD0');


            list($width, $height) = getimagesize($filename2);
            if ($width >= $height){
                $config['width'] = 500;
            }
            else{
                $config['height'] = 500;
            }
            $config['master_dim'] = 'auto';


            $this->load->library('image_lib',$config);
						$this->image_lib->initialize($config);

            if (!$this->image_lib->resize()){
                echo "error";
            }else{

                $this->image_lib->clear();
                $config=array();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/property/' . $upload_data['uploads']['file_name'];


                switch($imgdata['Orientation']) {
                    case 3:
                        $config['rotation_angle']='180';
                        break;
                    case 6:
                        $config['rotation_angle']='270';
                        break;
                    case 8:
                        $config['rotation_angle']='90';
                        break;
                }

                $this->image_lib->initialize($config);
                $this->image_lib->rotate();
							}

        // Watermark Image
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/property/' . $upload_data['uploads']['file_name'];
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = './assets/img/logo/logo-watermark.png';
        $config['wm_opacity'] = 50;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();



        // $file = $data2['file_name'];


        $data = [
          'property_id'      	=> $insert_id,
          'images'         		=>  $upload_data['uploads']['file_name'],
          'date_created'  		=> time()
        ];
        $this->images_model->create($data);
      }

    }

  }

	// get sub category by category_id
	function city(){
		$province_id = $this->input->post('id',TRUE);
		$data = $this->property_model->get_city($province_id)->result();
		echo json_encode($data);
	}


}
