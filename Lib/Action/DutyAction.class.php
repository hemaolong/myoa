<?php
class DutyAction extends CommonAction {
	protected $config=array('app_type'=>'master');

	public function _search_filter(&$map) {
		if (!empty($_GET['pid'])) {
			$map['pid'] = $_POST['pid'];
		}
	}

	public function index() {
		$node = M("Duty");
		$menu = array();
		$menu = $node -> field('id,name') -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('menu', sub_tree_menu($tree));
		$this -> display();
	}
}
?>