<?php
class FlowPhaseModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','名称必须',1),
		array('desc','require','描述必须',1),
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		);      

	function _after_insert($data,$options){
		$tid=$data["tid"];
		M("Forum")->where("id=$tid")->setInc("reply",1);
	}
}	
?>