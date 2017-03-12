<aside class="sidebar-navigation">
    <div class="sidebar-container">
        <div class="sidebar-navigation-header">
            <div class="brand">
                <a href="#" class="logo"><?= $this->Html->image('logo-light-blue.png', ['alt' => 'Forecast Clash Logo']) ?></a>
            </div>
        </div>
        <nav class="menu">
            <ul class="nav metismenu" id="sidebar-menu">
                <li class="play-link">
                    <a href="/forecast_clash"> <i class="fa fa-gamepad"></i> Play </a>
                </li>
                <li class="stats-link">
                    <a href="/forecast_clash/weatherstatistics/stats"> <i class="fa fa-bar-chart"></i> Statistics </a>
                </li>
                <li>
                    <a href="/forecast_clash/teams/dugout"> <i class="fa fa-users" aria-hidden="true"></i> Team </a>
                </li>
                <li class="contact-link">
                    <a href="/forecast_clash/pages/contact"> <i class="fa fa-comments-o" aria-hidden="true"></i> Contact </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>                        
<script>

$(document).ready(function() {

    $("#sidebar-collapse-btn").click(function(){
        $(".mobile-nav-close").fadeIn(3000);
    });
    
    /*Menu-toggle*/
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $(".sidebar-navigation").toggleClass("menu-collapse",3000);
        $('#app').toggleClass("app-overwrite");
        $('.header').toggleClass("header-overwrite");
    });
        // toggle button text
    $(".menu-toggle").click(function () {
        $(this).text(function(i, v){
           return v === "Close Sidebar" ? "Open Sidebar" : "Close Sidebar"
        })
    });
});

</script>

<style>


.app-overwrite{
    padding-left:0 !important;
}
.header-overwrite{
    left:0 !important;
}

.menu-collapse{
    left:-230px;
    transition: left .3s ease;
}

.menu-toggle{
    border:none;
    padding: 4px 8px;
    text-transform: uppercase;

}
</style>