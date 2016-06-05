<?php namespace somosAula\Http\Controllers;
use somosAula\Http\Requests\ContactFormRequest;

class AboutController extends Controller {

    public function create()
    {
        return view('about.contact');
    }

    public function store(ContactFormRequest $request)
    {

        \Mail::send('emails.contact',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'tema' => $request->get('tema'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('bj.devreugd@gmail.com');
                $message->to('bj.devreugd@gmail.com', 'Admin')->subject('SomosAula Feedback');
            });

        return \Redirect::route('contact')->with('message', 'Gracias por contactar con nosotros!');

    }

}