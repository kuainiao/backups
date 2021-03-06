<?php
class PayModel extends Model {

	//当前网站地址
	private $aliziHost = '';

	public function __construct(){
		$this->aliziHost = "http://".$_SERVER['HTTP_HOST'].C('ALIZI_ROOT');
	}
	//PC支付宝即时到账
	public function alipay($data,$aliziConfig){
		import('ORG.AlipayDirect.Alipay');
		$param  = array(
			'notify_url'    => $this->aliziHost.'/Api/alipay.php',    //服务器异步通知页面路径
			'return_url'    => $this->aliziHost.'/Api/alipayCallbak.php',  //页面跳转同步通知页面路径
			'merchant_url'  => $this->aliziHost,  //操作中断返回地址
			'seller_email'  => $aliziConfig['alipay_mail'],
			'out_trade_no'  => $data['order_no'],  //订单号
			'total_fee'     => $data['total_price'],     //付款金额
			'subject'       => $data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']),       //订单名称
		);
		$Alipay = new Alipay( $aliziConfig);
		$Alipay->submit($param);
	}

	//Wap支付宝
	public function alipayWap1($data,$aliziConfig){
		import('ORG.AliayWap.Alipay');
		$param  = array(
			'notify_url'    => $this->aliziHost.'/Api/alipayWap.php',    //服务器异步通知页面路径
			'call_back_url' => $this->aliziHost.'/Api/alipayCallbak.php',  //页面跳转同步通知页面路径
			'merchant_url'  => $this->aliziHost,  //操作中断返回地址
			'seller_email'  => $aliziConfig['alipay_mail'],
			'out_trade_no'  => $data['order_no'],  //订单号
			'total_fee'     => number_format($data['total_price'],2),     //付款金额
			'subject'       => $data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']),       //订单名称
		);

		$Alipay = new Alipay($aliziConfig);
		$Alipay->submit($param);    
	}
	public function alipayWap($data,$aliziConfig){
		Vendor('alipay.wap.lib.alipay_submit#class');
		
        $out_trade_no = $data['order_no'];  //订单号
        $subject = $data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']); //订单名称
        $total_fee = number_format($data['total_price'],2);     //付款金额
        $show_url = $data['url'];//收银台页面上，商品展示的超链接，必填
        $body = '';//商品描述，可空


		$alipay_config['partner'] = $aliziConfig['alipay_pid'];
		$alipay_config['seller_id']	= $aliziConfig['alipay_mail'];
		$alipay_config['key']   = $aliziConfig['alipay_key'];
		$alipay_config['notify_url'] = $this->aliziHost.'/Api/alipayWap.php';
		$alipay_config['return_url'] = $this->aliziHost.'/Api/alipayCallbak.php';
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		$alipay_config['transport']    = 'http';
		$alipay_config['payment_type'] = "1";
		$alipay_config['service'] = "alipay.wap.create.direct.pay.by.user";


		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service"       => $alipay_config['service'],
				"partner"       => $alipay_config['partner'],
				"seller_id"  => $alipay_config['seller_id'],
				"payment_type"	=> $alipay_config['payment_type'],
				"notify_url"	=> $alipay_config['notify_url'],
				"return_url"	=> $alipay_config['return_url'],
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset'])),
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"show_url"	=> $show_url,
				"app_pay"	=> "Y",//启用此参数能唤起钱包APP支付宝
				"body"	=> $body,	
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "confirm");
		echo $html_text;  
	}

	//支付宝担保交易
	public function alipayDb($data,$aliziConfig){
		Vendor('alipay.dbPay.alipay#class');
		$param  = array(
			'notify_url'    => $this->aliziHost.'/Api/alipayDb.php',    //服务器异步通知页面路径
			'return_url' => $this->aliziHost.'/Api/alipayCallbak.php',  //页面跳转同步通知页面路径
			'merchant_url'  => $this->aliziHost,  //操作中断返回地址
			'seller_email'  => $aliziConfig['alipay_mail'],
			
			'out_trade_no'  => $data['order_no'],  //订单号
			'price'     => $data['total_price'],     //付款金额
			'subject'       => $data['item_name'].'  '.$data['item_params'],       //订单名称

			'name'       => $data['name'], 
			'address'    => $data['address'], 
			'zcode'       => $data['zcode'], 
			'receive_phone' => $data['mobile'], 
			'receive_mobile' => $data['mobile'], 
		);
		$alipay = new alipay($aliziConfig);
		$alipay->submit($param);    
	}

	public function alipayNotify($aliziConfig){
        $out_trade_no = $_POST['out_trade_no'];//商户订单号
        $trade_no = $_POST['trade_no'];//支付宝交易号
        $trade_status = $_POST['trade_status'];//交易状态
        //支付记录
        $AlipayLog = M('AlipayLog');
        if($vo = $AlipayLog->create($_POST)){
            $vo['pay_type'] = 1; 
            $AlipayLog->add($vo);
        }
        import('ORG.AlipayDirect.Alipay');
        $Alipay = new Alipay($aliziConfig);
        $alipay_config = $Alipay->getConfig();
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {
            if($trade_status == 'TRADE_FINISHED') {
                //1、开通了普通即时到账，买家付款成功后。
                //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月、一年以内可退款等）后。
                logResult("TRADE_FINISHED");
            }else if ($trade_status == 'TRADE_SUCCESS') {
                //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
			$where  = array('order_no'=>trim($out_trade_no));
			$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
			if($order['status']==0){
	            	$data = array(
					'order_id'=>$order['id'],
					'status'=>1,
					'remark'=>htmlspecialchars($_POST['remark']),
				);
				$data['sign'] = createSign($data,C('ALIZI_KEY'));
	            	R('Api/aliziUpdateStatus',array('data'=>$data));
	            }
            }
            echo "success";
        }else {
            echo "fail";
        }
    }
    public function alipayWapNotify1($aliziConfig){
    	
		import('ORG.AliayWap.Alipay');
		$Alipay = new Alipay($aliziConfig);
		$alipayNotify = new AlipayNotify($Alipay->getConfig());
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			$xml = simplexml_load_string($_REQUEST['notify_data']);
			if( ! empty($xml->notify_id) ) {
				$out_trade_no = $xml->out_trade_no;//商户订单号
				$trade_no = $xml->trade_no;//支付宝交易号
				$trade_status = $xml->trade_status;//交易状态
				$buyer_email = $xml->buyer_email;//购买者邮箱
				
				$data = (array)$xml;
				$AlipayLog = M('AlipayLog');
				if($vo = $AlipayLog->create($_POST)){
					$vo['pay_type'] = 2; 
					$AlipayLog->add($vo);
				}
			
				if($trade_status == 'TRADE_FINISHED') {
					//该种交易状态只在两种情况下出现
					//1、开通了普通即时到账，买家付款成功后。
					//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
					echo "success";		//请不要修改或删除
				}else if ($trade_status == 'TRADE_SUCCESS') {
					//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
					$where  = array('order_no'=>trim($out_trade_no));
					$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
					if($order['status']==0){
			            	$data = array(
							'order_id'=>$order['id'],
							'status'=>1,
							'remark'=>htmlspecialchars($_POST['remark']),
						);
						$data['sign'] = createSign($data,C('ALIZI_KEY'));
			            	R('Api/aliziUpdateStatus',array('data'=>$data));
			            }
					echo "success";		//请不要修改或删除
				}
			}
		}else {
			echo "fail";//验证失败
		}
    }
	public function alipayWapNotify($aliziConfig){
    	
		Vendor('alipay.wap.lib.alipay_notify#class');
		
		$alipay_config['partner'] = $aliziConfig['alipay_pid'];
		$alipay_config['seller_id']	= $aliziConfig['alipay_mail'];
		$alipay_config['key']   = $aliziConfig['alipay_key'];
		$alipay_config['notify_url'] = $this->aliziHost.'/Api/alipayWap.php';
		$alipay_config['return_url'] = $this->aliziHost.'/Api/alipayCallbak.php';
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		$alipay_config['transport']    = 'http';
		$alipay_config['payment_type'] = "1";
		$alipay_config['service'] = "alipay.wap.create.direct.pay.by.user";
		
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
	
			//商户订单号

			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号
			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];

			$AlipayLog = M('AlipayLog');
			if($vo = $AlipayLog->create($_POST)){
				$vo['pay_type'] = 2; 
				$AlipayLog->add($vo);
			}
		
			if($_POST['trade_status'] == 'TRADE_FINISHED') {
			
			}else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
				$where  = array('order_no'=>trim($out_trade_no));
				$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
				if($order['status']==0){
					$data = array(
					'order_id'=>$order['id'],
					'status'=>1,
					'remark'=>htmlspecialchars($_POST['remark']),
				);
				$data['sign'] = createSign($data,C('ALIZI_KEY'));
					R('Api/aliziUpdateStatus',array('data'=>$data));
				}
				echo "success";		//请不要修改或删除
			}else {
				//验证失败
				echo "fail";
			}

		}
	}
	
    public function alipayDbNotify($aliziConfig){
     	Vendor('alipay.dbPay.alipay#class');
     	$alipay = new alipay($aliziConfig);
     	$alipayNotify = new AlipayNotify($alipay->getConfig());
		$verify_result = $alipayNotify->verifyNotify();
		$verify_result =1;
		if($verify_result) {
			$out_trade_no = $_POST['out_trade_no'];//订单号
			$trade_no = $_POST['trade_no'];//支付宝交易号
			$trade_status = $_POST['trade_status'];//交易状态
			$where  = array('order_no'=>trim($out_trade_no));
			$order = M('Order')->where($where)->find(); 

			if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
		     	echo "success";	
		     }else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
		     	if($order['status']==0){
		     		$data = array(
						'order_id'=>$order['id'],
						'status'=>1,
						'remark'=>htmlspecialchars($_POST['trade_no']),
					);
					$data['sign'] = createSign($data,C('ALIZI_KEY'));
			          R('Api/aliziUpdateStatus',array('data'=>$data));
		     	}
		        	echo "success";
		     }else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
	     		$data = array(
					'order_id'=>$order['id'],
					'status'=>3,
					'remark'=>htmlspecialchars($_POST['remark']),
				);
				$data['sign'] = createSign($data,C('ALIZI_KEY'));
		          R('Api/aliziUpdateStatus',array('data'=>$data));
		        	echo "success";	
		    }else if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//该判断表示买家已经确认收货，这笔交易完成
			    	$data = array(
					'order_id'=>$order['id'],
					'status'=>4,
					'remark'=>htmlspecialchars($_POST['remark']),
				);
				$data['sign'] = createSign($data,C('ALIZI_KEY'));
		          R('Api/aliziUpdateStatus',array('data'=>$data));
		        echo "success";
		    }else {
				//其他状态判断
		        echo "success";
		    }
		}else {
		    //验证失败
		    echo "fail";
		}
     }

     public function wxPayNotify(){
        $result_code = $_POST['result_code'];
        $out_trade_no = explode('-',$_POST['out_trade_no']);
        $transaction_id = $_POST['transaction_id'];
        if('SUCCESS'===$result_code){
            $where  = array('order_no'=>trim($out_trade_no[0]));
            $order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
            if($order['status']==0){
                $data = array(
	                'order_id'=>$order['id'],
	                'status'=>1,
	                'remark'=>htmlspecialchars($transaction_id),
	            );
	            $data['sign'] = createSign($data,C('ALIZI_KEY'));
	            R('Api/aliziUpdateStatus',array('data'=>$data));
            }
            echo "success";
        }
     }	
	 
	 public function yunpayNotify($aliziConfig){
		$yun_config['partner'] = $aliziConfig['yunpay_pid'];//合作身份者id
		$yun_config['key'] = $aliziConfig['yunpay_key'];//安全检验码
		$seller_email = $aliziConfig['yunpay_email'];//云会员账户（邮箱）
		$GLOBALS['i2ekeys']=$yun_config['key'];
		Vendor('yunpay.lib.yun_md5#function');
		
		$yunNotify = md5Verify($_REQUEST['i1'],$_REQUEST['i2'],$_REQUEST['i3'],$yun_config['key'],$yun_config['partner']);
		if($yunNotify) {
			
			$out_trade_no = $_REQUEST['i2'];//商户订单号
			$trade_no = $_REQUEST['i4'];//云支付交易号
			$yunprice=$_REQUEST['i1'];//价格
			
			$where  = array('order_no'=>trim($out_trade_no));
            $order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
			
			if($order['status']==0){
				$data = array(
					'order_id'=>$order['id'],
					'status'=>1,
					'remark'=>htmlspecialchars($trade_no),
				);
				$data['sign'] = createSign($data,C('ALIZI_KEY'));
				R('Api/aliziUpdateStatus',array('data'=>$data));
			}
			echo "success";
		}else {
			echo "fail";//验证失败,请不要修改或删除
		}
	 }
	
}

