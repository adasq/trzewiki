<?php

function showAlert($mode, $text) {
    echo '<div class="alert alert-' . $mode . ' alert-dismissable fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $text . '</div>';
}

function login($login, $password) {
    $customer_rec = Customer::finder()->find("login = :login AND deleted = 0", array(":login" => $login));
    if ($customer_rec != null) {
        $password = hash('sha256', $password . $customer_rec->salt);
    } else {
        return null;
    }

    $customer_rec = Customer::finder()->find("login = :login AND password = :password AND deleted = 0", array(":login" => $login, ":password" => $password));
    return $customer_rec;
}

function generateSalt() {
    $chars = "`1234567890-=~!@#$%^&*()_+QWERTYUIOP{}|ASDFGHJKL:ZXCVBNM<>?qwertyuiop[]\asdfghjkl;'zxcvbnm,./";

    $salt = "";
    for ($i = 0; $i < 25; $i++) {
        $salt .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $salt;
}
