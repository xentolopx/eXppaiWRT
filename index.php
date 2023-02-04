<?php
require_once __DIR__ . "/src/PHPTelebot.php";
require_once __DIR__ . "/src/xc.php";

// Read token & username
function readToken($input)
{
    $data = file_get_contents("Xppai.WRT");
    $raw = explode("\n", $data);
    return $input == "token" ? $raw[0] : $raw[1];
}

$bot = new PHPTelebot(readToken("token"), readToken("username"));

function sendAd() {
    $options = ["parse_mode" => "html", "reply" => true];
    $ads = [
        "<span class='tg-spoiler'>Enjoying eXppaiWRT?, Support me on BCA : 0131630831 | DANA / OVO : 087837872813 | AN Dimas Syahrul Hidayat</span>",
        "<span class='tg-spoiler'>Keep Your eXppaiWRT updated with 'git pull'</span>",
        "<span class='tg-spoiler'>Anda bergelut didunia Cryptocurrency?, Saya menyediakan pencairan asset crypto anda di https://t.me/XCTX_bot?start=283993474</span>",
    ];

    // Select a random advertisement message
    $selectedAd = $ads[array_rand($ads)];

    Bot::sendMessage($selectedAd, $options);
}

// Ping Command
$bot->cmd("/ping", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    $start_time = microtime(true);
    Bot::sendMessage("<code>pong</code>", $options);
    $end_time = microtime(true);
    $diff = round(($end_time - $start_time) * 1000);
    Bot::sendMessage("<code>Time taken: " . $diff . "ms</code>", $options);
    return sendAd();
});

$bot->cmd("/start", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>
__   __                  _ _    _______ _____ 
\ \ / /                 (_) |  | | ___ \_   _|
 \ V / _ __  _ __   __ _ _| |  | | |_/ / | |  
 /   \| '_ \| '_ \ / _` | | |/\| |    /  | |  
/ /^\ \ |_) | |_) | (_| | \  /\  / |\ \  | |  
\/   \/ .__/| .__/ \__,_|_|\/  \/\_| \_| \_/  
      | |   | |                               
      |_|   |_|  Monitor Your OpenWRT
Welcome to XppaiWRT\n/cmdlist to see all comand\nTelegram Support : @OppaiCyber
</code>", $options);
    return sendAd();
});


$bot->cmd("/cmdlist", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>
📁Aria2 Command
 ↳/aria2add      | Add task
 ↳/aria2stats    | Aria2 status
 ↳/aria2pause    | Pause all
 ↳/aria2resume   | Resume all
📁OpenClash Command
 ↳/oc        | OC Information
 ↳/proxies   | Proxies status 
 ↳/rules     | Rule list 
📁MyXL Command 
 ↳/myxl      | Bandwidth usage 
 ↳/setxl 087 | Set default number
📁System Information
 ↳/vnstat    | Bandwidth usage 
 ↳/memory    | Memory status 
 ↳/myip      | Get ip details 
 ↳/speedtest | Speedtest 
 ↳/ping      | Ping bot
 ↳/sysinfo   | System Information</code>",
        $options);
    return sendAd();
});



$bot->on('document', function() {
  // download file
    $token = readToken("token");
    $message = Bot::message();
    $file_id = $message['document']['file_id'];
    $raw = json_decode(Bot::getFile($file_id),true);
    $file_path = $raw['result']['file_path'];
    $wget = shell_exec("wget -P /etc/openclash/config https://api.telegram.org/file/bot$token/$file_path");
    Bot::sendMessage("file harusnya dah terdownload stb, dan terupload di folder openclash config dengan nama $file_path");
 });


// OpenWRT Command
$bot->cmd("/proxies", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>" . Proxies() . "</code>", $options);
    sendAd();
});

$bot->cmd("/vnstat", function ($input) {
    $options = ["parse_mode" => "html", "reply" => true];
    $input = escapeshellarg($input);
    $output = shell_exec("vnstat $input 2>&1");
    if ($output === null) {
        Bot::sendMessage("<code> Invalid input or vnstat not found</code>", $options);
    } else {
        Bot::sendMessage("<code>" . $output . "</code>", $options);
    }
    sendAd();
});

// cmd vnstati
$bot->cmd("/vnstati", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    $image_files = [
        'summary' => 'vnstati -s -i br-lan -o summary.png',
        'hourly' => 'vnstati -h -i br-lan -o hourly.png',
        'daily' => 'vnstati -d -i br-lan -o daily.png',
        'monthly' => 'vnstati -m -i br-lan -o monthly.png',
        'yearly' => 'vnstati -y -i br-lan -o yearly.png',
        'top' => 'vnstati --top 5 -i br-lan -o top.png',
    ];
    
    foreach ($image_files as $image_file) {
        shell_exec($image_file);
    }
    
    foreach ($image_files as $file_name => $command) {
        Bot::sendPhoto($file_name . '.png');
    }
    
    shell_exec("rm *.png");
    sendAd();
});


$bot->cmd("/memory", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    $meminfo = file("/proc/meminfo");
    $total = intval(trim(explode(":", $meminfo[0])[1])) / 1024;
    $free = intval(trim(explode(":", $meminfo[1])[1])) / 1024;
    $used = $total - $free;
    $percent = round(($used / $total) * 100);
    $bar = str_repeat("■", round($percent / 5));
    $bar .= str_repeat("□", 20 - round($percent / 5));
    $output =
        "<code>Memory usage: \nBar: " .
        $bar .
        "\nUsed: $used MB \nAvailable: $free MB \nTotal: $total MB \nUsage: $percent%</code>";
    Bot::sendMessage($output, $options);
    sendAd();
});

$bot->cmd("/sysinfo", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/sysinfo.sh -bw") . "</code>",
        $options);
    sendAd();
});

$bot->cmd("/oc", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/oc.sh") . "</code>",
        $options);
    sendAd();
});

$bot->cmd("/myip", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>" . myip() . "</code>", $options);
    sendAd();
});

$bot->cmd("/rules", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>" . Rules() . "</code>", $options);
    sendAd();
});

$bot->cmd("/speedtest", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>Speedtest on Progress</code>", $options);
    Bot::sendMessage("<code>" . Speedtest() . "</code>", $options);
    sendAd();
});

//Myxl cmd
$bot->cmd("/setxl", function ($number) {
    $options = ["parse_mode" => "html", "reply" => true];
    if ($number == "") {
        Bot::sendMessage(
            "<code>Masukan nomor yang mau di set sebagai default /setxl 087x</code>",
            $options
        );
    } else {
        shell_exec("echo '$number' > xl");
        Bot::sendMessage(
            "<code>Nomer $number disetting sebagai default\nSilahkan gunakan cmd /myxl tanpa memasukkan nomor</code>",
            $options
        );
    }
});

$bot->cmd("/myxl", function ($number) {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>MyXL on Progress</code>", $options);
    Bot::sendMessage("<code>" . MyXL($number) . "</code>", $options);
    sendAd();
});

$bot->cmd("/adb", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage("<code>ADB on Progress</code>", $options);
    Bot::sendMessage("<code>" . ADB() . "</code>", $options);
    sendAd();
});

$bot->cmd("/aria2add", function ($url) {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/add.sh $url") . "</code>",
        $options
    );
    sendAd();
});

$bot->cmd("/aria2stats", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/stats.sh") . "</code>",
        $options
    );
    sendAd();
});

$bot->cmd("/aria2pause", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/pause.sh") . "</code>",
        $options
    );
    sendAd();
});

$bot->cmd("/aria2resume", function () {
    $options = ["parse_mode" => "html", "reply" => true];
    Bot::sendMessage(
        "<code>" . shell_exec("src/plugins/resume.sh") . "</code>",
        $options
    );
    sendAd();
});

//Aria2 cmd end

//inline command
$bot->on("inline", function ($cmd, $input) {
    if ($cmd == "proxies") {
        $results[] = [
            "type" => "article",
            "id" => "unique_id1",
            "title" => Proxies(),
            "parse_mode" => "html",
            "message_text" => "<code>" . Proxies() . "</code>",
        ];
    } elseif ($cmd == "rules") {
        $results[] = [
            "type" => "article",
            "id" => "unique_id1",
            "title" => Rules(),
            "parse_mode" => "html",
            "message_text" => "<code>" . Rules() . "</code>",
        ];
    } elseif ($cmd == "myxl") {
        $results[] = [
            "type" => "article",
            "id" => "unique_id1",
            "title" => MyXL($input),
            "parse_mode" => "html",
            "message_text" => "<code>" . MyXL($input) . "</code>",
        ];
    }

    $options = [
        "cache_time" => 3600,
    ];

    return Bot::answerInlineQuery($results, $options);
});

$bot->run();
