<?php
class DocAction extends CommonAction {
	protected $config=array('app_type'=>'common','action_auth'=>array('folder'=>'read','tag_manage'=>'admin'),'folder_auth'=>true);
	//过滤查询字段
	function _search_filter(&$map) {
		$map['is_del'] = array('eq', '0');
		if (!empty($_REQUEST['keyword']) && empty($map['64'])) {
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index(){
		$user_id = get_user_id();
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}

		$model = D("DocView");
		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> display();
		return;
	}

	public function folder(){
		$this->assign('auth',$this->config['auth']);
		$model = D("Doc");
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}

		$folder_id = $_REQUEST['fid'];
		$map['folder'] = $folder_id;
		if (!empty($_REQUEST['tag'])) {
			$map['_string'] = "locate('{$_REQUEST['tag']}',Doc.tag_name)";
		}
		if (!empty($model)) {
			$this -> _list($model, $map);
		}

		$where = array();
		$where['id'] = array('eq', $folder_id);
		
		$folder_name = M("SystemFolder") -> where($where) -> getField("name");
		$this -> assign("folder_name", $folder_name);
		$this -> assign("folder_id", $folder_id);
		
		$this->_assign_folder_list();
		$this -> display();
		return;
	}

	public function add() {
		$fid = $_REQUEST['fid'];
		$type = D("Folder") -> where("id=$fid") -> getField("folder");
		$this -> assign('folder', $fid);
		$this -> assign('type', $type);
		$this->display();
	}

	public function _before_read() {
		$id = $_REQUEST['id'];
		$user_id = get_user_id();
		$model = M("Doc");
		$folder_id = $model -> where("id=$id") -> getField('folder');
		$this -> assign("auth", D("SystemFolder") -> get_folder_auth($folder_id));
	}

	protected function _insert() {
		$name = $this -> getActionName();
		$model = D($name);
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		if (in_array('user_id', $model -> getDbFields())) {
			$model -> user_id = get_user_id();
		};
		if (in_array('user_name', $model -> getDbFields())) {
			$model -> user_name = $this -> _session("user_name");
		};
		$tag_list = conv_tag_list($_POST['tag']);
		//保存当前数据对象
		$new_id = $model -> add();

		if ($list !== false) {//保存成功
			D("SystemTag") -> set_tag($new_id, $tag_list);
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('新增成功!');
		} else {
			//失败提示
			$this -> error('新增失败!');
		}
	}

	public function mark() {
		$action = $_REQUEST['action'];
		$id = $_REQUEST['doc_id'];
		if (!empty($id)) {
			switch ($action) {
				case 'del' :
					$where['id'] = array('in', $id);
					$folder = M("Doc") -> distinct(true) -> where($where) -> field("folder") -> select();
					if (count($folder) == 1) {
						$auth = D("Folder") -> _get_folder_auth($folder[0]["folder"]);
						if ($auth['admin'] == true) {
							$field = 'is_del';
							$this -> _set_field($id, $field, 0);
						}
						$this -> ajaxReturn('', "删除成功", 1);
					} else {
						$this -> ajaxReturn('', "删除失败", 1);
					}
					break;
				case 'move_folder' :
					$target_folder = $_REQUEST['val'];

					$where['id'] = array('in', $id);
					$folder = M("Doc") -> distinct(true) -> where($where) -> field("folder") -> select();
					if (count($folder) == 1) {
						$auth = D("Folder") -> _get_folder_auth($folder[0]["folder"]);
						if ($auth['admin'] == true) {
							$field = 'folder';
							$this -> _set_field($id, $field, $target_folder);
						}
						$this -> ajaxReturn('', "操作成功", 1);
					} else {
						$this -> ajaxReturn('', "操作失败", 1);
					}
					break;
				default :
					break;
			}
		}
	}

	 function _assign_doc_folder_list(){
		$this->_assign_folder_list();
	}

	function tag_manage() {
		$this->_tag_manage("标签管理");		
	}

	function upload() {
		$this->_upload();
	}

	function down() {
		$this->down();
	}

}
