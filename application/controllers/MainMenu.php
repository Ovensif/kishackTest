<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainMenu extends CI_Controller {

	public function index()
	{   

        $data['css_files'] = [
        ];
        $data['js_files'] = [
        ];

		load_template('Menu/index.php', $data);
	}
}
