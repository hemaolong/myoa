f<?php

class FileModel extends CommonModel {

	public $_auto		=	array(
		array('create_time','time',self::MODEL_INSERT,'function'),
		array('update_time','time',self::MODEL_UPDATE,'function'),
		);
		
	function _after_insert($data,$options){
		$old = M('File')->field('name, project_id')->where(array("id" => $data['id']))->find();
		D('ProjectHistory')->logHistory($old['project_id'], 'OPT_FILE_ADD', null, $old['name']);
	}
	
	function _after_update($data,$options){
	    if ($data['is_del'] == 1){
			$old = M('File')->field('name, project_id')->where(array("id" => $data['id']))->find();
			D('ProjectHistory')->logHistory($old['project_id'], 'OPT_FILE_DEL', null, $old['name']);
		}
	}
}
?>