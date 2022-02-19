<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasabah extends CI_Controller {

	public function index()
	{   

        $data['css_files'] = [
            "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback",
            base_url()."assets/plugins/fontawesome-free/css/all.min.css",
            base_url()."assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
            base_url()."assets/css/adminlte.min.css"
        ];
        $data['js_files'] = [
            base_url()."assets/plugins/jquery/jquery.min.js",
            base_url()."assets/plugins/bootstrap/js/bootstrap.bundle.min.js",
            base_url()."assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
            base_url()."assets/js/defaultJS/adminlte.js",
            base_url()."assets/plugins/jquery-mousewheel/jquery.mousewheel.js",
            base_url()."assets/plugins/raphael/raphael.min.js",
            base_url()."assets/plugins/jquery-mapael/jquery.mapael.min.js",
            base_url()."assets/plugins/jquery-mapael/maps/usa_states.min.js",
            base_url()."assets/plugins/chart.js/Chart.min.js",
            base_url()."assets/js/defaultJS/demo.js",
            base_url()."assets/js/defaultJS/pages/dashboard2.js",
        ];

		load_template('Menu/nasabah.php', $data);
	}
}
