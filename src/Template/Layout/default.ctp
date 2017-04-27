<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <script>
       // google analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-91748386-1', 'auto');
      ga('send', 'pageview');

    </script>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>
    <?=
     $this->Html->meta('ico.png','/webroot/img/ico.png',array('type' => 'icon'));
    ?>
    <?= $this->Html->css(['bootstrap.min', 'leaflet', 'L.Control.Sidebar.css','forecast.css?v=2']) ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
<!--     <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script> -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta property="og:image" content="/webroot/img/logo-light-blue-sm.png" />
    <?= $this->Html->script('jquery.min'); ?>
    <?= $this->Html->script('bootstrap.min'); ?>
    <?= $this->Html->script('leaflet'); ?>
    <?= $this->Html->script('leaflet-heat'); ?>
    <?= $this->Html->script('L.Control.Sidebar'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
     <!-- Navigation -->
<body>
    <div class="main-wrapper">
        <div class="app" id="app">
            <div class="container-fluid clearfix">
                <?= $this->fetch('content') ?>
            </div>
            <!-- login script -->
            <?= $this->Html->script('users'); ?>

            <script>
                $(document).ready(function() {

                    $('[data-toggle="tooltip"]').tooltip();
                    $('#sidebar-collapse-btn').click(function(){
                        $( '.sidebar' ).toggleClass('left-230');
                    });
                    $('.mobile-nav-close').click(function(){
                        $( '.sidebar' ).toggleClass('left-230');
                    });
                 });
            </script>

            <footer>
            </footer>
        </div>
    </div>

    <!-- Success Notification -->
    <div class="row success-notification">
        <div class="notification">
            <p class="notification-message" id="success-message"><?= (isset($success) ? $success : ''); ?></p>
        </div>
    </div>

    <!-- Error Notification -->
    <div class="row error-notification">
        <div class="notification">
            <p class="notification-message" id="error-message"><?= (isset($error) ? $error : ''); ?></p>
        </div>
    </div>
    
    <script>
        if(!$.trim($('#success-message').html()) == ''){
            $('.success-notification').show();
        }
        if(!$.trim($('#error-message').html()) == ''){
            $('.error-notification').show();
        }

        // Success
        setTimeout(function(){
            $('.success-notification').fadeOut();
        }, 5000);    


        // Error

        $('.error-notification .notification').append('<i class="fa fa-times close-me" aria-hidden="true"></i>');
        $('.close-me')
        .css({
          'float': 'right',
          'position': 'relative',
          'top': '-30px',
          'left': '18px',
          'color': 'rgb(188, 188, 188)',
          'cursor': 'pointer'
        })
        .click(function(){
            $('.error-notification').hide();
        })
    </script>




</body>
</html>
