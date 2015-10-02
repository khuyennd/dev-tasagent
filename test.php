<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zomyongho
 * Date: 11/20/12
 * Time: 3:25 PM
 * To change this template use File | Settings | File Templates.
 */

/*
    Author: Yash Gupta
    File: search.php
    Description:
        This script searches google for a given search term and outputs all the results' urls for upto 1000 results.
    Usage:
        Make a form in some other page and pass the following parameters with GET method, or modify the url as search.php?pages=50&amp;q=get+google+results+php     
        q => Your search query. Default query is: 'no query'     
        pages => The number of pages you want to parse. (default is 10, maximum of 100)     
        start => The page to start from. Default is 1
    */
    echo "aaaa";
    $servername = "localhost";
    $username = "root";
    $password = "chienva";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    die("xin chao");

    ini_set("max_execution_time", 0); set_time_limit(0); 	// no time-outs!
    if(isset($_GET['q']))
        $query=$_GET['q'];
    else
        $query="sample search term";
    if(isset($_GET['pages']))
        $npages=$_GET['pages'];
    else
        $npages=10;
    if(isset($_GET['start']))
        $start=$_GET['start'];
    else
        $start=0;
    if($npages>=100)
        $npages=100;
    $gg_url = 'https://www.google.com/search?hl=en&amp;q=' . urlencode($query) . '&amp;start=';
    $i=1;
    $size=0;
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_COOKIEFILE	=>    "cookie.txt",
            CURLOPT_COOKIEJAR	=>    "cookie.txt",
        CURLOPT_USERAGENT	=>    "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3",
        CURLOPT_REFERER	=>	    "http://www.google.com/",
        );
    for ($page = $start; $page < $npages; $page++)
    {
        $ch = curl_init($gg_url.$page.'0');
        curl_setopt_array($ch,$options);
        $scraped="";
        $scraped.=curl_exec($ch);
        curl_close( $ch );
        $results = array();
        preg_match_all('/a href="([^"]+)" class=l.+?>.+?<\/a>/',$scraped,$results);
        foreach ($results[1] as $url)
        {
            echo "<a href='$url'>$url</a> ";
            $i++;
        }
        $size+=strlen($scraped);
    }
    fclose($fp);
    echo "Number of results: $i Total KB read: ".($size/1024.0);
?>
