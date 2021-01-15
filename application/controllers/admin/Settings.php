<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    //Load Data Konfigurasi
    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');


        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {
        $settings = $this->settings_model->get_settings();
        $data = [
            'title'             => 'Pengaturan',
            'settings'          => $settings,
            'content'           => 'admin/settings/index_settings'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function update($id)
    {
        $settings = $this->settings_model->detail_settings($id);

        $this->form_validation->set_rules(
            'title',
            'Judul Web',
            'required',
            array('required'        => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Update Profile Web',
                'settings'              => $settings,
                'content'           => 'admin/settings/update_settings'

            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                    => $settings->id,
                'user_id'               => $this->session->userdata('id'),
                'title'                 => $this->input->post('title'),
                'tagline'               => $this->input->post('tagline'),
                'description'           => $this->input->post('description'),
                'keywords'              => $this->input->post('keywords'),
                'google_settings'           => $this->input->post('google_settings'),
                'bing_settings'             => $this->input->post('bing_settings'),
                'google_analytics'      => $this->input->post('google_analytics'),
                'google_tag'            => $this->input->post('google_tag'),
                'email'                 => $this->input->post('email'),
                'telepon'               => $this->input->post('telepon'),
                'alamat'                => $this->input->post('alamat'),
                'link'                  => $this->input->post('link'),
                'map'                   => $this->input->post('map'),
                'facebook'              => $this->input->post('facebook'),
                'instagram'             => $this->input->post('instagram'),
                'youtube'               => $this->input->post('youtube'),
                'twitter'               => $this->input->post('twitter'),
                'date_updated'          => time()
            ];
            $this->settings_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('admin/settings'), 'refresh');
        }
    }
}
