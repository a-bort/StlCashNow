<?php
    function index(){
        createCon();
        readAffiliates();
    }
    
    function createCon(){
        $con = mysql_connect("localhost", "root", "713396");
        
        if(!$con){
            echo "{error: 'Could not connect to DB'}";
            die();
        }
        
        $db_selected = mysql_select_db("stlcashnow"); //Couldn't select DB
        if(!$db_selected){
            echo "{error: 'Could not select DB'}";
            die();
        }

        return $con;
    }
    
    function readAffiliates(){
        $dataSql = mysql_query("SELECT * FROM `affiliates`");
        
        if($dataSql){
            $ar = array();
            while($data = mysql_fetch_object($dataSql)){
                array_push($ar, $data);
            }
            $return = array('data' => $ar);
            echo json_encode($return);
        }
        else{
            mysql_close($con);
            echo "{error: ''}";
            die();
        }
    }
    
    index();
?>