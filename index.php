<?php
require_once __DIR__.'/src/PHPTelebot.php';
require_once __DIR__.'/src/xc.php';

// Read token & username
function readToken($input){
    $TOKENr = file_get_contents("Xppai.WRT");
    $raw = explode("\n",$TOKENr);
    $TOKEN = $raw[0];
    $USERNAME = $raw[1];
    if ($input == "token") {
        return $TOKEN;
    }elseif($input == "username"){
        return $USERNAME;
    }
}

$bot = new PHPTelebot(readToken("token"), readToken("username"));

// Ping Command
$bot->cmd('/ping','yes');

// start cmd & cmd list
$bot->cmd('/start',"Welcome to XppaiWRT\n/cmdlist to see all comand\nTelegram Support : @OppaiCyber");
$bot->cmd('/cmdlist',"/proxies | Proxies status \n/rules | Rule list \n/vnstat | Bandwidth usage \n/memory | Memory status \n/myip | Get ip details \n/myxl 087xxx | MyXL Package Remaining \n/speedtest | Speedtest (still buggy) \n/ping | Ping bot\n/sysinfo | System Information");

// OpenWRT Command 
$bot->cmd('/proxies', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".Proxies()."</code>",$options);
});

$bot->cmd('/vnstat', function ($input) {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".shell_exec("vnstat $input")."</code>",$options);
});

$bot->cmd('/memory', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".shell_exec("cat /proc/meminfo | sed -n '1,5p'")."</code>",$options);
});

$bot->cmd('/sysinfo', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".shell_exec("src/plugins/sysinfo.sh -bw")."</code>",$options);
});

$bot->cmd('/myip', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".myip()."</code>",$options);
});

$bot->cmd('/rules', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".Rules()."</code>",$options);
});

$bot->cmd('/speedtest', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    Bot::sendMessage("<code>Speedtest on Progress</code>", $options);
    return Bot::sendMessage("<code>".Speedtest()."</code>",$options);
});

$bot->cmd('/myxl', function ($number) {
    $options = ['parse_mode' => 'html','reply' => true];
    Bot::sendMessage("<code>MyXL on Progress</code>", $options);
    return Bot::sendMessage("<code>".MyXL($number)."</code>",$options);
});

//inline command
// Inline
$bot->on('inline', function ($cmd,$input) {
    
    if($cmd == 'proxies'){
        $results[] = [
        'type' => 'article',
        'id' => 'unique_id1',
        'title' => Proxies(),
        'parse_mode' => 'html',
        'message_text' => "<code>".Proxies()."</code>",
        ];
    }elseif($cmd == 'rules'){
        $results[] = [
        'type' => 'article',
        'id' => 'unique_id1',
        'title' => Rules(),
        'parse_mode' => 'html',
        'message_text' => "<code>".Rules()."</code>",
        ];
    }elseif($cmd == 'myxl'){
        $results[] = [
        'type' => 'article',
        'id' => 'unique_id1',
        'title' => MyXL($input),
        'parse_mode' => 'html',
        'message_text' => "<code>".MyXL($input)."</code>",
        ];
    }
    
    $options = [
        'cache_time' => 3600,
    ];

    return Bot::answerInlineQuery($results, $options);
});

$bot->run();
