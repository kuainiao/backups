var casper = require('casper').create(); 
casper.start("https://www.baidu.com/", function () {   
    this.capture("1.png");   
});   
casper.then(function () {   
    this.click('a[class="lb"]');  
    this.wait(5000, function () {   
        this.capture("2.png");   
    });   
});   
casper.then(function () {   
    this.fill('form[id="TANGRAM__PSP_8__form"]', {  
        "userName": "水货诶",   
        "password": "Ou891007"   
    }, true);   
    this.capture("3.png"); 
});  
casper.then(function () {   
    this.click('a[class="lb"]');  
    this.wait(5000, function () {   
        this.capture("2.png");   
    });   
});   

casper.then(function () {   
    this.wait(10000, function () {   
        var code = fs.read("code.txt");
        this.fill('form[id="loginform"]', { 
            "userName": "水货诶",   
            "password": "Ou891007",
            // "verifycode": code
        }, true);   
        this.capture("5.png");    
    });  
});


casper.run(); 
