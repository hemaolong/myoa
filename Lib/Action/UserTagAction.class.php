<?php
class UserTagAction extends CommonAction {
	protected $config=array('app_type'=>'public');
	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['code|name'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}
}
?>