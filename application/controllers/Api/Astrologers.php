<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Astrologers extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('astrologers_model_api');
    }
    /**
     * User Register
     * @link : user/register
     */

    public function index_get($id = null)
    {
        $headers = $this->input->request_headers();
        
        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
        
            if ($token != false) {
                $astrologers = ($id != null) ? $this->astrologers_model->get($id) : $this->astrologers_model->all();
                $this->set_response($astrologers, REST_Controller::HTTP_OK);
                return;
            }
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }
}