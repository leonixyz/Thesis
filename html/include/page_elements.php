<?php
/* Static html elements */

/* login popup */
$LOGIN_BOX = <<<STR
<div class='popup info' id='login-popup'>\n
    <form action='/index.php' method='POST'>\n
        <h3 class='centered'>Log in</h3>\n
        <input type='text' name='user'> username<br>\n
        <input type='password' name='password'> password<br>\n
        <input type='submit' value='Log In'>\n
        <script>
            $(function(){
                $("#login-popup").offset({
                    left: ($(window).width()/2 - $("#login-popup").width()/2),
                    top: ($(window).height()/2 - $("#login-popup").height()/2)
                });
            });
        </script>
    </form>\n
</div>\n
STR;

/* error popup */
$ERROR_BOX = <<<STR
<div class='popup warning' id='error-popup'>\n
    <h3 class="centered">Error</h3>
    <p class='justified'>{ERROR_STR}</p>\n
    <script>
        $(function(){
            $("#error-popup").offset({
                left: ($(window).width()/2 - $("#error-popup").width()/2),
                top: ($(window).height()/2 - $("#error-popup").height()/2)
            });
            setTimeout(function(){
                    window.location.href = window.location.href;
                },
                5000
            );
        });
    </script>
</div>\n
STR;
