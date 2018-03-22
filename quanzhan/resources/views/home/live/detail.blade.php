<!DOCTYPE html>
<!-- saved from url=(0056)https://www.boxuegu.com/web/html/video.html?courseId=325 -->
<html class="translated-ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
		<title>视频播放</title>
		<style>*{padding: 0px; margin: 0px;}</style>
<body>

	{{--<video src="{{$pullVideo}}" controls="controls" width="780" height="420">你的浏览器不支持啊</video>--}}

		<div class="videoBody-play"id="video_play"></div>

<script type="text/javascript" src="{{ asset('homes') }}/js/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
	var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth;
	var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;
	console.log(width);
	var flashvars={
		f:'{{ $pullVideo }}',
		c:0,
		b:1,
		i:'http://www.ckplayer.com/static/images/cqdw.jpg'
		};
//	var video=['http://img.ksbbs.com/asset/Mon_1605/0ec8cc80112a2d6.mp4->video/mp4'];
	var video=['{{$pullVideo}}->video/mp4'];
	CKobject.embed('{{ asset('homes') }}/ckplayer/ckplayer.swf','video_play','ckplayer_a1', width, height,false,flashvars,video)
	function closelights(){//关灯
		alert(' 本演示不支持开关灯');
	}
	function openlights(){//开灯
		alert(' 本演示不支持开关灯');
	}
</script>

</body></html>