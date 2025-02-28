<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->text) || empty(trim($data->text))) {
    echo json_encode(["message" => "متن پیام خالی است"]);
    exit;
}

$token = "bot364686:8b37c954-d6bf-43e9-96bb-a7e94e8f2fbd";
$chat_id = "10480082"; // یا نام کاربری کانال بدون @
$text = $data->text;

$url = "https://eitaayar.ir/api/$token/sendMessage";
$params = [
    "chat_id" => $chat_id,
    "text" => $text
];

$options = [
    "http" => [
        "header" => "Content-Type: application/json",
        "method" => "POST",
        "content" => json_encode($params)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    echo json_encode(["message" => "خطا در ارسال پیام"]);
} else {
    echo json_encode(["message" => "پیام ارسال شد!"]);
}
?>
