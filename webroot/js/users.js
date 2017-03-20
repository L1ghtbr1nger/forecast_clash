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
    $('.experience').click(function(e){
        e.preventDefault();
        var experience = $(this).val();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/users/meteorology.json",
            dataType: 'json',
            data: {'experience': experience},
            success : function(response) {
                window.location.href = "/forecast_clash";     
            },
            error : function() {   
            }
        });
    });
    $('.notification-item').click(function(e){
        e.preventDefault();
        var id = $('.notification-item').attr('id');
        var address = $(this).attr('href');
        if(id == "guest"){
            window.location.href = address;
        } else {
            $.ajax({
                type: "POST",
                url: "/forecast_clash/notifications/notifier.json",
                dataType: 'json',
                data: {'id': id},
                success : function(response) {
                    window.location.href = address;
                },
                error : function() {   
                }
            });
        }
    });
    $('#dismisser').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/notifications/deleter.json",
            dataType: 'json',
            data: 0,
            success : function(response) {
                $('.read').hide();
            },
            error : function() {   
            }
        });
    });
});

