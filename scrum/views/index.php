<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <title>新建面板</title>
    <link href="<?php echo url(); ?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url(); ?>static/chosen/chosen.css" rel="stylesheet">
  </head>
  <body>
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h1>新建面板</h1>
        <p class="lead"></p>
      </div>

      <h3>基本信息</h3>
      <p></p>
      <div class="row">
        <div class="col-md-2"><input name="borad[bname]" class="form-control" type="text"  placeholder="名称" /></div>
        <div class="col-md-3">
          <div class="input-group">
            <input name="borad[begintime]" id="begin_time" class="form-control" type="text" placeholder="开始日期" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <input name="borad[endtime]"  id="end_time" class="form-control" type="text" placeholder="结束日志" onclick="WdatePicker({onpicked:function(){change_except();},dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <input id="chosen-select-demo" class="form-control" type="text" placeholder="排除日期" disabled />
            <select name="borad[exceptdays][]" data-placeholder="请选择排除日期" class="form-control hide" id="chosen-select" multiple ></select>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
       </div>
      </div>
      <hr/>
      <h3>任务信息</h3>
      <div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:50%;">故事/任务名称</th>
              <th style="width:20%;">所有者</th>
              <th style="width:20%;">预计完成</th>
              <th style="width:10%;">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_demo" class="hide">
              <td><input class="form-control" type="text" name="task[story][]"  placeholder="故事/任务名称" /></td>
              <td><input class="form-control" type="text" name="task[owner][]"  placeholder="所有者" /></td>
              <td>
	              <div class="input-group">
		            <input name="task[expendt][]"  id="end_time" class="form-control" type="text" placeholder="预计完成" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5"><button id="addtask" type="button" class="btn btn-default pull-right">新增任务</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <hr/>
      <div style="text-align:center">
        <button type="button" class="btn btn-default btn-lg" onclick="submit()">确认资料</button>
      </div>
    </form>
    </div> <!-- /container -->
    <script src="<?php echo url(); ?>static/datepicker/WdatePicker.js"></script>
    <script src="<?php echo url(); ?>static/jquery-1.11.0.min.js"></script>
    <script src="<?php echo url(); ?>static/chosen/chosen.jquery.min.js"></script>
    <script>
    $(function(){
        $('table tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        $('#addtask').click(function(){
            $('table tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        })
        
    });
    function deltr(obj)
    {
        $(obj).parent().parent().remove();
    }
    function change_except(){
        $('#chosen-select-demo').show();
        $('#chosen-select').hide();
        $('#chosen-select').html("");
        if(!$('#begin_time').val()){
            alert('开始时间不能为空！');
            return;
        }
        beginDate_t = new Date($('#begin_time').val().replace(/\-/g,"/"));
        beginDate =new Date( beginDate_t.setMonth(beginDate_t.getMonth()));
        
        endDate_t = new Date($('#end_time').val().replace(/\-/g,"/"));
        endDate =new Date( endDate_t.setMonth(endDate_t.getMonth()));
        if(beginDate && beginDate>endDate){
            alert('开始时间不能大于结束时间！');
            return;
        }
        var date = new Date();
        beginDate.setDate(beginDate.getDate()-1);
        date = beginDate;
        while(date<endDate){
             date.setDate(date.getDate() + 1);
             var s_data = date.getFullYear()+"-";
             
             if((date.getMonth()+1)<10){
            	 s_data+= "0"+(date.getMonth()+1)+"-";
             }else{
            	 s_data+= (date.getMonth()+1)+"-";
             }
             if(date.getDate()<10){
            	 s_data+= "0"+date.getDate();
             }else{
            	 s_data+= date.getDate();
             }
              
             $('#chosen-select-demo').hide();
             $('#chosen-select').show();
             $('#chosen-select').append('<option value="'+s_data+'">'+s_data+'</option>');
        }
        $("#chosen-select").chosen({width: "100%"}); 
    }
    </script>
    <?php $this->load("footer"); ?>
  </body>
</html>