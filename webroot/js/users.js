$(document).ready(function(){
    $('.login').click(function(e){ 
        e.preventDefault();
        var caller = e.target.id;
        var source;
        if (caller == 'profile') {
            source = 'profiles';
        } else if (caller == 'forecast') {
            source = 'forecasts';
        } else {
            source = 'users';
        }
        $.ajax({
            type: "POST",
            url: "/forecast_clash/"+source+"/"+caller+".json",
            dataType: 'json',
            data: $('#'+caller+'Form').serialize(),
            success : function(response) {
                var what = response;
                var temp = "";
                if (what['result']) {
                    alert(what['msg']);
                    if (what['regLog']) {
                        window.location.href = "/forecast_clash/";
                    } else {
                        if (source == 'profiles') {
                            window.location.href = "/forecast_clash/profiles";
                        } else {
                            window.location.href = "/forecast_clash/users/login";
                        }
                    }
                } else {
                    if (what['regLog'] != 0) {
                        temp = what['msg'];
                    } else {
                        $.each(what['msg'], function(index, value) {
                            temp += value + "\n";
                        });
                    }
                    alert(temp);
                    if (what['regLog'] == 3) {
                        window.location.href = "/forecast_clash/users/forgot_password";
                    }
                }
            },
            error : function() {   
            }
        });
  
    });
    
    
});

