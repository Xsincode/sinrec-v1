<?php

require ("./functions.php");
sinrec_banner();
// $url = readline("Domain Name -> ");
echo "
                                                            \e[34m1 -> Get IPv4 and IPv6 
                                                            \e[34m2 -> Ip Info
                                                            \e[34m3 -> Get Info User github
                                                            \e[34m4 -> WebSite Infoe 
                                                            \e[34m5 -> All Links In Web Page
                                                            \e[97m
";
$option = readline("Choose Your Option -> ");


if($option == 1){
    function GetIp(){
        $url = readline("Domain Name -> ");
        $ipv4 = dns_get_record($url,DNS_A);
        $ipv6 = dns_get_record($url,DNS_AAAA);
        echo "\e[91mTHE IPv6 :\e[36m\n";
        for($i=0;$i<count($ipv6);$i++){
            print_r($ipv6[$i]["ipv6"]);
            echo "\n";
        };
        echo "\n";
        echo "\e[91mTHE IPv4 :\e[36m\n";
        for($i=0;$i<count($ipv4);$i++){
            print_r($ipv4[$i]["ip"]);
            echo "\n";
        };
        echo "\n";
        echo "\n";
        
    }
    GetIp();
}
if($option == 2){
    $ip = readline("The Ip -> ");
    function ip_info($ip) {
        $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
        $details = json_decode($json);
        return $details;
    }
    $details = ip_info($ip);
    $elemts = array("ip","hostname","city","region","country","org","postal","timezone");
    for($i=0;$i<8;$i++){
        $det = $details;
        $el = $elemts[$i];
        // echo ($elemts[$i] . " -> " . $details->$el);
        echo ("\e[91m{$elemts[$i]} : \e[36m {$details->$el}");
        echo "\n";
    }
}

if($option == 3){
    function UserGithubInfo(){
    $YouUserAgent = readline("You User Agent => ");
    $YourApiKey = readline("You github Api Key => ");
    $url = 'https://api.github.com/users';
    $user_name = readline("The UserName => ");
    $request_url = $url . '/' . $user_name;
    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-RapidAPI-Host: api.github.com','X-RapidAPI-Key: ' . $YourApiKey,'Content-Type: application/json']);
    $config['useragent'] = $YouUserAgent;
    curl_setopt($curl, CURLOPT_USERAGENT, $config['useragent']);
    $response = curl_exec($curl);
    curl_close($curl);
    $obj = json_decode($response);
    $TheList = array("name","location","bio","twitter_username","followers","following","created_at","updated_at","company");
    echo "\n";
    for($i=0;$i<=8;$i++){
        $TheNewList = $TheList[$i];
        if($obj->$TheNewList != ""){
            // print_r($TheList[$i] . " : " . $obj->$TheNewList . "\n");
            echo ("\e[91m{$TheList[$i]} : \e[36m {$obj->$TheNewList}");
            echo "\n";
        }
    }
}
    UserGithubInfo();
}

if($option == 4){
    function WebSiteInfo(){
        $domain = readline("Domain Name -> ");
        $data = file_get_contents("https://api.hackertarget.com/dnslookup/?q=$domain");
        print_r($data);
    }
    WebSiteInfo();
}

if($option == 5){
    function Links(){
        $domain = readline("Domain Name -> ");
        echo "\n";
        $data = file_get_contents("https://api.hackertarget.com/pagelinks/?q=$domain");
        echo "\n";
        echo $data;
        echo "\n";
    }
    Links();
}





