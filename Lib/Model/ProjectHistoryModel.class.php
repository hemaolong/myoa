<?php
class ProjectHistoryModel extends CommonModel {
	
	public function logHistory($project_id, $opt_type, $old_value = null, $new_value = null){
	    $this->project_id = $project_id;
		$this->opt_type = getHistoryOptType($opt_type);
		$this->old_value = $old_value;
		$this->new_value = $new_value;
		
		$this->user_id = get_user_id();
		$this->opt_date = time();
		$this->add();
	}
	
	public function getHistory($project_id){
		$join = 'as h join ' . $this->tablePrefix . 'user as u on user_id = u.id';
		$h = $this->join($join)
			->where(array('project_id' => $project_id))
			->field('h.id, u.emp_no, h.user_id, u.id, project_id, opt_date, opt_type, old_value, new_value')
			->order('opt_date DESC')
			->select();//dump($this);
		return $h;
	}
	
	
	
}
?>