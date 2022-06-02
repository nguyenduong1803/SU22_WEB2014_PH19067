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
?>