<?php 
// app/Controller/PeoplesController.php
App::uses('AppController', 'Controller');

class PeoplesController extends AppController {

	function all($page_num = 1) {
		$userData  = $this->Auth->user(); 
		$this->layout = 'dashboard';
		$this->set('title', 'Peoples | Buzinga Budgeting Tool');
		$peopleData = $this->get_tw_peoples($userData['api_key'], $page_num);
		$this->set('userData', $userData); 
		if($peopleData['status'] == 'OK') {
			$this->set('peopleData', $peopleData); 
			$this->set('curPage', $page_num); 
		}  else  {
			$this->Flash->error(__('Sorry, Invalid request for users list.'));
			return $this->redirect(array('controller'=>'projects', 'action' => 'all'));
		}
	}
	
	function view($pid) {
		$userData  = $this->Auth->user(); 
		$this->layout = 'dashboard';
		$this->set('title', 'View User | Buzinga Budgeting Tool');
		$this->get_tw_people_detail($userData['api_key'], $pid);
		$this->set('userData', $userData); 
		/*if($peopleData['status'] == 'OK') {
			$this->set('peopleData', $peopleData); 
			$this->set('curPage', $page_num); 
		}  else  {
			$this->Flash->error(__('Sorry, Invalid request for users list.'));
			return $this->redirect(array('controller'=>'projects', 'action' => 'all'));
		}*/
	}
	
	/////////// H E L P E R   F U N C T I O N //////////////
	function get_tw_peoples($api_key, $page_num = 1 )	{
		$endurl = "https://buzinga.teamwork.com/people.json?page=".$page_num."&pageSize=20";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );  
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		$httpRes = curl_getinfo($ch);
		
		if($httpRes['http_code'] == 200) {
			$response = array();
			list($headers, $body) = explode("\r\n\r\n", $output, 2);
			$headers = explode("\n", $headers);
			foreach($headers as $header) {
				if (stripos($header, 'X-Page:') !== false) {
					$response['pager']['page'] = (int)str_replace('X-Page: ','',$header);
				} else if (stripos($header, 'X-Pages:') !== false) {
					$response['pager']['pages'] = (int)str_replace('X-Pages: ','',$header);
				} else if (stripos($header, 'X-Records:') !== false) {
					$response['pager']['records'] = (int)str_replace('X-Records: ','',$header);
				}
			}
			$allPeople = json_decode($body)->people;
			foreach($allPeople as $k=>$v) {
				$v = (array)$v;
				$response['data'][$k]['user_id'] 		= $v['id'];
				$response['data'][$k]['first_name'] 	= $v['first-name'];
				$response['data'][$k]['last_name'] 		= $v['last-name'];
				$response['data'][$k]['email'] 			= $v['email-address'];
			}
			$response['status'] = 'OK';
		}  else  {
			$response['status'] = 'ERROR';
		}
		curl_close ( $ch );
		return $response;
	}
	
	function get_tw_people_detail($api_key, $person_id) {
		$endurl = "https://buzinga.teamwork.com/people/".$person_id	.".json";
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endurl);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: BASIC ". base64_encode( $api_key .":xxx" )));
		$output = curl_exec ( $ch );
		/*echo "<pre>"; print_r(json_decode($output)); die;*/
		curl_close ( $ch );
		return $output;
/*		$output = json_decode($output);
		if($output->STATUS == 'OK') {
			return (array)$output->project;
		} else {
			return array();
		}*/
	}
}
