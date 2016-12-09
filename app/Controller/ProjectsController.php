<?php 
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class ProjectsController extends AppController {

	public function isAuthorized($user) {
		// All registered users can add posts
		if ($this->action === 'add') {
			return true;
		}

		// The owner of a post can edit and delete it
		if (in_array($this->action, array('edit', 'delete'))) {
			$postId = (int) $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
	
	function all() { 
		$userData  = $this->Auth->user(); 
		$this->layout = 'dashboard';
		$this->set('title', 'Projects | Buzinga Budgeting Tool');
		$this->set('userData', $userData);
		
		$userProjects = json_decode($this->get_tw_projects($userData['api_key']));
		if($userProjects->STATUS == 'OK') {
			$userProjects->projects = (array)$userProjects->projects;
			$this->set('userProjects', $userProjects->projects);
		}  else  {
			$this->Flash->error(__('Sorry, Invalid request.'));
			$this->set('userProjects', array());
		}
	}
	
	function view($id, $tab = 'overview') { 
		$userData  = $this->Auth->user(); 
		$this->layout = 'dashboard';
		$this->set('title', 'Projects Detail | Buzinga Budgeting Tool');
		$this->set('userData', $userData);
		$this->set('projectId', $id);
		
		$res = $this->get_tw_project_detail($userData['api_key'], $id);
		if(!empty($res)) {
			$this->set('project_detail', $res); 
			switch($tab) { 
			  case 'overview':
				$this->render('view_overview');
			  break;
			  case 'users':
				$project_users = $this->get_tw_project_users_detail($userData['api_key'], $id);
				$this->set('project_users', $project_users); 
				$this->render('view_users');
			  break;
			  case 'budget':
				$this->render('view_budget');
			  break; 
			  default:
				return $this->redirect(array('controller'=>'projects', 'action' => 'view',$id));
			  break;
			}
		}  else  {
			$this->Flash->error(__('Sorry, this project id doesn\'t exist.'));
			return $this->redirect(array('controller'=>'projects', 'action' => 'all'));
		}
		/*$userProjects = json_decode($this->get_tw_projects($userData['api_key']));
		if($userProjects->STATUS == 'OK') {
			$userProjects->projects = (array)$userProjects->projects;
			$this->set('userProjects', $userProjects->projects);
		}  else  {
			$this->set('userProjects', array());
		}*/
	}
	
	
	/////////// H E L P E R   F U N C T I O N //////////////
	function get_tw_projects($api_key)	{
		$endurl = "https://buzinga.teamwork.com/projects.json";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		return $output;
	}
	
	function get_tw_project_detail($api_key, $project_id) {
		$endurl = "https://buzinga.teamwork.com/projects/".$project_id	.".json?includePeople=true";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		$output = json_decode($output);
		if($output->STATUS == 'OK') {
			return (array)$output->project;
		} else {
			return array();
		}
	}
	
	function get_tw_project_users_detail($api_key, $project_id) {  // users is a array list
		$endurl = "https://buzinga.teamwork.com/projects/".$project_id."/people.json";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		$output = json_decode($output);
		curl_close ( $ch );
		return $output;
	}
}
