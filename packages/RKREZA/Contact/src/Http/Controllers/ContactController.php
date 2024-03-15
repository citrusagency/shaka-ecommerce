<?php

namespace RKREZA\Contact\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RKREZA\Contact\Mail\ContactEmail;
use RKREZA\Contact\Repositories\ContactRepository as Contact;
use Webkul\Rule\Helpers\Validator;

class ContactController extends Controller
{

    protected $_config;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->_config = request('_config');
    }


    public function show()
    {
        return view($this->_config['view']);
    }


    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contact = $this->contact->all();
        return view($this->_config['view'], compact('contact'));
    }


    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'], compact('contact'));
    }


    public function destroy($id = null)
    {

        $contact = $this->contact->findorFail($id);

        try {
            $this->contact->delete($id);

            session()->flash('success', trans('contact_lang::app.response.delete-success', ['name' => 'Message']));

        } catch (\Exception $e) {
            session()->flash('error', trans('contact_lang::app.response.delete-failed', ['name' => 'Message']));
        }


        return response()->json(['message' => false], 400);

    }

    // Shop Section
    public function sendMessage()
    {

        $data = request()->all();
        dd($data);
        try {
            $contact = $this->contact->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'message_body' => $data['message_body'],
                'message_title' => $data['message_title'],
            ]);

            if ($contact) {
                session()->flash('success', trans('contact_lang::app.response.message-send-success'));
                try {
                    Mail::queue(new ContactEmail($data));
                } catch (\Exception $e) {
                    \Log::error(
                        'prepareMail' . $e->getMessage()
                    );
                }
                return redirect()->route($this->_config['redirect']);
            }
        } catch (\Exception $e) {

        }
    }
}