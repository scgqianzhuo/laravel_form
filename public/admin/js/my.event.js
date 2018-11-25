//初始化参数
var input_list = {

	init_list:function(){

	}
}

//页面处理
var page = {

	init:function(){
		
		this.eventBind();
	},
	//事件
	eventBind:function(){

		// $(".addSubmit").click(function(){

		// 	$.ajax({
	 //             type:"post",
	 //             url:"save",
	 //             dataType:'json',
	 //             data: $("form").serialize(),//表单数据
	 //             success:function(result){
	 //                 if(result.code=="200"){
	 //                     layer_close();
	 //                 }
	 //                 if(result.code=="201"){
	 //                	 layer.msg(result.data);
	 //                 }
	 //             }
	 //        });
			
		// });

	},
	//ajax
	ajaxEvent:function(){

	}

}

//启动器
page.init();

