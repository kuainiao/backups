
var marquee = new Array(
    "<p><span>[���¹���]��</span>��**��130****3260����1����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>",
    "<p><span>[���¹���]��</span>��**��136****7163����3����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>",
    "<p><span>[���¹���]��</span>��**��139****1955����5����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>",
    "<p><span>[���¹���]��</span>��**��180****6999����2����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>",
    "<p><span>[���¹���]��</span>��**��151****2588����4����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>",
    "<p><span>[���¹���]��</span>��**��133****4096����6����ǰ�����ȡ��"+quotes[Math.floor((Math.random()*quotes.length))]+" <font color='#FF0000'>��</font></p>"
);
var wfgdaa = 0;
var wfgdbb = 1;
function marqueeL(){
	if(wfgdaa>(marquee.length-1))
	wfgdaa = 0;
	if(wfgdbb>(marquee.length-1))
	wfgdaa = 0;
	wfgdbb = wfgdaa +1;
	var marHTML = marquee[wfgdaa]+marquee[wfgdbb];
	document.getElementById("fahuo").innerHTML = marHTML;
	wfgdaa +=1;
	wfgdbb +=1;
}
window.setInterval("marqueeL()", 3000);