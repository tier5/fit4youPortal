<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Sendemail;
use Cake\I18n\Time;

// src/Controller/UsersController.php

class WebservicesController extends AppController
{
	var $uses=array('User');

	

	////////// login page

	public function index()
	{
		$this->autoRender = false;
		
		
	
	}
	
	public function loginClient()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('UserRelations');
		$pin = $this->request->data['pin'];
		
		
				
		if ($this->Users->find('all',['conditions' => ['userPin' => $pin,'role' => 'CLIENT', 'is_active' => '1']])->count())
		{
			$client_data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
			
			$query = $this->Users->query();
			$flag = $query->update()
				->set(['is_login' => '1'])
				->where(['userPin' => $pin])
				->execute();
			
						
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '1'])
				->where(['client_id' => $client_data['id'],'start_time <=' => date('Y-m-d H:i:s',strtotime('+1 hours')) ])
				->execute();
			
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '0'])
				->where(['client_id' => $client_data['id'],'end_time <' => date('Y-m-d H:i:s') ])
				->execute();
			
			
			$r=$this->UserRelations->find('all',array('conditions'=>array('Client.userPin' => $pin, 'Client.is_active' => '1','UserRelations.status' => '1'),'contain'=>['Client','Trainer']));
			$arr = $r->toArray();
			if(empty($arr))
			{
				$data['client'] = $client_data;
				$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$client_data['photo'];
				$data['client']['msg'] = 'You dont have any existing session';
				//cho '<pre>';print_r($data);exit;
				echo json_encode($data);
				exit;
			}
			$data = $arr[0]->toArray();
			
			if($data['id'])
			{
				$start_time = get_object_vars($data['start_time']);
				$end_time = get_object_vars($data['end_time']);
				$data['status'] = '1';
				$data['start_time'] =  $start_time['date'];
				$data['end_time'] =  $end_time['date'];
				$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['client']['photo'];
				$data['trainer']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['trainer']['photo'];
				//echo '<pre>';print_r($data);exit;
				echo json_encode($data);
				exit;
			}
			else
			{
				echo json_encode(['status'=>0,'msg'=>'Sorry there is some error.Try later']);
				exit;
				
			}
		}
		else
		{
			echo json_encode(['status'=>0,'msg'=>'Sorry PIN does not match']);
			exit;	
		}
		
	}
	
	public function loginTrainer()
	{
		
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('UserRelations');
		$pin = $this->request->data['pin'];

		
		if ($this->Users->find('all',['conditions' => ['userPin' => $pin,'role' => 'TRAINER', 'is_active' => '1']])->count())
		{
			$trainer_data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
			
			$query = $this->Users->query();
			$flag = $query->update()
				->set(['is_login' => '1'])
				->where(['userPin' => $pin])
				->execute();
			
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '1'])
				->where(['trainer_id' => $trainer_data['id'],'start_time <=' => date('Y-m-d H:i:s',strtotime('+1 hours')) ])
				->execute();
				
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '0'])
				->where(['trainer_id' => $trainer_data['id'],'end_time <' => date('Y-m-d H:i:s'), ])
				->execute();
				
			$r=$this->UserRelations->find('all',array('conditions'=>['Trainer.userPin' => $pin, 'Trainer.is_active' => '1','UserRelations.status' => '1'],'contain'=>['Trainer','Client']));
			$arr = $r->toArray();
			if(empty($arr))
			{
				
				$data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
				$data['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['photo'];
				$data['msg'] = 'You dont have any existing session';
				echo json_encode($data);
				exit;
			}
			$data = $arr[0]->toArray();
			//echo '<pre>';print_r($data);echo '<pre>';exit;
			if($data['id'])
			{
				$start_time = get_object_vars($data['start_time']);
				$end_time = get_object_vars($data['end_time']);
				$data['status'] = '1';
				$data['start_time'] =  $start_time['date'];
				$data['end_time'] =  $end_time['date'];
				$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['client']['photo'];
				$data['trainer']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['trainer']['photo'];
				echo json_encode($data);
				exit;
			}
			else
			{
				echo json_encode(['status'=>0,'msg'=>'Sorry there is some error.Try later']);
				exit;
				
			}
		}
		else
		{
			echo json_encode(['status'=>0,'msg'=>'Sorry PIN does not match']);
			exit;
			
		}
	}
	
	public function present()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$pin = $this->request->data['pin'];
		
		$query = $this->Users->query();
		$flag = $query->update()
				->set(['is_present' => '1'])
				->where(['pin' => $pin])
				->execute();

		if(!empty($flag))
		{
			echo json_encode(['is_present'=>1,'msg'=>'Your presence registered successfully.']);
			exit;
			
		}
		else
		{
			echo json_encode(['is_present'=>0,'msg'=>'Sorry there is some error.Try later']);
			exit;
			
		}
		
	}
	


}
