<?php $session = $this->request->session();
echo '<header class="header '.(($loggedIn) ? "" : "header-logged-out").'">';
?>
<div class="header-block header-block-collapse hidden-lg-up hidden-sm hidden-xs">
    <div class="header-block header-block-collapse hidden-lg-up">
        <span class="menu-open">
            <i class="fa fa-bars" aria-hidden="true"><span>Menu</span></i>
        </span>
    </div>
</div>
<div class="header-block header-block-search hidden-sm-down">
</div>
<div class="header-block header-block-buttons">
</div>
<div class="header-block header-block-nav">
    <ul class="nav-profile">
        <li class="notifications new">
            <a href="" data-toggle="dropdown"><i class="fa fa-bell-o"></i><sup><span class="counter">8</span></sup></a>
            <div class="dropdown-menu notifications-dropdown-menu">
                <ul class="notifications-container">
                    <li>
                        <a href="" class="notification-item">
                            <div class="img-col">
                                <div class="img"></div>
                            </div>
                            <div class="body-col">
                                <p><span class="accent">Zack Alien</span> pushed new commit: <span class="accent">Fix page load performance issue</span>. </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="notification-item">
                            <div class="img-col">
                                <div class="img"></div>
                            </div>
                            <div class="body-col">
                                <p> <span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="notification-item">
                            <div class="img-col">
                                <div class="img"></div>
                            </div>
                            <div class="body-col">
                                <p> <span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span> </p>
                            </div>
                        </a>
                    </li>
                </ul>
                <footer>
                    <ul>
                        <li> <a href="">View All</a> </li>
                    </ul>
                </footer>
            </div>
        </li>
        <li class="profile dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="img" style="background-image: url(/forecast_clash/img/<?= $session->read('User.avatar') ?>)"></div>
                    <span class="name"><?php 
                    if ($loggedIn) {
                        echo h($session->read('Auth.User.first_name'))." ".h($session->read('Auth.User.last_name'));
                    } else {
                        echo '<style>.nav-link{display:none !important;}</style><a style="display: inline;" href="/forecast_clash/users/login"><strong>Please login</strong></a>'; } ?>
            <img src="" alt=""></span>
            </a>
            <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" href="#"> <i class="fa fa-user icon"></i> Profile </a>
                <a class="dropdown-item" href="#"> <i class="fa fa-bell icon"></i> Notifications </a>
                <a class="dropdown-item" href="#"> <i class="fa fa-gear icon"></i> Settings </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/forecast_clash/users/logout"> <i class="fa fa-power-off icon"></i> Logout </a>
            </div>
        </li>
    </ul>
</div>
</header>

<script>

$(document).ready(function() {

    $("#sidebar-collapse-btn").click(function(){
        $(".mobile-nav-close").fadeIn(3000);
    });
    
    /*Menu-toggle*/
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $(".sidebar-navigation").toggleClass("menu-collapse",3000);
        $("#app").toggleClass("app-overwrite");
        $(".header").toggleClass("header-overwrite");
        $(".menu-open").css('display', 'inline-block');
    });
    $('.menu-open').click(function(){
        $(".sidebar-navigation").toggleClass("menu-collapse",3000);
        $("#app").toggleClass("app-overwrite");
        $(".header").toggleClass("header-overwrite");
        $(this).css('display', 'none');
    })

});

</script>