<?php
session_start();
if (isset($_SESSION['auth_characterid'])) {
    echo "Logged in. ".$_SESSION['auth_characterid'];
    exit;
} else {
    //Throw login redirect.
    $authsite='https://login.eveonline.com';
    $authurl='/oauth/authorize';
    $client_id='ea09a57ef06543fea25d389a07d0c4f4';
    $redirect_uri="http://www.test.eve-missions.com/auth/devauthcallback.php";
    $state=uniqid();

    $redirecturl=$_SERVER['HTTP_REFERER'];

    if (!preg_match("#^https:/www.test.eve-missions.com/(.*)$#", $redirecturl, $matches)) {
        $redirecturl='/';
    } else {
        $redirecturl=$matches[1];
    }

    $redirect_to="https://www.test.eve-missions.com".$redirecturl;
    $_SESSION['auth_state']=$state;
    $_SESSION['auth_redirect']=$redirect_to;
    session_write_close();
    header(
        'Location:'.$authsite.$authurl
        .'?response_type=code&redirect_uri='.$redirect_uri
        .'&client_id='.$client_id.'&scope=&state='.$state
    );
    exit;
}
