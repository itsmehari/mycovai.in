<?php
$ipaddress = $_SERVER['REMOTE_ADDR'];
$page = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}"; 
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct Access';
$date = date('Y-m-d H:i:s');
$useragent = $_SERVER['HTTP_USER_AGENT'];
$remotehost = @getHostByAddr($ipaddress);

// echo $ipaddress;
// echo "<br>";
// echo $page;
// echo "<br>";
// echo $useragent;
// echo "<br>";
// echo $referrer;
// echo "<br>";
// echo $date;
// echo "<br>";
// echo $remotehost;

// Create log line
$logline = $ipaddress . '|' . $referrer . '|' . $date . '|' . $useragent . '|' . $remotehost . '|' . $page . "\n";

// echo $logline;

// // Write to log file (anchor to this file — PHP CWD is often the main script dir, e.g. /directory/)
$logfile = __DIR__ . '/logfile.txt';

$handle = @fopen($logfile, 'a+');
if ($handle) {
    if (fwrite($handle, $logline) === false) {
        @error_log('weblog/log.php: fwrite failed for ' . $logfile);
    }
    fclose($handle);
} else {
    @error_log('weblog/log.php: fopen failed for ' . $logfile);
}
?>