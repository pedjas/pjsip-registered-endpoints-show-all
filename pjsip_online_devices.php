<?php
/**********************************************************
PJSIP Online Devices
Author: Steve Hillin <stevehillin@gmail.com>
Disclaimer: The data displayed by this file could be 
considered a security risk.  It is imparative that you 
secure this page from public consumption.
**********************************************************/
?>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>
(function($)
{
    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#content').fadeOut();
                $('#loading').fadeIn();
            },
            complete: function() {
                $('#loading').fadeOut();
                $('#content').fadeIn();
            },
            success: function() {
                $('#loading').fadeOut();
                $('#content').fadeIn();
            }
        });
        var $container = $("#content");
        $container.load("pjsip_online_devices_data.php");
        setInterval(function()
        {
            $container.load('pjsip_online_devices_data.php');
        }, 15000);
    });
})(jQuery);
</script>
</head>
<body>
<div id="wrapper">
    <div id="content"></div>
</div>
</body>
</html>
