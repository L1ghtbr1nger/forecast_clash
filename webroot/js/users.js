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
                var temp = "";
                if (response['result']) {
                    if (response['regLog']) {
                       window.location.href = response['url'];
                    } else {
                        if (source == 'profiles') {
                            window.location.href = "/forecast_clash/profiles/profile";
                        } else {
                            window.location.href = "/forecast_clash/users/login";
                        }
                    }
                } else {
                    if (response['regLog'] != 0) {
                        temp = response['msg'];
                    } else {
                        $.each(response['msg'], function(index, value) {
                            temp += value + "\n";
                        });
                    }
                    alert(temp);
                    if (response['regLog'] == 3) {
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

