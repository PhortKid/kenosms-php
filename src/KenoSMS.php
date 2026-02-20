<?php
namespace KenoSMS;

class KenoSMS {
    private $apiToken;
    private $apiUrl = "https://sms.kenosis.co.tz/api/http/sms";

    public function __construct(string $apiToken) {
        $this->apiToken = $apiToken;
    }

    private function request(string $method, string $endpoint = "", array $data = []) {
        $url = $this->apiUrl . $endpoint;
        $ch = curl_init();

        if ($method === "GET" && !empty($data)) {
            $url .= "?" . http_build_query($data);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Accept: application/json"
        ]);

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            $data['api_token'] = $this->apiToken;
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function sendSMS(string $recipient, string $sender_id, string $message, string $type="plain", string $schedule_time=null, string $dlt_template_id=null) {
        $data = [
            "recipient" => $recipient,
            "sender_id" => $sender_id,
            "type" => $type,
            "message" => $message
        ];
        if ($schedule_time) $data['schedule_time'] = $schedule_time;
        if ($dlt_template_id) $data['dlt_template_id'] = $dlt_template_id;

        return $this->request("POST", "", $data);
    }

    public function getSMS(string $uid) {
        return $this->request("GET", "/$uid", ["api_token" => $this->apiToken]);
    }

    public function listSMS() {
        return $this->request("GET", "", ["api_token" => $this->apiToken]);
    }
}