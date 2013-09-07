<?php
// 用户模型
class SystemTagModel extends CommonModel {
	public function get_list($field="id,name",$module=MODULE_NAME){		
		$where['module']=$module;
		$list=$this->where($where)-> order('sort asc')->getfield($field);
		return $list;
	}

	public function get_data_list($module=MODULE_NAME,$tag_id=null){
		$model=M("SystemTagData");
		$where="tag.module='$module'";
		if(!empty($tag_id)){
			$where.=" and tag_id=$tag_id";
		}
		$join='join '.$this->tablePrefix.'system_tag tag on tag_id=tag.id';
		$list=$model->join($join)->where($where)->field("row_id,tag_id")->select();
		return $list;
	}

	function del_data_by_row($row_list,$module=MODULE_NAME){
		$model=M("SystemTagData");
		$where['row_id']=array('in',$row_list);
		$where['module']=$module;
		$result=$model->where($where)->delete();
		return $result;
	}
	
	function del_tag($tag_id){
		$model = M("SystemTag");		
		$tag_list = tree_to_list(list_to_tree($this->get_list("id,pid,name"), $tag_id));
		$tag_list = rotate($tag_list);
		
		$tag_list = implode(",", $tag_list['id']) . ",$tag_id";	
		$where['id']=array('in',$tag_list);
		$this->where($where)->delete();
		$this->del_data_by_tag($tag_list);
	}

	function del_data_by_tag($tag_list){
		$model=M("SystemTagData");
		if (is_array($tag_list)){
			$tag_list=array_filter($tag_list);
		}else{
			$tag_list=explode(",",$tag_list);
		}
		$where['tag_id']=array('in',$tag_list);
		$result=$model->where($where)->delete();
		return $result;			
	}

	function set_tag($row_list,$tag_list,$module=MODULE_NAME){
		if(empty($row_list)){
			return true;
		}
		if(empty($tag_list)){
			return true;
		}
		if (is_array($row_list)){
			$row_list=array_filter($row_list);
		}else{
			$row_list=explode(",",$row_list);
			$row_list=array_filter($row_list);
		}
		$row_list=implode(",",$row_list);
		if (is_array($tag_list)){
			$tag_list=array_filter($tag_list);
		}else{
			$tag_list=explode(",",$tag_list);
			$tag_list=array_filter($tag_list);
		}
		$tag_list=implode(",",$tag_list);
		$where = 'a.id in ('.$row_list.') AND b.id in('.$tag_list.')';
		$sql='INSERT INTO '.$this->tablePrefix.'system_tag_data (row_id,module,tag_id) SELECT a.id,b.module,b.id ';
		$sql.=' FROM '.$this->tablePrefix.$module.' a, '.$this->tablePrefix.'system_tag b WHERE '.$where;
		
		$result = $this->execute($sql);
		if($result===false){
			return false;
		}else {
			return true;
		}
	}
}
?>