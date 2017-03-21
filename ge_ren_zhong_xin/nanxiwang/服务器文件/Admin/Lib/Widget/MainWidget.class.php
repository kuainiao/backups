<?php
class MainWidget extends Widget 
{
	public function render($data)
	{
		switch($_SESSION['user']['role'])
		{
			case 'admin':
				$menu = array(
					'Index' => array(array('name'=>'system_info','list'=>array('index'=>'basic_info','account'=>'account_setting')), array('name'=>'extend_manage','list'=>array('advert'=>'advert_slideshow')), ),
					'Item' => array(
						array('name'=>'item', 'list'=>array('index'=>'item_list', 'edit'=>'hand_add_item', 'uploads'=>'file_upload_item')), 
						array('name'=>'category', 'list'=>array('category'=>'category_list')),
						array('name'=>'statics', 'list'=>array('NotStatics'=>'not_statics_list', 'statics'=>'statics_list')), 
						// array('name'=>'upload', 'list'=>array('uploads'=>'file_upload_item')),
					),
					'Order' => array(array('name'=>'order','list'=>array('index'=>'all_order','import'=>'bulk_action')),array('name'=>'order_statistics','list'=>array('statistics'=>'order_statistics','channel'=>'channel_statistics','region'=>'region_statistics','time'=>'time_statistics','user'=>'user_statistics')),
					 ),
					'Article' => array(array('name'=>'article','list'=>array('index'=>'article_list','edit'=>'add_article')), array('name'=>'category','list'=>array('category'=>'category_list')), ),
					'User' => array(array('name'=>'user','list'=>array('index'=>'admin_list','agent'=>'agent_list','member'=>'member_list','add'=>'add_user')), 
						array('name'=>'user_group','list'=>array('adminGroup'=>'admin_group','agentGroup'=>'agent_group')),
					),
					'Setting' => array(array('name'=>'setting','list'=>array('index'=>'system_setting','database'=>'database_manage','shipping'=>'shipping_manage')),
						array('name'=>'recycle','list'=>array('item'=>'item_list','order'=>'order_list','user'=>'user_list')),
					 ),
				);
				if(!in_array('user',$_SESSION['user']['auth'])) unset($menu['User']);
				if(!in_array('article',$_SESSION['user']['auth'])) unset($menu['Article']);
				if(!in_array('setting',$_SESSION['user']['auth'])) unset($menu['Setting']);
				if(!in_array('itemAdd',$_SESSION['user']['auth'])) unset($menu['Item'][0]['list']['edit']);
				if(!in_array('itemCategory',$_SESSION['user']['auth'])) unset($menu['Item'][1]);
				if(!in_array('orderModify',$_SESSION['user']['auth'])) unset($menu['Order'][0]['list']['import']);
				if(!in_array('orderStatistics',$_SESSION['user']['auth'])) unset($menu['Order'][1]);
			break;	
			case 'agent':
				$menu = array(
					'Index'   => array( array('name'=>'system_info','list'=>array('index'=>'basic_info','account'=>'account_setting')),),
					'Item'   => array( array('name'=>'item','list'=>array('index'=>'item_list',)),),
					'Order'   => array( 
						array('name'=>'order','list'=>array('index'=>'all_order','import'=>'bulk_action')),
						array('name'=>'order_statistics','list'=>array('statistics'=>'order_statistics','channel'=>'channel_statistics')),
					 ),
					'User'   => array( array('name'=>'user','list'=>array('index'=>'member_list','add'=>'add_member')), ),
				);
				if(!in_array('user',$_SESSION['user']['auth'])) unset($menu['User']);
				if(!in_array('import',$_SESSION['user']['auth'])) unset($menu['Order'][0]['list']['import']);
			break;
			case 'member':
				$menu = array(
					'Index'   => array( array('name'=>'system_info','list'=>array('index'=>'basic_info','account'=>'account_setting')), ),
					'Item'   => array( array('name'=>'item','list'=>array('index'=>'item_list')), ),
					'Order'   => array( 
						array('name'=>'order','list'=>array('index'=>'all_order')), 
						array('name'=>'order_statistics','list'=>array('statistics'=>'order_statistics','channel'=>'channel_statistics')),
					),
				);
			break;
		}
		
		$data['menu'] = $menu;
		$data['user'] = $_SESSION['user'];
		return $this->renderFile ("index", $data);
	}
}
?>