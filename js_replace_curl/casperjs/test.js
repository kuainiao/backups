// putenv("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs");
var casper = require('casper').create();//一看便知  
casper.start("http://www.weather.com.cn/weather1d/101280101.shtml");//一目了然  
  
casper.waitForSelector('.t', function() { //等选择器内容找到后,  
    this.captureSelector('1.png', '.t');//对指定元素截图  
    });  
      
casper.run();//这时才运行从start()开始的步骤  
