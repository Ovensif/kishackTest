<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainMenu extends CI_Controller {

	public function index()
	{
        $data['js_files'] = [
            base_url()."assets/plugins/jquery/jquery.min.js",
            base_url()."assets/plugins/bootstrap/js/bootstrap.bundle.min.js",
            base_url()."assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
            base_url()."assets/dist/js/adminlte.js",
            base_url()."assets/plugins/jquery-mousewheel/jquery.mousewheel.js",
            base_url()."assets/plugins/raphael/raphael.min.js",
            base_url()."assets/plugins/jquery-mapael/jquery.mapael.min.js",
            base_url()."assets/plugins/jquery-mapael/maps/usa_states.min.js",
            base_url()."assets/plugins/chart.js/Chart.min.js",
            base_url()."assets/js/defaultJS/dist/js/demo.js",
            base_url()."assets/js/defaultJS/dist/js/pages/dashboard2.js",
        ];

		load_template('Menu/index.php', $data);
	}
}
