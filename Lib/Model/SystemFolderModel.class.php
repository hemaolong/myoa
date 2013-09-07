<?php
class SystemFolderModel extends CommonModel {

	function get_list($folder=''){
		if(empty($folder)){
			$folder=MODULE_NAME."Folder";
		}
		$where['folder']=$folder;
		$where['is_del']=0;
        $list = $this ->where($where) -> order("sort") -> Field('id,name,pid') -> select();
		return $list;
	}
	
	function get_folder_name($folder_id){
		$where['id'] = array('eq', $folder_id);
		return $this -> where($where) -> getField("name");
	}

	function get_folder_menu(){
		$sql="		select concat('sfid_',a.id) as id,a.name,a.folder,a.sort,CONCAT('sfid_',a.pid) as pid,concat(replace(a.folder,'Folder','/folder/?fid='),a.id) as url";
		$sql.="		FROM {$this->trueTableName} AS a";
		$sql.="		WHERE  is_del=0 ";
		$sql.="		ORDER BY a.folder,a.sort ";
		$rs = $this->db->query($sql);
		$list=array();
		foreach($rs as $val){
			if ($val["pid"]=='sfid_0'){
				$where['sub_folder']=$val['folder'];
				$pid=M("Node")->where($where)->getField('id');
				$val["pid"]=$pid;
			}
			$list[]=$val;
		}
		return $list;
	}

	function get_folder_auth($folder_id){				 

		$auth_list=M("SystemFolder")->where("id=$folder_id")->Field('admin,write,read')->find();	
		$result= array_map(array("SystemFolderModel","_check_auth"),$auth_list);

		if ($result['admin']==true){
			$result['write']=true;				
		}
		if ($result['write']==true){
			$result['read']=true;			
		}
		return $result;			
	}
	
	private function _check_auth($auth_list){
			$arrtmp = explode(';', $auth_list);					
			foreach ($arrtmp as $item) {
				if (strlen($item) > 2) {
					if (stripos($item, "dept_")!==false){
						$arr_dept = explode('|', $item);
						$dept_id=substr($arr_dept[1],5);
						
						$emp_list =D("Contact")->get_dept_list($dept_id);
						$emp_list=rotate($emp_list);		
						if (in_array($_SESSION['emp_no'],$emp_list["emp_no"])){
							return true;
						}
					} else {
						if (stripos($item,$_SESSION['emp_no'])){
							return true;
						}
					}
				}
			}
			return false;		
	}
}
?>