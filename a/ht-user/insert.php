<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>用户添加</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<form action="insertdb.php" method="post">
<div class="place">
<span>位置：</span>
<ul class="placeul">
    <li><a href="javascript:void(0);">首页</a></li>
    <li><a href="select.php">用户管理</a></li>
</ul>
</div>
<div class="formbody">
<div class="formtitle">
    <span>用户信息</span>
</div>
<ul class="forminfo">
	<li>
		<label>用户名：</label>
		<input type="text" name="user_name" id="user_name" class="dfinput" />
		<i>*必须填写</i>
	</li>
	<li>
		<label>密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
		<input type="text" name="user_password" id="user_password" class="dfinput" />
		<i>*必须填写</i>
	</li>
	<li>
        <label>权&nbsp;&nbsp;&nbsp;&nbsp;限：</label>
        <select name="user_power" id="DropDownList1" class="dfinput">
        <?php
        $sql = "select power_id,power_name from power where power_id>1";
        $rows = $db->query_lists($sql);
        foreach ($rows as $row){
        $power_id= $row['power_id'];
        $power_name = $row['power_name'];
        ?>
            <option value="<?php echo $power_id ;?>"><?php echo $power_name ;?></option>
        <?php
        }
        ?>
        </select>
	</li>
	<li>
	<label>&nbsp;</label>
	<input type="submit" name="btnAdd" id="btnAdd" value="确认保存" class="btn" > 
	<input type="button" name="btnSearch" id="btnSearch" onclick="fh()"
	       value="返回" class="btn" />  
	</li>
</ul>
</div>
</form>
</body>
</html>
