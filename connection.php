<?php
    /**********SERVERNAME OF MSSQL LOGIN START***********/
$serverName = "DESKTOP-USGNHAA\SQLEXPRESS";
    /**********SERVERNAME OF MSSQL LOGIN END***********/

    /**********ADMIN ACCESS INTO DATABASES START***********/
$connectionInfo=array("Database"=>"database name","UID"=>"root","PWD"=>" ");
    /**********ADMIN ACCESS INTO DATABASES END***********/

    /**********COMBINED TWO VARIABLE NAME TO BE FUNCTION IN VARIABLE $conn START***********/
$conn = sqlsrv_connect($serverName,$connectionInfo);
    /**********COMBINED TWO VARIABLE NAME TO BE FUNCTION IN VARIABLE $conn END***********/
?> 