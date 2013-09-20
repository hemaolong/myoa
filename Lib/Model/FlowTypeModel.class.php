<?php
class FlowTypeModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','名称必须',1),
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		array('is_del','0',self::MODEL_INSERT),
		array('create_time','time',self::MODEL_INSERT,'function'),
		array('update_time','time',self::MODEL_UPDATE,'function'),
		);      

	function _after_insert($data,$options){
		D('ProjectHistory')->logHistory($data['id'], 'OPT_NEW');
	}
	
	function _before_update($data,$options){
		$where = $options['where'];
		$id = $where['id'];
		$old = M('FlowType')->field('name, state, fb_check, cy_check, kh_check, description')->where(array('id' => $id))->find();
		
		if (!empty( $data['name']) && $old['name'] != $data['name'])
			D('ProjectHistory')->logHistory($id, 'OPT_PROJ_NAME_CHG', $old['name'], $data['name']);
			
		if (!empty( $data['state']) && $old['state'] != $data['state'])
			D('ProjectHistory')->logHistory($id, 'OPT_CHG_STATE', $old['state'], $data['state']);
		/*
		if (!empty( $data['description']) && $old['description'] != $data['description'])
			D('ProjectHistory')->logHistory($id, 'OPT_PROJ_DESC_CHG', $old['description'], $data['description']);
		*/
		if (!empty( $data['fb_check']) && $old['fb_check'] != $data['selected'])
			D('ProjectHistory')->logHistory($id, 'OPT_PROJ_FB_CHK_CHG', $old['fb_check'], $data['fb_check']);
		if (!empty( $data['cy_check']) && $old['cy_check'] != 'selected')
			D('ProjectHistory')->logHistory($id, 'OPT_PROJ_CY_CHK_CHG', $old['cy_check'], $data['cy_check']);
		if (!empty( $data['kh_check']) && $old['kh_check'] != 'selected')
			D('ProjectHistory')->logHistory($id, 'OPT_PROJ_KH_CHK_CHG', $old['kh_check'], $data['kh_check']);
	}
}	
?>