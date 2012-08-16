<?php
    function init(){
        if(array_key_exists("code", $_POST)){
            $code = $_POST["code"];
            $con = createCon();
            $data = readFromDB($con, $code);
            $ip = getIpAddress();

            if($data){
                logAttempt($code, $ip);
                mysql_close($con);
                header("Location: landing.html");
            }
        }
        else{
            header("Location: index.html");
        }
    }

    function createCon(){
        $con = mysql_connect("localhost", "root", "713396");
        
        if(!$con){
            header("Location: index.html?error=101");  //Couldn't connect to db
        }
        
        mysql_select_db("stlcashnow") or die(header("Location: index.html?error=102")); //Couldn't select DB
        return $con;
    }
    
    function readFromDB($con, $inCode){
        
        $dataSql = mysql_query("SELECT * FROM `codes` WHERE `code` = " . $inCode);
        
        if($dataSql){
            $data = mysql_fetch_array($dataSql);
            return $data;
        }
        else{
            mysql_close($con);
            header("Location: index.html?error=1");  //Code not found
            return false;
        }
    }
    
    function getIpAddress() {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
    
    function logAttempt($code, $ip) {
        mysql_query("INSERT INTO `stlcashnow`.`entries` (`code`, `ip`, `created`) VALUES ('" . $code . "', '" . $ip . "', '" . date('Y-m-d H:i:s') . "')");
    }
    
    init();
?>