$(document).ready(function(){
    $('.login').click(function(e){ 
        e.preventDefault();
        var caller = e.target.id;
        var source;
        if (caller == 'profile' || caller == 'userUpdate' || caller == 'passwordReset' || caller == 'avatars') {
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
                       window.location.href = response['url'];
                } else {
                    if (response['regLog'] === 1) {
                        $('#error-message').html(response['msg']);
                    } else {
                        $.each(response['msg'], function(index, value) {
                            temp += value + "</br>";
                        });
                        $('#error-message').html(temp);
                    }
                    $('.error-notification').show();
                    if (typeof response['url'] !== 'undefined') {
                        window.location.href = response['url'];
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
    $('#dismissRead').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/notifications/deleter.json",
            dataType: 'json',
            data: {toDelete: 0},
            success : function(response) {
                $('.read').hide();
            },
            error : function() {   
            }
        });
    });
    $('.dismisser').click(function(e){
        if(e.target.id == 'dismissAll') {
            var chosen = 1;
        } else {
            var chosen = 0;
        }
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/notifications/deleter.json",
            dataType: 'json',
            data: {toDismiss: chosen},
            success : function(response) {
                $('.read').hide();
                if(chosen){
                    $('.unread').hide();
                    $('.counter').html('');
                }
            },
            error : function() {   
            }
        });
    });
});

