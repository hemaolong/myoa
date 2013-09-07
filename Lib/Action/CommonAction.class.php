<?php
class CommonAction extends Action {
	/**
	 *  1. 确认SESSION
	 *  2. 确认权限
	 *  3. 处理显示菜单
	 *  **/

	function _initialize() {
		$auth_id = session(C('USER_AUTH_KEY'));
		if (!isset($auth_id)) {
			//跳转到认证网关
			redirect(U(C('USER_AUTH_GATEWAY')));
		}
		$this -> _assign_menu();
	}

	/**列表页面 **/
	function index() {
		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		$name = $this -> getActionName();
		$model = D($name);

		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> display();
	}
	
	/**查看页面 **/
	function read() {
		$this -> edit();
	}

	/**编辑页面 **/
	function edit() {
		$name = $this -> getActionName();
		$model = M($name);
		$id = $_REQUEST[$model -> getPk()];
		$vo = $model -> getById($id);
		if ($this -> isAjax()) {
			if ($vo !== false) {// 读取成功
				$this -> ajaxReturn($vo, "", 0);
			} else {
				die ;
			}
		}
		if (isset($vo['add_file'])) {
			$this -> _assign_file_list($vo["add_file"]);
		};
		$this -> assign('vo', $vo);
		$this -> display();
	}

	/** 保存操作  **/
	function save() {
		$opmode = $_POST["opmode"];
		if ($opmode == "add") {
			$this -> _insert();
		}
		if ($opmode == "edit") {
			$this -> _update();
		}
		if ($opmode == "del") {
			$this -> _del();
		}
	}
	

	/** 插入新新数据  **/
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

	/** 更新数据  **/
	protected function _update() {
		$name = $this -> getActionName();
		$model = D($name);
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
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
	
	protected function _upload(){
		R('File/upload');
	}
	
	protected function _down(){
		$attach_id = $_REQUEST["attach_id"];
		R("File/down", array($attach_id));
	}
	
	/** 删除数据  **/
	 protected function _del($id){
		$app_type = $this -> config['app_type'];
		switch ($app_type) {
			case 'personal' :
				$this -> destory($id);
				break;
			case 'common' :
				$name = $this -> getActionName();
				$model = M($name);
				if (!empty($model)){
					$pk = $model -> getPk();
					if (isset($id)) {
						if (is_array($id)) {
							$where[$pk] = array("in", array_filter($id));
						} else {
							$where[$pk] = array('in', array_filter(explode(',', $id)));
						}

						$result = $model -> where($where) -> setField("is_del", 1);
						if ($result !== false) {
							$this -> assign('jumpUrl', get_return_url());
							$this -> success("成功删除{$result}条!");
						} else {
							$this -> error('删除失败!');
						}
					} else {
						$this -> error('没有可删除的数据!');
					}
				}
			default :
				break;
		}
	}

	/** 删除数据  **/
	protected function _destory($id) {

		$name = $this -> getActionName();
		$model = M($name);

		if (!empty($model)) {
			$pk = $model -> getPk();
			if (isset($id)) {
				if (is_array($id)) {
					$where[$pk] = array("in", array_filter($id));
				} else {
					$where[$pk] = array('in', array_filter(explode(',', $id)));
				}

				$app_type = $this -> config['app_type'];

				switch ($app_type) {
					case 'personal' :
						$where['user_id'] = get_user_id();
						break;
					default :
						break;
				}
				$file_list = $model -> where($where) -> getField("id,add_file");
				$file_list = array_filter(explode(";", implode($file_list)));
				$this -> _destory_file($file_list);

				$result = $model -> where($where) -> delete();
				
				if ($result !== false) {
					$this -> success("彻底删除{$result}条!");
				} else {
					$this -> error('删除失败!');
				}
			} else {
				$this -> error('没有可删除的数据!');
			}
		}
	}

	protected function _destory_file($file_list) {

		$model = M("File");
		$where = array();
		$where['id'] = array('in', $file_list);
		$list = $model -> where($where) -> select();

		$save_path = C('SAVE_PATH');
		foreach ($list as $file) {
			if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/" . $save_path . $file['savename'])) {
				unlink($_SERVER["DOCUMENT_ROOT"] . "/" . $save_path . $file['savename']);
			}
		}
		$result = $model -> where($where) -> delete();

		if ($result !== false) {
			return true;
		} else {
			return false;
		}
	}

	//生成查询条件
	protected function _search($name = '', $view = false) {
		$map = array();
		$request = array_filter(array_keys(array_filter($_REQUEST)), "filter_search_field");
		if (empty($name)) {
			$name = $this -> getActionName();
		}
		$model = D($name);
		if ($view) {
			$fields = get_view_fields($model);
		} else {
			$fields = $model -> getDbFields();
		}
		foreach ($request as $val) {
			if (!in_array(substr($val, 3), $fields)) {
				continue;
			}
			if (substr($val, 0, 3) == "be_") {
				if (isset($_REQUEST["en_" . substr($val, 3)])) {
					if (strpos($val, "date")) {
						$map[substr($val, 3)] = array( array('egt', date_to_int(trim($_REQUEST[$val]))), array('elt', date_to_int(trim($_REQUEST["en_" . substr($val, 3)]))));
					}
					if (strpos($val, "time")) {
						$map[substr($val, 3)] = array( array('egt', trim($_REQUEST[$val])), array('elt', trim($_REQUEST["en_" . substr($val, 3)])));
					}
				}
			}
			if (substr($val, 0, 3) == "li_") {
				$map[substr($val, 3)] = array('like', '%' . trim($_REQUEST[$val]) . '%');
			}
			if (substr($val, 0, 3) == "eq_") {
				$map[substr($val, 3)] = array('eq', trim($_REQUEST[$val]));
			}
			if (substr($val, 0, 3) == "gt_") {
				$map[substr($val, 3)] = array('egt', trim($_REQUEST[$val]));
			}
			if (substr($val, 0, 3) == "lt_") {
				$map[substr($val, 3)] = array('elt', trim($_REQUEST[$val]));
			}
		}
		return $map;
	}

	
	protected function _list($model, $map, $sortBy = '', $asc = false) {
		//排序字段 默认为主键名
		if (isset($_REQUEST['_order'])) {
			$order = $_REQUEST['_order'];
		} else {
			$order = !empty($sortBy) ? $sortBy : $model -> getPk();
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset($_REQUEST['_sort'])) {
			$sort = $_REQUEST['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		//取得满足条件的记录数

		$count_model = clone $model;
		//取得满足条件的记录数
		if (!empty($count_model -> pk)) {
			$count = $count_model -> where($map) -> count($model -> pk);
		} else {
			$count = $count_model -> where($map) -> count();
		}
		if ($count > 0) {
			import("@.ORG.Util.Page");
			//创建分页对象
			if (!empty($_REQUEST['list_rows'])) {
				$listRows = $_REQUEST['list_rows'];
			} else {
				$listRows = get_user_config('list_rows');
			}
			$p = new Page($count, $listRows);
			//分页查询数据
			$voList = $model -> where($map) -> order("`" . $order . "` " . $sort) -> limit($p -> firstRow . ',' . $p -> listRows) -> select();

			$p -> parameter = $this -> _search;
			//分页显示
			$page = $p -> show();
			//列表排序显示
			$sortImg = $sort;
			//排序图标
			$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';
			//排序提示
			$sort = $sort == 'desc' ? 1 : 0;
			//排序方式
			//模板赋值显示

			$name = $this -> getActionName();
			$this -> assign('list', $voList);
			$this -> assign('sort', $sort);
			$this -> assign('order', $order);
			$this -> assign('sortImg', $sortImg);
			$this -> assign('sortType', $sortAlt);
			$this -> assign("page", $page);
		}
		return;
	}

	/**显示top menu及 left menu **/

	protected function _assign_menu() {
		$model = D("Node");
		$top_menu = cookie('top_menu');
		$user_id = get_user_id();
		$top_menu_list = session('top_menu' . $user_id);
		if (!empty($top_menu_list)) {
			$list = $top_menu_list;
		} else {
			$list = $model -> get_top_menu();
			if (empty($list)) {
				$this -> assign('jumpUrl', U("Login/logout"));
				$this -> error("没有权限");
			}
			session('top_menu' . $user_id, $list);
		}

		$this -> assign('list_top_menu', $list);

		//读取数据库模块列表生成菜单项
		$menu = D("Node") -> access_list();
		$system_folder_menu = D("SystemFolder") -> get_folder_menu();
		$user_folder_menu = D("UserFolder") -> get_folder_menu();
		$menu = array_merge($system_folder_menu, $user_folder_menu, $menu);

		if (!empty($top_menu)) {
			$this -> assign("top_menu_name", $model -> where("id=$top_menu") -> getField('name'));
		}

		$tree = list_to_tree($menu, $top_menu);
		$this -> assign('html_left_menu', left_menu($tree));
	}

	 protected function _assign_folder_list(){
		 if($this->config['app_type']=='personal'){
			$model = D("UserFolder");
		 }else{
			 $model = D("SystemFolder");
		 }
		$list = $model -> get_list();
		$tree = list_to_tree($list);
		$this -> assign('folder_list', dropdown_menu($tree));
	}

	protected function _assign_file_list($add_file) {
		$files = explode(';', $add_file);
		$where['id'] = array('in', $files);
		$model = M("File");
		$list = $model -> where($where) -> select();
		$this -> assign('file_list', $list);
	}

	/**
	 * +----------------------------------------------------------
	 * 更新个别字段值
	 * +----------------------------------------------------------
	 * @access public
	 * +----------------------------------------------------------
	 * @return string
	 *+----------------------------------------------------------
	 * @throws ThinkExecption
	 *+----------------------------------------------------------
	 */
	protected function _set_field($id, $field, $val, $name = '') {
		if (empty($name)) {
			$name = $this -> getActionName();
		}
		$model = M($name);
		if (!empty($model)) {
			$pk = $model -> getPk();
			if (isset($id)) {
				if (is_array($id)) {
					$where[$pk] = array("in", $id);
				} else {
					$where[$pk] = array('in', explode(',', $id));
				}
				$admin=$this->config['auth']['admin'];
				if (in_array('user_id', $model -> getDbFields()) && !$admin) {
					$where['user_id'] = array('eq', get_user_id());
				};
				$list = $model -> where($where) -> setField($field, $val);
				if ($list !== false) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	protected function _tag_manage($tag_name) {		
		 if($this->config['app_type']=='personal'){
			$tag = A('UserTag');
		 }else{
			$tag = A('SystemTag');
		 }
		$tag -> assign("tag_name", $tag_name);
		$tag -> tag_manage();		
		//		R('Systemtag/tag_manage');
	}
	
	protected function _pushReturn($data, $info, $status, $time = null) {
		$user_id = get_user_id();
		$model = M("Push");
		$model -> user_id = $user_id;
		$model -> data = $data;
		$model -> status = $status;
		$model -> info = $info;
		if (empty($time)) {
			$model -> time = time();
		} else {
			$model -> time = $time;
		}
		$model -> add();
		exit();
	}
	

}
?>