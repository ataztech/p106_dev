<?php
namespace App\Http\Controllers;
use App\Modules\Models\GlobalValue;
use Illuminate\Http\Request;
use Redirect,Response;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class RazorpayController extends Controller
{
    public function processDetail(Request $request)
    {
        $razorpay_key_id = GlobalValue::where('slug','razorpay-key')->first();
        $razorpay_secret_key = GlobalValue::where('slug','razorpay-secret-key')->first();
        $keyId = $razorpay_key_id->value;
        $keySecret = $razorpay_secret_key->value;
        $displayCurrency = 'INR';
        $api = new Api($keyId, $keySecret);

        $orderData = [
            'receipt'         => 3456,
            'amount'          => $request->amount * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpayOrderId = $razorpayOrder['id'];
        $_SESSION['razorpay_order_id'] = $razorpayOrderId;
        $displayAmount = $amount = $orderData['amount'];

        if ($displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
        }

        $checkout = 'automatic';

        if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
        {
            $checkout = $_GET['checkout'];
        }
        $image_url = url('/public/theme1/images/1.png');
        $data = [
            "key"         => $keyId,
            "amount"      => $amount,
            "image"       => $image_url,
            "order_id"          => $razorpayOrderId,
        ];

        if ($displayCurrency !== 'INR')
        {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }

        return json_encode($data);
    }


    public function verifyPayment(Request $request)
    {
        $razorpay_key_id = GlobalValue::where('slug','razorpay-key')->first();
        $razorpay_secret_key = GlobalValue::where('slug','razorpay-secret-key')->first();
        $keyId = $razorpay_key_id->value;
        $keySecret = $razorpay_secret_key->value;
        $success = true;
        $error = "Payment Failed";
        if (empty($_POST['razorpay_payment_id']) === false)
        {
            $api = new Api($keyId, $keySecret);
            try
            {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => $request['response']['razorpay_order_id'],
                    'razorpay_payment_id' => $request['response']['razorpay_payment_id'],
                    'razorpay_signature' => $request['response']['razorpay_signature']
                );

                $api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
        if ($success === true)
        {
            $insert_payment_detail = new \App\Modules\Payment\Models\PaymentDetail();
            $insert_payment_detail->customer_name = $request->name;
            $insert_payment_detail->contact_no = $request->contact;
            $insert_payment_detail->email = $request->email;
            $insert_payment_detail->package = $request->packages;
            $insert_payment_detail->validity = $request->validity;
            $insert_payment_detail->amount = $request->amount;
            $insert_payment_detail->razorpay_order_id = $request['response']['razorpay_order_id'];
            $insert_payment_detail->razorpay_payment_id = $request['response']['razorpay_payment_id'];
            $insert_payment_detail->razorpay_signature = $request['response']['razorpay_signature'];
            $insert_payment_detail->save();
            $html = "<p><h4>Your payment was successful</h4></p>
             <p><h5>Payment ID : {$request['response']['razorpay_payment_id']}</h5></p>";
            $result = array('icon' => 'success','msg' => $html);
        }
        else
        {
            $html = "<p><h4>Your payment failed</h4></p>
             <p><h5>{$error}</h5></p>";
            $result = array('icon' => 'danger','msg' => $html);
        }
        return json_encode($result);


    }
}