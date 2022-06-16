<?php
    function is_username($username) {
        $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
        if (preg_match($parttern, $username))
            return true;
    }

    function is_password($password) {
        $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if (preg_match($parttern, $password))
            return true;
    }

    function is_email($email) {
        $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (preg_match($parttern, $email))
            return true;
    }

    function is_doctor($hoten1)//Địa chỉ
    {
        $parttern = "/^[^$&+,:;=?@#|'<>.^*()%!]{1,1000}$/";
        if(Preg_match($parttern, $hoten1))
            return true;
     }
     function is_ghichu($hoten1)//Địa chỉ
    {
        $parttern = "/^[^$&+:;=?@#|'<>^*()%!]{1,1000}$/";
        if(Preg_match($parttern, $hoten1))
            return true;
     }
?>