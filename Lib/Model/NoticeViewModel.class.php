<?php
class NoticeViewModel extends ViewModel {
	public $viewFields=array(
		'Notice'=>array('*'),
		'Folder'=>array('name'=>'folder_name','_on'=>'Notice.folder=Folder.id')
		);
}
?>