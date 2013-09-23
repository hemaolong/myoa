<?php
/* class SystemTagAction extends CommonAction {
	protected $config=array('app_type'=>'public');
		
	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['code|name'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function tag_manage() {
		if ($_POST) {
			$opmode = $_POST["opmode"];
			$model = D("SystemTag");
			if (false === $model -> create()) {
				$this -> error($model -> getError());
			}
			if ($opmode == "add") {
				$model -> module = MODULE_NAME;
				$list = $model -> add();
			}
			if ($opmode == "edit") {
				$list = $model -> save();
			}
			if ($opmode == "del") {
				$tag_id = $model -> id;
				$model -> del_tag($tag_id);
			}
		}
		$model = D("SystemTag");
		$tag_list = $model -> get_list("id,pid,name");
		$tree = list_to_tree($tag_list);
		$this -> assign('menu', sub_tree_menu($tree));

		$tag_list = $model -> get_list();
		$this -> assign("tag_list", $tag_list);
		$this -> display('Systemtag:tag_manage');
	}

	function winpop() {
		$model = M("SystemTag");
		$module = $_GET['module'];
		$where['module'] = array('eq', $module);
		$menu = $model -> where($where) -> field('id,pid,name') -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('menu', popup_tree_menu($tree));
		$this -> display();
	}

	function popup() {
		$model = M("SystemTag");
		$module = $_GET['module'];
		$where['module'] = array('eq', $module);
		$list = array();
		$list = $model -> where($where) -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_popup', sub_tree_menu($list));
		$this -> display();
		return;
	}

} */
?>