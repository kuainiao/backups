@ECHO OFF
set CASPER_PATH=%~dp0..
set CASPER_BIN=%CASPER_PATH%\bin\
set ARGV=%*
call phantomjs C:\MySelf\code\www\js_replace_curl\phantomjs "%CASPER_BIN%bootstrap.js" --casper-path="%CASPER_PATH%" --cli %ARGV%