<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    //Load Data
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
    // Index
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
    // Update
    public function update($id)
    {
        $settings = $this->settings_model->detail_settings($id);

        $this->form_validation->set_rules(
            'moderation',
            'Moderasi',
            'required',
            array('required'        => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Update Seting',
                'settings'              => $settings,
                'content'           => 'admin/settings/update_settings'

            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                    => $settings->id,
                'user_id'               => $this->session->userdata('id'),
                'moderation'                 => $this->input->post('moderation'),
                'premium_range'               => $this->input->post('premium_range'),

                'date_updated'          => time()
            ];
            $this->settings_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('admin/settings'), 'refresh');
        }
    }
}
