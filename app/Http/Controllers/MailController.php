<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use App\Invoice;
use Session;
use Mail;
use View;
use URL;

class MailController extends Controller
{
    public function emailInvoice($key)
    {

        $invoice = Invoice::all()->where('invoice_key', $key)->first();

        if($invoice->user){
            $customer_email = $invoice->user->email;
        }else{
            $customer_email = $invoice->customer->email;
        }
                           

        $vendor_name = $invoice->vendor->name;
        $invoice_link = URL::to('/invoice/'.$key);
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
            $mail->Subject = 'You have new invoice from '.$vendor_name;
            $mail->Body    = '<h5>You can check you invoice from this link </h5>'.$invoice_link;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            Invoice::where('invoice_key', $key)->update(['locked' => 1]);
            
            Session::flash('message-email-sent', 'Email is sent successfully'); 
            return redirect('vendor/invoices/filterBy/all');

        } catch (Exception $e) {

            Session::flash('message-email-error', 'Message could not be sent. Try Later'); 
            return redirect('vendor/invoices/filterBy/all');
        }


    }
}
