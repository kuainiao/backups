<?php
namespace Home\Controller;
use Think\Controller;
class ExcelController extends BeforeController 
{
    public function index() 
    {
        // $where['id'] = $_SESSION['id'];
        // $where['jurisdiction'] = $_SESSION['jurisdiction'];
        // $Admin = M('Admin');
        // $res = $Admin->where($where)->find();
        // if($res && $where['jurisdiction'] !== 'admin')
        // {
        //     $this->display('index1');
        // }
        // else if($res && $res['jurisdiction'] === 'admin')
        // {   
        //     $this->display('index');
        // }
        // else
        // {
        //     $_SESSION = array();
        // }
        $this->CheckAdmin('index', 'index1');
    }

    // 处理手动添加Excel模版
    public function DoHandAdd()
    {
        $who = I('get.temp');
        $info1 = I('post.');

        // 删除空白信息
        $info = array();
        foreach($info1['info'] as $k => $v)
        {
            if(!empty($v))
            {
                $info[$k] = $v;
            }
        }
        if(empty($info))
        {
            $this->ReturnJudge('提交信息为空', 'index');
            exit();
        }
        // 调用导入模版模块
        $this->InsertTemp($who, $info);
    }

    // 处理上传Excel倒入模版
    public function DoExcelAdd()
    {
        $who = I('get.temp');
        // thinkphp 上传文件
        // 实例化上传类
        $up = new \Think\Upload();
        // 设置附件上传大小
        $up->maxSize  = 3145728 ;
        // 设置附件上传类型
        $up->exts     = array('xlsx', 'xls');
        // 设置附件上传根目录
        $up->rootPath = './Uploads/excel/'; 
        // 设置附件上传（子）目录
        $up->savePath = ''; 
        $up->saveName = date('Y-m-d H-i-s', time()) . '_' . mt_rand();
        // 上传文件 
        $res1 = $up->upload();
        if(!$res1) 
        {
            // 上传错误提示错误信息
            $this->ReturnJudge($up->getError());
            exit();
        }
        else
        {
            // 上传成功
            // 获取文件路径
            $file = '';
            foreach($res1 as $v){
                $file = 'Uploads/excel/'.$v['savepath'].$v['savename'];
            }

            // 获取excel内容
            $data = $this->ImportExcel($file);
            $data = $this->PreventSql($data);
            // var_dump($who);exit();
            // 调用导入模版模块
            if($who === 'myself' || $who === 'express')
            {
                // echo '模版';
                // 只传参Excel表头
                $this->InsertTemp($who, $data[1]);
            }
            // 调用导入数据模块
            else if($who === 'MyData' || $who === 'ExData')
            {
                // 删除Excel表头
                // unset($data[1]);
                // $data = array_values($data);
                $this->InsertData($who, $data);
            }
            else
            {
                $this->ReturnJudge('what are you 弄啥勒？', 'index');
                exit();
            }

        }
    }
    // 导入模版
    public function InsertTemp($who, $info)
    {
        // 添加自己的模版
        if($who === 'myself')
        {
            $who = 's';
            $Temp = M('self_temp');
        }
        // 添加圆通快递的模版
        else if($who === 'express')
        {
            $who = 'e';
            $Temp = M('yuantong_temp');
        }
        else
        {
            $this->ReturnJudge('你谁啊');
            exit();
        }

        // 查询当前模版下的tag最大的配置
        // 状态
        $where1['sta'] = 1;
        
        $res1 = $Temp->where($where1)->max('tag');
        if($res1)
        {
            // 将当前最大的tag保存到session中，后面用
            $_SESSION["$TempBeForeTag"] = $res1;
            $MaxTag = $res1 + 1;
        }
        else
        {
            $MaxTag = 1;
        }
        $_SESSION['TempInsertTag'] = $MaxTag;
        // 格式化提交过来的信息
        foreach($info as $k => $v)
        {
            $info[$k] = $k.'TitValueInterval'.$v;
        }
        $name = implode('ArrayInterval', $info);
        // php匹配信息中英文数字指定的符号等
        // preg_match_all('/[\x{4e00}-\x{9fa5}\w]+/u', $name, $name1);
        // 防止一下sql注入吧
        $name1 = $this->PreventSql($name);
        $name2 = explode('ArrayInterval', $name1);

        $info2 = array();
        foreach($name2 as $v)
        {
            $key = explode('TitValueInterval', $v)[0];
            $val = explode('TitValueInterval', $v)[1];
            $info2[$key] = $val;
        }

        $data2 = array();
        $time = time();
        foreach($info2 as $k => $v)
        {
            $data2[$k]['w_ad'] = $_SESSION['id'];
            $data2[$k]['a_t'] = $time;
            $data2[$k]['tag'] = $MaxTag;
            $data2[$k]['sta'] = 1;
            $data2[$k]['line'] = $k + 1;
            $data2[$k]['l_val'] = $v;
        }

        $data2 = array_values($data2);
        $where3['tag'] = $_SESSION["$TempBeForeTag"];
        // var_dump($where3['tag']);exit();
        // 插入数据前有数据
        if(!empty($where3['tag']))
        {   
            $data3['sta'] = 0;
            $res3 = $Temp->where($where3)->save($data3);

            $data4['sta'] = 1;  
            // 更新之前的数据失败回滚
            if($res3 === false)
            {   
                $Temp->where($where3)->save($data4);

                $this->ReturnJudge('更新出错，请重新操作', 'index');
                exit();
            }
            else
            {   
                // 重新将键值从0排列，负责插入数据的时候有点问题
                $res2 = $Temp->addAll($data2);
                if($res2)
                {
                    $this->ReturnJudge('添加模版成功', 'index');
                    exit();
                }
                else
                {
                    $where4['tag'] = $_SESSION['TempInsertTag'];
                    $Temp->where($where4)->delete();
                    $Temp->where($where3)->save($data4);

                    $this->ReturnJudge('添加模版失败', 'index');
                    exit();
                }
            }
        }
        // 插入数据前没有数据
        else
        {
            $res2 = $Temp->addAll($data2);
            if($res2)
            {
                $this->ReturnJudge('添加模版成功', 'index');
                exit();
            }
            else
            {
                $where4['tag'] = $_SESSION['TempInsertTag'];
                $Temp->where($where4)->delete();

                $this->ReturnJudge('添加模版失败', 'index');
                exit();
            }
        }
    }

    // 插入数据
    public function InsertData($who, $data)
    {
        // var_dump($who);
        // var_dump($data);
        if($who === 'MyData')
        {
            $Temp = M('self_temp');
            $TagModel = M('self_data_tag');
            $DataModel = M('self_data');
            // $DataTable = M();
        }
        else if($who === 'ExData')
        {
            $Temp = M('yuantong_temp');
            $TagModel = M('yuantong_data_tag');
            $DataModel = M('yuantong_data');
        }
        else
        {
            $this->ReturnJudge('不认你', 'index');
            exit();
        }

        // 查询当前模版的当前配置
        $where1['sta'] = 1;
        $res1 = $Temp->where($where1)->select();
        if($res1)
        {
            $val = array();
            foreach($res1 as $v)
            {
                $val[] = $v["l_val"];
            }
        }
        else
        {
            $this->ReturnJudge('当前模版配置为空', 'index');
            exit();
        }
// var_dump($val);
// var_dump($data[1]);
// exit();
        // 调用自己封装的函数，查看两个数组有什么不同
        $diff = $this->ArraYDif($val, $data[1]);
        // var_dump($val);
        // var_dump($data[1]);
        // var_dump($diff);
        // exit();
        // 模版配置文件与文件标题不同
        if($diff)
        {   
            $this->ReturnJudge('当前模版配置与当前文件的标题不同，请仔细检查', 'index');
            exit();
        }
        // 模版配置文件与文件标题相同
        else
        {   
            $time = time();
            $data2['d_tag'] = $_SESSION['d_tag'] = $this->CreateDataTag('self_data_tag');
            $data2['w_ad'] = $_SESSION['id'];
            $data2['a_t'] = $time;

            $data2['s_tag'] = 1;

            $res2 = $TagModel->add($data2);
            if($res2)
            {
                unset($data[1]);
                if(empty($data))
                {
                    $this->ReturnJudge('添加数据不能为空', 'index');
                    exit();
                }
           
                $data22 = array();
                $data222 = array();
                
                if($who === 'ExData')
                {
                    foreach($data as $k => $v)
                    {
                        $data22['d_tags'] = $_SESSION['d_tag'];
                        $data22['l0'] = isset($v[0]) ? $v[0] : '';
                        $data22['l1'] = isset($v[1]) ? $v[1] : '';
                        $data22['l2'] = isset($v[2]) ? $v[2] : '';
                        $data22['l3'] = isset($v[3]) ? $v[3] : '';
                        $data22['l4'] = isset($v[4]) ? $v[4] : '';
                        $data22['l5'] = isset($v[5]) ? $v[5] : '';
                        $data22['l6'] = isset($v[6]) ? $v[6] : '';
                        $data22['l7'] = isset($v[7]) ? $v[7] : '';
                        $data22['l8'] = isset($v[8]) ? $v[8] : '';
                        $data22['l9'] = isset($v[9]) ? $v[9] : '';
                        $data22['l10'] = isset($v[10]) ? $v[10] : '';
                        $data22['l11'] = isset($v[11]) ? $v[11] : '';
                        $data22['l12'] = isset($v[12]) ? $v[12] : '';
                        $data22['l13'] = isset($v[13]) ? $v[13] : '';

                        $data222[] = $data22;
                    }    
                }
                else if($who === 'MyData')
                {
                    foreach($data as $k => $v)
                    {
                        $data22['d_tags'] = $_SESSION['d_tag'];
                        $data22['l0'] = isset($v[0]) ? $v[0] : '';
                        $data22['l1'] = isset($v[1]) ? $v[1] : '';
                        $data22['l2'] = isset($v[2]) ? $v[2] : '';
                        $data22['l3'] = isset($v[3]) ? $v[3] : '';
                        $data22['l4'] = isset($v[4]) ? $v[4] : '';
                        $data22['l5'] = isset($v[5]) ? $v[5] : '';
                        $data22['l6'] = isset($v[6]) ? $v[6] : '';
                        $data22['l7'] = isset($v[7]) ? $v[7] : '';
                        $data22['l8'] = isset($v[8]) ? $v[8] : '';
                        $data22['l9'] = isset($v[9]) ? $v[9] : '';
                        $data22['l10'] = isset($v[10]) ? $v[10] : '';
                        $data22['l11'] = isset($v[11]) ? $v[11] : '';
                        $data22['l12'] = isset($v[12]) ? $v[12] : '';
                        $data22['l13'] = isset($v[13]) ? $v[13] : '';
                        $data22['l14'] = isset($v[14]) ? $v[14] : '';
                        $data22['l15'] = isset($v[15]) ? $v[15] : '';
                        $data22['l16'] = isset($v[16]) ? $v[16] : '';
                        $data22['l17'] = isset($v[17]) ? $v[17] : '';
                        $data22['l18'] = isset($v[18]) ? $v[18] : '';
                        $data22['l19'] = isset($v[19]) ? $v[19] : '';
                        $data22['l20'] = isset($v[20]) ? $v[20] : '';
                        $data22['l21'] = isset($v[21]) ? $v[21] : '';
                        $data22['l22'] = isset($v[22]) ? $v[22] : '';
                        $data22['l23'] = isset($v[23]) ? $v[23] : '';

                        $data222[] = $data22;
                    }
                }

                $res22 = $DataModel->addALL($data222);
                if($res22)
                {
                    $this->ReturnJudge('添加数据成功', 'index');
                    exit();
                }
                else
                {
                    $where3['d_tag'] = $_SESSION['d_tag'];
                    $where33['d_tags'] = $_SESSION['d_tag'];
                    $res3 = $TagModel->where($where3)->delete();
                    $res33 = $DataModel->where($where33)->delete();
                    if($res3 && $res33)
                    {
                        $this->ReturnJudge('添加数据失败唲', 'index');
                        exit();
                    }
                    else
                    {
                        $this->ReturnJudge('请联系管理员', 'index');
                        exit();
                    }
                }
            }
            else
            {
                $this->ReturnJudge('添加数据失败咦', 'index');
                exit();
            }
        
        }
    }

    // 展示当前模版
    public function ShowTemp()
    {
        $who = $this->PreventSql(I('get.temp'));
        // 用户模版
        if($who === 'user')
        {
            $who = 1;
            $Temp = M('self_temp');
        }
        // 快递模版
        else if($who === 'express')
        {
            $who = 2;
            $Temp = M('yuantong_temp');
        }
        else
        {
            $this->ReturnJudge('你想干森么', 'index');
            exit();
        }
        $where1['sta'] = 1; 
        $res1 = $Temp->where()->max('tag');

        if($res1)
        {
            $where1['tag'] = $res1;
            $res2 = $Temp->where($where1)->select();

            if($res2)
            {
                $where3['u_id'] = $res2[0]['w_ad'];
                $Admin = M('Admin');
                $res3 = $Admin->where($where3)->getField('u_name');
                $time = $res2[0]['a_t'];

                $this->assign('who', $who);
                $this->assign('user', $res3);
                $this->assign('time', $time);
                $this->assign('info', $res2);
                $this->display();
            }
            else
            {
                $this->ReturnJudge('当前模版不存在', 'index');
                exit();
            }
        }  
        else
        {
            $this->ReturnJudge('当前模版为空', 'index');
            exit();
        }
    }

    // 修改当前模版
    public function UpdTemp()
    {
        $who = $this->PreventSql(I('get.temp'));
        $info1 = $this->PreventSql(I('post.'));

        // 用户模版
        if($who === '1')
        {
            $Temp = 'self_temp';
        }
        // 快递模版
        else if($who === '2')
        {
            $Temp = 'yuantong_temp';
        }
        else
        {
            $this->ReturnJudge('what are you 弄啥勒？', 'index');
            exit();
        }

        $data1 = array();
        $ids = array();
        foreach($info1 as $k => $v);
        {
            foreach($v as $key => $val)
            {
                if(!empty($val))
                {
                    $ids['id'][] = $key;
                    $data1[]['l_val'] = $val;
                }
            }
        }
        $time1 = time();
        foreach($data1 as $k => $v)
        {
            $data1[$k]['w_upd'] = $_SESSION['id'];
            $data1[$k]['u_t'] = $time1; 
        }
        // 将数组键值重新从0开始
        // $data1 = array_values($data1);
        // 取出二维数组中的所有一位数组的键值
        // $id = array_column($data1, 'id');
        // 调用父方法，更新所有数据，有事务处理
        $res1 = $this->SaveAll($ids, $data1, $Temp);
        if($res1)
        {
            $this->ReturnJudge('更新成功', 'index');
            exit();
        }
        else
        {
            $this->ReturnJudge('更新失败', 'index');
            exit();
        }
    }

    // 筛选数据
    public function ScreenData()
    {
        $act = I('get.act');
        $act = $this->PreventSql($act);

        $where1['sta'] = 1;
        
        $Model = M('Screen');
        $res1 = $Model->where($where1)->getField('s_id, s_act, e_val, u_val, name');

        // var_dump($res1);
        // 存在筛选数据的配置 
        if($res1)
        {   
            // echo 2;
            if($act === 'screen')
            {
                // echo 1;
                $this->assign('screen', $res1);
                $this->CheckAdmin('ScreenData', 'ScreenData1');
                // $this->display('ScreenData');
            }
            else if($act === 'upds')
            {
                // 获取当前配置数据
                // 并且获取各自配置表中的line
                $ExpressTemp1 = array();
                $UserTemp1 = array();
                foreach($res1 as $k => $v)
                {
                    $ExpressTemp1[] = $v['e_val'];
                    $UserTemp1[] = $v['u_val'];
                    $data2[$k] = $v;
                }

                // 删除空line与重复的line
                // 用户配置表
                $UserTemp2 = array();
                foreach($UserTemp1 as $k => $v)
                {
                    if(!empty($v))
                    {
                        $UserTemp2[$v] = $v;
                    }
                }

                // 快递配置表
                $ExpressTemp2 = array();
                foreach($ExpressTemp1 as $k => $v)
                {
                    if(!empty($v))
                    {
                        $ExpressTemp2[$v] = $v;
                    }
                }

                // 查找对应表中的line，l_val
                $where3['sta'] = $where33['sta'] = 1;
                $where3['line'] = array('in', implode(',', $UserTemp2));
                $where33['line'] = array('in', implode(',', $ExpressTemp2));

                $Model3 = M('self_temp');
                $Model33 = M('yuantong_temp');

                $res3 = $Model3->where($where3)->getField('line, l_val');
                $res33 = $Model33->where($where33)->getField('line, l_val');
                if(!$res3 || !$res33)
                {
                    $this->ReturnJudge('未知错误，请联系管理员', 'index');
                    exit();
                }

                // 拼接数据
                $data22 = array();
                foreach($data2 as $k => $v)
                {
                    if(!empty($v['e_val']))
                    {
                        if(isset($res33[$v['e_val']]))
                        {
                            $v['value1'] = $res33[$v['e_val']];
                        }
                    }
                    if(!empty($v['u_val']))
                    {
                        if(isset($res3[$v['u_val']]))
                        {
                            $v['value2'] = $res3[$v['u_val']];
                        }
                    }
                    $data22[] = $v;
                }   
                $data222 = $this->GetTempSetting();
                // $UserTemp = $data222['UserTemp'];
                // $ExpressTemp = $data222['ExpressTemp'];

                $data2222 = array();
                foreach($data22 as $k => $v)
                {
                    $data2222[$k] = $v;
                    $data2222[$k]['UserTemp'] = $data222['UserTemp'];
                    $data2222[$k]['ExpressTemp'] = $data222['ExpressTemp'];
                }
// var_dump($data22);
// var_dump($data2222);
// var_dump($UserTemp);
                // $this->assign('UserTemp', $UserTemp);
                // $this->assign('ExpressTemp', $ExpressTemp);
                $this->assign('data', $data2222);
                $this->assign('sta', '修改');
                $this->display('ScreenSeted');
            }
        }
        // 不存在筛选数据的配置
        else
        {
            // echo 3;
            $data1 = $this->GetTempSetting();
// var_dump($data1);
            $this->assign('sta', '当前筛选数据模版为空，请添加');
            $this->assign('data', $data1);
            $this->display('ScreenSet');
        }
    }

    // 读取模版配置表
    public function GetTempSetting()
    {
        $where1['sta'] = 1;

        $Model1 = M('self_temp');
        $Model2 = M('yuantong_temp');

        $where2['tag'] = $Model1->where($where1)->max('tag');
        $where22['tag'] = $Model2->where($where1)->max('tag');

        $res1 = $Model1->where($where2)->select();
        $res2 = $Model2->where($where22)->select();

        if(!$res1)
        {
            $this->ReturnJudge('用户配置表为空，请更新用户配置表', 'index');
            exit();
        }
        else if(!$res2)
        {
            $this->ReturnJudge('快递配置表为空，请更新快递配置表', 'index');
            exit();
        }
        else if($res1 && $res2)
        {
            $data['UserTemp'] = $res1; 
            $data['ExpressTemp'] = $res2; 

            return $data;
        }
        else
        {
            $this->ReturnJudge('嘿嘿', 'index');
            exit();
        }
    }

    // 设置筛选配置
    public function DoScreenData()
    {
        // var_dump($_POST);
        // var_dump($_GET);
        // echo 1;
        // exit();
        $info = I('post.');
        $act = I('get.act');
        $info = $this->PreventSql($info);
        $act = $this->PreventSql($act);
// var_dump($info);exit();
        // 删除空数据
        foreach($info as $k => $v)
        {
            if($v['Express'] === 'shenshuang' && $v['User'] === 'shenshuang' && $v['name'] === '')
            {
                unset($info[$k]);
            }
        }
        
        // 如果添加筛选配置为空的话返回
        if(empty($info))
        {
            $this->ReturnJudge('筛选配置数据不能为空', 'index');
            exit();
        }

        // 添加筛选配置表
        // 更新筛选配置表
        // var_dump($act);exit();
        if($act === 'adds' || $act === 'upds')
        {
            $where1['sta'] = 1;
            $Model = M('Screen');
            $res1 = $Model->where($where1)->max('s_tag');

            // 筛选配置表中存在数据
            if($res1)
            {
                // echo 1;exit();
                $where3['s_tag'] = $_SESSION['s_tag'] = $res1;
                $data3['sta'] = 0;

                $res3 = $Model->where($where3)->save($data3);
                if($res3)
                {
                    $max = $res1 + 1;
                }
                else
                {
                    $this->ReturnJudge('更新配置表失败', 'index');
                    exit();
                }
            }
            // 筛选数据表中不存在数据
            else
            {
                $max = 1;
            }

            $time = time();
            $data2 = array();
            $data22 = array();

            foreach($info as $k => $v)
            {
                if($v['Express'] === 'shenshuang')
                {
                    $v['Express'] = '';
                }
                if($v['User'] === 'shenshuang')
                {
                    $v['User'] = '';
                }
// var_dump($v);exit();
                $data2['w_ad'] = $_SESSION['id'];
                $data2['a_t'] = $time;
                $data2['s_tag'] = $max;
                $data2['e_val'] = $v['Express'];
                $data2['u_val'] = $v['User'];
                $data2['name'] = $v['name'];
                $data2['s_act'] = $v['act'];
                $data2['sta'] = 1;

                $data22[] = $data2;
            }

            $res2 = $Model->addAll($data22);
            if($res2)
            {
                $this->ReturnJudge('添加筛选配置数据成功', 'index');
                exit();
            }
            else
            {
                $data4['sta'] = 1;
                $Model->where($where3)->save($data4);
                $where44['s_tag'] = $max;
                $Model->where($where44)->delete();
                $this->ReturnJudge('添加筛选配置数据失败', 'index');
                exit();
            }
        }
        else
        {
            $this->ReturnJudge('哈哈', 'index');
            exit();
        }
    }
}