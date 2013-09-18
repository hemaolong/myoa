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
		
		// Read the attachement
		$attach_list = M('file')->field('id, name, create_time')->where(array('project_id' => $id))->select();
		$this->assign('file_list', $attach_list);
		
		$history = D("ProjectHistory")->getHistory($id);
		$this->assign("flow", $f_m);
		$this->assign("flow_id", $id);
		$this->assign("state", getFlowStateById($f_m['state']));
		$this->assign("history", $history);
		$this->assign("fb_check", $fb_check_name);
		$this->assign("cy_check", $cy_check_name);
		$this->assign("kh_check", $kh_check_name);
	}
	
	function delete_attach(){
		dump("delete ok!");
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
	
		$id = $_POST['id'];
		$model = D("FlowType");
		dump('update ok');return;
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
	
	function submit_switch(){
		
        $flow_id = $_REQUEST["flow_id"];
		$where_f['id'] = $flow_id;
		$model =  M('flow_type');
		$model->id = $flow_id;
		$model->__set('state', $_REQUEST['to_state']);
		$f_m = $model->save();
		
		$this->success ('操作成功！');
	}

	public function upload() {
		if (!empty($_FILES)) {
			$this -> _upload();
		}
	}

	// 文件上传
	protected function _upload() {
		import("@.ORG.Util.UploadFile");
		$module = strtolower($_REQUEST["module"]);
		$upload = new UploadFile();
		$upload -> subFolder = $module;
		$upload -> savePath = C("SAVE_PATH");
		$upload -> saveRule = uniqid;
		$upload -> autoSub = true;
		$upload -> subType = "date";
		

		if (!$upload -> upload()) {
			$this -> error($upload -> getErrorMsg());
		} else {
			//取得成功上传的文件信息
			$uploadList = $upload -> getUploadFileInfo();
			$File = M("File");
			$File -> create($uploadList[0]);
			$File -> create_time = time();
			$File -> project_id = $_REQUEST["flow_id"]
			$user_id = get_user_id();
			$File -> user_id = $user_id;
			$fileId = $File -> add();

			$fileInfo = $uploadList[0];
			$fileInfo['id'] = $fileId;
			$fileInfo['error'] = 0;
			$fileInfo['url'] = $fileInfo['savepath'] . $fileInfo['savename'];

			//header("Content-Type:text/html; charset=utf-8");
			exit(json_encode($fileInfo));
			$this->success ('上传成功！');
		}
	}

	public function down($file_id) {

		$file_id = f_decode($file_id);
		$File = M("File") -> find($file_id);

		$filepath = C("SAVE_PATH") . $File['savename'];
		$filePath = realpath($filepath);
		$fp = fopen($filePath, 'rb');
		$ext = $File['ext'];

		//$filePath = realpath($filepath);
		$query = file_get_contents($filepath);
		//$query = file_get_contents($filepath);

		$filetype['chm'] = 'application/octet-stream';
		$filetype['ppt'] = 'application/vnd.ms-powerpoint';
		$filetype['xls'] = 'application/vnd.ms-excel';
		$filetype['doc'] = 'application/msword';
		$filetype['pptx'] = 'application/vnd.ms-powerpoint';
		$filetype['xlsx'] = 'application/vnd.ms-excel';
		$filetype['docx'] = 'application/msword';
		$filetype['exe'] = 'application/octet-stream';
		$filetype['rar'] = 'application/octet-stream';
		$filetype['js'] = "javascript/js";
		$filetype['css'] = "text/css";
		$filetype['hqx'] = "application/mac-binhex40";
		$filetype['bin'] = "application/octet-stream";
		$filetype['oda'] = "application/oda";
		$filetype['pdf'] = "application/pdf";
		$filetype['ai'] = "application/postsrcipt";
		$filetype['eps'] = "application/postsrcipt";
		$filetype['es'] = "application/postsrcipt";
		$filetype['rtf'] = "application/rtf";
		$filetype['mif'] = "application/x-mif";
		$filetype['csh'] = "application/x-csh";
		$filetype['dvi'] = "application/x-dvi";
		$filetype['hdf'] = "application/x-hdf";
		$filetype['nc'] = "application/x-netcdf";
		$filetype['cdf'] = "application/x-netcdf";
		$filetype['latex'] = "application/x-latex";
		$filetype['ts'] = "application/x-troll-ts";
		$filetype['src'] = "application/x-wais-source";
		$filetype['zip'] = "application/zip";
		$filetype['bcpio'] = "application/x-bcpio";
		$filetype['cpio'] = "application/x-cpio";
		$filetype['gtar'] = "application/x-gtar";
		$filetype['shar'] = "application/x-shar";
		$filetype['sv4cpio'] = "application/x-sv4cpio";
		$filetype['sv4crc'] = "application/x-sv4crc";
		$filetype['tar'] = "application/x-tar";
		$filetype['ustar'] = "application/x-ustar";
		$filetype['man'] = "application/x-troff-man";
		$filetype['sh'] = "application/x-sh";
		$filetype['tcl'] = "application/x-tcl";
		$filetype['tex'] = "application/x-tex";
		$filetype['texi'] = "application/x-texinfo";
		$filetype['texinfo'] = "application/x-texinfo";
		$filetype['t'] = "application/x-troff";
		$filetype['tr'] = "application/x-troff";
		$filetype['roff'] = "application/x-troff";
		$filetype['shar'] = "application/x-shar";
		$filetype['me'] = "application/x-troll-me";
		$filetype['ts'] = "application/x-troll-ts";
		$filetype['gif'] = "image/gif";
		$filetype['jpeg'] = "image/pjpeg";
		$filetype['jpg'] = "image/pjpeg";
		$filetype['jpe'] = "image/pjpeg";
		$filetype['ras'] = "image/x-cmu-raster";
		$filetype['pbm'] = "image/x-portable-bitmap";
		$filetype['ppm'] = "image/x-portable-pixmap";
		$filetype['xbm'] = "image/x-xbitmap";
		$filetype['xwd'] = "image/x-xwindowdump";
		$filetype['ief'] = "image/ief";
		$filetype['tif'] = "image/tiff";
		$filetype['tiff'] = "image/tiff";
		$filetype['pnm'] = "image/x-portable-anymap";
		$filetype['pgm'] = "image/x-portable-graymap";
		$filetype['rgb'] = "image/x-rgb";
		$filetype['xpm'] = "image/x-xpixmap";
		$filetype['txt'] = "text/plain";
		$filetype['c'] = "text/plain";
		$filetype['cc'] = "text/plain";
		$filetype['h'] = "text/plain";
		$filetype['html'] = "text/html";
		$filetype['htm'] = "text/html";
		$filetype['htl'] = "text/html";
		$filetype['rtx'] = "text/richtext";
		$filetype['etx'] = "text/x-setext";
		$filetype['tsv'] = "text/tab-separated-values";
		$filetype['mpeg'] = "video/mpeg";
		$filetype['mpg'] = "video/mpeg";
		$filetype['mpe'] = "video/mpeg";
		$filetype['avi'] = "video/x-msvideo";
		$filetype['qt'] = "video/quicktime";
		$filetype['mov'] = "video/quicktime";
		$filetype['moov'] = "video/quicktime";
		$filetype['movie'] = "video/x-sgi-movie";
		$filetype['au'] = "audio/basic";
		$filetype['snd'] = "audio/basic";
		$filetype['wav'] = "audio/x-wav";
		$filetype['aif'] = "audio/x-aiff";
		$filetype['aiff'] = "audio/x-aiff";
		$filetype['aifc'] = "audio/x-aiff";
		$filetype['swf'] = "application/x-shockwave-flash";

		$ua = $_SERVER["HTTP_USER_AGENT"];
		if (!preg_match("/MSIE/", $ua)) {
			header("Content-Length: " . filesize($filePath));
			header("Content-type:" . $filetype[$ext]);
			header("Content-Length: " . filesize($filePath));
			header("Accept-Ranges: bytes");
			header("Accept-Length: " . filesize($filePath));
		}

		header("Content-Disposition:attachment;filename =" . str_ireplace('+', '%20', URLEncode($File['name'])));
		header('Cache-Control:must-revalidate, post-check=0,pre-check=0');
		header('Expires:     0');
		header('Pragma:     public');
		//echo $query;
		fpassthru($fp);
		exit ;
	}
}
?>