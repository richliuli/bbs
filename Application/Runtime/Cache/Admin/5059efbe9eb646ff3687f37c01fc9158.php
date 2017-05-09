<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <?php echo ($locate); ?>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <label>商企名称</label>
                    <input name="le_name" placeholder="请输入商企名称" type="text" class="dfinput" /><i>名称不能超过30个字符</i></li>
                <li>
                    <label>联系方式</label>
                    <input name="le_phone" placeholder="请输入联系方式" type="text" class="dfinput" /><i></i></li>
                <li><label>代理级别</label><cite><input name="le_rank" type="radio" value="0" checked="checked" />省级&nbsp;&nbsp;&nbsp;&nbsp;<input name="le_rank" type="radio" value="1" />市级</cite></li>

                <li>
                    <label>推荐人</label>
                    <input name="le_rec" placeholder="请输入推荐单位或人名称" type="text" class="dfinput" />
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('myue',{toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion'
        ]]});

    //页面的载入事件
    $(function(){
        //需要给button绑定点击事件
        $('#btnSubmit').click(function(){
            //事件处理程序
            $('form').submit();
        });

        $('select[name=type_id]').change(function(){
            $('.newtag').remove();
            var _typeID=$(this).val();
            var _this=this;
            $.ajax({
                url: "<?php echo U('getAttr');?>",
                data: {typeid: _typeID},
                type: 'GET',
                dataType: 'json',
                success:function(data){
                   $.each(data,function(index,el) {
                       var str='';
                       if(el.attr_sel == '0'){
                            str += "<li class='newtag'><label><a href='javascript:;' class='add'>[+]</a>" + el.attr_name + "</label><input name='attr_vals[" + el.attr_id + "][]' placeholder='请输入" + el.attr_name + "' type='text' class='dfinput' /></li>";
                       }else{
                            str += "<li class='newtag'><label><a href='javascript:;' class='add'>[+]</a>" + el.attr_name + "</label><select name='attr_vals[" + el.attr_id + "][]' class='dfinput'><option value='0'>--请选择分类--</option>";
                            var vals = el.attr_vals.split(',');
                           for(var i = 0;i < vals.length;i++){
                                str += "<option value='" + vals[i] + "'>" + vals[i] + "</option>";
                           };
                            str += "</select></li>";
                       }
                       $(_this).parent().after(str);
                       
                   })
                }
            });
        });
        $(document).on('click','.add',function (){
            var li = $(this).parent().parent().clone();
            li.find('a').remove();
            li.find('label').prepend("<a href='javascript:;' class='remove'>[-]</a>");
            $(this).parent().parent().after(li);

        });
        $(document).on('click','.remove',function () {
            $(this).parent().parent().remove();
        });
    });
</script>
</html>