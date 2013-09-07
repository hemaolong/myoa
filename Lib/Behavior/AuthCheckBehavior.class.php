<?php

 /*
  * 定义行为: 确认权限
 */

class AuthCheckBehavior extends Behavior {
	 protected $config;

     public function run(&$params){
		 //个人数据
		 $this->config=&$params;
		 
		 $app_type=$params['app_type'];		 
		 switch ($app_type){
			 case 'public':
					$auth=array('admin'=>true,'write'=>true,'read'=>true);
					$params['auth']=$auth;
					return true;
					break;			 

			 case 'personal':

					$auth=array('admin'=>true,'write'=>true,'read'=>true);
					$params['auth']=$auth;
					return true;
					break;
				 
			 case 'common':
					$action_auth=C('AUTH');	
					 if(!empty($params['action_auth'])){
						$action_auth= array_merge(C('AUTH'),$params['action_auth']); 	
					}
					$auth=$this->get_auth();
					break;			
				
			 case 'flow':
					$action_auth=C('AUTH');	
					 if(!empty($params['action_auth'])){
						$action_auth= array_merge(C('AUTH'),$params['action_auth']); 	
					}
					$auth=$this->get_auth();
					break;	

 			 case 'master':
					$action_auth=C('AUTH');	
					if(!empty($params['action_auth'])){
						$action_auth= array_merge(C('AUTH'),$params['action_auth']); 	
					}
					$auth=$this->get_auth();
					if($auth['admin']){
						return true;
					}
					break;
			default:	
				$public_list = explode(",", C('NOT_AUTH_MODULE'));
				if (in_array(MODULE_NAME, $public_list)){
					return true;
				}
				$action_auth=C('AUTH');	
				$auth=$this->get_auth();
				
	 break;
		 
			}
		if($auth[$action_auth[ACTION_NAME]]){
			$this->config['auth']=$auth;
			return true;
		}else{
			 //dump("没有权限");
			 $e['message'] ="没有权限";
			 include C('TMPL_EXCEPTION_FILE');
			 die;
		};
     }

	function get_auth(){
		if(!empty($this->config['folder_auth'])){
			$folder_id=$_REQUEST['fid'];
			if(!empty($folder_id)){
				return D("SystemFolder") ->get_folder_auth($folder_id);
			}
		}
		
		$access_list = D("Node") -> access_list();
		$access_list=array_filter($access_list,'filter_module');				
		$access_list = rotate($access_list);
		//dump($access_list);
		$module_list = $access_list['url'];
		$module_list = array_map("get_module", $module_list);
		$module_list=str_replace("_","",$module_list);
		//dump($module_list);

		$access_list_admin=array_filter(array_combine($module_list,$access_list['admin']));
		$access_list_write=array_filter(array_combine($module_list,$access_list['write']));
		$access_list_read=array_filter(array_combine($module_list,$access_list['read']));
		
		$public_list = explode(",", C('NOT_AUTH_MODULE'));
		if (in_array(MODULE_NAME, $public_list)){
			$auth['admin']=true;
		} else {
			$auth['admin']=array_key_exists(strtolower(MODULE_NAME),$access_list_admin);
			$auth['write']=array_key_exists(strtolower(MODULE_NAME),$access_list_write);
			$auth['read']=array_key_exists(strtolower(MODULE_NAME),$access_list_read);
		}

		if ($auth['admin']==true){
			$auth['write']=true;				
		}
		if ($auth['write']==true){
			$auth['read']=true;			
		}
		// Add by heml
		$auth['admin']=true;
		$auth['write']=true;
        $auth['read']=true;				
		return $auth;
	 }
 }

 ?>