<?php
// +----------------------------------------------------------------------
// | SMEOA [ 专注小微企业信息化 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.smeoa.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: smeoa <smeoa@qq.com>
// +----------------------------------------------------------------------

class LoginAction extends Action {
	
	// 检查用户是否登录

	public function index(){
		//如果通过认证跳转到首页
		$auth_id = session(C('USER_AUTH_KEY'));
		if (!isset($auth_id)) {
			$this -> display();
		} else {
			redirect(__APP__);
		}
	}

	// 用户登出
	public function logout() {
		$auth_id = session(C('USER_AUTH_KEY'));
		if (isset($auth_id)) {
			session(C('USER_AUTH_KEY'), null);
			session('top_menu' . $auth_id, null);
			//dump($_SESSION);
			//die();
			$this -> assign("jumpUrl", __URL__ . '/');
			$this -> success('登出成功！');
		} else {
			$this -> assign("jumpUrl", __URL__ . '/');
			$this -> error('已经登出！');
		}
	}

	// 登录检测
	public function check_login() {
		if (empty($_POST['emp_no'])) {
			$this -> error('帐号必须！');
		} elseif (empty($_POST['password'])) {
			$this -> error('密码必须！');
		}
		//生成认证条件
		$map = array();
		// 支持使用绑定帐号登录
		$map['emp_no'] = $_POST['emp_no'];
		$map["is_del"] = array('eq', 0);
		$model = M(C('USER_AUTH_MODEL'));
		$authInfo = $model -> where($map) -> find();
		//使用用户名、密码和状态的方式进行认证
		if (false === $authInfo) {
			$this -> error('帐号或密码错误！');
		} else {
			if ($authInfo['password'] != md5($_POST['password'])) {
				$this -> error('帐号或密码错误！');
			}
			session(C('USER_AUTH_KEY'), $authInfo['id']);
			session('emp_no', $authInfo['emp_no']);
			session('email', $authInfo['email']);
			session('user_name', $authInfo['emp_name']);
			session('last_login_time', $authInfo['last_login_time']);
			session('login_count', $authInfo['login_count']);
			session('dept_id', $authInfo['dept_id']);
			if ($authInfo['emp_no'] == 'admin') {
				session(C('ADMIN_AUTH_KEY'), true);
			}

			//读取数据库模块列表生成菜单项
			$menu = D("Node") -> access_list();
			$system_folder_menu = D("SystemFolder") -> get_folder_menu();
			$user_folder_menu = D("UserFolder") -> get_folder_menu();
			$menu = array_merge($system_folder_menu, $user_folder_menu, $menu);

			//缓存菜单访问
			session('menu' . $authInfo['id'], $menu);
			//保存登录信息
			$User = M('User');
			$ip = get_client_ip();
			$time = time();
			$data = array();
			$data['id'] = $authInfo['id'];
			$data['last_login_time'] = $time;
			$data['login_count'] = array('exp', 'login_count+1');
			$data['last_login_ip'] = $ip;
			$User -> save($data);
			$this -> assign('jumpUrl', U("index/index"));
			$this -> success('登录成功！');
		}
	}

	public function verify() {
		$type = isset($_GET['type']) ? $_GET['type'] : 'gif';
		import("@.ORG.Util.Image");
		Image::buildImageVerify(4, 1, $type);
	}
}
?>