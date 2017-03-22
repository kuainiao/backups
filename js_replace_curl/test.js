

var

casper = require('casper').create();

casper.start('https://passport.baidu.com/v2/?login',
function()
 {

    this.fill('div[id="loginForm"]',
 {

        'userName':
'whcyc2002',

        'password':
'*******'

    },
false);

});

   

casper.then(function()
 {

  this.click('input[class="pass-button pass-button-submit"]');

  this.echo('login...');

});

   

casper.then(function()
 {

    this.wait(3000,function()
 {

        this.capture("baidu.png");

    });

});

casper.run();
