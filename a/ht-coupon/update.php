﻿<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑优惠券</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script>
<link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/preview-pictures.js"></script>
<script type="text/javascript" src="../js/back.js"></script>
<script type="text/javascript">
var editor = new UE.ui.Editor();
editor.render("coupon_content");
</script>
</head>
<body>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">编辑优惠券</a></li>
        </ul>
    </div>
    <?php
    $id=$_REQUEST["id"];
    $row=$db->query_list_id("select * from coupon where coupon_id=$id");
    ?>
    <div class="formbody">
        <div class="formtitle">
            <span>信息</span>
            <input type="hidden" name="coupon_id" value="<?=$row['coupon_id'] ?>" />
            <input type="hidden" name="coupon_level" value="<?=$_REQUEST['level']?>" />
        </div>
        <ul class="forminfo">
            <li>
                <label>优惠券：</label>
                <input type="text" name="coupon_title" id="coupon_title" class="dfinput" value="<?=$row['coupon_title']?>"  />
                <i>*必须填写</i>
            </li>
            <li>
                <label>品牌LOGO：</label>
                <input type="file" name="coupon_logo" id="coupon_logo" onchange="preview(this,'preview_coupon_logo')"  />
                <i>*<?=$logo_width ?>*<?=$logo_height ?></i><br />
                <img src="../../<?=$row['coupon_logo']?>" id="coupon_logo_show" width="<?=$logo_width ?>px" height="<?=$logo_height ?>px"  />
                <input type="hidden" name="coupon_logos" id="coupon_logos" value="<?=$row['coupon_logo']?>" />
                <div id="preview_coupon_logo">预览区</div>
            </li>
            <li>
                <label>金额：</label>
                ￥<input type="text" name="coupon_price" id="coupon_price" class="dfinput" value="<?=$row['coupon_price']?>" style="width:100px;" />
                <i>*数字</i>
            </li>
            <li>
                <label>条件：</label>
                <input type="text" name="coupon_content" id="coupon_content" class="dfinput" value="<?=$row['coupon_content']?>" />
            </li>
            <li>
                <label>时间：</label>
                <input type="text" name="coupon_time" id="coupon_time" value="<?=date("Y-m-d H",strtotime($row['coupon_time']))?>" class="dfinput" style="width:120px" class="Wdate" onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH'})"/>
<!--                <input type="text" name="coupon_start" id="coupon_start" value="--><?//=date("H",strtotime($row['coupon_start']))?><!--" class="dfinput" style="width:30px" class="Wdate" onFocus="WdatePicker({lang:'zh-cn',dateFmt:'HH'})"/>-->
                -<input type="text" name="coupon_end" id="coupon_end" value="<?=date("H",strtotime($row['coupon_end']))?>" class="dfinput"style="width:40px" class="Wdate" onFocus="WdatePicker({lang:'zh-cn',dateFmt:'HH'})"/>
                <i>*如果为空默认为当前时间</i>
            </li>
            <li>
                <label>是否置顶：</label>
                <select name="coupon_sort" id="coupon_sort" class="dfinput">
                   <option  value="0" <?=$row['coupon_sort']==0?"selected='selected'":""?>>否</option>
                   <option  value="1" <?=$row['coupon_sort']==1?"selected='selected'":""?>>是</option>
                </select>
            </li>  
            <li>
                <label>是否推荐到首页：</label>
                <select name="coupon_show" id="coupon_show" class="dfinput">
                    <option  value="0" <?=$row['coupon_show']==0?"selected='selected'":""?>>否</option>
                    <option  value="1" <?=$row['coupon_show']==1?"selected='selected'":""?>>是</option>
                </select>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit" value="确认保存" class="btn" /> 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
