<?php
class UserAction extends AliziAction {
	public function _initialize(){
        parent::_init();
    }
	function index($role='admin'){
		$role = $this->role=='agent'?'member':$role;
		$id = (int)$_GET['id'];
		$do = trim($_GET['do']);
		if(!empty($do)){
			$this->info($id);
			$this->display($do);exit;
		}
		$keyword = trim($_GET['keyword']);
		
		$Model = D('User');
		import('ORG.Util.Page');
		$where = "is_delete=0 AND role='{$role}' ";
		if($this->role!='admin') $where .= " AND pid=".$this->uid;
	
		if(!empty($keyword)) $where .= " AND (username LIKE '%{$keyword}%' )";
		$order = empty($orderby)?"id desc":"{$orderby} {$sort}";
		$count = $Model->where($where)->count();
		$page  = new Page($count,15);
		
		$list  = $Model->where($where)->limit($page->firstRow . ',' . $page->listRows)->order($order)->select();
		$show  = $page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display($role);
    } 
	
    function member(){
    	$this->index('member');
    }
	function agent(){
    	$this->index('agent');
    }
	
	//查看用户信息
	function info($user_id){
		$info = M('User')->where('id='.$user_id)->find();
		$group = M('UserGroup')->where(array('role'=>$info['role']))->order('id asc')->select();
		$this->assign('group',$group);
		$this->assign('info',$info);
	}
	function add(){
		$User = M('User');
		$agent = $User->where("is_delete=0 AND role='agent' ")->order('id asc')->select();
		
		$this->assign('agent',$agent);
		$this->display();
	}
	function getGroup($role='admin'){
		$list = M('UserGroup')->where(array('role'=>$role))->order('id asc')->select();
		$options =  '<option value="0">'.lang('select_group').'</option>';
		if($list){
			foreach($list as $li){ $options .= "<option value='{$li['id']}'>{$li['name']}</option>"; }
		}
		echo $options;
	}
	private function userGroup($role){
		$list = M('UserGroup')->where(array('role'=>$role))->order('id asc')->select();
		$agentAuth=$role=='agent'?C('AGENT_AUTH'):C('ADMIN_AUTH');
		$this->assign('agentAuth',$agentAuth);
		$this->assign('list',$list);
		$this->display('userGroup');
	}
	function userGroupEdit(){
		if(IS_POST){
			$data = array(
				'name'=>trim($_POST['name']),
				'role'=>trim($_POST['role']),
				'discount'=>(int)$_POST['discount'],
				'auth'=>implode('|',$_POST['auth']),
			);
			if(isset($_POST['id'])){
				M('UserGroup')->where(array('id'=>(int)$_POST['id']))->save($data);
			}else{
				M('UserGroup')->add($data);
			}
			$this->ajaxReturn(1,lang('success'),1);
		}else{
			$group = M('UserGroup')->where(array('id'=>(int)$_GET['id']))->find();
			$group['auth']=explode('|',$group['auth']);
			$auth = $_GET['role']=='agent'?C('AGENT_AUTH'):C('ADMIN_AUTH');

			$this->assign('group',$group);
			$this->assign('auth',$auth);
			$this->display('userGroupEdit');
		}
	}
	function agentGroup(){
		$this->assign('role','agent');
		$list = $this->userGroup('agent');
	}
	function adminGroup(){
		$this->assign('role','admin');
		$list = $this->userGroup('admin');
	}
	
	
}

