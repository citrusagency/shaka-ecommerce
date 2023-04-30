<?php

namespace RKREZA\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use RKREZA\Contact\Mail\ContactEmail;
use RKREZA\Contact\Repositories\ContactRepository as Contact;

class ContactController extends Controller
{

    protected $_config;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact              = $contact;
        $this->_config              = request('_config');
    }


    public function show()
    {
        return view($this->_config['view']);
    }


    public function index()
    {
        $contact        = $this->contact->all();
        return view($this->_config['view'], compact('contact'));
    }


    public function view($id)
    {

        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'], compact('contact'));
    }


    public function destroy($id=null)
    {

        $contact = $this->contact->findorFail($id);

        try {
            $this->contact->delete($id);

            session()->flash('success', trans('contact_lang::app.response.delete-success', ['name' => 'Message']));

        } catch(\Exception $e) {
            session()->flash('error', trans('contact_lang::app.response.delete-failed', ['name' => 'Message']));
        }


        return response()->json(['message' => false], 400);

    }




    // Shop Section
    public function sendMessage()
    {
        $this->validate(request(), [
            'name'              => 'required',
            'email'             => 'required',
            'message_body'      => 'required',
            'message_title'      => 'required'
        ]);

        $data = request()->all();



        try {
            $contact = $this->contact->create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'message_body'  => $data['message_body'],
                'message_title'  => $data['message_title'],
            ]);

            if ($contact) {
                session()->flash('success', trans('contact_lang::app.response.message-send-success'));
                // Send email to customer
                try {
                    Mail::queue(new ContactEmail($data));
                } catch(\Exception $e) {
                    \Log::error(
                        'prepareMail' . $e->getMessage()
                    );
                }
                return redirect()->route($this->_config['redirect']);
            }
        }catch (\Exception $e) {

        }


    }




}
