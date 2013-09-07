<?php
class SystemFolderAction extends CommonAction {
	protected $config = array('app_type' => 'master');
	
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['is_del'] = array('eq', '0');
	}

	function index() {
		$node = M("SystemFolder");
		$menu = array();
		$where['folder'] = MODULE_NAME;
		$menu = $node -> where($where) -> field('id,pid,name') -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('menu', sub_tree_menu($tree));

		$model = M("SystemFolder");
		$list = $model -> where($where) -> getField('id,name');
		$this -> assign('folder_list', $list);
		$this -> display("SystemFolder:index");
	}

	protected function _insert() {
		$model = D("SystemFolder");
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		//保存当前数据对象
		$model -> folder = MODULE_NAME;
		$list = $model -> add();
		if ($list !== false) {//保存成功.
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('新增成功!');
		} else {
			//失败提示
			$this -> error('新增失败!');
		}
	}

	protected function _update() {
		$model = D("SystemFolder");
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		// 更新数据
		$list = $model -> save();
		if (false !== $list) {
			//成功提示
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('编辑成功!');
		} else {
			//错误提示
			$this -> error('编辑失败!');
		}
	}

	function read() {
		$model = M("SystemFolder");
		$id = $_REQUEST["id"];
		$data = $model -> getById($id);
		if ($data !== false) {// 读取成功
			$this -> ajaxReturn($data, "", 1);
		}
	}

	function winpop() {
		$node = M("SystemFolder");
		$menu = array();
		$where['folder'] = MODULE_NAME;
		$menu = $node -> where($where) -> field('id,pid,name') -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('menu', popup_tree_menu($tree));
		$this -> display("SystemFolder:winpop");
	}

}
