<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$this->load->model('model_setting');
$this->load->view('template_web/login/View_header');
$this->load->view('template_web/login/View_content');
$this->load->view('template_web/login/View_footer');
