function weixin(sta)
{
    // ��ȡbody��
    var wid = document.getElementById('page').offsetWidth;
    // ��ȡ����ȥbody��
    // var gao = document.body.scrollTop;
    // ������dtd��׼�������ȡ�ĸ�Ϊ0
    var gao = document.documentElement.scrollTop;
    // ��ǰ�����
    var gao1 = document.body.clientHeight;
    var div = document.getElementById('weixindiag');

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
// input ���б�ɫ �޸ļ۸� �ߴ� ��Ʒ���� ��ƷͼƬ
function ReColor(obj)
{
    if(obj != undefined)
    {
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

        //�޸Ķ�������ƷͼƬ
        var img = document.getElementById('imgs');
        var name = div.id;

        if(name.indexOf('name') == 0 )
        {
            var NameNum = name.match(/\d+/g);
            img.innerHTML = "<img src = 'images_files/shangpin_" + NameNum + ".jpg' />";

            // ��ȡ�۸�
            var product = document.getElementsByName('product');
            var qian = product[NameNum].getAttribute('alt');
            // ��ȡ����
            var shu = document.getElementById('number').value;
            var ZongQian = qian * shu;

            // ������ʱ�۸�
            document.getElementById('CunDan').innerHTML = qian;

            // �޸Ķ�������ƷͼƬ�Ա߼۸�
            var zong = document.getElementsByClassName('qian');
            var FormZong = document.getElementById('zong');
            var FormDan = document.getElementById('dan');
            // �޸�form��Ҫ�ļ۸�
            FormZong.value = ZongQian;
            FormDan.value = ZongQian;
            var ZongLen = zong.length;
            var i = 0;
            for(i = 0; i < ZongLen; i++)
            {
                zong[i].innerHTML = '��' + ZongQian + '.00';
            }   
            // ��ȡ��������ƷͼƬ����Ʒ���
            var BianHao = product[NameNum].value;
            var num = document.getElementById('num');
            num.innerHTML = BianHao;
            var yixuantaocan = document.getElementById('yixuantaocan');
            yixuantaocan.innerHTML = BianHao;
        }

        // ��ȡ�ߴ�
        var chi = document.getElementById('chi');
        var ChiCun = div.id;
       
        if(ChiCun.indexOf('chicun') == 0 )
        {
            var ChiCun1 = ChiCun.match(/\d+/g);
            // ��ȡ�ߴ�
            var chicun = document.getElementsByName('chanpin1')[ChiCun1].value;

            chi.innerHTML = '&nbsp;' + chicun;

            var yixuanchicun = document.getElementById('yixuanchicun');
            yixuanchicun.innerHTML = '&nbsp;' + chicun;
        }
    }

}
// �����Ӽ�
function CheckNum(num)
{
    var numbers = document.getElementById('number');
    var number = numbers.value;

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
        if(number >= 10)
        {
            alert('������˴�������Ʒ���Ƿ���Ҫ��ϵ�¿ͷ�');
            numbers.value = number * 1 + 1 * 1;
        }
        else if(number < 10)
        {
            numbers.value = number * 1 + 1 * 1;
        }
    }
    else
    {
        return 'ɵ��';    
    }

    // ��ȡ��ǰѡ�е���Ʒ����
    var qian = document.getElementById('CunDan').innerHTML;

    var FormZong = document.getElementById('zong');
    var FormDan = document.getElementById('dan');
    // �޸�form��Ҫ�ļ۸�
    var ZongQian = qian * numbers.value;
    FormZong.value = ZongQian;
    FormDan.value = ZongQian;

    var zong = document.getElementsByClassName('qian');
    var ZongLen = zong.length;
    var i = 0;
    for(i = 0; i < ZongLen; i++)
    {
        zong[i].innerHTML = '��' + ZongQian + '.00';
    }   

    GetIndentId();
    CheckArea();
    CheckInput();
}
// ���� ��ʾ div
function hide(div)
{
    if(div != 'buy')
    {
        var a = document.getElementById(div);
        if(a.style.display != 'block')
        {   
            // ��ǰ�����
            var BodyHeight = document.body.clientHeight;

            a.style.display = 'block';
            a.style.height = BodyHeight / 2 + 'px';
        }
        else
        {
            a.style.display = 'none';
        }
        document.getElementsByClassName('buy')[0].id = 'xianshi';
    }
    else if(div == 'buy')
    {
        var b = document.getElementsByClassName(div)[0];
        var c = document.getElementById('zhankai1');
        var d = document.getElementsByClassName('dingdan')[0];

        // ��ǰ�����
        var BodyHeight = document.body.clientHeight;

        if(b.id == 'xianshi')
        {
            b.id = 'fudong';
            b.style.height = BodyHeight / 2 + 'px';
            c.style.display = 'block';
            d.style.display = 'none';
        }
        else if(b.id == 'fudong')
        {
            b.id = 'xianshi';
            b.removeAttribute('style');
            c.style.display = 'none';
            d.style.display = 'block';

        }
        document.getElementById('cuxiao1').style.display = 'none';
    }
    ReColor();
    GetIndentId();
    CheckArea();
    CheckInput();
}
// js��ȡʱ�����ֵ������id
function GetIndentId()
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
    var obj2 = document.getElementById('s_city'); //��λid
    var index2 = obj2.selectedIndex; // ѡ������
    var text2 = obj2.options[index2].text; // ѡ���ı�
    // var value2 = obj.options[index].value; // ѡ��ֵ
    var obj3 = document.getElementById('s_county'); //��λid
    var index3 = obj3.selectedIndex; // ѡ������
    var text3 = obj3.options[index3].text; // ѡ���ı�
    // var value3 = obj.options[index3].value; // ѡ��ֵ

    var area = document.getElementById('dao');

    area.innerHTML = '&nbsp;' + text1 + '&nbsp;'+ text2 + '&nbsp;'+ text3;
} 
// �����д��
function CheckInput()
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
var h = 1;
var m = 59;
var s = 59;  
// ����ʱʱ��
function DaoJiShi()
{
    --s;
    if(s<0){
        --m;
        s = 59;
    }
    if(m<0){
        --h;
        m = 59
    }
    if(h<0){
        s = 0;
        m = 0;
    }

    if (h < 10) 
    {
        document.getElementById('DaoJiShi_H').innerHTML = '0' + h;
    }
    else
    {
        document.getElementById('DaoJiShi_H').innerHTML = h;
    }
    if (m < 10) 
    {
        document.getElementById('DaoJiShi_M').innerHTML = '0' + m;
    }
    else
    {
        document.getElementById('DaoJiShi_M').innerHTML = m;
    }
    if (s < 10) 
    {
        document.getElementById('DaoJiShi_S').innerHTML = '0' + s;
    }
    else
    {
        document.getElementById('DaoJiShi_S').innerHTML = s;
    }
}
// ��ȡ��ǰ�� �Զ���������
function Autos()
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
    // ��ȡ��ǰѡ�е���Ʒ����
    var qian = document.getElementById('CunDan').innerHTML;

    var FormZong = document.getElementById('zong');
    var FormDan = document.getElementById('dan');
    // �޸�form��Ҫ�ļ۸�
    var ZongQian = qian * number;
    FormZong.value = ZongQian;
    FormDan.value = ZongQian;

    var zong = document.getElementsByClassName('qian');
    var ZongLen = zong.length;
    var i = 0;
    for(i = 0; i < ZongLen; i++)
    {
        zong[i].innerHTML = '��' + ZongQian + '.00';
    }   

    ReColor();
    GetIndentId();
    CheckArea();
    CheckInput();
    DaoJiShi();
    setInterval('DaoJiShi()', 1000);
}
