<?php
class UserFolderModel extends CommonModel {

	public function get_list($folder){		
		$where['folder']=$folder;
		$user_id=get_user_id();
		$where['user_id']=$user_id;
        $list = $this ->where($where) -> order("sort") -> Field('id,name,pid') -> select();
		return $list;
	}
	
	public function get_folder_name($folder_id){
		$where['id'] = array('eq', $folder_id);
		return $this -> where($where) -> getField("name");
	}
	
	public function get_folder_menu(){
		$user_id=get_user_id();
		$sql="select concat('ufid_',a.id) as id,a.name,a.folder,concat('ufid_',a.pid) as pid,concat(replace(a.folder,'Folder','/folder/?fid='),a.id) as url";
		$sql.="		FROM {$this->trueTableName} AS a";
		$sql.="		WHERE  is_del=0 and user_id={$user_id}";
		$sql.="		ORDER BY a.folder,a.sort ";
		$rs = $this->db->query($sql);

		$list=array();
		foreach($rs as $val){
			if ($val["pid"]=='ufid_0'){
				$where['sub_folder']=$val['folder'];
				$pid=M("Node")->where($where)->getField('id');
				$val["pid"]=$pid;
			}
			$list[]=$val;
		}
		return $list;
	}

	public function _get_folder_auth($folder_id){				 
		return array('admin'=>true,"write"=>true,"read"=>true);	
	}
}
?>