@extends('common.layouts')
@section('title')
用户信息展示
@stop
@section('nav')
@stop
@section('main')
<div class="cl pd-20" style=" background-color:#5bacb6">
	<img class="avatar size-XL l" src="@if (empty($student->icon)) {{asset('storage/images/avator.png')}} @else {{asset('storage/images/'.$student->icon)}} @endif">
	<dl style="margin-left:80px; color:#fff">
		<dt>
			<span class="f-18">{{$student->name}}</span>
			<span class="pl-10 f-12">余额：40</span>
		</dt>
		<dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
	</dl>
</div>
<div class="pd-20">
	<table class="table">
		<tbody>
			<tr>
				<th class="text-r" width="80">性别：</th>
				<td>{{$student->sex($student->sex)}}</td>
			</tr>
			<tr>
				<th class="text-r">手机：</th>
				<td>{{$student->phone}}</td>
			</tr>
			<tr>
				<th class="text-r">邮箱：</th>
				<td>{{$student->email}}@mail.com</td>
			</tr>
			<tr>
				<th class="text-r">地址：</th>
				<td>{{$student->city}}</td>
			</tr>
			<tr>
				<th class="text-r">注册时间：</th>
				<td>2014.12.20</td>
			</tr>
		</tbody>
	</table>
</div>
@stop

@section('footer')
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> 
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
</body>
</html>
@stop