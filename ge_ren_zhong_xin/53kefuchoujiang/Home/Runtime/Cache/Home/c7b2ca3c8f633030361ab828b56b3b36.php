<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel = 'stylesheet' type = 'text/css' href = '/kefuchoujiang/Public/HomeCss/reset.css'>
<style type="text/css">  
#input{
    width: 200px; 
    height: 63px; 
    border: 1px solid black; 
    background: #FC3DD7;
    float: left;
}
#input:hover{
    background: #F21AA1;
}
input{
    display: block;
    width: 500px; 
    height: 60px; 
    line-height: 60px;
    text-indent: 20px;
}
</style>
</head>
<body>
    <center> 
        <div style = 'width: 1300px; height: 856px; border: 1px solid black;'>
            <div id = 'edit'>
                <span style = 'display: block; width: 100%; height: 60px; line-height: 60px; background: #C4C4C4; border-bottom: 1px solid black; font-size: 20px;'>编辑用户信息</span>
                <span style = 'display: block; width: 100%; height: 50px; line-height: 50px; color: red;'><?php echo ($status); ?></span>
                <form action = '/kefuchoujiang/index.php/Home/ShenShow/ShenEdit' method = 'post' style = 'width: 700px; height: 600px; border: 1px solid #A4A4A4;' onsubmit = "return submitFun(this);" >
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>用户名</span>
                    <input type = 'text' name = 'name' value = '<?php echo ($info["user"]); ?>' />
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>奖品</span>
                    <input type = 'text' name = 'prize' value = '<?php echo ($info["prize"]); ?>' />
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>电话</span>
                    <input type = 'text' name = 'tel' value = '<?php echo ($info["tel"]); ?>' />
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>收货地址</span>
                    <input type = 'text' name = 'address' value = '<?php echo ($info["address"]); ?>' />
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>套餐</span>
                    <input type = 'text' name = 'combo' value = '<?php echo ($info["combo"]); ?>' />
                    <span style = 'display: block; width: 500px; height: 30px; line-height: 30px; text-align: left; text-indent: 20px;'>金额</span>
                    <input type = 'text' name = 'money' value = '<?php echo ($info["money"]); ?>' />
                    <input type = 'hidden' name = 'id' value = '<?php echo ($info["id"]); ?>' />
                    <input type = 'hidden' name = 'form' value = '<?php echo ($info["form"]); ?>' />
                    <div style = 'width: 500px; height: 70px; margin-top: 30px;'>  
                        <input type = 'submit' value = '提交'  id = 'input'>
                        <a href = '/kefuchoujiang/index.php/Home/ShenShow/ShenDo' style = 'display: block; width: 200px; height: 60px; line-height: 60px; background: #FC3DD7; border: 1px solid black; float: left; margin-left: 97px;' ><span>返回前一页</span></a>
                    </div>
                </form>
            </div>
        </div>
    </center>
</body>
<script language="javascript">
function submitFun(obj)
{
    if(document.getElementsByName('name')[0].value.length < 1){
        alert('用户名不能为空');
        return false;

    }
    if(document.getElementsByName('tel')[0].value.length < 1){

        alert('用户电话不能为空');
        return false;
    }
    if(document.getElementsByName('address')[0].value.length < 1){
        alert('用户地址不能为空');
        return false;
    }
    if(document.getElementsByName('combo')[0].value.length < 1){
        alert('套餐不能为空');
        return false;
    }
    if(document.getElementsByName('money')[0].value.length < 1){
        alert('金额不能为空');
        return false;
    }
    if(document.getElementsByName('prize')[0].value.length < 1){
        alert('奖品不能为空');
        return false;
    }
}
</script>

</html>