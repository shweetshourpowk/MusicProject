<?php
/**
 * Created by PhpStorm.
 * User: rmccr_000
 * Date: 4/25/2015
 * Time: 12:15 PM
 */

    $link = mysqli_connect("localhost", "rpmccror", "rpmccror", "rpmccror_db");

    if(!$link){
        die('Connect error (' . mysqli_connect_error() . ') ' . mysqli_connect_error());
    }
