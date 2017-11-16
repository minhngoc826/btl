<?php
class Share extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('shares_model');
    }
}