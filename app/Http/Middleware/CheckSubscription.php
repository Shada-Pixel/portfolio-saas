<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check() && \Auth::user()->hasRole('super_admin') || ! \Auth::check()) {
            return $next($request);
        }

        $subscription = Subscription::where('status', Subscription::ACTIVE)->where('user_id',
            \Auth::user()->id)->first();

        if (! $subscription) {
            Flash::error('Your 7 days Trail Plan is expired. Please choose a plan to continue the service.');

            return redirect()->route('subscription.pricing.plans.index');
        }

        $now = Carbon::now();
        $endDate = Carbon::parse($subscription->end_date);

        if ($endDate < $now) {
            if ($subscription->subscription_plan_id == null) {
                Flash::error('Your 7 days Trail Plan is expired. Please choose a plan to continue the service.');
            } else {
                Flash::error('Your Current Plan is expired. Please choose a plan to continue the service.');
            }

            return redirect()->route('subscription.pricing.plans.index');
        }

        return $next($request);
    }
}
