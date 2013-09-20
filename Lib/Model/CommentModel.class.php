<?php
class CommentModel extends CommonModel {
	
	public function addComment($project_id, $content){
	    $this->project_id = $project_id;
		$this->content = $content;
		
		$this->creator_id = get_user_id();
		$this->create_date = time();
		$this->add();
	}
	
	public function delete_comment($id){
		// Log
		$old = M('Comment')->where(array('id' => $id))->find();
		D('ProjectHistory')->logHistory($old['project_id'], 'OPT_COMMENT_DEL', null, $old['content']);
		
	    $this->id = $id;
		$this->delete();
	}
	
	function _after_insert($data,$options){
		D('ProjectHistory')->logHistory($data['project_id'], 'OPT_COMMENT_ADD', null, $data['content']);
	}
	
	public function getComment($project_id){
		$h = $this
			->where(array('project_id' => $project_id))
			->field('id, content')
			->select();
		return $h;
	}
	
	
	
}
?>