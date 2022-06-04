<?php 


function isValidEmail($email)
{
    return preg_match('/\A[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}\z/', $email)
        && preg_match('/^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/', $email) && $email !== "";
}
function isPass($pass)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass) && $pass !== "";
}
function isRequired($element)
{
    return !$element ? true : false;
}

function isNumber($num)
{
    return preg_match('/^[a-zA-Z0-9]*$/', $num) && $num > 0 ? true : false;
}

function saveCookie($id,$name,$time){
    $saveCookie = $id;
    if ($saveCookie != "" && isset($_COOKIE[$name]) && $_COOKIE[$name] != "null") {
        $getCookie = json_decode($_COOKIE[$name]);
        array_push($getCookie, $saveCookie);
        $newArr = array_unique($getCookie);
        setcookie($name, json_encode($newArr),time()+$time);
        // header("Location:?page=products&sussec=true");
    } else {
        setcookie($name, json_encode(array($saveCookie)),time()+$time);
        // header("Location:?page=products&sussec=true");

    }
}
