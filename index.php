<?php
require_once __DIR__.'/src/PHPTelebot.php';
require_once __DIR__.'/src/xc.php';

// edit this line with your token bot and username
$bot = new PHPTelebot('Input your Token Bot', 'Bot Username');

// Ping Command
$bot->cmd('xc','yes');

// OpenWRT Command 
$bot->cmd('/proxies', function () {
    $options = ['parse_mode' => 'html','reply' => true];
    return Bot::sendMessage("<code>".Proxies()."</code>",$options);
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
    }
    
    $options = [
        'cache_time' => 3600,
    ];

    return Bot::answerInlineQuery($results, $options);
});

$bot->run();
