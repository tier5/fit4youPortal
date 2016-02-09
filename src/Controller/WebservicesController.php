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
	
	
	public function beforeFilter(Event $event)
	{		
		parent::beforeFilter($event);
		
		// If you want all methods to be allowed for this controller
		$this->Auth->allow();
		
	}
	
	

	////////// login page

	public function index()
	{
		
		$this->autoRender = false;
	
	}
	
	// Created to test the service and JSON response on a web client
	public function loginClientTest()
	{
		$this->autoLayout = false;
		
	}
	
	
	public function loginTrainerTest()
	{
		$this->autoLayout = false;
		
	}
	
	public function loginClient()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('UserRelations');
		
		if(isset($this->request->data['pin']))
		{
			$pin = $this->request->data['pin'];
			
			if ($this->Users->find('all', ['conditions' => ['userPin' => $pin, 'role' => 'CLIENT', 'is_active' => '1']])->count())
			{
				
				
				$client_data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
				
				$query = $this->Users->query();
				$flag = $query->update()
					->set(['is_login' => '1'])
					->where(['userPin' => $pin])
					->execute();
					
					
				
				//print_r($client_data);
				//exit;
				
				
				
				$query = $this->UserRelations->query();
				//$query->first();
				//debug($query->first());
				$flag = $query->update()
					->set(['status' => '1'])
					->where(['start_time <=' => date('Y-m-d H:i:s',strtotime('+'.$this->settings['xtime'].' minutes')) ])
					->orWhere(['start_time >=' => date('Y-m-d H:i:s',strtotime('-'.$this->settings['ytime'].' minutes'))])
					->andWhere(['client_id' => $client_data['id']])
					->andWhere(['status' => '0'])
					->execute();
					
				
				
				$query = $this->UserRelations->query();
				$flag = $query->update()
					->set(['status' => '0'])
					->where(['start_time <' => date('Y-m-d H:i:s',strtotime('-'.$this->settings['ytime'].' minutes'))])
					->orWhere(['start_time >' => date('Y-m-d H:i:s',strtotime('+'.$this->settings['xtime'].' minutes'))])
					->andWhere(['client_id' => $client_data['id']])
					->execute();
					
				
				
				
				$r = $this->UserRelations->find('all',array('conditions'=>['Client.userPin' => $pin, 
				'Client.is_active' => '1',
				'UserRelations.start_time >' => date('Y-m-d H:i:s', strtotime('-'.$this->settings['ytime'].' minutes'))],'contain'=>['Client','Trainer']))->order(['UserRelations.start_time' => 'ASC'])->first();
				if($r)
				{
					$data = $r->toArray();
					
					if($data['id'])
					{
						$data['success'] = '1';
						$data['xtime'] = $this->settings['xtime'];
						$data['ytime'] = $this->settings['ytime'];
						$start_time = get_object_vars($data['start_time']);
						$end_time = get_object_vars($data['end_time']);
						$data['start_time'] =  $start_time['date'];
						$data['end_time'] =  $end_time['date'];
						if(!empty($data['client']['photo']))
						{
							$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['client']['photo'];
						}
						else
						{
							$data['client']['photo'] = '';
						}
						
						if(!empty($data['trainer']['photo']))
						{
							$data['trainer']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['trainer']['photo'];
						}
						else
						{
							$data['trainer']['photo'] = '';
						}
						
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
					$data['trainer'] = array();
					$data['client'] = array();
					$data['client'] = $client_data;
					if(!empty($client_data['photo']))
					{
						$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$client_data['photo'];
					}
					else
					{
						$data['client']['photo'] = '';
					}
					
					$data['start_time'] = '';
					$data['end_time'] = '';
					$data['status'] = '';
					$data['xtime'] = '';
					$data['ytime'] = '';
					$data['trainer_id'] = $client_data['id'];
					$data['client_id'] = '';
					$data['trainer'] =[
						'id' 		=> '',
						'firstName' 	=> '',
						'lastName' 	=> '',
						'userPin' 	=> '',
						'city' 		=> '',
						'state' 	=> '',
						'zip' 		=> '',
						'address' 	=> '',
						'photo' 	=> '',
						'status' 	=> '',
						
					];
					$data['success'] = '1';
					echo json_encode($data);
					exit;
					
				}	
				
				
			}
			else
			{
				echo json_encode(['success'=>0,'msg'=>'Sorry PIN does not match']);
				exit;	
			}
			
		
		}
		else{
			echo json_encode(['success'=>0,'msg'=>'Sorry PIN does not match']);
			exit;	
		}
		
	}
	
	public function loginTrainer()
	{
		
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('UserRelations');
		$pin = $this->request->data['pin'];

		
		if ($this->Users->find('all',['conditions' => ['userPin' => $pin, 'role' => 'TRAINER', 'is_active' => '1']])->count())
		{
			$data['success'] = '1';
			
			$trainer_data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
			
			$query = $this->Users->query();
			$flag = $query->update()
				->set(['is_login' => '1'])
				->where(['userPin' => $pin])
				->execute();
			
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '1'])
				->where(['start_time <=' => date('Y-m-d H:i:s',strtotime('+'.$this->settings['xtime'].' minutes')) ])
				->orWhere(['start_time >=' => date('Y-m-d H:i:s',strtotime('-'.$this->settings['ytime'].' minutes'))])
				->andWhere(['trainer_id' => $trainer_data['id']])
				->andWhere(['status' => '0'])
				->execute();
			
			$query = $this->UserRelations->query();
			$flag = $query->update()
				->set(['status' => '0'])
				->where(['start_time <' => date('Y-m-d H:i:s',strtotime('-'.$this->settings['ytime'].' minutes'))])
				->orWhere(['start_time >' => date('Y-m-d H:i:s',strtotime('+'.$this->settings['xtime'].' minutes'))])
				->andWhere(['trainer_id' => $trainer_data['id']])
				->execute();
			
			
			$r=$this->UserRelations->find('all',array('conditions'=>['Trainer.userPin' => $pin, 'Trainer.is_active' => '1','UserRelations.start_time >' => date('Y-m-d H:i:s',strtotime('-'.$this->settings['ytime'].' minutes'))],'contain'=>['Client','Trainer']))->order(['UserRelations.start_time' => 'ASC'])->first();
			if($r)
			{
				$data = $r->toArray();
				if($data['id'])
				{
					$data['success'] = '1';
					$data['xtime'] = $this->settings['xtime'];
					$data['ytime'] = $this->settings['ytime'];
					$start_time = get_object_vars($data['start_time']);
					$end_time = get_object_vars($data['end_time']);
					$data['start_time'] =  $start_time['date'];
					$data['end_time'] =  $end_time['date'];
					if(!empty($data['client']['photo']))
					{	
						$data['client']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['client']['photo'];
					}
					else
					{
						$data['client']['photo'] = '';
					}
					if(!empty($data['trainer']['photo']))
					{
						$data['trainer']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$data['trainer']['photo'];
					}
					else
					{
						$data['trainer']['photo'] = '';
					}
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
				$data['trainer'] = array();
				$data['client'] = array();
				$data['trainer'] = $trainer_data;
				if(!empty($trainer_data['photo']))
				{
					$data['trainer']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$trainer_data['photo'];
				}
				else
				{
					$data['trainer']['photo'] = '';
				}
				
				$data['start_time'] = '';
				$data['end_time'] = '';
				$data['status'] = '';
				$data['xtime'] = '';
				$data['ytime'] = '';
				$data['client_id'] = '';
				$data['trainer_id'] = $trainer_data['id'];
				$data['client'] =[
					'id' 		=> '',
					'firstName' 	=> '',
					'lastName' 	=> '',
					'userPin' 	=> '',
					'city' 		=> '',
					'state' 	=> '',
					'zip' 		=> '',
					'address' 	=> '',
					'photo' 	=> '',
				];
				$data['success'] = '1';
				echo json_encode($data);
				exit;
				
			}
		}
		else
		{
			echo json_encode(['success'=>0,'msg'=>'Sorry PIN does not match']);
			exit;
			
		}
	}
	
	public function present()
	{
		$this->autoRender = false;
		$this->loadModel('UserRelations');
		$id = $this->request->data['id'];
		
		$query = $this->UserRelations->query();
		$flag = $query->update()
				->set(['status' => '2'])
				->where(['id' => $id])
				->execute();
		$update = $flag->rowCount();
		if(!empty($update))
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
	
	public function missed()
	{
		$this->autoRender = false;
		$this->loadModel('UserRelations');
		$id = $this->request->data['id'];
		
		$query = $this->UserRelations->query();
		$flag = $query->update()
				->set(['status' => '3'])
				->where(['id' => $id])
				->execute();
		$update = $flag->rowCount();
		if(!empty($update))
		{
			echo json_encode(['is_present'=>2,'msg'=>'Missed.']);
			exit;
			
		}
		else
		{
			echo json_encode(['is_present'=>0,'msg'=>'Sorry there is some error.Try later']);
			exit;
			
		}
		
	}
	
	public function adminLogin()
	{
		
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('Gyms');
		$pin = $this->request->data['pin'];

		
		if ($this->Users->find('all',['conditions' => ['userPin' => $pin,'role' => 'ADMIN', 'is_active' => '1']])->count())
		{
			$admin_data = $this->Users->find('all',['conditions' => ['userPin' => $pin]])->first()->toArray();
			$gym_data = $this->Gyms->find('all',['conditions' => ['is_active' => '1']])->toArray();
			
			$data['status'] = '1';
			$data['admin_data'] = $admin_data;
			if($admin_data['photo'])
			{
				$data['admin_data']['photo'] = BASE_URL.'uploads/images/users_profile/thumb/'.$admin_data['photo'];
			}
			else
			{
				$data['admin_data']['photo'] = '';
			}
			$data['gym_data'] = $gym_data;
			
			$query = $this->Users->query();
			$flag = $query->update()
				->set(['is_login' => '1'])
				->where(['id' => $admin_data['id']])
				->execute();
				
			echo json_encode($data);
			exit;
				
		}
		else
		{
			echo json_encode(['status'=>0,'msg'=>'Sorry PIN does not match']);
			exit;
			
		}
		
		
		
	}
	
	public function currentGym()
	{
		
		$this->autoRender = false;
		$this->loadModel('Gyms');
		$id = $this->request->data['id'];

		
		if ($this->Gyms->find('all',['conditions' => ['id' => $id,'is_active' => '1']])->count())
		{
			$query = $this->Gyms->query();
			$flag = $query->update()
				->set(['current' => '1'])
				->where(['id' => $id])
				->execute();
			
			$query = $this->Gyms->query();
			$flag = $query->update()
				->set(['current' => '0'])
				->where(['id !=' => $id])
				->execute();
				
			$gym_data = $this->Gyms->find('all',['conditions' => ['is_active' => '1']])->toArray();
			$data['status'] = '1';
			$data['gym_data'] = $gym_data;
			echo json_encode($data);
			exit;
				
		}
		else
		{
			echo json_encode(['status'=>0,'msg'=>'Sorry PIN does not match']);
			exit;
			
		}
		
		
		
	}


}
