<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('load_template')) :
    function load_template($view_name, $data = array())
    {
        $CI = &get_instance();

        $data           = array_merge_recursive($data, array(
            /* Additional Settings */));

        $CI->load->view('templates/header', $data);
        $CI->load->view('templates/navbar');
        $CI->load->view($view_name);
        $CI->load->view('templates/footer');
    }
endif;


/* End of file project_helpers.php */
/* Location: ./application/helpers/project_helpers.php */
