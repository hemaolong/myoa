<?php
// 角色模块
class RoleAction extends CommonAction {
	protected $config=array('app_type'=>'master',
											 'action_auth'=>array('node'=>'admin',
																				'get_node_list'=>'admin',
																				'user'=>'admin',
																				'duty'=>'admin',
																				'get_role_list'=>'admin',
																				'get_duty_list'=>'admin',
																				)
											 );
	public function node() {
		$node_model = M("Node");
		if (!empty($_POST['s_pid'])) {
			$pid = $_POST['s_pid'];
		} else {
			$pid = $node_model -> where('pid=0') -> order('sort asc') -> getField('id');
		}

		$node_list = tree_to_list(list_to_tree($node_model -> select(), $pid));
		$node_list = rotate($node_list);

		$node_list = implode(",", $node_list['id']) . ",$pid";

		$where['id'] = array('in', $node_list);
		$menu = $node_model -> field('id,pid,name,url') -> where($where) -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('pid', $pid);

		$list = tree_to_list($tree);
		$this -> assign('node_list', $list);
		//$this->assign('menu',sub_tree_menu($list));

		$role = M("Role") -> select();
		$this -> assign('list', $role);

		$list = $node_model -> where('pid=0') -> order('sort asc') -> getField('id,name');
		$this -> assign('groupList', $list);
		$this -> display();
	}

	public function get_node_list() {
		$role_id = $_POST["role_id"];
		$model = D("Role");
		$data = $model -> get_node_list($role_id);
		if ($data !== false) {// 读取成功
			$this -> ajaxReturn($data, "", 1);
		}
	}

	public function set_node() {

		$role_id = $_POST["role_id"];
		$org_list = $_POST["org_node_list"];
		$node_list = $_POST["node_list"];
		$admin_list = $_POST["admin"];
		$write_list = $_POST["write"];
		$read_list = $_POST["read"];

		$model = D("Role");
		$model -> del_node($role_id, $org_list);

		$result = $model -> set_node($role_id, $node_list);

		$model = M("RoleNode");
		$where['role_id'] = $role_id;

		$where['node_id'] = array('in', $admin_list);
		$model -> where($where) -> setField('admin', 1);

		$where['node_id'] = array('in', $write_list);
		$model -> where($where) -> setField('write', 1);

		$where['node_id'] = array('in', $read_list);
		$model -> where($where) -> setField('read', 1);

		if ($result === false) {
			$this -> error('操作失败！');
		} else {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功！');
		}
	}

	public function get_role_list() {
		$model = D("Role");
		$id = $_REQUEST["id"];
		$data = $model -> get_role_list($id);
		if ($data !== false) {// 读取成功
			$this -> ajaxReturn($data, "", 1);
		}
	}

	public function set_role() {
		$emp_list = $_POST["emp_id"];
		$role_list = $_POST["role_list"];
		$model = D("Role");
		$model -> del_role($emp_list);

		$result = $model -> set_role($emp_list, $role_list);
		if ($result === false) {
			$this -> error('操作失败！');
		} else {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功！');
		}
	}

	public function user() {
		$keyword = "";
		if (!empty($_POST['keyword'])) {
			$keyword = $_POST['keyword'];
		}
		$user_list = D("User") -> get_user_list($keyword);
		$this -> assign("user_list", $user_list);

		$role = M("Role");
		$role_list = $role -> select();
		$this -> assign("role_list", $role_list);
		$this -> display();
	}

	public function duty() {
		$duty = M("Duty");
		$duty_list = $duty -> select();
		$this -> assign("duty_list", $duty_list);

		$role = M("Role") -> select();
		$this -> assign('list', $role);
		$this -> display();
	}

	public function get_duty_list() {
		$role_id = $_POST["role_id"];
		$model = D("Role");
		$data = $model -> get_duty_list($role_id);
		if ($data !== false) {// 读取成功
			$this -> ajaxReturn($data, "", 1);
		}
	}

	public function set_duty() {
		$role_id = $_POST["role_id"];
		$duty_list = $_POST["duty_list"];

		$model = D("Role");
		$model -> del_duty($role_id);

		$result = $model -> set_duty($role_id, $duty_list);
		if ($result === false) {
			$this -> error('操作失败！');
		} else {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功！');
		}
	}

}
?>