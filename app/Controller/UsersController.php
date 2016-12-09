<?php 
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
         $this->Auth->allow('login', 'add', 'logout', 'tw_authenticate', 'tw_register');
         $this->Auth->fields = array('username' => 'user_name', 'password' => 'password');  

    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
    

 
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    
	public function login() {
		$this->layout = 'landing';
		if(!empty($this->Auth->user())) {
			return $this->redirect(array('controller' => 'projects', 'action' => 'all'));
		}
		if ($this->request->is('post')) {
			$data = $this->request->data; 
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'), array('key' => 'tw_auth'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
 
	//==========================================
	
	// STEP 1 - Registration Authentication from Teamwork
	public function tw_authenticate() {
		$this->layout = 'landing';
		if(!empty($this->Auth->user())) {
			return $this->redirect(array('controller' => 'projects', 'action' => 'all'));
		}
        if ($this->request->is('post')) {
			
			// Check 1 : is it already exist in Database or not ? 
			$getUserDetail = $this->User->find('first', array('conditions' => array('User.user_name' => $this->request->data['User']['email_id'])));
			
			if(empty($getUserDetail)) {
				// Check 2 : Authenticate by TeamWork API
				$teamwork_user_detail = $this->get_tw_authentication($this->request->data['User']['email_id'], $this->request->data['User']['api_key']);
				if($teamwork_user_detail['status'] == true ) {
					$this->redirect(array('controller' => 'users','action' => 'tw_register', '?' => array('data' => base64_encode(json_encode(array('id'=>$teamwork_user_detail['uid'],'apikey'=>$this->request->data['User']['api_key'], 'email'=>$this->request->data['User']['email_id']))))));
				}	else 	{
					$this->Flash->error(__('Sorry! Invalid teamwork account or API key.'), array('key' => 'tw_auth'));
				}
				
/*				echo "<pre>"; print_r($teamwork_user_detail); die;
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(
					__('The user could not be saved. Please, try again.')
				);*/
            } else {
				$this->Flash->error(__('Sorry! This email address is already registered with Budgeting tool.'), array('key' => 'tw_auth'));
			}
            
        }
    }

    // STEP 2 - Registration Completion
    public function tw_register() {
		$this->layout = 'landing'; 
		if(!empty($this->Auth->user())) {
			return $this->redirect(array('controller' => 'projects', 'action' => 'all'));
		}
		if(!empty($this->request->query['data']) && isset($this->request->query['data'])) {
			$reqData = json_decode(base64_decode($this->request->query['data']));
			if(isset($reqData->id) && isset($reqData->apikey) && isset($reqData->email)) {
				if($this->get_user_exists($reqData->email) == false) {
					$getUserDetail = json_decode($this->get_tw_people($reqData->id, $reqData->apikey));
					if($getUserDetail->STATUS == 'OK') {
						$getUserDetail = (array)$getUserDetail->person;
					} else {
						$getUserDetail = array('first-name'=>'','last-name'=>'');
					}
					$reqData->first_name = $getUserDetail['first-name'];
					$reqData->last_name  = $getUserDetail['last-name'];
					//echo "<pre>"; print_r($reqData); die;
					$this->set('reqData',$reqData);
					if ($this->request->is('post')) { 
						$userData = array('User'=>array(
						//'id_user'=>$this->request->data['User']['user_id'],
						'user_name'		=>	$this->request->data['User']['username'],
						'password'		=>	$this->request->data['User']['password'],
						'api_key'		=>	$this->request->data['User']['api_key'],
						'first_name'	=>	$this->request->data['User']['first_name'],
						'last_name'		=>	$this->request->data['User']['last_name'],
						));
						$this->User->create();
						if ($this->User->save($userData)) {
							$this->Flash->success(__('User has been registered successfully.'), array('key' => 'tw_auth'));
							return $this->redirect(array('action' => 'login'));
						}
						$this->Flash->error(
							__('The user could not be saved. Please, try again.'), array('key' => 'tw_auth')
						);
					}
				}  else  {
					$this->Flash->error(__('Sorry, this user is already registered.'), array('key' => 'tw_auth'));
					$this->redirect(array('controller' => 'users','action' => 'tw_authenticate'));
				}
			} else {
				$this->Flash->error(__('Invalid request! Please try again.'), array('key' => 'tw_auth'));
				$this->redirect(array('controller' => 'users','action' => 'tw_authenticate'));
			}
		} else {
			$this->redirect(array('controller' => 'users','action' => 'tw_authenticate'));
		}
	}
	
	function get_tw_authentication($email_id, $api_key)  // aran614planet
	{
		$endurl = "https://buzinga.teamwork.com/authenticate.json";
		//$api_key = "wages67norway";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl); 
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		$accountDetail = json_decode($output);
		
		// Check - is this api_key exist in teamwork or not ?
		if(!empty($accountDetail) && ($accountDetail->STATUS == 'OK') && (isset($accountDetail->account))) {
			$userProfileDetail = $this->get_tw_people($accountDetail->account->userId,$api_key);
			$userProfileDetail = json_decode($userProfileDetail);
			
			// If exits, fetch user detail by userId
			if((!empty($userProfileDetail)) && ($userProfileDetail->STATUS == 'OK') && (isset($userProfileDetail->person))) {
				$userProfileDetail->person= (array)$userProfileDetail->person;
				// Check - User Email id exist with input Email id
				if($userProfileDetail->person['email-address'] == $email_id ) {
					return array('status'=>true,'uid'=>$accountDetail->account->userId);
				}	else  {
					return array('status'=>false);
				}
			} else {
				return array('status'=>false);
			}
		} else {
			return array('status'=>false);
		}
	}
	
	function get_tw_people($uid, $api_key)  
	{
		$endurl = "https://buzinga.teamwork.com/people/".$uid.".json";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		return $output;
	}
	
	function get_user_exists($email){
		$getUserDetail = $this->User->find('first', array('conditions' => array('User.user_name' => $email)));
		if(!empty($getUserDetail['User']) && isset($getUserDetail['User'])) {
			return true;
		} else {
			return false;
		}
	}

	function tw_getwebhookevents($api_key)  // aran614planet
	{
		$endurl = "https://buzinga.teamwork.com/webhooks/events.json";
		//$api_key = "wages67norway";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		return $output;
	}
	 
}
