
post提交数据:
var request = require('request');
var sendSMS = function (phone, msg) {
        var param = {
            'action': "send"
        };
        console.log("发送短信");
        console.log(param);
        request.post("http://d654645654.com", {form: param}, function (error, response, body) {
            console.log(body);
        });
    }