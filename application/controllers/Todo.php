<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Todo extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('todo_model');
    }

    public function index_get($id = null)
    {
        $headers = $this->input->request_headers();
        
        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
        
            if ($token != false) {
                $todo = ($id != null) ? $this->todo_model->get($id) : $this->todo_model->all($token->id);
                $this->set_response($todo, REST_Controller::HTTP_OK);
                return;
            }
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }

    public function addTodo_post()
    {
        $headers = $this->input->request_headers();
        $this->form_validation->set_rules('todo', 'Todo', 'required');
        $this->form_validation->set_rules('done', 'Done', 'required|max_length[100]');
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
        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
                $data=array(
                    'user_id'=>$token->id,
                    'todo'=>$this->post('todo'),
                    'done' =>$this->post('done')
                    ); 
                $result = $this->todo_model->create($data, $token);
                
                if($result){
                    $message = [
                    'status' => REST_Controller::HTTP_OK,
                    'message' => 'Data Added Successfully.',
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
                return;
                }

                
            }

            $response = [
                'status' => REST_Controller::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized',
            ];
            $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }
  }
}
