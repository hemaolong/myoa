<?php
class IndexAction extends CommonAction {
	// 框架首页

	public function index() {
		$this -> redirect("Home/index");
	}

}
?>