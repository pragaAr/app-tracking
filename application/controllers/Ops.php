<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ops extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['title']    = 'Oops';

    $this->load->view('errors/ops', $data);
  }
}
