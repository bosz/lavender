<?php
namespace App\Http\Middleware\Cart;

use App\Cart;
use App\Support\Facades\Message;

class HasPayment
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if(!$this->cart->hasPayment()){

            Message::setWarning('Payment is required.');

            return redirect()->guest('cart');

        }

        return $next($request);
    }
}