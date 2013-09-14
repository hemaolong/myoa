<?php
class ProjectHistoryModel extends CommonModel {
	
	public function logHistory($project_id, $opt_type, $old_value = null, $new_value = null){
	    $this->project_id = $project_id;
		$this->opt_type = $this->getHistoryOptType($opt_type);
		$this->old_value = $old_value;
		$this->new_value = $new_value;
		
		$this->user_id = get_user_id();
		$this->opt_date = time();
		$this->add();
	}
	
	public function getHistory($project_id){
		$join = ' join ' . $this->tablePrefix . 'user as u on user_id = u.id';
		dump($join);
		dump($this->join($join)
			->where(array('project_id' => $project_id))
			->field('id, user_id, u.id, project_id, opt_date, opt_type, old_value, new_value')
			->select());
	}
	
	
	private function getHistoryOptType($type){
	  $history_opt_type = C('HISTORY_OPT_TYPE');
	  $typeKeys = array_keys($history_opt_type);
	  for ($i = 0, $c = count($history_opt_type); $i < $c; $i++){
		 if ($typeKeys[$i] == $type){
			$t = $history_opt_type[$type];
			return $t[0];
		 }
	  }
	}
}
?>