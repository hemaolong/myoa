<?php
class ForumAction extends CommonAction {
	protected $config=array('app_type'=>'common','action_auth'=>array('folder'=>'read','save_post'=>'write','edit_post'=>'write','del_post'=>'admin'));
	//过滤查询字段
	function _search_filter(&$map) {
		$map['is_del'] = array('eq', '0');
		if (!empty($_REQUEST['fid'])) {
			$map['folder'] = $_REQUEST['fid'];
		}
	}

	public function _conv_data(&$item){
		if (isset($item['folder'])) {
			$model = D('SystemFolder');
			$list = $model -> getField('id,name');
			$item['folder_name'] = $list[$item['folder']];
		}
		if (isset($item['user_id'])) {
			$model = D('User');
			$list = $model -> get_user_list();
			$list = fix_array_key($list, "id");
			$item['user'] = $list[$item['user_id']];
		}
		return $item;
	}

	public function index() {
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$model = D("Forum");
		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> display();
	}

	public function add(){
		$this -> assign('folder', $_REQUEST['fid']);
		$this->display();
	}

	public function read(){
		$this->assign('auth',$this->config['auth']);

		$model = M("Forum");
		$id = $_REQUEST['id'];
		$fid= $_REQUEST['fid'];
		$where['id']=array('eq',$id);
		$where['fid']=array('eq',$fid);
			
		$vo = $model ->where($where)->find();
		$vo = $this -> _conv_data($vo);

		$this -> assign('vo', $vo);

		$id = $_REQUEST['id'];
		$user_id = get_user_id();
		$user['user_id'] = $user_id;

		$user = $this -> _conv_data($user);
		$this -> assign('user', $user);
		$this -> assign('user_id', $user_id);

		$model = M("Forum");
		$model -> where("id=$id") -> setInc('views', 1);

		$model = M("Forum");
		
		$where=array();
		$where['tid'] = $id;
		$where['is_del'] = 0;

		$model = M("Post");
		
		if (!empty($model)) {
			$this -> _list($model, $where, "id", true);
		}

		$this -> assign("tid", $id);
		$this -> display();
	}

	public function folder(){
		$this->assign('auth',$this->config['auth']);
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$model = M("Forum");
		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$where = array();
		$folder_id = $map['folder'];		
		$where['id'] = array('eq', $folder_id);
		$folder_name = M("Folder") -> where($where) -> getField("name");
		$this -> assign("folder_name", $folder_name);

		//$this -> _assign_folder_list('/forum/folder/');
		$this -> assign("folder_id", $folder_id);
		$this -> display();
		return;
	}

	public function del() {
		$id = $_REQUEST['id'];
		$where['id'] = array('in', explode(',', $id));
		$list = M("Forum") -> where($where) -> getfield('id,folder');

		$result = array_map(array("FolderAction", "_get_folder_auth"), $list);

		foreach ($result as $key => $val) {
			if ($val['admin'] == true) {
				$field = 'is_del';
				$this -> _set_field($key, $field, 0);
			}
		}
		$this -> ajaxReturn('', "删除成功", 1);
	}

	public function save_post(){
		R("post/save");
	}

	public function edit_post(){
		R("post/edit");
	}

	public function del_post(){
		R("post/del");
	}

	public function move_folder() {
		$id = $_REQUEST['id'];
		$user_id = get_user_id();

		$where['id'] = array('in', explode(',', $id));
		$list = $list = M("Forum") -> where($where) -> getfield('id,folder,user_id');

		foreach ($list as $key => $val) {
			if ($val['user_id'] == $user_id) {
				$field = 'folder';
				$target_folder = $_REQUEST['folder'];
				$this -> _set_field($key, $field, $target_folder);
			}
		}

		$list = M("Forum") -> where($where) -> getfield('id,folder');
		$result = array_map(array("FolderAction", "_get_folder_auth"), $list);
		foreach ($result as $key => $val) {
			if ($val['admin'] == true) {
				$field = 'folder';
				$target_folder = $_REQUEST['folder'];
				$this -> _set_field($key, $field, $target_folder, '', true);
			}
		}
	}

	public function upload() {
		$this->_upload();
	}

	public function down() {
		$this->_down();
	}
}
