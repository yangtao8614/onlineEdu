<?php
function  demo(){
	echo  'I am  demo';
}
function nihao(){
	echo 'wolcome to nihao';
}
//完成权限显示，格式化数据
function  getForamt($data,$parent_id=0){
	//定义一个静态的数组
	static $list = [];
	//遍历数据
	foreach($data as $v){
		if($v['parent_id']==$parent_id){
			$list[]=$v;
			getForamt($data,$v['id']);
		}
	}
	return $list;
}

//获取当前控制器的名称和方法名称的；
function getName(){
	$action = \Route::current()->getActionName();
    list($controller_name,$action_name)=explode('@', $action);
    $data['controller_name'] = ltrim(str_replace('Controller','',strrchr($controller_name,'\\')),'\\');
    $data['action_name']=$action_name;
    return $data;
}
//获取控制器名称的
function getController_name(){
	$data  = getName();
	return $data['controller_name'];
}
//获取当前方法名称的；
function getAction_name(){
	$data  = getName();
	return $data['action_name'];
}
?>