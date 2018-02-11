<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admins')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admins')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$role->role_name}}" placeholder="" id="role_name" name="role_name">
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">所属权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
			@foreach($privA as $a)
				<dl class="permission-list">
					<dt>
						<label>
							<input
							@if(in_array($a->id,$old_priv_ids))
								checked='checked'
							@endif

							 class="priv" type="checkbox" value="{{$a->id}}" name="priv_ids[]" id="user-Character-0">
							{{$a->priv_name}}</label>
					</dt>
					<dd>
					@foreach($privB as $b)
						@if($a->id==$b->parent_id)
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input 
									@if(in_array($b->id,$old_priv_ids))
										checked='checked'
									@endif


									 class="priv" type="checkbox" value="{{$b->id}}" name="priv_ids[]" id="user-Character-0-0">
									{{$b->priv_name}}</label>
							</dt>
							<dd>
								@foreach($privC as $c)
									@if($c->parent_id==$b->id)
								<label class="">
									<input
									@if(in_array($c->id,$old_priv_ids))
										checked='checked'
									@endif
									 class="priv" type="checkbox" value="{{$c->id}}" name="priv_ids[]" id="user-Character-0-0-0">
									{{$c->priv_name}}</label>
									@endif
								@endforeach
							</dd>
						</dl>
						@endif
					@endforeach	
					</dd>
				</dl>
			@endforeach	
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$("#form-admin-role-add").submit(function(e){
		//阻止表单的默认提交
		e.preventDefault();
		//提交数据之前，要判断是否选择了复选框
		var len = $(".priv:checked").length;
		if(len<1){
			layer.msg('你至少选择一个吧',{icon:5,time:2000});
			return false;
		}
		//ajax方式提交数据
		var data = $(this).serialize();
		$.ajax({
			type:'post',
			url:"{{url('admin/role/update')}}/{{$role->id}}",
			data:data,
			success:function(msg){
				if(msg.info==1){
					//修改成功；
					layer.alert('修改成功',function(){
						//刷新父窗口
						parent.window.location.href = parent.window.location.href;
						//关闭当前窗口
						layer_close();
					});
				}else {
					layer.msg('修改失败：'+msg.error,{icon:5,time:2000});
				}
			}

		});

	});


	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	/*$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
		}
	});*/
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>