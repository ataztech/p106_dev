<?php


namespace App\Http\Controllers;

use App\Modules\Cms\Models\Cms;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Demo\Models\Demo;
use App\Modules\Sales\Models\Sales;
use App\User;
use App\UserState;
use Illuminate\Http\Request;
use App\Modules\Price\Models\Price;
use Illuminate\Support\Facades\Session;
use Auth;
use Hash;
use Carbon\Carbon;


class SalesApiController extends Controller
{
    public function __construct()
    {

    }

    // This function handel counsellor login
    public function counsellorLogin(Request $request)
    {
        $counsellor_mobile_no = $request->mobile;
        $counsellor_password = $request->password;
        if(isset($counsellor_mobile_no) && isset($counsellor_password))
        {
            $check_counsellor = Counsellor::where('counsellor_mobile_no',$counsellor_mobile_no)->first();
            if(isset($check_counsellor))
            {
                if(Hash::check($counsellor_password,$check_counsellor->counsellor_password))
                {
                    $logged_in_seller['seller_id'] = $check_counsellor->id;
                    $logged_in_seller['name'] = $check_counsellor->counsellor_name;
                    $result = array('res_status' => 0,'res_msg' => 'Login successfull','response' => $logged_in_seller);
                    return json_encode($result);
                }
                else
                {
                    $result = array('res_status' => 1,'res_msg' => 'Invalid Login Credentials', 'response' => '');
                    return json_encode($result);
                }
            }
            else
            {
                $result = array('res_status' => 1,'res_msg' => 'Invalid Login Credentials', 'response' => '');
                return json_encode($result);
            }
        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Please enter mobile number and password', 'response' => '');
            return json_encode($result);
        }

    }


    // This function display list of demo according to counsellor
    public function counsellorDemoList(Request $request)
    {
        $counsellor_id = $request->seller_id;
        $skip = $request->skip;
        if(isset($counsellor_id))
        {
            $counsellor_list_count = Demo::where('assigned_to',$counsellor_id)->where('status','0')->count();
            $counsellor_demo_list = Demo::select('id','student_name','contact_number','alternative_contact_number','standard','date','time','address')->where('assigned_to',$counsellor_id)->where('status','0')->skip($skip)->limit(1)->get();
            if(isset($counsellor_demo_list) && $counsellor_demo_list->count() > 0)
            {
                $demo_list = [];
                foreach($counsellor_demo_list as $key => $demo)
                {
                    $demo_list['id'] = $demo->id;
                    $demo_list['student_name'] = $demo->student_name;
                    $demo_list['student_contact'] = $demo->contact_number;
                    $demo_list['student_alternate_contact'] = $demo->alternative_contact_number;
                    $demo_list['standard'] = $demo->standard;
                    $demo_list['date'] = $demo->date;
                    $demo_list['time'] = $demo->time;
                    $demo_list['address '] = $demo->address;
                }
                $result = array('count' => $counsellor_list_count,'res_status' => 0,'res_msg' => 'Success','response' => $demo_list);
                return json_encode($result);
            }
            else
            {
                $result = array('res_status' => 0,'res_msg' => 'No demo found', 'response' => '');
                return json_encode($result);
            }
        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function update demo status
    public function counsellorDemoFinish(Request $request)
    {
        $demo_id = $request->id;
        $status = $request->demo_status;
        $comment = $request->comment;
        $update_demo_status = Demo::find($demo_id);
        if(isset($update_demo_status) && $update_demo_status->count() > 0)
        {
            $update_demo_status->status = $status;
            $update_demo_status->comment = $comment;
            $update_demo_status->hours = $request->hours;
            $update_demo_status->minutes = $request->minutes;
            $update_demo_status->seconds = $request->seconds;
            $update_demo_status->save();
            $result = array('res_status' => 0,'res_msg' => 'Demo submitted successfully', 'response' => '');
            return json_encode($result);

        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function is used to create new demo by counsellor
    public function counsellorDemoCreate(Request $request)
    {
        $create_date = date_create($request->date);
        $create_time = date_create($request->time);
        $date = date_format($create_date,"Y/m/d");
        $time = date_format($create_time,"h:i: a");
        $create_demo =  new Demo();
        //$create_demo->created_by_id = $request->seller_id;
        //$create_demo->created_by = 7;
        $create_demo->student_name = $request->student_name;
        $create_demo->contact_number = $request->contact;
        $create_demo->alternative_contact_number = $request->alternate_contact;
        $create_demo->standard = '';
        $create_demo->date = $request->date;
        $create_demo->time = $request->time;
        $create_demo->address = $request->address;
        $create_demo->assigned_to = $request->seller_id;
        $create_demo->save();
        if($create_demo->save())
        {
            $message = 'Your Ataz learning home counselling session has been confirmed for '.$date.', '.$time.'.';
            $mobile = $request->contact;
            $this->sendMessage($mobile, $message);
            $result = array('res_status' => 0,'res_msg' => 'Demo created successfully', 'response' => '');
            return json_encode($result);
        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function return particular demo record
    public function counsellorEditDemo(Request $request)
    {
        $demo_id = $request->id;
        if(isset($demo_id))
        {
            $edit_demo = Demo::find($demo_id);
            $edit_demo_arr = [];
            if(isset($edit_demo) && $edit_demo->count() > 0)
            {
                $edit_demo_arr['student_name'] = $edit_demo->student_name;
                $edit_demo_arr['student_contact'] = $edit_demo->contact_number;
                $edit_demo_arr['student_alternane_contact'] = $edit_demo->alternative_contact_number;
                $edit_demo_arr['time'] = $edit_demo->time;
                $edit_demo_arr['date'] = $edit_demo->date;
                $edit_demo_arr['address'] = $edit_demo->address;
                $result = array('res_status' => 0,'res_msg' => 'Demo fetched successfully', 'response' => $edit_demo_arr);
                return json_encode($result);
            }
            else
            {
                $result = array('res_status' => 1,'res_msg' => 'Demo not found', 'response' => '');
                return json_encode($result);
            }

        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function is used to update particular demo
    public function counsellorUpdateDemo(Request $request)
    {
        $demo_id = $request->id;
        $time = $request->time;
        $date = $request->date;
        $address = $request->address;
        if(isset($demo_id))
        {
            $update_demo = Demo::find($demo_id);
            if(isset($update_demo) && $update_demo->count() > 0)
            {
                $update_demo->time = $time;
                $update_demo->date = $date;
                $update_demo->address = $address;
                if($update_demo->save())
                {
                    $result = array('res_status' => 0,'res_msg' => 'Demo updated successfully', 'response' => '');
                    return json_encode($result);
                }
                else
                {
                    $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
                    return json_encode($result);
                }
            }
            else
            {
                $result = array('res_status' => 1,'res_msg' => 'Demo not found', 'response' => '');
                return json_encode($result);
            }
        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'No demo id passed', 'response' => '');
            return json_encode($result);
        }
    }


    // This function is used to add student by seller
    public function counsellorStudentAdd(Request $request)
    {
        $counsellor_id = $request->seller_id;
        $demo_id = $request->id;
        if(isset($counsellor_id))
        {
            $demo_status = '0';
            if(isset($demo_id))
            {
                $change_demo_status = Demo::find($demo_id);
                if($change_demo_status->count() > 0)
                {
                    $demo_status = $change_demo_status->status;
                }
            }
            
            $create_student = new Sales();
            $create_student->counsellor_id = $counsellor_id;
            $create_student->customer_name = $request->student_name;
            $create_student->contact_no = $request->contact;
            $create_student->alternate_contact = $request->alternate_contact;
            $create_student->address = $request->address;
            $create_student->class = $request->class;
            $create_student->service = $request->service;
            $create_student->validity = $request->validity;
            $create_student->recipt_no = $request->receipt_no;
            $create_student->receipt_img = $request->receipt_img;
            
            $create_student->first_installment_payment_mode = $request->instalment1_payment_mode;
            $create_student->first_installment_amount = $request->instalment1_amount;
            $create_student->first_installment_cheque_img = $request->instalment1_cheque_img;
            $create_student->first_installment_cheque_no = $request->instalment1_cheque_no;
            
            $create_student->second_installment_payment_mode = $request->instalment2_payment_mode;
            $create_student->second_installment_amount = $request->instalment2_amount;
            $create_student->second_installment_cheque_img = $request->instalment2_cheque_img;
            $create_student->second_installment_cheque_no = $request->instalment2_cheque_no;
            
            $create_student->third_installment_payment_mode = $request->instalment3_payment_mode;
            $create_student->third_installment_amount = $request->instalment3_amount;
            $create_student->third_installment_cheque_img = $request->instalment3_cheque_img;
            $create_student->third_installment_cheque_no = $request->instalment3_cheque_no;
            $create_student->status = $demo_status;
    
            // if(isset($request->first_instalment) && count($request->first_instalment) > 0)
            // {
            //     $create_student->first_installment_payment_mode = $request->first_instalment['payment_mode'] ? $request->first_instalment['payment_mode'] : '';
            //     $create_student->first_installment_amount = $request->first_instalment['amount'] ? $request->first_instalment['amount'] : '';
            //     $create_student->first_installment_cheque_img = $request->first_instalment['cheque_img'] ? $request->first_instalment['cheque_img'] : '';
            //     $create_student->first_installment_cheque_no = $request->first_instalment['cheque_no'] ? $request->first_instalment['cheque_no'] : '';
            // }
            // if(isset($request->second_instalment) && count($request->second_instalment) > 0)
            // {
            //     $create_student->second_installment_payment_mode = $request->second_instalment['payment_mode'];
            //     $create_student->second_installment_amount = $request->second_instalment['amount'];
            //     $create_student->second_installment_cheque_img = $request->second_instalment['cheque_img'];
            //     $create_student->second_installment_cheque_no = $request->second_instalment['cheque_no'];
            // }
            // if(isset($request->third_instalment) && count($request->third_instalment) > 0)
            // {
            //     $create_student->third_installment_payment_mode = $request->third_instalment['payment_mode'];
            //     $create_student->third_installment_amount = $request->third_instalment['amount'];
            //     $create_student->third_installment_cheque_img = $request->third_instalment['cheque_img'];
            //     $create_student->third_installment_cheque_no = $request->third_instalment['cheque_no'];
            // }
            if($create_student->save())
            {
                $result = array('res_status' => 0,'res_msg' => 'Student added successfully', 'response' => '');
                return json_encode($result);
            }
            else
            {
                $result = array('res_status' => 1,'res_msg' => 'Something went wrong', 'response' => '');
                return json_encode($result);
            }
        }
        else
        {
            $result = array('res_status' => 1,'res_msg' => 'Seller not found', 'response' => '');
            return json_encode($result);
        }
    }


    // This function display list of student according to seller
    public function counsellorStudentList(Request $request)
    {
        $counsellor_id = $request->seller_id;
        $skip = $request->skip;
        if(isset($counsellor_id))
        {
            $counsellor_student_count = Sales::where('counsellor_id',$counsellor_id)->count();
            $counsellor_students = Sales::where('counsellor_id',$counsellor_id)->skip($skip)->limit(1)->get();
            if(isset($counsellor_students) && $counsellor_students->count() > 0)
            {
                $students_arr = [];
                foreach($counsellor_students as $index => $student)
                {
                    $students_arr['id'] = $student->id;
                    $students_arr['student_name'] = $student->customer_name;
                    $students_arr['student_contact'] = $student->contact_no;
                    $students_arr['student_alternane_contact'] = $student->alternate_contact;
                    $students_arr['class'] = $student->class;
                    $students_arr['validity'] = $student->validity;
                    //$students_arr['time'] = $student->id;
                    $students_arr['date'] = Carbon::parse($student->created_at)->format('d/m/Y');
                    $students_arr['address'] = $student->address;
                    $students_arr['status'] = $student->status;
                }
                $result = array('count' => $counsellor_student_count,'res_status' => 1, 'res_msg' => 'success', 'response' => $students_arr);
                return json_encode($result);
            }
            else
            {
                $result = array('res_status' => 0, 'res_msg' => 'No student found', 'response' => '');
                return json_encode($result);
            }

        }
        else
        {
            $result = array('res_status' => 0, 'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function is used to send otp
    public function demoSendOTP(Request $request)
    {
        $demo_id = $request->id;
        if(isset($demo_id))
        {
            $demo = Demo::find($demo_id);
            if(isset($demo) && $demo->count() > 0)
            {
                $mobile_number = $demo->contact_number;
                $generated_otp = rand(1000,9999);
                $message = 'Your Counselling Code for Ataz counselling session is '.$generated_otp;
                $message_response = $this->sendMessage($mobile_number,$message);
                /*$xml_data ='<?xml version="1.0"?>
                                <parent>
                                    <child>
                                        <user>ATAZTech</user>
                                        <key>6c5128b6dcXX</key>
                                        <mobile>'.$mobile_number.'</mobile>
                                        <message>'.$message.'</message>
                                        <accusage>2</accusage>
                                        <senderid>ATAZLR</senderid>
                                    </child>
                                </parent>';
                $URL = "http://mobicomm.dove-sms.com//submitsms.jsp?";
                $ch = curl_init($URL);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
                curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);
                $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);*/
                if($message_response == 200)
                {
                    $demo->otp = $generated_otp;
                    $demo->save();
                    $result = array('res_status' => 0, 'res_msg' => 'OTP sent successfully', 'response' => '');
                    return json_encode($result);
                }
                else
                {
                    $result = array('res_status' => 1, 'res_msg' => 'Failed to send OTP', 'response' => '');
                    return json_encode($result);
                }

            }
            else
            {
                $result = array('res_status' => 1, 'res_msg' => 'Something went wrong', 'response' => '');
                return json_encode($result);
            }
        }
        else
        {
            $result = array('res_status' => 1, 'res_msg' => 'Something went wrong', 'response' => '');
            return json_encode($result);
        }
    }


    // This function verify otp submited by counsellor
    public function demoSubmitOTP(Request $request)
    {
        $demo_id = $request->id;
        $otp = $request->otp;
        if(isset($demo_id) && isset($otp))
        {
            $verify_otp = Demo::where('id',$demo_id)->where('otp',$otp)->first();
            if($verify_otp)
            {
                $result = array('res_status' => 0, 'res_msg' => 'OTP verified successfully', 'response' => '');
                return json_encode($result);
            }
            else
            {
                $result = array('res_status' => 1, 'res_msg' => 'OTP not matched', 'response' => '');
                return json_encode($result);
            }
        }
    }
    
    
    // function to send message
    public function sendMessage($mobile_number, $message)
    {
        $xml_data ='<?xml version="1.0"?>
                                <parent>
                                    <child>
                                        <user>ATAZTech</user>
                                        <key>6c5128b6dcXX</key>
                                        <mobile>'.$mobile_number.'</mobile>
                                        <message>'.$message.'</message>
                                        <accusage>2</accusage>
                                        <senderid>ATAZLR</senderid>
                                    </child>
                                </parent>';
        $URL = "http://mobicomm.dove-sms.com//submitsms.jsp?";
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $resultStatus;
    }







}

