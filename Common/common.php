<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2007 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: common.php 2601 2012-01-15 04:59:14Z liu21st $

//公共函数
 function get_return_url() {
		$return_url = cookie('return_url');
		if (!empty($return_url)) {
			return $return_url;
		} else {
			return __URL__ . '?' . C('VAR_MODULE') . '=' . MODULE_NAME . '&' . C('VAR_ACTION') . '=' . C('DEFAULT_ACTION');
		}
	}

function timediff($starttime, $end_time = null) {
	date_Default_TimeZone_set("PRC");
	$starttime = strtotime($starttime);
	if (!$end_time)
		$end_time = strtotime(date("Y-m-d H:i:s"));
	if ($starttime >= $end_time)
		return "1秒";
	$timediff = $end_time - $starttime;
	//var_dump($timediff);
	$days = intval($timediff / 86400);
	$remain = $timediff % 86400;
	$hours = intval($remain / 3600);
	$remain = $remain % 3600;
	$mins = intval($remain / 60);
	$secs = $remain % 60;
	if ($mins > 0)
		$res .= $mins . "分";
	if ($secs > 0)
		$res .= $secs . "秒";
	if ($hours > 0)
		$res = $hours . "小时";
	if ($days > 0)
		$res = $days . "天";
	if (!$res) {
		$res = "1秒";
	}
	return $res;
}

function get_system_config($code) {
	$model = M("SystemConfig");
	$where['code'] = array('eq', $code);
	return $model -> where($where) -> getfield("val");
}

function get_user_config($field) {
	$model = M("UserConfig");
	$user_id = get_user_id();
	$where['id'] = array('eq', $user_id);
	$result = $model -> where($where) -> getfield($field);
	if (empty($result)) {
		return get_system_config(strtoupper($field));
	} else {
		return $result;
	}
}

function big_num($num) {
	$arr = array("零", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十");
	return $arr[$num];
}

function conv_tag_list($tag) {
	$tag_list = explode("|", $tag);
	$tag_list = array_filter($tag_list);

	if (count($tag_list) > 0) {
		$string = $tag_list[0];
		$pattern = '/_\d+/';
		$replacement = "_";
		$str = preg_replace($pattern, $replacement, $string);
		$tag_list = str_replace($str, "", $tag);
		$tag_list = array_filter(explode("|", $tag_list));
		return $tag_list;
	}
}

function winclose($msg) {
	header("Content-Type:text/html; charset=utf-8");
	exit('<script>alert("' . $msg . '");window.opener=null;window.open("","_self");window.close();</script>');
}

function get_user_id() {
	$user_id = session(C('USER_AUTH_KEY'));
	return isset($user_id) ? $user_id : 0;
}

function del_folder($dir) {
	//打开文件目录
	$dh = opendir($dir);
	//循环读取文件
	while ($file = readdir($dh)) {
		if ($file != '.' && $file != '..') {
			$fullpath = $dir . '/' . $file;

			//判断是否为目录
			if (!is_dir($fullpath)) {
				//echo $fullpath."已被删除<br>";
				//如果不是,删除该文件
				if (!unlink($fullpath)) {
				}
			} else {
				//如果是目录,递归本身删除下级目录
				del_folder($fullpath);
			}
		}
	}
	//关闭目录
	closedir($dh);
	//删除目录

	if (rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}

function get_user_name() {
	$user_name = session('user_name');
	return isset($user_name) ? $user_name : 0;
}

function C2($name = NULL, $value = NULL, $cache = 0) {
	if ($value == NULL) {
		if ($cache == 0) {
			if (!F("config") || is_null(F("config"))) {
				$config = m("config");
				$row = $config -> getField("n,v");
				F("config", $row);
				if (empty($name))
					return $row;
				return isset($row[$name]) ? $row[$name] : null;
			} else {
				$row = F("config");
				return isset($row[$name]) ? $row[$name] : null;
			}
		} else {
			$row = F("config", $row);
			if (!$row) {
				$config = D("web.config");
				$row = $config -> getField("n,v");
			}
			if (empty($name))
				return $row;
			return isset($row[$name]) ? $row[$name] : null;
		}
	} else {
		//if($cache==1) $config= m("sys_config"); else $config= D("web.config");
		$config = m("config");
		str_replace("\\", "", $value);
		$r = $config -> where("n='" . $name . "'") -> setField("v", $value);
		if ($r <= 0) {
			$data["n"] = $name;
			$data["v"] = $value;
			$r = $config -> add($data);
		}
		if ($r > 0 && $cache == 1)
			F("config", NULL);
		return $r;
	}
}

function ages($birth) {
	list($by, $bm, $bd) = explode('-', $birth);
	if (empty($by))
		return '-';
	$cm = date('n');
	$cd = date('j');
	$age = date('Y') - $by - 1;
	if ($cm > $bm || $cm = $bm && $cd > $$bd)
		$age++;
	return $age;
}

function agey($age) {
	list($by, $bm, $bd) = explode('-', $birth);
	$cm = date('n');
	$cd = date('j');
	$year = date('Y') - $age - 1;
	//if ($cm>$bm || $cm=$bm && $cd>$$bd) $age++;
	return $year;
}

function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty($time)) {
		return '';
	}
	$format = str_replace('#', ':', $format);
	return date($format, $time);
}

function date_to_int($date) {
	$date = explode("-", $date);
	$time = explode(":", "00:00");
	$time = mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
	return $time;
}

function fix_time($time) {
	return substr($time, 0, 5);
}

function filter_search_field($v1) {
	if ($v1 == "keyword")
		return true;
	$prefix = substr($v1, 0, 3);
	$arr_key = array("be_", "en_", "eq_", "li_", "lt_", "gt_");
	if (in_array($prefix, $arr_key)) {
		return true;
	} else {
		return false;
	}
}

function get_view_fields($model) {
	$arr_field = array();
	foreach ($model->viewFields as $key => $val) {
		unset($val['_on']);
		unset($val['_type']);
		if ($val[0] == "*") {
			$model = M($key);
			$fields = $model -> getDbFields();
			$arr_field = array_merge($arr_field, array_values($fields));
		} else {
			$arr_field = array_merge($arr_field, array_values($val));
		}
	}
	return $arr_field;
}

function step_type($step) {
	if ($step >= 20) {
		return "裁决";
	}
	if ($step >= 30) {
		return "协商";
	}
}

function step($step) {
	if ($step == 40) {
		return "通过";
	}
	if ($step > 30) {
		return "协商中";
	}
	if ($step == 30) {
		return "带协商";
	}
	if ($step > 20) {
		return "裁决中";
	}
	if ($step == 20) {
		return "待裁决";
	}
	if ($step == 10) {
		return "临时保管";
	}
	if ($step == 0) {
		return "驳回";
	}
}

function IP($ip = '', $file = 'UTFWry.dat') {
	$_ip = array();
	if (isset($_ip[$ip])) {
		return $_ip[$ip];
	} else {
		import("ORG.Net.IpLocation");
		$iplocation = new IpLocation($file);
		$location = $iplocation -> getlocation($ip);
		$_ip[$ip] = $location['country'] . $location['area'];
	}
	return $_ip[$ip];
}

function sort_by($array, $keyname = null, $sortby = 'asc') {
	$myarray = $inarray = array();
	# First store the keyvalues in a seperate array
	foreach ($array as $i => $befree) {
		$myarray[$i] = $array[$i][$keyname];
	}
	# Sort the new array by
	switch ($sortby) {
		case 'asc' :
			# Sort an array and maintain index association...
			asort($myarray);
			break;
		case 'desc' :
		case 'arsort' :
			# Sort an array in reverse order and maintain index association
			arsort($myarray);
			break;
		case 'natcasesor' :
			# Sort an array using a case insensitive "natural order" algorithm
			natcasesort($myarray);
			break;
	}
	# Rebuild the old array
	foreach ($myarray as $key => $befree) {
		$inarray[] = $array[$key];
	}
	return $inarray;
}

function fix_array_key($list, $key) {
	$arr = null;
	foreach ($list as $val) {
		$arr[$val[$key]] = $val;
	}
	return $arr;
}

/**
 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat('0123456789', 3);
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) {//位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
	}
	if ($type != 4) {
		$chars = str_shuffle($chars);
		$str = substr($chars, 0, $len);
	} else {
		// 中文随机字
		for ($i = 0; $i < $len; $i++) {
			$str .= msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
		}
	}
	return $str;
}

function pwdHash($password, $type = 'md5') {
	return hash($type, $password);
}

function list_to_tree($list, $root = 0, $pk = 'id', $pid = 'pid', $child = '_child') {
	// 创建Tree
	$tree = array();
	if (is_array($list)) {
		// 创建基于主键的数组引用
		$refer = array();
		foreach ($list as $key => $data) {
			$refer[$data[$pk]] = &$list[$key];
		}
		foreach ($list as $key => $data) {
			// 判断是否存在parent
			$parentId = 0;
			if (isset($data[$pid])) {
				$parentId = $data[$pid];
			}
			if ($root == $parentId) {
				$tree[] = &$list[$key];
			} else {
				if (isset($refer[$parentId])) {
					$parent = &$refer[$parentId];
					$parent[$child][] = &$list[$key];
				}
			}
		}
	}
	return $tree;
}

function tree_to_list($tree, $level = 0, $pk = 'id', $pid = 'pid', $child = '_child') {
	$list = array();
	if (is_array($tree)) {
		foreach ($tree as $val) {
			$val['level'] = $level;
			$child = $val['_child'];
			if (isset($child)) {
				if (is_array($child)) {
					unset($val['_child']);
					$list[] = $val;
					$list = array_merge($list, tree_to_list($child, $level + 1));
				}
			} else {
				$list[] = $val;
			}
		}
		return $list;
	}
}

function tree_menu($tree) {
	$html = "";
	if (is_array($tree)) {
		$html = '<dl>';
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$url = $val["url"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<dd><span></span><a href=\"$url\" node=\"$id\" hidefocus=\”true\”>$title</a>";
					$html = $html . tree_menu($val['_child']);
					$html = $html . "</dd>";
				} else {
					$html = $html . "<dt><span></span><a href=\"$url\" node=\"$id\"  hidefocus=\”true\”>$title</a></dt>";
				}
			}
		}
		$html = $html . '</dl>';
	}
	return $html;
}

function tree_menu2($tree) {
	$html = "";
	if (is_array($tree)) {
		$html = "<ul>\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$url = $val["url"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li id=\"$id\" url=\"$url\">\r\n<span>$title</span>\r\n";
					$html = $html . tree_menu2($val['_child']);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li id=\"$id\" url=\"$url\">\r\n<span>$title</span>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function left_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				if (!empty($val["url"])) {
					$url = U($val['url']);
				} else {
					$url = "#";
				}
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a node=\"$id\" href=\"" . "$url\"><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . left_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a  node=\"$id\" href=\"" . "$url\"><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function popup_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a node=\"$id\" ><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . popup_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a  node=\"$id\" ><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function sub_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a node=\"$id\"><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . sub_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a  node=\"$id\" ><i class=\"icon-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function folder_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li id=\"$id\">\r\n<span class=\"level$level\">$title</span>\r\n";
					$html = $html . folder_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li  id=\"$id\">\r\n<span class=\"level$level\">$title</span>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function dropdown_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li id=\"$id\" class=\"level$level\"><a>$title</a>\r\n";
					$html = $html . dropdown_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li  id=\"$id\"  class=\"level$level\">\r\n<a>$title</a>\r\n</li>\r\n";
				}
			}
		}
	}
	return $html;
}

function f_encode($str) {
	$str = base64_encode($str);
	$str = rand_string(10) . $str . rand_string(10);
	$str = str_replace("+", "-", $str);
	$str = str_replace("/", "_", $str);
	$str = str_replace("==", "*", $str);
	return $str;
}

function f_decode($str) {
	$str = str_replace("-", "+", $str);
	$str = str_replace("_", "/", $str);
	$str = str_replace("*", "==", $str);
	$str = substr($str, 10, strlen($str) - 20);
	$str = base64_decode($str);
	return $str;
}

function u_str_pad($cnt, $str) {
	$tmp = '';
	for ($i = 1; $i <= $cnt; $i++) {
		$tmp = $tmp . $str;
	}
	return $tmp;
}

function show_contact($str, $mode = "show") {
	$tmp = '';
	if (!empty($str)) {
		$contacts = explode(';', $str);
		if (count($contacts) > 2) {
			foreach ($contacts as $contact) {
				if (strlen($contact) > 6) {
					$arr = explode('|', $contact);
					$name = htmlspecialchars(rtrim($arr[0]));
					$email = htmlspecialchars(rtrim($arr[1]));
					if ($mode == "edit") {
						$tmp = $tmp . "<span email=\"$email\"><nobr><b  title=\"$email\">$name</b><a class=\"del\" title=\"删除\">&#10005</a></nobr></span>";
					} else {
						$tmp = $tmp . "<a email=\"$email\" title=\"$email\" >$name;</a>";
					}
				}
			}
		} else {
			$arr = explode('|', $contacts[0]);
			$name = htmlspecialchars(rtrim($arr[0]));
			$email = htmlspecialchars(rtrim($arr[1]));
			$tmp = "";
			if ($mode == "edit") {
				$tmp = $tmp . "<span email=\"$email\"><nobr><b  title=\"$email\">$name</b><a class=\"del\" title=\"删除\">&#10005</a></nobr></span>";
			} else {
				$tmp = $tmp . "<a email=\"$email\" title=\"$email\" >$name</a>";
			}
		}
	}
	return $tmp;
}

function show_recent($str) {
	$contacts = explode(';', $str);
	if (count($contacts) > 2) {
		foreach ($contacts as $contact) {
			if (strlen($contact) > 6) {
				$arr = explode('|', $contact);
				$name = rtrim($arr[0]);
				$email = rtrim($arr[1]);
				$tmp = $tmp . "<li><span title=\"$email\">$name</span></li>";
			}
		}
	} else {
		$arr = explode('|', $contacts[0]);
		$name = rtrim($arr[0]);
		$email = rtrim($arr[1]);
		$tmp = "";
		$tmp = $tmp . "<li><span title=\"$email\">$name</span></li>";
	}
	return $tmp;
}

function not_dept($val) {
	if (strrchr($val, "dept@group")) {
		return false;
	} else {
		return true;
	}
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents, $from, $to) {
	$from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
	$to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
	if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
		//如果编码相同或者非字符串标量则不转换
		return $fContents;
	}
	if (is_string($fContents)) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($fContents, $to, $from);
		} elseif (function_exists('iconv')) {
			return iconv($from, $to, $fContents);
		} else {
			return $fContents;
		}
	} elseif (is_array($fContents)) {
		foreach ($fContents as $key => $val) {
			$_key = auto_charset($key, $from, $to);
			$fContents[$_key] = auto_charset($val, $from, $to);
			if ($key != $_key)
				unset($fContents[$key]);
		}
		return $fContents;
	} else {
		return $fContents;
	}
}

function getExt($filename) {
	$pathinfo = pathinfo($filename);
	return $pathinfo['extension'];
}

function del_html($str) {
	$str = trim($str);
	$str = preg_replace("/<[^>]*>/i", "", $str);
	$str = ereg_replace("\t", "", $str);
	$str = ereg_replace("\r\n", "", $str);
	$str = ereg_replace("\r", "", $str);
	$str = ereg_replace("\n", "", $str);
	$str = ereg_replace("&nbsp;", "", $str);
	$str = ereg_replace(" ", "", $str);
	$str = ereg_replace("{br}", "<br/>", $str);
	$str = ereg_replace("{}", "&nbsp;", $str);
	return $str;
}

function getfilecounts($ff) {
	$dir = './' . $ff;
	$handle = opendir($dir);
	$i = 0;
	while (false !== $file = (readdir($handle))) {
		if ($file !== '.' && $file != '..') {
			$i++;
		}
	}
	closedir($handle);
	return $i;
}

function show_confirm($confirm) {
	$arr_emp_no = explode('|', $confirm);
	$arr_emp_no = array_filter($arr_emp_no);
	if (count($arr_emp_no) > 1) {
		$model = D("User");
		foreach ($arr_emp_no as $emp_no) {
			if (strlen($emp_no) > 1) {
				$emp = $model -> get_user($emp_no);
				$str .= $emp['emp_name'] . " / " . $emp['position_name'] . " &rarr; ";
			}
		}
		return substr($str, 0, -7);
	} else {
		return "";
	}
}

function showFile($add_file, $mode) {
	$files = explode(';', $add_file);
	if (count($files) > 1) {
		foreach ($files as $file) {
			if (strlen($file) > 1) {
				$fileId = f_decode($file);
				$fileId = $file;
				$model = M("File");
				$File = $model -> where("id=$fileId") -> field("name,size,extension") -> find();

				echo '<div class="attach_file" style="background-image:url(__PUBLIC__/images/ico/ico_' . strtolower($File['extension']) . '.jpg); background-repeat:no-repeat;"><a target="_blank" href="__URL__/down/attach_id/' . f_encode($file) . '">' . $File['name'] . ' (' . reunit($File['size']) . ')' . '</a>';
				if ($mode == "edit") {
					echo '<a href="#" class="prgCancel" id="' . $file . '">删除</a>';
				}
				echo '</div>';
			}
		}
	}
}

function reunit($size) {
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " KB";
	}
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " MB";
	}
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " GB";
	}
	return round($size, 2) . $unit;
}

function get_module($str) {
	$arr_str = explode("/", $str);
	return $arr_str[0];
}

function filter_module($str){
	if(empty($str['admin'])&&empty($str['write'])&&empty($str['read'])){
		return false;
	}
	return strpos($str['url'],'index');
}

function rotate($a) {
	$b = array();
	foreach ($a as $val) {
		foreach ($val as $k => $v) {
			$b[$k][] = $v;
		}
	}
	return $b;
}

function utf_strlen($string) {
	return count(mb_str_split($string));
}

function utf_str_sub($string, $cnt) {
	$charlist = mb_str_split($string);
	$new = array_chunk($charlist, $cnt);
	return implode($new[0]);
}

function get_letter($string) {
	$charlist = mb_str_split($string);
	return implode(array_map("getfirstchar", $charlist));
}

function mb_str_split($string) {
	// Split at all position not after the start: ^
	// and not before the end: $
	return preg_split('/(?<!^)(?!$)/u', $string);
}

function getfirstchar($s0) {
	$fchar = ord(substr($s0, 0, 1));
	if (($fchar >= ord("a") and $fchar <= ord("z")) or ($fchar >= ord("A") and $fchar <= ord("Z")))
		return strtoupper(chr($fchar));
	$s = iconv("UTF-8", "GBK", $s0);
	$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
	if ($asc >= -20319 and $asc <= -20284)
		return "A";
	if ($asc >= -20283 and $asc <= -19776)
		return "B";
	if ($asc >= -19775 and $asc <= -19219)
		return "C";
	if ($asc >= -19218 and $asc <= -18711)
		return "D";
	if ($asc >= -18710 and $asc <= -18527)
		return "E";
	if ($asc >= -18526 and $asc <= -18240)
		return "F";
	if ($asc >= -18239 and $asc <= -17923)
		return "G";
	if ($asc >= -17922 and $asc <= -17418)
		return "H";
	if ($asc >= -17417 and $asc <= -16475)
		return "J";
	if ($asc >= -16474 and $asc <= -16213)
		return "K";
	if ($asc >= -16212 and $asc <= -15641)
		return "L";
	if ($asc >= -15640 and $asc <= -15166)
		return "M";
	if ($asc >= -15165 and $asc <= -14923)
		return "N";
	if ($asc >= -14922 and $asc <= -14915)
		return "O";
	if ($asc >= -14914 and $asc <= -14631)
		return "P";
	if ($asc >= -14630 and $asc <= -14150)
		return "Q";
	if ($asc >= -14149 and $asc <= -14091)
		return "R";
	if ($asc >= -14090 and $asc <= -13319)
		return "S";
	if ($asc >= -13318 and $asc <= -12839)
		return "T";
	if ($asc >= -12838 and $asc <= -12557)
		return "W";
	if ($asc >= -12556 and $asc <= -11848)
		return "X";
	if ($asc >= -11847 and $asc <= -11056)
		return "Y";
	if ($asc >= -11055 and $asc <= -10247)
		return "Z";
	return null;
}

function get_folder_name($id) {

	if($id==1){
		return "收件箱";
	}
	if($id==2){
		return "已发送";
	}
	if($id==3){
		return "草稿箱";
	}
	if($id==4){
		return "已删除";
	}
	if($id==5){
		return "垃圾邮件";
	}

	$model = D("UserFolder");
	$result = $model -> where("id=$id") -> getField("name");
	if ($result) {
		return $result;
	} else {
		return null;
	}
}

function mail_org_string($vo) {
	$count = 0;
	if (!empty($vo['sender_check']) && $count < 1) {
		$count++;
		if ($vo["sender_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['sender_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "发件人" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['domain_check']) && $count < 1) {
		$count++;
		if ($vo["domain_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['domain_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "发件域" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['recever_check']) && $count < 1) {
		$count++;
		if ($vo["recever_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['recever_key'];

		$str3 =get_folder_name($vo["to"]);

		$html = "收件人" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['title_check']) && $count < 1) {
		$count++;
		if ($vo["title_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['title_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "标题中" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};
	if ($count > 1) {
		$html .= " 等";
	}
	return $html;
}

function status($status) {
	if ($status == 0) {
		return "启用";
	}
	if ($status == 1) {
		return "禁用";
	}
}

function todo_status($status) {
	if ($status == 1) {
		return "尚未进行";
	}
	if ($status == 2) {
		return "正在进行";
	}
	if ($status == 3) {
		return "完成";
	}
}

function phpexcel($data, $templete, $file_name) {

	Vendor('Excel.PHPExcel');
	//导入thinkphp第三方类库

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel -> getProperties() -> setCreator("小薇") -> setLastModifiedBy("小薇") -> setTitle("Office 2007 XLSX Test Document") -> setSubject("Office 2007 XLSX Test Document") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");
	// Add some data
	$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue('A1', 'Hello') -> setCellValue('B2', 'world!') -> setCellValue('C1', 'Hello') -> setCellValue('D2', 'world!');

	// Miscellaneous glyphs, UTF-8
	$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue('A4', '中文') -> setCellValue('A5', '한글');

	// Rename worksheet
	$objPHPExcel -> getActiveSheet() -> setTitle('Contact');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel -> setActiveSheetIndex(0);

	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . $file_name . '"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter -> save('php://output');
	exit ;
}

function mb_unserialize(&$serial_str) {

	$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str);

	return unserialize($out);

}

function getValueField($item, $v){
    if ($v != null) return $item[$v];
	return $item['value'];
}

function getLabelField($item, $l){
	if ($l != null) return $item[$l];
	return $item['label'];
}

// Add by heml
function getOptionList(&$list, $selected, $v, $l){
	$options = '';
	$selected_str = 'selected = selected';
	for ($i = 0, $c = count($list); $i < $c; $i++){
		$e = $list[$i];
		$cur_value = getValueField($e, $v);
		$cur_label = getLabelField($e, $l);
		$options .= sprintf('<option value=%s %s>%s</option>', 
			$cur_value == $selected? $selected_str: '',
			$cur_value, $cur_label);
			
	}
	return $options;
}

function getOption(&$list){
	$options = '';
	for ($i = 0, $c = count($list); $i < $c; $i++){
		$e = $list[$i];
		if ($e['value'] == $value){
			return $e['label'];
		}
	}
}

function getFlowStates(){
    // value 不能修改
	$l = array(
		array('value' => 10, 'label' => '立项'), 
		array('value' => 11, 'label' => '终止'), 
		array('value' => 20, 'label' => '申请编码'), 
		array('value' => 30, 'label' => '设计模具'), 
		array('value' => 40, 'label' => '请求发包加工'), 
		array('value' => 50, 'label' => '发包加工'), 
		// Check
		array('value' => 60, 'label' => '清点零件'), 
		array('value' => 70, 'label' => '调试模具'), 
		// Check
		array('value' => 80, 'label' => '提交样品'), 
		// Check
		array('value' => 90, 'label' => '发版'), 
		array('value' => 100, 'label' => '交付'), 
		array('value' => 110, 'label' => '结案'), 
	);
	return $l;
}

function getFlowStateById($id){
	$l = getFlowStates();
	for ($i = 0; $i < count($l); $i++){
		$item = $l[$i];
		if ($item['value'] == $id){
			return $item;
		}
	}
}

function getNextState($state){
    $l = array(
	    '10' => array(11, 20),
		'11' => array(11, 30),
		'20' => array(11, 40),
		'40' => array(11, 50),
		'50' => array(11, 60),
		'60' => array(11, 70),
		'70' => array(11, 80),
		'80' => array(11, 90),
		'90' => array(11, 100),
		'100' => array(11, 110),
		'110' => array(),
	);
	
	$ns = $l[$state];
	return $ns;
}

function getPrioritys(){
    $l = array(
		array('value' => 0, 'label' => '设计工程师'), 
		array('value' => 1, 'label' => '设计主管'), 
		array('value' => 100, 'label' => '管理员'), 
	);
	return $l;
}

function getNextStateList($state){
	$ns = getNextState($state);
	$r = array();
	for ($i = 0; $i < count($ns); $i++){
	    $r[$i] = getFlowStateById($ns[$i]);
	}
	$nl = getOptionList($r);
	return $nl;
}

function getPriorityList(){
    $list = getPrioritys();
	return getOptionList($list);
}

function getUserList($list, $select){
    return getOptionList($list, $select, 'id', 'emp_no');
}

function getPriorityOption($value){
	$list = getPrioritys();
	return getOption($list);
}

function getHistoryOptType($type){
  $history_opt_type = C('HISTORY_OPT_TYPE');
  $typeKeys = array_keys($history_opt_type);
  for ($i = 0, $c = count($history_opt_type); $i < $c; $i++){
	 if ($typeKeys[$i] == $type){
		$t = $history_opt_type[$type];
		return $t[0];
	 }
  }
}

function getHistoryOptTypeById($type){
  $history_opt_type = C('HISTORY_OPT_TYPE');
  $typeKeys = array_keys($history_opt_type);
  for ($i = 0, $c = count($history_opt_type); $i < $c; $i++){
	 $key = $typeKeys[$i];
	 $value = $history_opt_type[$key];
	 if ($value[0] == $type){
		return $value[1];
	 }
  }
}



?>