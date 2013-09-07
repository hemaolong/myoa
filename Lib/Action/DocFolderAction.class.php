<?php
class DocFolderAction extends SystemFolderAction {
	protected $config=array('app_type'=>'master','action_auth'=>array('winpop'=>'admin'));
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['is_del'] = array('eq', '0');
	}

	public function _before_index() {
		$this -> assign("folder_name", "文档库设置");
	}
}
