<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}" />


<!-- <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" /> -->
<!-- <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" /> -->
@section('header')

@stop
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>
    
    @yield('title')
</title>
</head>
<body>


    @section('nav')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

@show
 @section('main')
<div class="page-container dataTables_wrapper">
   <form id="search" action="{{url('student/search')}}" name="student_search" method="post">
    {{ csrf_field() }}
        <div class="text-c"> 日期范围：
            <input value="" type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" name="start_time" style="width:120px;">
            -
            <input value="@if (!empty($end_time)) {{$end_time}} @endif" type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" name="end_time" style="width:120px;">
            <input value="@if (!empty($search_text)) {{$search_text}} @endif" type="text" class="input-text" style="width:250px" placeholder="输入会员名称" id="" name="search_text">
            <button type="button" onclick="search();" class="btn btn-success radius" id="student_search_button" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','{{url('student/create')}}','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>{{$students->total()}}</strong> 条</span> </div>
    <div class="mt-20">
    <form action="{{url('student/del')}}" method="post" id="del" name="del">
        {{ csrf_field() }}
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox"></th>
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="40">性别</th>
                <th width="90">手机</th>
                <th width="70">状态</th>
                <th width="70">创建时间</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr class="text-c">
                <td><input type="checkbox" class="studentIds" name="studentIds[]" value="{{$student->id}}"></td>
                <td>{{$student->id}}</td>
                <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$student->name}}','{{url('student/show',['id'=>$student->id])}}','10001','360','400')">{{$student->name}}</u></td>
                <td>{{$student->sex($student->sex)}}</td>
                <td>{{$student->phone}}</td>
                <td class="td-status"><span class="label label-{{$student->status($student->status)['style']}} radius">{{$student->status($student->status)['status']}}</span></td>
                <td>{{$student->dateForm($student->created_at)}}</td>
                <td class="td-manage"><a style="text-decoration:none" onClick="@if ($student->status==1)member_stop(this,{{$student->id}}) @else member_start(this,{{$student->id}}) @endif" href="javascript:;" title="停用"><i class="Hui-iconfont">@if ($student->status==1)&#xe631; @else &#xe6e1; @endif</i></a> <a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{url('student/edit',['id'=>$student->id])}}','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <!-- <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a>  --><a title="删除" href="javascript:;" onclick="member_del(this,{{$student->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </form>
    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">显示 {{$students->firstItem()}} 到 {{$students->lastItem()}} ，共 {{$students->total()}} 条</div>
    <!-- <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">

        <a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">上一页</a>


        <span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></span>
        <span><a class="paginate_button" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">2</a></span>
        <span><a class="paginate_button" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">3</a></span>


        <a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" id="DataTables_Table_0_next">下一页</a></div>
    </div> -->
    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
    {{$students->links()}}
    </div>
    <input type="hidden" name="studentStatusUrl" value="{{url('student/status')}}">
    <input type="hidden" name="studentDelUrl" value="{{url('student/del')}}">

</div>
@show
@section('footer')
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>  -->
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">
// $(function(){
//     $('.table-sort').dataTable({
//         "aaSorting": [[ 2, "desc" ]],//默认第几个排序
//         "bStateSave": true,//状态保存
//         "aoColumnDefs": [
//           //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//           {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
//         ]
//     });

// });
/*用户-添加*/
var statusUpdateUrl = $('input[name=studentStatusUrl]').val();
var studentDelUrl = $('input[name=studentDelUrl]').val();
var _token = $('input[name=_token]').val();
function member_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
    layer.confirm('确认要注销该用户吗？',function(index){
        $.ajax({
            type: 'POST',
            url: statusUpdateUrl,
            data:{id:id,_token:_token},
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已注销</span>');
                $(obj).remove();
                layer.msg('已注销!',{icon: 5,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/*用户-启用*/
function member_start(obj,id){
    layer.confirm('确认要启用吗？',function(index){
        $.ajax({
            type: 'POST',
            url: statusUpdateUrl,
            data:{id:id,_token:_token},
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,'+id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用!',{icon: 6,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*用户-删除*/
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: studentDelUrl,
            data:{ids:id,_token:_token},
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/*用户批量删除*/
function datadel(){
    //判断是否选中
    if(!$('.studentIds').is(':checked')) {
        layer.msg('请选择至少一项',{icon: 6,time:1000});
        return false;
    }
    layer.confirm('确认要删除吗？',function(index){

        $('#del').submit();
    });
}


/*搜索用户*/
function search()
{
    var start_time = $('input[name=start_time]').val();
    var end_time = $('input[name=end_time]').val();
    var search_text = $('input[name=search_text]').val();
    if(!start_time&&!end_time&&!search_text){
        layer.msg('请填写至少一项',{icon: 6,time:1000});
        return false;
    }
    $('#search').submit();
}
</script>
</body>
</html>

@show