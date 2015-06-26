<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Sendemail;

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
		
		//$query = $this->Users->find('all');
		//$datas = $query->leftJoin(['ur' => 'user_relations'],['ur.client_id = Users.id'],['Users.userPin' => $pin]);
		//$user_details=$query->first();	

		$r=$this->UserRelations->find('all',array('conditions'=>array('Client.userPin' => $pin),'contain'=>['Client','Trainer']));
		$arr = $r->toArray();
		$data = $arr[0]->toArray();
		
		echo json_encode($data);
		exit;
	}
	
	public function loginTrainer()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$this->loadModel('UserRelations');
		$pin = $this->request->data['pin'];
		
		$r=$this->UserRelations->find('all',array('conditions'=>array('Trainer.userPin' => $pin),'contain'=>['Trainer','Client']));
		$arr = $r->toArray();
		$data = $arr[0]->toArray();
		echo json_encode($data);
		exit;
	}
	
	public function present()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$user_id = $this->request->data['user_id'];
		
		$query = $this->Users->query();
		$flag = $query->update()
				->set(['is_present' => '1'])
				->where(['id' => $user_id])
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
