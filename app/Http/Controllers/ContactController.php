<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsEmail;
use App\Models\Blog;
use App\Models\ContactEmail;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Contact Us',
            'name' => '',
            'email' => '',
            'phone' => '',
            'subject' => '',
            'message' => '',
        ];
        return view('contact')->with($data);
    }

    public function submit(Request $request)
    {
        $error = '';

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');


        $rules = [
            'name' => ['bail', 'required', 'min:2', 'max:30'],
            'email' => ['bail', 'required', 'email', 'min:5', 'max:50'],
            'phone' => ['bail', 'required', 'min:7', 'max:15'],
            'subject' => ['bail', 'required', 'min:3', 'max:50'],
            'message' => ['bail', 'required', 'min:10', 'max:1000'],
        ];

        if (!$request->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
        ];

        if (empty($error)) {
            $contact_email = new ContactEmail();
            $contact_email->name = $name;
            $contact_email->email = $email;
            $contact_email->phone = $phone;
            $contact_email->subject = $subject;
            $contact_email->message = $message;
            $contact_email->save();

//            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactUsEmail($data));
            return redirect('contact')->withErrors(["success" => __('text.Your message has been sent successfully!')]);
        } else {
            return redirect('contact')->with($data);
        }
    }
}
