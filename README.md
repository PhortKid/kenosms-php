
# KenoSMS PHP SDK

Official PHP SDK for sending and managing SMS via the KenoSMS HTTP API.

This SDK provides a simple interface for:

* Sending SMS messages
* Scheduling SMS delivery
* Retrieving a single SMS by UID
* Listing all SMS messages

---

## Installation

Install via Composer:

```bash
composer require iamphort/kenosms-php
```

---

## Requirements

* PHP 7.4 or higher
* cURL extension enabled
* Composer

---

## Getting Started

### 1. Include Composer Autoload

```php
require 'vendor/autoload.php';
```

### 2. Import the Namespace

```php
use KenoSMS\KenoSMS;
```

### 3. Initialize the Client

```php
$sms = new KenoSMS("YOUR_API_TOKEN");
```

Replace `YOUR_API_TOKEN` with your actual API token provided by KenoSMS.

---

## Send SMS

```php
$response = $sms->sendSMS(
    "2557XXXXXXXX",
    "KENOSMS",
    "Hello from KenoSMS PHP SDK!"
);

print_r($response);
```

### Parameters

| Parameter       | Type   | Required | Description                                 |
| --------------- | ------ | -------- | ------------------------------------------- |
| recipient       | string | Yes      | Recipient phone number (e.g., 2557XXXXXXXX) |
| sender_id       | string | Yes      | Registered Sender ID                        |
| message         | string | Yes      | SMS message content                         |
| type            | string | No       | SMS type (default: `plain`)                 |
| schedule_time   | string | No       | Schedule date/time (`YYYY-MM-DD HH:MM:SS`)  |
| dlt_template_id | string | No       | DLT Template ID if required                 |

---

## Send Scheduled SMS

```php
$response = $sms->sendSMS(
    "2557XXXXXXXX",
    "KENOSMS",
    "This message is scheduled",
    "plain",
    "2026-02-25 10:00:00"
);

print_r($response);
```

---

## Get a Single SMS

Retrieve SMS details using its unique ID (UID):

```php
$response = $sms->getSMS("SMS_UNIQUE_ID");

print_r($response);
```

---

## List All SMS

```php
$response = $sms->listSMS();

print_r($response);
```

---

## API Endpoint

This SDK communicates with:

```
https://sms.kenosis.co.tz/api/http/sms
```

---

## Error Handling Example

```php
try {
    $response = $sms->sendSMS(
        "2557XXXXXXXX",
        "KENOSMS",
        "Testing error handling"
    );

    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

---

## Response Format

All methods return a decoded JSON response as an associative array.

Example:

```php
Array
(
    [status] => success
    [message] => SMS sent successfully
    [data] => Array
        (
            [uid] => abc123xyz
        )
)
```

---

## License

MIT License

---

## Author

KenoSMS
Website: [https://sms.kenosis.co.tz](https://sms.kenosis.co.tz)

---

