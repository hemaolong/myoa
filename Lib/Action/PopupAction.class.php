<?php
class PopupAction extends CommonAction {
	protected $config=array('app_type'=>'personal');
	//过滤查询字段
	private $position;
	private $rank;
	private $dept;

	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['letter'] = array('like', "%" . $_POST['letter'] . "%");
		$map['is_del'] = array('eq', '0');
		if (!empty($_POST['group'])) {
			$map['group'] = $_POST['group'];
		}
		$map['user_id'] = array('eq', get_user_id());
	}

	function read() {
		$type = $_REQUEST['type'];
		$id = $_REQUEST['id'];

		switch ($type) {
			case "company" :
				$model = M("Dept");
				$dept = tree_to_list(list_to_tree( M("Dept") -> select(), $id));
				$dept = rotate($dept);
				$dept = implode(",", $dept['id']) . ",$id";

			case "emp" :
				$model = M("Dept");
				$dept = tree_to_list(list_to_tree( M("Dept") -> select(), $id));
				$dept = rotate($dept);
				$dept = implode(",", $dept['id']) . ",$id";

				$sql = D("UserView") -> buildSql();
				$model = new Model();
				$where['dept_id'] = array('in', $dept);
				$data = $model -> table($sql . "a") -> where($where) ->  select();
				break;

			case "rank" :
				$sql = D("UserView") -> buildSql();
				$model = new Model();
				$where['rank_id'] = array('eq', $id);
				$data = $model -> table($sql . "a") -> where($where) ->  select();
				break;

			case "position" :
				$sql = D("UserView") -> buildSql();
				$model = new Model();
				$where['position_id'] = array('eq', $id);
				$data = $model -> table($sql . "a") -> where($where) ->  select();
				break;

			case "personal" :
				$model = D("UserTag");
				if ($id == "#") {
					$data = $model -> get_data_list();
					$data = rotate($data);
					$data = $data['row_id'];
					$where['id'] = array('not in', implode(",", $data));
				} else {
					$data = $model -> get_data_list(MODULE_NAME, $id);
					$data = rotate($data);
					$data = $data['row_id'];
					$where['id'] = array('in', implode(",", $data));
				}
				$model = M("Contact");
				$data = $model -> where($where) -> field('id,name,email') -> select();
				//echo $model->getLastSql();
				break;
			default :
		}
		$new = array();
		if (true) {// 读取成功
			$this -> ajaxReturn($data,dump($data,false), 1);
		}
	}

	function contact() {
		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_company', popup_tree_menu($list));

		$model = M("Rank");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_rank', popup_tree_menu($list));

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', popup_tree_menu($list));

		$model = D("UserTag");

		$tag_list = $model -> get_list();
		$tag_list['#']="未分组";
		$this -> assign("list_personal", $tag_list);

		$this -> assign('type', 'rank');
		$this -> display();
		return;
	}

	function auth() {
		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_company', popup_tree_menu($list));

		$model = M("Rank");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_rank', popup_tree_menu($list));

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', popup_tree_menu($list));

		$this -> assign('type', 'rank');
		$this -> display();
		return;
	}
	
	function emp(){
		$this->auth();
	}
	function actor() {

		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_company', popup_tree_menu($list));

		$model = M("Rank");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_rank', popup_tree_menu($list));

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', popup_tree_menu($list));

		$this -> assign('type', 'rank');
		$this -> display();
		return;
	}

	function confirm() {

		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_company', popup_tree_menu($list));

		$model = M("Rank");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_rank', popup_tree_menu($list));

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', popup_tree_menu($list));

		$this -> assign('type', 'rank');
		$this -> display();
		return;
	}

	function flow(){
		$model = M("DeptGrade");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_dept_grade', sub_tree_menu($list));

		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_dept', sub_tree_menu($list));

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', sub_tree_menu($list));

		$this -> assign('type', 'dgp');
		$this -> display();
		return;
	}

	function popup_depts(){
		$model = M("Dept");
		$list = array();
		$list = $model -> field('id,pid,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_dept', sub_tree_menu($list));
		$this -> display();
		return;
	}


	function position(){

		$model = M("Position");
		$list = array();
		$list = $model -> field('id,name') -> order('sort asc') -> select();
		$list = list_to_tree($list);
		$this -> assign('list_position', sub_tree_menu($list));
		$this -> display();
		return;
	}

	function json(){
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

		$where = array();
		$model = M("Contact");
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
		$contact = array_merge_recursive($company, $personal);
		exit(json_encode($contact));
	}
}
?>