<?php
class FlowTypeAction extends CommonAction {
	protected $config=array('app_type'=>'master');

	//过滤查询字段
	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])){
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	function index(){
		$model = M("FlowType");
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$list = $model -> where($map) -> select();
		$this -> assign('list', $list);
		$this -> group_list();
		$this -> display();
		return;
	}

	function mark() {
		$id = $_REQUEST["flow_type_id"];
		$val = $_REQUEST["val"];
		$field = 'group';
		$result=$this -> _set_field($id, $field, $val);
		if ($result !== false) {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功!');
		} else {
			//失败提示
			$this -> error('操作失败!');
		}
	}
	
	function _before_read(){
		$id = $_REQUEST["id"];
		$where_f['id'] = $id;
		$f_m = M('flow_type')->where($where_f)->find();
		
		$fb_check_name = D('user')->field('emp_no')->where(array('id' => $f_m['fb_check']))->find();
		$cy_check_name = D('user')->field('emp_no')->where(array('id' => $f_m['cy_check']))->find();
		$kh_check_name = D('user')->field('emp_no')->where(array('id' => $f_m['kh_check']))->find();
		//dump($fb_check_name);
		
		$history = D("ProjectHistory")->getHistory($id);
		$this->assign("flow", $f_m);
		$this->assign("flow_id", $id);
		$this->assign("state", getFlowStateById($f_m['state']));
		$this->assign("history", $history);
		$this->assign("fb_check", $fb_check_name);
		$this->assign("cy_check", $cy_check_name);
		$this->assign("kh_check", $kh_check_name);
	}
	
	function _before_edit(){
		$id = $_REQUEST["id"];
		$where_f['id'] = $id;
		$model =  M('flow_type');
		$f_m = $model->where($where_f)->find();
		$fb_check_name = D('user')->field('emp_no, id')->where(array('id' => $f_m['fb_check']))->find();
		$cy_check_name = D('user')->field('emp_no, id')->where(array('id' => $f_m['cy_check']))->find();
		$kh_check_name = D('user')->field('emp_no, id')->where(array('id' => $f_m['kh_check']))->find();
		
		$this->assign("flow", $f_m);
		$this->assign("flow_id", $id);
		$this->assign("state", getFlowStateById($f_m['state']));
		$this->assign("fb_check", $fb_check_name);
		$this->assign("cy_check", $cy_check_name);
		$this->assign("kh_check", $kh_check_name);
		
		$u_model = D('user');
		$user_list = $u_model->field('emp_no, id')->select();
		$this->assign("ulist", $user_list);
	}
	
	function switch_state(){
		$id = $_REQUEST["id"];
		$to_state = $_REQUEST["to_state"];
		$to_state_label = getFlowStateById($to_state);
		$where_f['id'] = $id;
		$model =  M('flow_type');
		$f_m = $model->where($where_f)->find();
		
		
		$this->assign("flow", $f_m);
		$this->assign("flow_id", $id);
		$this->assign("to_state", $to_state);
		$this->assign("to_state_label", $to_state_label['label']);
		$this->assign("state", getFlowStateById($f_m['state']));
		$this->display();
	}
	
	function submit_switch(){
        $flow_id = $_REQUEST["flow_id"];
		$where_f['id'] = $flow_id;
		$model =  M('flow_type');
		$f_m = $model->where($where_f)->find();
		
		dump($f_m);
	}


	function add() {
		$model = D('user');
		$user_list = $model->field('emp_no, id')->select();
		$this -> assign("ulist", $user_list);
		$this->display();
	}

	function insert() {
		$model = D('FlowType');
		
		if (false === $model -> create()) {
			$this -> error($model -> getError());
			return;
		}
		
		$user_name = get_user_name();	
		$model -> name = $_POST['name'];
		$model -> description = $_POST['desc'];
		$model->fb_check = $_POST['fb_check'];
		$model->fb_check = $_POST['fb_check'];
		$model->kh_check = $_POST['kh_check'];
		$model->state = 10;
		
		$model -> creator = $user_name;
		//保存当前数据对象
		$list = $model -> add();
		
		if ($list !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('新增成功!');
		} else {
			//失败提示
			$this -> error('新增失败!');
		}
	}
	
	function submit_update() {
	dump('update ok');return;
		$id = $_POST['id'];
		$model = D("FlowType");
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
	function group_list() {
		$model = M("FlowType");
		$where['group'] = array("neq", "");
		$group_list = $model -> where($where) -> distinct("group") -> field("group") -> select();
		$group_list = rotate($group_list);
		$group_list = array_combine($group_list["group"], $group_list["group"]);
		$this -> assign("group_list", $group_list);
	}

	/*
	

	function _before_edit() {
		$this -> group_list();
		$user_id = get_user_id();
		$this -> assign("user_id", $user_id);
	}

	function ajaxRead() {
		$type = $_REQUEST['type'];
		$id = $_REQUEST['id'];

		switch ($type) {
			case "company" :
				$model = M("Dept");
				$dept = tree_to_list(list_to_tree( M("Dept") -> select(), $id));
				$dept = rotate($dept);
				$dept = implode(",", $dept['id']) . ",$id";

				$model = M("User");
				$where['dept_id'] = array('in', $dept);
				$data = $model -> where($where) -> field('id,emp_name,dept_id,email') -> select();
				break;
			case "rank" :
				$model = M("User");
				$where['rank_id'] = array('eq', $id);
				$data = $model -> where($where) -> field('id,emp_name,email') -> select();
				break;

			case "position" :
				$model = M("User");
				$where['position_id'] = array('eq', $id);
				$data = $model -> where($where) -> field('id,emp_name,email') -> select();
				break;

			case "personal" :
				$model = M("FlowType");
				if ($id == "#")
					$id = "";
				$where['group'] = array('eq', $id);
				$where['email'] = array('neq', '');
				$where['user_id'] = array('eq', get_user_id());
				$data = $model -> where($where) -> field('id,name as emp_name,email') -> select();
				break;

			default :
		}

		if (true) {// 读取成功
			$this -> ajaxReturn($data, "", 1);
		}
	}

	function json() {
		header("Content-Type:text/html; charset=utf-8");
		$key = $_REQUEST['key'];
		$ajax = $_REQUEST['ajax'];
		//dump($ajax);

		$model = M("User");
		$where['emp_name'] = array('like', "%" . $key . "%");
		$where['letter'] = array('like', "%" . $key . "%");
		$where['email'] = array('like', "%" . $key . "%");
		$where['_logic'] = 'or';
		$company = $model -> where($where) -> field('id,emp_name as name,email') -> select();
		$model = M("FlowType");

		$where['name'] = array('like', "%" . $key . "%");
		$where['letter'] = array('like', "%" . $key . "%");
		$where['email'] = array('like', "%" . $key . "%");
		$where['_logic'] = 'or';
		$map['_complex'] = $where;
		$map['email'] = array('neq', '');
		$map['user_id'] = array('eq', get_user_id());
		$personal = $model -> where($map) -> field('id,name,email') -> select();

		if (empty($company)) {
			$company = array();
		}
		if (empty($personal)) {
			$personal = array();
		}

		$FlowType = array_merge_recursive($company, $personal);
		exit(json_encode($FlowType));
	}*/
}
?>