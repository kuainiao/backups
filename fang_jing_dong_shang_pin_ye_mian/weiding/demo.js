function weixin(sta)
{
    var div = document.getElementById('weixindiag');
    // ��ȡbody��
    var wid = document.getElementById('page').offsetWidth;
    // ��ȡ����ȥbody��
    var gao = document.body.scrollTop;
    // ��ǰ�����
    var gao1 = document.body.clientHeight;

    if(sta == 0)
    {
        div.style.display = 'block';
        div.style.marginLeft = (wid - div.offsetWidth) / 2 + 'px';
        div.style.marginTop = (gao1 - div.offsetHeight) / 2 + gao + 'px';
    }
    else if(sta == 1)
    {
        div.style.display = 'none';
    }
}
// ��ȡ��ǰ��
window.onload = function()
{
    var date = new Date();
    // alert(date.getDate());
    var txt = date.getDate();
    var now = document.getElementById('now');
    now.innerHTML = txt + '��' + '����' + '-' + (txt + 1) + '��' + '����';

    var numbers = document.getElementById('number');
    var number = numbers.value;
    if(number > 10)
    {
        alert('������˴�������Ʒ���Ƿ���Ҫ��ϵ�¿ͷ�');
    }

    GetTime();
    CheckIn();
}
// input ���б�ɫ
function ReColor(obj)
{
    // alert(obj.id);
    var divs = document.getElementsByClassName(obj.className);
    var i = 0;
    var num = divs.length;
    for(i = 0; i < num; i ++)
    {
        divs[i].style.color = 'black';
        divs[i].style.border = '1px solid #B2B1B1';
    }
    var div = document.getElementById(obj.id);

    div.style.color = 'red';
    div.style.border = '1px solid red';
    var qians = new Array('198', '198', '298', '298', '398', '398');
    var numbers = new Array('1508��ɫ', '1508��ɫ', '1508��ɫ����', '1508��ɫ����', '1508��+1508��ɫ����', '1508��+1508��ɫ����');
    var imgs = new Array('33.jpg', '44.jpg', '11.jpg', '22.jpg', '11.jpg', '22.jpg');
    var chicun = new Array('170/M��', '175/L��', '180/XL��', '185/XXL��', '190/XXXL��');
    // alert(qian[n]);
    var n = div.id;
    var len = qians.length;
    var nu = n - len;
    var img = document.getElementById('imgs');
    var qian = document.getElementById('qian');
    var number = document.getElementById('num');
    var shu = document.getElementById('number');
    var chi = document.getElementById('chi');
    var yixuantaocan = document.getElementById('yixuantaocan');
    var yixuanchicun = document.getElementById('yixuanchicun');
    // var CunDan = document.getElementById('CunDan');
    // alert(n);
    var Dan = qians[n];
    if(n < len)
    {   
        // alert(qians[n]);
        img.innerHTML = "<img src = 'images_files/" + imgs[n] + "' />";
        var qians = qians[n] * shu.value;
        qian.innerHTML = '��' + qians + '.00';
        number.innerHTML = '��Ʒ���&nbsp;:&nbsp;' + numbers[n];
        yixuantaocan.innerHTML = '&nbsp;' + numbers[n];
        document.getElementById('CunDan').innerHTML = Dan;
    }
    else if(n >= len)
    {
        chi.innerHTML = '&nbsp;' + chicun[nu];
        yixuanchicun.innerHTML = '&nbsp;' + chicun[nu];
    }
    GetMoney();
}
// �����Ӽ�
function CheckNum(num)
{
    var numbers = document.getElementById('number');
    var number = numbers.value;
    // alert(number);
    if(num == 1)
    {
        if(number == 1)
        {
            alert('��Ʒ�����Ѿ�Ϊ1���벻Ҫ�ټ�');
            return false;
        }
        else if(number != 1)
        {
            numbers.value = number - 1;
        }
    }
    else if(num == 2)
    {
        // alert(22);
        if(number >= 10)
        {
            alert('������˴�������Ʒ���Ƿ���Ҫ��ϵ�¿ͷ�');
            numbers.value = number * 1 + 1 * 1;
        }
        else if(number < 10)
        {
            // alert(parsInt(number));
            numbers.value = number * 1 + 1 * 1;
        }
    }
    else
    {
        return 'ɵ��';
    }
    GetMoney();
}
function GetMoney()
{
    // alert(1);
    var qian = document.getElementById('CunDan');
    var num = document.getElementById('number');
    var money = qian.innerHTML;
    var nums = num.value;
    // alert(nums);
    var zong = document.getElementById('zong');
    var dan = document.getElementById('dan');
    var qians = document.getElementById('qian');
    qians.innerHTML = zong.value = dan.value = money * nums;
}
// ���� ��ʾ div
function hide(div)
{
    // alert(div);
    var a = document.getElementById(div);
    var cuxiao1 = document.getElementById('cuxiao1');
    var info = document.getElementById('info');
    var infos = document.getElementById('infos');
    var infoss = document.getElementById('infoss');
    if(div == 'info')
    {
        infos.style.display = 'none';
        infoss.style.display = 'none';
        cuxiao1.style.display = 'none';
    }
    else if(div == 'infos')
    {
        info.style.display = 'none';
        infoss.style.display = 'none';
        cuxiao1.style.display = 'none';
    }
    else if(div == 'infoss')
    {
        info.style.display = 'none';
        infos.style.display = 'none';
        cuxiao1.style.display = 'none';
    }
    else if (div == 'cuxiao1')
    {
        info.style.display = 'none';
        infos.style.display = 'none';
        infoss.style.display = 'none';
    }
    // alert(a);
    if(a.style.display == 'none')
    {
        a.style.display = 'block'
    }
    else
    {
        a.style.display = 'none'
    }
    CheckArea();
    CheckIn();
}
// js��ȡʱ�����ֵ������id
function GetTime()
{
    var times = new Date();
    var years = times.getFullYear();
    var mons = times.getMonth()+1;
    var days = times.getDate();
    var hours = times.getHours(); 
    var mins = times.getMinutes();
    var secs = times.getSeconds();
    // �������������
    function rd(n,m){
        var c = m-n+1;  
        return Math.floor(Math.random() * c + n);
    }
    var txt = 'no.' + years + mons + days + hours + mins + secs + rd(111, 999);
    var input = document.getElementById('orderid');
    input.value = txt;
}  
// ����ַ��
// ��ȡselectѡ�е�ֵ
function CheckArea()
{
    // ��ȡselectѡ�е�ֵ
    var obj1 = document.getElementById('s_province'); //��λid
    var index1 = obj1.selectedIndex; // ѡ������
    var text1 = obj1.options[index1].text; // ѡ���ı�
    // var value1 = obj.options[index1].value; // ѡ��ֵ
    // alert(text1);
    // alert(value1);
    var obj2 = document.getElementById('s_city'); //��λid
    var index2 = obj2.selectedIndex; // ѡ������
    var text2 = obj2.options[index2].text; // ѡ���ı�
    // var value2 = obj.options[index].value; // ѡ��ֵ
    // alert(text2);
    var obj3 = document.getElementById('s_county'); //��λid
    var index3 = obj3.selectedIndex; // ѡ������
    var text3 = obj3.options[index3].text; // ѡ���ı�
    // var value3 = obj.options[index3].value; // ѡ��ֵ
    // alert(text3);

    var area = document.getElementById('dao');

    area.innerHTML = '&nbsp;' + text1 + '&nbsp;'+ text2 + '&nbsp;'+ text3;
} 
// �����д��
function CheckIn()
{
    var inp1 = document.getElementById('name');
    var inp2 = document.getElementById('mob');
    var inp3 = document.getElementById('address');
    var info = document.getElementById('Ge');
    if(inp1.value == '')
    {
        info.innerHTML = '&nbsp;' + 'δ��д����';
    }
    else if(inp2.value == '')
    {
        info.innerHTML = '&nbsp;' + 'δ��д�ֻ���';
    }
    else if(inp3.value == '')
    {
        info.innerHTML = '&nbsp;' + 'δ��д��ϸ��ַ';
    }
    else
    {
        info.innerHTML = '&nbsp;' + '����';
    }
}


