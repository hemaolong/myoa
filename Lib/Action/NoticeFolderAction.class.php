<?php
class NoticeFolderAction extends SystemFolderAction {
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['is_del'] = array('eq', '0');
	}

	function _before_index() {
		$this -> assign("folder_name", "公告栏管理");
	}
}
