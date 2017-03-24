var casper = require('casper').create(); 
casper.start("http://xui.ptlogin2.qq.com/cgi-bin/xlogin?appid=15000103&s_url=http%3A%2F%2Fe.qq.com%2Fads&style=20&border_radius=1&target=top&maskOpacity=60&", function () {   
    this.capture("1.png");   
});   

casper.then(function () {   
    this.fill('form[id="loginform"]', {  
        "u": "3092569630",   
        "p": "nanxiwang.+123"   
    }, false);   
    this.capture("2.png"); 
});  
casper.then(function () {   
    this.click('input[id="login_button"]');  
    this.wait(5000, function () {   
        this.capture("3.png");   
    });   
});    
casper.then(function () {   
    this.click('input[id="login_button"]');  
    this.wait(5000, function () {   
        this.capture("4.png");   
    });   
});   
casper.then(function () {
    casper.waitForSelector('.char', function then() {  
            recognizedCode = '1111';  
            this.evaluate(function(rtCode){  
                document.querySelector('input[id="capAns"]').value = rtCode; //1>可以用这种方式填input框框（without name attribute）  
                //document.querySelector('a[action-type="submit"]')[0].click(); //2>可以在这里提交哦！  
                //__utils__.findOne('input[class="WB_iptxt oauth_form_input oauth_form_code"]').value = rtCode; //1>也可以这样填input框框(without name attribute)  
            }, {rtCode:recognizedCode});  
            // this.click('a[action-type="submit"]'); //2>也可以在这里提交!  
        },  
        function onTimeout() {  
            this.log('wait selector timeout', 'error')  
        },  
        timeout = 1000  
    ); 
});
// casper.then(function () {   
//     this.wait(10000, function () {   
//         var code = fs.read("code.txt");
//         this.evaluate(function(rtCode){
//             document.querySelector('input[id="capAns"]').value = '1111';
//         });
//         this.capture("5.png");    
//     });  
// });


casper.run(); 

