<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME,'do'=>$_GET['do']));?>

<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3>
        	<strong><?php echo lang('breadclumb_colon');?></strong>
            <?php echo lang(MODULE_NAME);?><span></span><?php echo lang('category');?><span></span><?php if(empty($_GET["id"])): echo lang('add'); else: echo lang('edit'); endif; ?>
        </h3>
    </div>
    <div class="box clear-fix">
        <div class="layout-block-header"><h2><?php echo lang('details_info');?></h2></div>  
        <div id="AccountInfo">
            <div class="info-block">
                <form method="post" action="<?php echo U('Category/proccess');?>&type=category" id="ajaxform" enctype="multipart/form-data">
                <table class="info-table">
                    <tbody>
                        <tr>
                            <th><b class="verifing">*</b><?php echo lang('name_colon');?></th>
                            <td><input name="name" type="text" class="ui-text validate[required,minSize[2]]" value="<?php echo ($info["name"]); ?>" size="20"></td>
                        </tr>
                        <!--
                        <tr>
                            <th><?php echo lang('type_colon');?></th>
                            <td>
                                <select name="type">
									<?php echo (status($info["type"],"select",array('1'=>lang('item'),'2'=>lang('article')))); ?>
								</select>
                            </td>
                        </tr>
						-->
						<tr>
                            <th><?php echo lang('sortorder_colon');?></th>
                            <td>
                                <input name="sort_order" type="text" class="ui-text" value="<?php echo (intval($info["sort_order"])); ?>" size="4">
                                <span class="ui-validityshower-info">（数字越小越靠前）</span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>&nbsp;</th>
                            <td>
                            	<?php if(!empty($_GET['id'])): ?><input type="hidden" name="id" value="<?php echo ($_GET["id"]); ?>" />
								<?php else: ?>
								<input type="hidden" name="type" value="<?php echo ($_GET["type"]); ?>" /><?php endif; ?>
                                <input type="submit" class="btn btn-ok" value="<?php echo lang('confirm');?>" />
                                <a class="btn" href="<?php echo ($_SERVER['HTTP_REFERER']); ?>"><?php echo lang('goback');?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>  
    </div><!--.box-->
<link href="__PUBLIC__/Assets/js/validation/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
$(function(){
    $("#ajaxform").validationEngine('attach', {promptPosition : "centerRight", autoPositionUpdate : true});	
    $('#ajaxform').ajaxForm({
        timeout: 15000,
        error:function(){ $('#ajaxLoading').hide();alert("<?php echo lang('ajaxError');?>");},
        beforeSubmit:function(){ $('#ajaxLoading').show();},
        success:function(data){ 
            $('#ajaxLoading').hide();
            if(data.status==1){
                var redirectURL = "<?php echo ($_SERVER['HTTP_REFERER']); ?>";
                $.alert(data.info,data.status,function(){window.location.href=redirectURL});
            }else{
                $.alert(data.info,data.status);
            }
        },
        dataType: 'json'
    });
});

isLink('<?php echo ($info["is_link"]); ?>');
function isLink(id){
	if(parseInt(id)==1){
		$('.link_yes').show();	
		$('.link_no').hide();
	}else{
		$('.link_yes').hide();	
		$('.link_no').show();
	}
}
</script>     
       
<?php echo W("Foot");?>