<?php
// Enable CORS (Cross-Origin Resource Sharing) to allow cross-origin requests
header("Access-Control-Allow-Origin: *");

function get_ip_info($ip) {
    $context = stream_context_create([
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ]);

    $url = "http://ip-api.com/json/$ip";
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$ip_info = get_ip_info($visitor_ip);

$ip = $ip_info['query'];
$country = $ip_info['countryCode'];

$result = ["ip" => $ip, "country" => $country];
header('Content-Type: application/json');
echo json_encode($result);
?>
