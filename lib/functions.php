<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function formatDate($date) {

    $date1 = new DateTime($date);
    $date2 = new DateTime();
    $diff = $date2->diff($date1);

    if ($diff->y > 0) {
        $out = ($diff->y == 1 ? '1 rok' : $diff->y . ' lata') . ' ' . ($diff->m >= 1 ? $diff->m . ' mies.' : '');
    } elseif ($diff->m > 0) {
        $out = $diff->m . ' mies.';
    } elseif ($diff->d > 0) {
        $tyg = round($diff->d / 7);
        $out = ($diff->d >= 7) ? ($tyg == 1 ? '1 tydz.' : $tyg . ' tyg.') : ($diff->d == 1 ? '1 dzień ' . ($diff->h > 0 ? $diff->h . ' godz.' : '') : $diff->d . ' dni');
    } elseif ($diff->h > 0) {
        $out = $diff->h . ' godz.';
    } elseif ($diff->i > 0) {
        $out = $diff->i . ' min.';
    } else {
        $out = $diff->s . ' sek.';
    }

    return $out . ' temu.';
}


function authorize() {
    global $template, $DB;
    $authorized = getUser();
    if ($authorized) {
        if (isset($_GET['logout'])) {
            logout();
            header('Location: ' . $template->getConfigVariable('BASE_URL') . '/admin/login');
        } else {
            if (strpos($_SERVER['SCRIPT_FILENAME'], '/admin_login.php')) {
                header('Location: ' . $template->getConfigVariable('BASE_URL') . '/admin');
            }
            $template->assign("authorized", $authorized);
        }
    } else {
        if (!strpos($_SERVER['SCRIPT_FILENAME'], '/admin_login.php')) {
            header('Location: ' . $template->getConfigVariable('BASE_URL') . '/admin/login');
        }
    }
}

function getUser($withSmarty = true) {
    global $template, $DB;

    if (isset($_SESSION['access']) && isset($_SESSION['userId'])) {

        $user = new Admin();
        $user = $user->getById($_SESSION['userId']);
        if (!$user) {
            $_SESSION = array();
            session_unset();
            session_destroy();
            return null;
        } else {
            //if($withSmarty)$template->assign('user', $user);

            return $user;
        }
    } else {
        return null;
    }
}

function logout() {
    $_SESSION = array();
    session_unset();
    session_destroy();
}

function getPasswordHash($input) {
    //return md5($input);
    $salt = "hai";
    $toHash = $input . $salt;
    return hash('sha256', $toHash);
}

function datetime() {
    return date("Y-m-d H:i:s");
}


function goHomePage(){
    global $template;
    header('Location: '.$template->getConfigVariable('BASE_URL').'/admin');       
}

function protectMyData(){
    if(!empty($_FILES)) {
        $_FILES ['file'] ['name']= str_replace("'","+",$_FILES ['file'] ['name']);
        $_FILES ['file'] ['name']= str_replace('"',"+",$_FILES ['file'] ['name']);
         $_FILES ['file'] ['name']= htmlspecialchars(    mysql_real_escape_string( $_FILES ['file'] ['name'])    ); 
    
    }
    foreach ($_POST as $key => $value) { 
        if( $key === "deleted"){
            $_POST[$key] = ($_POST[$key] == "on")?1:0; 
        }
        if( $key !== "password"){
            $_POST[$key]= htmlspecialchars(    mysql_real_escape_string($_POST[$key])    ); 
        }
    
    }
    foreach ($_GET as $key => $value) {
        $_GET[$key]= htmlspecialchars(    mysql_real_escape_string($_GET[$key])    );   
    }
}