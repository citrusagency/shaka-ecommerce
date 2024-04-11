<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webkul\Core\Repositories\SubscribersListRepository;
use Webkul\Shop\Mail\SubscriptionEmail;
use Webkul\Shop\Mail\SubscriptionNotification;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\SubscribersListRepository  $subscriptionRepository
     * @return void
     */
    public function __construct(protected SubscribersListRepository $subscriptionRepository)
    {
        parent::__construct();
    }

    /**
     * Subscribes email to the email subscription list
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe()
    {
        $this->validate(request(), [
            'subscriber_email' => 'email|required',
        ]);

        $email = request()->input('subscriber_email');
        $token = request()->input('token');

        if(isset($token) && $token){
            $customerId = DB::table('customers')
                ->where('token', $token)
                ->value('id');
        }else{
            $token=uniqid();
        }

        $alreadySubscribed = $this->subscriptionRepository->findWhere(['email' => $email]);
        $unique = function () use ($alreadySubscribed) {
            return ! $alreadySubscribed->count();
        };

        if ($unique()) {
            $subscriptionData['email'] = $email;
            $subscriptionData['token'] = $token;

            $mailSent = true;

            try {
                if(!isset($customerId) || !$customerId){
                    Mail::queue(new SubscriptionEmail($subscriptionData));
                }
                Mail::queue(new SubscriptionNotification($subscriptionData));

                session()->flash('success', trans('shop::app.subscription.subscribed'));
            } catch (\Exception $e) {
                report($e);
                session()->flash('error', trans('shop::app.subscription.not-subscribed'));

                $mailSent = false;
            }

            $result = false;

            if ($mailSent) {
                if(isset($customerId)){
                    // for customers that are already in db
                    $result = $this->subscriptionRepository->create([
                        'email'         => $email,
                        'customer_id'   => $customerId,
                        'channel_id'    => core()->getCurrentChannel()->id,
                        'is_subscribed' => 1,
                        'token'         => $token,
                    ]);

                    DB::table('customers')
                        ->where('token', $token)
                        ->update(['subscribed_to_news_letter' => 1]);
                }else{
                    // for guests
                    $result = $this->subscriptionRepository->create([
                        'email'         => $email,
                        'channel_id'    => core()->getCurrentChannel()->id,
                        'is_subscribed' => 1,
                        'token'         => $token,
                    ]);
                }

                if (! $result) {
                    session()->flash('error', trans('shop::app.subscription.not-subscribed'));
                    return redirect()->back();
                }
            }
        } else {
            session()->flash('error', trans('shop::app.subscription.already'));
        }

        return redirect()->back();
    }

    /**
     * To unsubscribe from a the subcription list
     *
     * @param  string  $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe($token)
    {
        $subscriber = $this->subscriptionRepository->findOneByField('token', $token);

        if (isset($subscriber)) {
            if (
                $subscriber->count() > 0
                && $subscriber->is_subscribed
                && $subscriber->update(['is_subscribed' => 0])
            ) {
                DB::table('customers')
                    ->where('token', $subscriber['token'])
                    ->update(['subscribed_to_news_letter' => 0]);

                $subscriber->delete();
                session()->flash('info', trans('shop::app.subscription.unsubscribed'));
            } else {
                session()->flash('info', trans('shop::app.subscription.already-unsub'));
            }
        }

        return redirect()->route('shop.home.index');
    }
}
