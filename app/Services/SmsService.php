<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $username;
    protected $apiKey;
    protected $senderId;
    protected $apiUrl;
    protected $templates;

    public function __construct()
    {
        $this->username = config('sms.username');
        $this->apiKey = config('sms.api_key');
        $this->senderId = config('sms.sender_id');
        $this->apiUrl = config('sms.api_url');
        $this->templates = config('sms.templates');
    }

    /**
     * Send SMS using the provider API
     */
    public function send($mobile, $message, $templateId)
    {
        // Ensure 91 prefix for Indian numbers if length is 10
        if (strlen($mobile) === 10) {
            $mobile = '91' . $mobile;
        }

        if (empty($mobile)) {
            Log::warning("SmsService: Mobile number is empty");
            return false;
        }

        try {
            $response = Http::get($this->apiUrl, [
                'username' => $this->username,
                'apikey' => $this->apiKey,
                'apirequest' => 'Text',
                'sender' => $this->senderId,
                'route' => 'TRANS',
                'mobile' => $mobile,
                'message' => $message,
                'TemplateID' => $templateId,
                'format' => 'JSON'
            ]);

            $result = $response->json();

            if (isset($result['status']) && strtolower($result['status']) === 'success') {
                Log::info("SMS Sent Successfully to $mobile. MsgId: " . ($result['messageid'] ?? 'N/A'));
                return true;
            } else {
                Log::error("SMS Failed to $mobile: " . ($result['error'] ?? json_encode($result)));
                return false;
            }

        } catch (\Exception $e) {
            Log::error("SMS Service Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send OTP SMS
     */
    public function sendOtp($mobile, $otp, $validity = 10)
    {
        $templateId = $this->templates['otp'];
        $message = "Dear Customer, your OTP for login at Ved Herbs and Ayurveda is {$otp}. Do not share this OTP with anyone. Valid for {$validity} minutes. – Ved Herbs and Ayurveda";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Welcome SMS
     */
    public function sendWelcome($mobile)
    {
        $templateId = $this->templates['welcome'];
        $message = "Welcome to Ved Herbs and Ayurveda! Your account has been successfully created with mobile number {$mobile}. We wish you good health and wellness.";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Order Placed SMS
     */
    public function sendOrderPlaced($mobile, $customerName, $orderNumber, $amount)
    {
        $templateId = $this->templates['order_placed'];
        $message = "Dear {$customerName}, your order {$orderNumber} has been successfully placed on Ved Herbs and Ayurveda. Order amount: Rs.{$amount}. Thank you for choosing us.";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Order Cancelled SMS
     */
    public function sendOrderCancelled($mobile, $orderNumber)
    {
        $templateId = $this->templates['order_cancelled'];
        $message = "Your order {$orderNumber} has been cancelled as per your request. For assistance, contact Ved Herbs and Ayurveda support.";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Refund Initiated SMS
     */
    public function sendRefundInitiated($mobile, $amount, $orderNumber, $days = '5-7')
    {
        $templateId = $this->templates['refund'];
        $message = "Refund of Rs.{$amount} for Order {$orderNumber} has been initiated. Amount will be credited within {$days} working days. Ved Herbs and Ayurveda.";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Order Dispatched SMS
     */
    public function sendOrderDispatched($mobile, $customerName, $orderNumber, $trackingId, $courierName)
    {
        $templateId = $this->templates['dispatched'];
        $message = "Hello {$customerName} your order {$orderNumber} from Ved Herbs and Ayurveda has been dispatched. Tracking ID: {$trackingId} Courier Partner: {$courierName}.";

        return $this->send($mobile, $message, $templateId);
    }

    /**
     * Send Payment Failed SMS
     */
    public function sendPaymentFailed($mobile, $orderNumber)
    {
        $templateId = $this->templates['payment_failed'];
        $message = "Dear Customer, payment for Order {$orderNumber} has failed. Please retry or choose another payment method. Ved Herbs and Ayurveda.";

        return $this->send($mobile, $message, $templateId);
    }
}
