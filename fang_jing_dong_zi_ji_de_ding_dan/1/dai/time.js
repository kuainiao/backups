window.onload = function()
{
    init();
}
var h = 1;
var m = 59;
var s = 59;  
function init(){
    run();
    setInterval('run()',1000);
}
//���е���ʱ��ʾ
function run(){
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
    document.getElementById('DaoJiShi_H').innerHTML = CheckNum(h);
    document.getElementById('DaoJiShi_M').innerHTML = CheckNum(m);
    document.getElementById('DaoJiShi_S').innerHTML = CheckNum(s);
}
// ��������Ƿ�Ϊһλ���ǵĻ�ǰ���0
function CheckNum(n) 
{
  if (n < 10) {
      n = '0' + n;
  }
  return n;
}