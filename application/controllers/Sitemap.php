<?php
class Sitemap extends CI_Controller {
 public function index(){
     $this->load->model('sitemap_model');
     $this->load->helper('url');
     $data['berita'] = $this->sitemap_model->create();
     header("Content-Type: text/xml;charset=iso-8859-1");
     $this->load->view('front/sitemap/index_sitemap',$data);
 }
}
?>
