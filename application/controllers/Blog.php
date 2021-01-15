<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }

    //main page - Berita
    public function index()
    {
        $meta               = $this->meta_model->get_meta();
        $category_sidebar   = $this->category_model->get_category_sidebar();
        $recent_post        = $this->berita_model->recent_post();

        // Listing Berita Dengan Pagination
        $this->load->library('pagination');

        $config['base_url']       = base_url('blog/index/');
        $config['total_rows']     = count($this->berita_model->total());
        $config['per_page']       = 3;
        $config['uri_segment']    = 4;
        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $berita                   = $this->berita_model->berita($limit, $start);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'                 => 'Blog - ' . $meta->title,
            'deskripsi'             => 'Blog - ' . $meta->description,
            'keywords'              => 'Blog - ' . $meta->keywords,
            'paginasi'              => $this->pagination->create_links(),
            'berita'                => $berita,
            'category_sidebar'      => $category_sidebar,
            'recent_post'           => $recent_post,
            'content'               => 'front/berita/index_berita'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    //main page - detail Berita
    public function detail($berita_slug = NULL)
    {
        if (!empty($berita_slug)) {
            $berita_slug;
        } else {
            redirect(base_url('blog'));
        }

        $berita         = $this->berita_model->read($berita_slug);
        $category_sidebar   = $this->category_model->get_category_sidebar();
        $recent_post        = $this->berita_model->recent_post();
        $data = array(
            'title'                 => $berita->berita_title,
            'deskripsi'             => $berita->berita_title,
            'keywords'              => $berita->berita_keywords,
            'berita'                => $berita,
            'category_sidebar'      => $category_sidebar,
            'recent_post'           => $recent_post,
            'content'               => 'front/berita/detail_berita'
        );
        $this->add_count($berita_slug);
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    //  Category Article
    public function category($slug_kategori = NULL)
    {
        if (!empty($slug_kategori)) {
            $slug_kategori;
        } else {
            redirect(base_url('blog'));
        }

        $category                   = $this->category_model->read($slug_kategori);
        $category_id                = $category->id;
        $category_sidebar           = $this->category_model->get_category_sidebar();
        $recent_post                = $this->berita_model->recent_post();
        // $meta                       = $this->meta_model->listing();
        // Listing Berita Dengan Pagination
        $this->load->library('pagination');

        $config['base_url']       = base_url('blog/category/' . $category->category_slug . '/index/');
        $config['total_rows']     = count($this->berita_model->total_category($category_id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 5;
        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $berita                   = $this->berita_model->berita_category($category_id, $limit, $start);
        // End Listing Berita
        $data = array(
            'title'       => 'Kategori Berita - ' . $category->category_name,
            'deskripsi'   => 'Kategori Berita - ' . $category->category_name,
            'keywords'    => 'Kategori Berita - ' . $category->category_name,
            'paginasi'    => $this->pagination->create_links(),
            'berita'      => $berita,
            'category_sidebar'      => $category_sidebar,
            'recent_post'           => $recent_post,
            'content'         => 'front/berita/index_berita'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    // This is the counter function..
    function add_count($berita_slug)
    {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has slug name
        $check_visitor = $this->input->cookie(urldecode($berita_slug), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used slug for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"   => urldecode($berita_slug),
                "value"  => "$ip",
                "expire" =>  time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->berita_model->update_counter(urldecode($berita_slug));
        }
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
