<?php
    if (!defined('THINK_PATH')) exit();
    $array=array(
        'URL_MODEL'=>3, // 如果你的环境不支持PATHINFO 请设置为3
        'DB_TYPE'=>'mysql',
        'DB_HOST'=>'localhost',
        'DB_NAME'=>'install',
        'DB_USER'=>'root',
			'VAR_PAGE'=>'p',
        'DB_PWD'=>'',
        'DB_PORT'=>'3306',
        'DB_PREFIX'=>'smeoa_',
		'APP_DEBUG'=>true,
		'TOKEN_ON'=>false, 
		'TOKEN_TYPE'=>'md5',
		'TOKEN_NAME'=>'__hash__',
		'URL_CASE_INSENSITIVE' =>   true,
		'TMPL_CACHE_ON'=>false,
		'DB_FIELDS_CACHE'=>false,
        'APP_AUTOLOAD_PATH'=>'@.TagLib',
        'SESSION_AUTO_START'=>true,
       'USER_AUTH_KEY'             =>'authId',	// 用户认证SESSION标记
       'ADMIN_AUTH_KEY'			=>'administrator',
       'USER_AUTH_MODEL'           =>'User',	// 默认验证数据表模型
       'AUTH_PWD_ENCODER'          =>'md5',	// 用户认证密码加密方式
        'USER_AUTH_GATEWAY'         =>'login/index',// 默认认证网关
       'NOT_AUTH_MODULE'           =>'Push,Login,Home,Index,File',
        'DB_LIKE_FIELDS'            =>'title|content|name|remark',
			'SAVE_PATH'=>'Data/Files/',
        'SHOW_PAGE_TRACE'=>true, //显示调试信息
 		'AUTH'=>array('index'=>'read','read'=>'read','down'=>'read','add'=>'write',
		'edit'=>'write','save'=>'write','del'=>'admin','rstore'=>'admin','destory'=>'admin'),    
		
		'HISTORY_OPT_TYPE' => array('OPT_NEW' => array(1, "立项"),
								'OPT_CANCEL' => array(2, "终止"),
								'OPT_CHG_STATE' => array(3, "修改状态"),
								'OPT_PROJ_NAME_CHG' => array(4, "修改名称"),
								'OPT_PROJ_DESC_CHG' => array(5, "修改描述"),
								'OPT_PROJ_FB_CHK_CHG' => array(6, "发包审核"),
								'OPT_PROJ_CY_CHK_CHG' => array(7, "初样审核"),
								'OPT_PROJ_KH_CHK_CHG' => array(8, "客户审核"),
								
								'OPT_CLOSE' => array(30, "结案"),
								'OPT_FILE_ADD' => array(40, "添加文档"),
								'OPT_FILE_DEL' => array(41, "删除文档"),
								'OPT_COMMENT_ADD' => array(50, "添加注释"),
								'OPT_COMMENT_EDIT' => array(51, "修改注释"),
								'OPT_COMMENT_DEL' => array(52, "删除注释"),
							),
		);
    return $array;
?>
 
