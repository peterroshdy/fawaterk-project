<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Session;
use Lang;
use URL;
use Mail;
use App\Helpers;
use App\GeneralCustomer;
use App\User;


class UserAuthController extends Controller
{
    public function register( Request $request )
    {

        $this->validate( $request, [
            'name'                      => 'required|unique:general_customers',
            'email'                     => 'required|email|unique:general_customers',
            'password'                  => 'required|min:4|max:40|confirmed',
            'phone'                     => 'required|digits_between:9,12|unique:general_customers',
            'address'                     => 'required',
            'agree_to_terms_conditions' => 'required'
        ]);

        $customer = new GeneralCustomer;
        $user = new User;

        $customer_email = $request->input('email');
        $customer->name = $user->name = $request->input('name');
        if (doesEmailExist($request->vendor_email) == True) {

            Session::flash('message-email-exist', 'This email already in our records, Try Login'); 
            return redirect('register_vendor');
        }else{
             $customer->email = $user->email = $customer_email;
        }
       
        $customer->address = $user->address = $request->input('address');
        $customer->phone = $user->mobile = $request->input('phone');
        $customer->password = $user->password = bcrypt( $request->input('password') );

        $token = session()->getId().time().str_random(10);
        $customer->remember_token = $user->remember_token = $token;

        //Verification Link
        $verification_link = URL::to('/emailVerify/'.$token);

        $mail = new PHPMailer(true);   
        try {

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'senshicodo014@gmail.com';                 // SMTP username
            $mail->Password = 'qgfmpjnhonesdakp';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('senshicodo014@gmail.com', 'Fawaterk');
            $mail->addAddress($customer_email);     // Add a recipient
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Activate your account';
            $mail->Body    = '
                        <h3>Thanks for joining <b>Fawaterk</b></h3>
                        <p>you can activate your account from this link</p>
                        <h5><a href="'.$verification_link.'">Activate Your Account</a></h5>
            ';

            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        Session::flash('message-customer-email-sent', 'Account created successfully, please check your mail for activation link'); 

        $user->username = substr($customer->email, 0, strpos($customer->email, "@"));
        $user->role_id = 3;
        
        $customer->save();
        $user->save();

        return redirect('login');
    }
}
