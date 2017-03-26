$(document).ready(function(){
    $('.contactSubmit').click(function(e){ 
        var temp = '';
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/users/contact.json",
            dataType: 'json',
            data: $('#contactForm').serialize(),
            success : function(response) {
                if (response['result']) {
                       window.location.href = '/forecast_clash/';
                } else {
                    $.each(response['msg'], function(index, value) {
                        temp += value + "</br>";
                    });
                    $('#error-message').html(temp);
                }
                $('.error-notification').show();
            },
            error : function() {   
            }
        });
    });
});

