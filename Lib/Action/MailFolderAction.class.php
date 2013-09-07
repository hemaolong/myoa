<?php
class MailFolderAction extends UserFolderAction {
	protected $config=array('app_type'=>'personal');
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['is_del'] = array('eq', '0');
	}

	public function _before_index() {
		$this -> assign("folder_name", "邮件文件夹设置");
	}
}
