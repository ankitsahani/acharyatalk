<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class AuthController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model_api');
    }
    /**
     * User Register
     * @link : user/register
     */
    public function register_post()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|max_length[80]');

        $this->form_validation->set_rules('mobile', 'Mobile No', 'required|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
         $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $message = array(
                'status' => REST_Controller::HTTP_NOT_FOUND,
                'error' => $this->form_validation->error_array(),
                'message' => "Please Fill all fields"
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            date_default_timezone_set('Asia/Kolkata');

                $insert_data = [
                    'name' => $this->post('name'),
                    'email' => $this->post('email'),
                    'mobile' => $this->post('mobile'),
                    'password' => md5($this->post('password')),
                    'created_at' => date('Y-m-d H:i'),
                    'status' => 'A',
                ];
           
                $output = $this->user_model_api->insert_user($insert_data);
                if($output)
                {
                    $message = [
                        'status' => REST_Controller::HTTP_OK,
                        'message' => "User registration successful."
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                } else
                {
                    $message = [
                        'status' => REST_Controller::HTTP_NOT_FOUND,
                        'message' => "Something went to wrong. Please try again later."
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
        }
    }
    /**
     * User Login API
     * --------------------
     * @link: user/login
     */

    public function login_post()
    {
        $this->form_validation->set_rules('type', 'Mobile Or Email', 'trim|required');
        $this->form_validation->set_rules('login_type', 'Mobile=>M Or Email=>E', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => "Please Fill all fields"
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
        $email=$this->post('type');

        $user_exist = $this->user_model_api->check_user_exist($email);

        if($user_exist == FALSE ){
           date_default_timezone_set('Asia/Kolkata');
            if($this->post('login_type') == "M"){
                $insert_data = [
                    'mobile' => $email,
                    'created_at' => date('Y-m-d H:i'),
                    'status' => 'A',
                ];
           
                $output = $this->user_model_api->insert_user($insert_data);
                if($output)
                {
                    $message = [
                        'status' => REST_Controller::HTTP_OK,
                        'message' => "User registration successful."
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                } else
                {
                    $message = [
                        'status' => REST_Controller::HTTP_NOT_FOUND,
                        'message' => "Something went to wrong. Please try again later."
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }else{
                $insert_data = [
                    'email' => $email,
                    'created_at' => date('Y-m-d H:i'),
                    'status' => 'A',
                ];
           
                $output = $this->user_model->insert_user($insert_data);
                if($output)
                {
                    $message = [
                        'status' => REST_Controller::HTTP_OK,
                        'message' => "User registration successful."
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                } else
                {
                    $message = [
                        'status' => REST_Controller::HTTP_NOT_FOUND,
                        'message' => "Something went to wrong. Please try again later."
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }
                
                
        }else{
           $user = $this->user_model_api->user_login($email);
        
            if ($user != null) {
                $tokenData = array();
                $tokenData['id'] = $user->id;
                $response = Authorization::generateToken($tokenData);
                if($user->email){
                    $return_data = [
                        //'name' => $user->name,
                        'email' => $user->email,
                       // 'mobile' => $user->mobile,
                        'token'=> $response,
                    ];
                }else{
                   $return_data = [
                        //'name' => $user->name,
                        //'email' => $user->email,
                        'mobile' => $user->mobile,
                        'token'=> $response,
                    ]; 
                }
                

                    $message = [
                        'status' => REST_Controller::HTTP_OK,
                        'message' => "User login successfully",
                        'data' => $return_data,
                    ];
                    $this->set_response($message, REST_Controller::HTTP_OK);
                return; 
            }else
            {
                $message = [
                    'status' => FALSE,
                    'message' => "Invalid Username or Password"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
       }
    }
}

    /**
     * User List API
     * --------------------
     * @link: user/list
     */

    public function users_get($id=null)
    {
        $headers = $this->input->request_headers();
        
        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
        
            if ($token != false) {
                $users = ($id != null) ? $this->user_model_api->getUsers($id) : $this->user_model_api->allUsers();
                $response = [];
                foreach($users as $user){
                    $res['name']   = $user->name;
                    $res['email']  = $user->email;
                    $res['mobile'] = $user->mobile;
                    if($user->status == 'A'){
                        $res['status'] = 'Active';
                    }else{
                        $res['status'] = 'Inactive';
                    }
                    $res['created_at'] = $user->created_at;

                    $response[]['users'] = $res;

                }
                $message = [
                    'status' => REST_Controller::HTTP_OK,
                    'message' => "Users list",
                    'data' => $response,
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
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
