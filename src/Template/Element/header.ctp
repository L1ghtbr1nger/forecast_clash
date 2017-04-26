<?php $session = $this->request->session();
echo '<header class="header '.(($loggedIn) ? "" : "header-logged-out").'">';
?>
<style>
    .side-menu-container{
        display:none;
    }
    .clock-container .header-block-collapse{
        margin: 0 -6px !important;
    }
</style>
<div class="side-menu-container header-block header-block-collapse hidden-lg-up hidden-sm hidden-xs">
    <div class="header-block header-block-collapse hidden-lg-up">
        <span class="menu-open">
            <i class="fa fa-bars" aria-hidden="true"><span>Menu</span></i>
        </span>
    </div>
</div>
<div class="clock-container header-block header-block-collapse hidden-lg-up">
    <div class="header-block header-block-collapse hidden-lg-up">
        <span>Local:</span>
       <div id="clock" class="clock">loading ...</div><br>
       <span>UTC:&nbsp;&nbsp;</span>
       <div id="utc" class="clock">loading ...</div>
    </div>
</div>
<div class="header-block header-block-nav">
    <ul class="nav-profile">
        <li class="notifications new">
            <a href="" data-toggle="dropdown"><i class="fa fa-bell-o"></i><sup><span class="counter"><?= (!empty($notificationsUnread) ? count($notificationsUnread) : '') ?></span></sup></a>
            <div class="dropdown-menu notifications-dropdown-menu">
                <header id="notice">
                    <h4>Notificatons <span><small>Unread</small></span></h4>
                </header>
                <ul class="notifications-container"><?php
                    if (isset($notificationsUnread)) {
                        foreach ($notificationsUnread as $notice) {
                            echo '<li class="unread">';
                                echo '<a href="'.$notice['link_address'].'" class="notification-item" id="'.$notice['id'].'">';
                                    echo '<div class="img-col">';
                                        echo '<div class="img">';
                                            if (isset($notice['link_image'])) {
                                                echo $this->Html->image($notice['link_image'], [
                                                    'class' => 'notification-image'
                                                ]);
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="body-col">';
                                        echo '<p>';
                                            echo $notice['message'];
                                        echo '</p>';
                                        echo '<div class="seen-unseen unseen"></div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</li>';
                        }
                    }
                    if (isset($notificationsRead)) {
                        foreach ($notificationsRead as $notice) {
                            echo '<li class="read">';
                                echo '<a href="'.$notice['link_address'].'" class="notification-item" id="'.$notice['id'].'">';
                                    echo '<div class="img-col">';
                                        echo '<div class="img">';
                                            if (isset($notice['link_image'])) {
                                                echo $this->Html->image($notice['link_image'], [
                                                    'class' => 'notification-image'
                                                ]);
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="body-col">';
                                        echo '<p>';
                                            echo $notice['message'];
                                        echo '</p>';
                                        echo '<div class="seen-unseen seen"></div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</li>';
                        }
                    } ?>
                </ul>
                <footer>
                    <ul>
                        <li><a class="dismisser" id="dismissRead" href="">Dismiss Read</a></li>
                        <li><a class="dismisser" id="dismissAll" href="">Dismiss All</a></li>
                    </ul>
                </footer>
            </div>
        </li>
        <li class="profile dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="img" <?php if ($loggedIn) {
                        echo 'style="background-image: url('.(($hasSocial) ? '' : '/forecast_clash/img/').''.$session->read('User.avatar').')"';
                    } ?> ></div>
                    <span class="name"><?php 
                    if ($loggedIn) {
                        echo h($session->read('Auth.User.first_name'))." ".h($session->read('Auth.User.last_name'));
                    } else {
                        echo '<style>.nav-link{display:none !important;}</style><a style="display: inline;" href="/forecast_clash/users/login"><strong>Please login</strong></a>'; 
                    } ?>
            <img src="" alt=""></span>
            </a>
            <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" href="/forecast_clash/profiles/profile"> <i class="fa fa-user icon"></i> Profile </a>
                <?php if ($captain) { ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/forecast_clash/teams/manager" > <i class="fa fa-pencil icon"></i> Manage Team </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/forecast_clash/users/logout"> <i class="fa fa-power-off icon"></i> Logout </a>
            </div>
        </li>
    </ul>
</div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
<script>

$(document).ready(function() {

    $('#sidebar-collapse-btn').click(function(){
        $('.mobile-nav-close').fadeIn(3000);
        ('.side-menu-container').css('display', 'none');
    });


    $('.menu-open-mobile').click(function(){
        $('.mobile-nav').toggleClass('toggle-mobile');
    });

    
    /*Menu-toggle*/
    $('.menu-toggle').click(function(e) {
        e.preventDefault();
        $('.side-menu-container').css('display', 'block');
        $('.sidebar-navigation').toggleClass('menu-collapse',3000);
        $('#app').toggleClass('app-overwrite');
        $('.header').toggleClass('header-overwrite');
        $('.menu-open').css('display', 'inline-block');
    });
    $('.menu-open').click(function(){
        $('.sidebar-navigation').toggleClass('menu-collapse',3000);
        $('#app').toggleClass('app-overwrite');
        $('.header').toggleClass('header-overwrite');
        $(this).css('display', 'none');
    })

    // Clock

    function update() {
      $('#clock').html(moment().format('hh:mm:ss'));
      $('#utc').html(moment.utc().format('hh:mm:ss'));
    }

    setInterval(update, 1000);

});

</script>