$(document).ready(function(){
    $('.draft').click(function(e){ 
        e.preventDefault();
        var choice = e.target.id;
        $('#createButton').addClass('returnButton'); //move button to corner for user to change initial .draft choice
        $('#joinButton').addClass('returnButton'); //move button to corner for user to change initial .draft choice
        $('p.text-xs-center').html('</br>'); //poor man's layout fix
        if(choice == 'createButton') {            
            $('#joinButton').show(); //show corner version of Join Team button 
            $('#createButton').hide(); //hide Create Team button 
            $('#createSubmit').show(); //show Create Team submit button 
            $('#joinSubmit').hide(); //hide Join Team submit button  
            $("#creator").show(); //display create team_name and team_logo input
            $("#joiner").hide(); //hide join team_name search input and livesearch div
        } else if(choice == 'joinButton') {
            $('#joinButton').hide(); //hide Join Team button 
            $('#createButton').show(); //show corner version of Create Team button 
            $('#joinSubmit').show(); //show Join Team submit button 
            $('#createSubmit').hide(); //hide Create Team submit button 
            $("#joiner").show(); //display join team_name search input and livesearch div
            $("#creator").hide(); //hide create team_name and team_logo input
        }    
    });
    $('#createSubmit').click(function(e){ 
        e.preventDefault();
        if($(e.target).hasClass('disabled')){
            alert();
        } else {
            var fd = new FormData(); //create new FormData variable to send through ajax
            fd.append('team_logo', $('#logo')[0].files[0]); //add user uploaded file to FormData
            fd.append('team_name', $('#team-name').val()); //add user submitted team_name to FormData
            fd.append('privacy', $('input[name=privacy]:checked').val());
            $.ajax({
                type: "POST",
                url: "/forecast_clash/Teams/creator.json",
                dataType: 'json',
                data: fd,
                cache: false,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success : function(response) {
                    if (response['result']){
                        alert(response['msg']);
                        location.reload();
                    } else {
                        alert(response['msg']);
                    }
                },
                error : function() {   
                }
            });
        }
    }); 
    $('input').keypress(function(e){
        if (e.which == 13) {
            e.preventDefault();
        }
    });
    $('#team-name').keyup(function(e){
        if ($.trim($(this).val()) !== '') { //if user types in team_name input, check if there is a non white-space value assigned
            $('#createSubmit').removeClass('disabled'); //enable submission
        } else {
            $('#createSubmit').addClass('disabled'); //disable submission
        }
    });
    $('#typer').keyup(function(e){
        var params = {'letters': $(this).val()};
        $.ajax({
            type: "POST",
            url: "/forecast_clash/Teams/typer",
            dataType: 'json',
            data: params,
            success : function(response) {
                $('#liveSearch').html(''); //empty the results div
                if (response['result']) { //if search box contains anything
                    var teamData = response['team_data']; //separate the team_data from the rest of the response array
                    $.each(teamData, function(key, teamArray) { //get each of the key/value pairs in the team_data array of objects
                        if(teamArray['privacy']) {
                            var privacy = '<img src="/forecast_clash/webroot/img/teams/key.png" alt="Private" />';
                            var filler = 'privacy';
                        } else {
                            var privacy = '';
                            var filler = '';
                        }
                        $('#liveSearch').append('<p class="options chooser '+filler+'" id="'+teamArray['id']+'">'+teamArray['team_name']+' '+privacy+'</p>'); //insert a p element for each team returned by the search and set the id equal to the DB row id
                    });
                } else {
                    $('#liveSearch').html('NO RESULTS FOUND'); //Tell user that no results matched search request
                }
            },
            error : function() {   
            }
        });
    });
    $(document.body).on('click', '.chooser', function(e){ //if a search result is clicked
        $('.chosen').addClass('chooser'); //turn the current selected result into a selectable result
        $('.chosen').removeClass('chosen'); //deselect the currently selected result
        $(this).addClass('chosen'); //select the result that was clicked
        $(this).removeClass('chooser'); //make the selected result unselectable
        $('#joinSubmit').removeClass('disabled'); //enable submission
        if($(this).hasClass('privacy')){
            $('#joinSubmit').html('Request to Join Team');
        } else {
            $('#joinSubmit').html('Join Team');
        }
    });
    $(document.body).on('click', '.chosen', function(e){ //if the currently selected result is clicked
        $(this).removeClass('chosen'); //deselect it
        $(this).addClass('chooser'); //make it selectable
        $('#joinSubmit').addClass('disabled'); //disable submission
    });
    $('#joinSubmit').click(function(e){
        e.preventDefault();
        var params = {'team_id': $('.chosen').attr('id')};
        if($(this).hasClass('disabled')){
            alert();
        } else {
            $.ajax({
                type: "POST",
                url: "/forecast_clash/TeamsUsers/joiner.json",
                dataType: 'json',
                data: params,
                success : function(response) {
                    if (response['result']){
                        alert(response['msg']);
                        location.reload();
                    } else {
                        alert(response['msg']);
                    }
                },
                error : function() {   
                }
            });
        }
    });
    $('.freeAgent').click(function(e){
        e.preventDefault();
        var form = $('#freeAgentForm').serialize();
        form += '&sign='+$(this).val();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/TeamsUsers/freeAgent.json",
            dataType: 'json',
            data: form,
            success : function(response) {
                if (response['result']){
                    alert(response['msg']);
                    window.location.href = "/forecast_clash/teams/dugout";
                } else {
                    alert(response['msg']);
                }
            },
            error : function() {   
            }
        });
    });
});
