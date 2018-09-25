<?php

namespace App\Http\Controllers\Auth;

use App\User;
use URL;
use Mail;
use Auth;
use App\Store;
use Session;
use App\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //Get Vendor Register Page
    public function register_vendor_show()
    {
        return view('auth/register_vendor');
    }


    //Check Vendor Registertion And Create him/her Account
    public function register_vendor_store(Request $request)
    {
        $user = new User;
        $user->name = $request->vendor_name;
        
        //Check if Email Exist in DB
        if (doesEmailExist($request->vendor_email) == True) {

            Session::flash('message-email-exist', 'This email already in our records, Try Login'); 
            return redirect('register_vendor');

        }else{
            $vendor_email = $request->vendor_email;
            $user->email = $vendor_email;
            //Get the username before the '@' symbol
            $user->username = substr($request->vendor_email, 0, strpos($request->vendor_email, "@"));
        }


        //Check if Phone Number Exist in DB
        if (doesPhoneNumberExist($user->mobile = $request->vendor_phone) == True) {

            Session::flash('message-phone-exist', 'This Phone Number already in our records, Try Login'); 
            return redirect('register_vendor');

        }else{
            $user->mobile = $request->vendor_phone;
        }

        $user->password = bcrypt($request->vendor_password);
        $user->address = $request->vendor_address;  
        $user->role_id = 1;
        $user->bank_name = $request->vendor_bank_name;

        $token = session()->getId().time().str_random(10);
        $user->remember_token = $token;
        $user->save();

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
            $mail->addAddress($vendor_email);     // Add a recipient
        
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

        Session::flash('message', 'Account created successfully, please check your mail for activation link'); 
        return redirect('login');
    }


    public function VerifyEmail($token)
    {
        $user = User::where('remember_token', $token)->where('last_login', null)->where('active', 0)->first();
        if ($user != '') {
            $user->active = 1;
            $user->save();
            Session::flash('message-account-activated', 'Account is activated, Login now'); 
            return redirect('login');
        }else{
            return view('404');
        }
    }
}

