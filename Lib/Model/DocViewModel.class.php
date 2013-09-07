<?php
class DocViewModel extends ViewModel {
	public $viewFields=array(
		'Doc'=>array('*'),
		'Folder'=>array('name'=>'folder_name','_on'=>'Doc.folder=Folder.id')
		);
}
?>