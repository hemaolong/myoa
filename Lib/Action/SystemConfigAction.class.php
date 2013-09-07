<?php
class SystemConfigAction extends CommonAction {
	//过滤查询字段
	protected $config=array('app_type'=>'master');
	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['val|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}
}
?>