<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php if(empty($info["name"])): echo ($aliziConfig["title"]); else: echo ($info["name"]); endif; ?></title>
<meta charset="utf-8" />
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="dns-prefetch" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" name="viewport">
<meta name="description" content="<?php if(empty($info["brief"])): echo ($aliziConfig["description"]); else: echo ($info["brief"]); endif; ?>">
<meta name="keywords" content="<?php if(!empty($info["tags"])): echo str_replace('#',' ',$info['tags']); endif; ?> <?php echo ($aliziConfig["keywords"]); ?>">
<meta name="author" content="<?php echo lang('author');?>">
<link rel="shortcut icon" href="__PUBLIC__/Assets/img/alizi.ico" />
<link href="__PUBLIC__/Alizi/alizi-order.css?v=<?php echo (ALIZI_VERSION); ?>" rel="stylesheet">
<!--[if lt IE 9]><link href="__PUBLIC__/Alizi/alizi-ie.css?v=<?php echo (ALIZI_VERSION); ?>" rel="stylesheet"><![endif]-->
<script type="text/javascript" src="__PUBLIC__/Alizi/seajs/seajs/sea.js"></script>
<script type="text/javascript">
var aliziHost = "<?php echo ($aliziHost); ?>",aliziRoot = "<?php echo C('ALIZI_ROOT');?>",aliziVersion="<?php echo (ALIZI_VERSION); ?>-<?php echo C('ALIZI_KEY');?>",lang="<?php echo C('DEFAULT_LANG');?>";
seajs.config({ base: '__PUBLIC__/Alizi/seajs/',alias: {'jquery': 'jquery/jquery','alizi': 'alizi/alizi','lang': 'alizi/lang-'+lang}, map: [['.css', '.css?v=' + aliziVersion],['.js', '.js?v=' + aliziVersion]]});
</script>

<link href="__PUBLIC__/Alizi/pc/alizi.css?v=<?php echo (ALIZI_VERSION); ?>" rel="stylesheet">
<script type="text/javascript">
seajs.use(['jquery/lazyload'], function() {
    $(".alizi-lazy").lazyload({ placeholder : "__PUBLIC__/Alizi/alizi.gif",effect : "fadeIn"});
});
</script>

<style>
.alizi-detail-wrap{max-width:<?php echo $template['width']; ?>;}
<?php $color = $template['color'];if($color && !in_array(MODULE_NAME,array('Item'))){ ?>
body{background-color:#<?php echo $color['body_bg']; ?>;}
.alizi-detail-content{padding:<?php echo $template['extend']['padding']; ?>;}
.alizi-detail-content h2{border-top-color:#<?php echo $color['body_bg']; ?>;}
.alizi-border,.alizi-side.alizi-full-row{border-color:#<?php echo $color['border']; ?>;}
.alizi-order{color:#<?php echo $color['font'] ?>;background-color:#<?php echo $color['form_bg']; ?>;}
.alizi-detail-header dt{color:#<?php echo $color['font']; ?>;}
.alizi-title{background-color:#<?php echo $color['title_bg']; ?>;}
.alizi-btn,.alizi-btn:hover, .alizi-btn:active,.alizi-badge,.alizi-params.active,.alizi-group-box input:checked + label:after{background-color:#<?php echo $color['button_bg']; ?>;border-color:#<?php echo $color['button_bg']; ?>;}
.alizi-foot-nav{background-color:#<?php echo $color['nav_bg']; ?>}
.alizi-group.alizi-params.alizi-checkbox.active:hover{background-color:#<?php echo $color['button_bg']; ?> !important;border-color:#<?php echo $color['button_bg']; ?> !important;color:#fff !important;}
<?php } ?>
</style>
</head>
<body>
<?php if(!empty($aliziConfig["notice"])): ?><div class="aliziAlert"><a class="close" onclick="$('.aliziAlert').slideUp(500);">×</a><?php echo ($aliziConfig["notice"]); ?></div><?php endif; ?>

<div class="header">
	<div class="mainwidth">
		<div class="headtop">
			<span class="place cur_city_name">
				<form action="<?php echo U('Index/category');?>" method="get" class="search_form">
					<input type="text" name="kw" class="search_input" placeholder="<?php echo lang('item_search');?>" value="<?php echo ($_GET['kw']); ?>" />
					<input type="submit" value="" class="search_button">
					<input type="hidden" name="m" value="Index" class="search_button">
					<input type="hidden" name="a" value="category" class="search_button">
				</form>
			</span>
			 
			<div class="topright">
				<?php  ?>
				<a href="<?php echo U('Item/index');?>" class="phone"><?php echo lang('themeMobile');?></a>
			</div>
			
		</div>
		<div class="logobox">
			<a href="<?php echo ($aliziHost); ?>" class="logo">
				<img title="<?php echo ($aliziConfig["title"]); ?>" alt="<?php echo ($aliziConfig["title"]); ?>" src="<?php if(empty($aliziConfig["logo_pc"])): ?>__PUBLIC__/Alizi/pc/logo.png<?php else: echo (imageurl($aliziConfig["logo_pc"])); endif; ?>">
			</a>
		</div>
		<div class="nav">
			<ul>
				<li style = 'width: 16%;' <?php if((ACTION_NAME) == "index"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><span data-hover="<?php echo lang('index');?>"><?php echo lang('index');?></span></a></li>
				<li style = 'width: 16%;' class="li_2 <?php if((ACTION_NAME) == "category"): ?>active<?php endif; ?>"><a href="<?php echo U('Index/category');?>"><span data-hover="<?php echo lang('item_category');?>"><?php echo lang('item_category');?></span></a></li>
				<li style = 'width: 16%;' <?php if((ACTION_NAME) == "query"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/query');?>"><span data-hover="<?php echo lang('order_query');?>"><?php echo lang('order_query');?></span></a></li>
				<li style = 'width: 16%;' <?php if((ACTION_NAME) == "article"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/article');?>"><span data-hover="<?php echo lang('article');?>"><?php echo lang('article');?></span></a></li>
			</ul>
		</div>
		
	</div>
</div>

<div class="container">
    <div class="mainwidth">
        <div class="meminfo topban"><div class="infoleft "><span class="name"><?php echo lang('item_category');?></span></div></div>
        <div class="promenu">
            <div class="cake">
                <a data-id="0" href="<?php echo U('Index/category');?>" <?php if(empty($_GET["id"])): ?>class="active"<?php endif; ?>><?php echo lang('all_category');?></a>
                <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a data-id="<?php echo ($vo["id"]); ?>" href="<?php echo U('Index/category',array('id'=>$vo['id']));?>" <?php if(($vo["id"]) == $_GET['id']): ?>class="active"<?php endif; ?>><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div id="product-list">
            <ul class="prolist" id="alizi-category">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="li_on">
                    <div class="img">
                        <a href="<?php echo U('Index/order',array('id'=>$vo['sn']));?>&do=show" title="<?php echo ($vo["name"]); ?>"><img src="<?php echo (imageurl($vo["image"])); ?>"  class="alizi-lazy"><span></span></a>
                    </div>
                    <span class="textcon">
                        <span class="title"><?php echo ($vo["name"]); ?></span>
                        <span class="price">
                            <?php echo lang('symbol'); echo ($vo["price"]); ?>
                            <?php if(floatval($vo['original_price']) > 0): ?><del><?php echo lang('symbol'); echo ($vo["original_price"]); ?></del><?php endif; ?>
                        </span>
                        <span class="text"><?php echo ($vo["brief"]); ?></span>
                        <a href="<?php echo U('Index/order',array('id'=>$vo['sn']));?>&do=show" title="<?php echo ($vo["name"]); ?>" class="line_a"><?php echo lang('detail');?></a>
                    </span>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="paginal"><?php echo ($page); ?></div>
    </div>
</div>


<div class="footer">
	<div class="mainwidth">
		<!-- <ul class="footcon"> 修改一-->
			<!-- <li> 修改一-->
				<div class="copyright"><?php echo ($aliziConfig["footer"]); ?></div>
			<!-- </li>
			<li> 修改一-->
				<div class="foottel">
					<span class="tell"><?php echo lang('serviceNumber');?><span class="num"><?php echo ($aliziConfig["contact_tel"]); ?></span></span>
					<?php if(!empty($aliziConfig["contact_qq"])): ?><span class="online"><?php echo lang('online_service');?><span class="num"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($aliziConfig["contact_qq"]); ?>&site=qq&menu=yes" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($aliziConfig["contact_qq"]); ?>:51 &amp;r=0.22914223582483828"></a></span></span>
					<?php else: ?><br /><?php endif; ?>
				</div>
				
			<!-- </li> 修改一-->
		<!-- </ul> 修改一-->
	</div>
</div>
<div id="aliziUp"></div>
<script type="text/javascript">
seajs.use(['jquery/scrollup'], function(){ $.scrollUp({scrollName: 'aliziUp'}); });
</script>

<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');if(ac){ $.cookie('ac',ac);}})
</script><?php endif; ?>
</body>
</html>