@extends('layouts.frontend_app')

@section('frontend_content')
  <!-- .breadcumb-area start -->
  <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="http://themepresss.com/tf/html/tohoney/checkout">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <p> Name *</p>
                                    <input type="text" value="{{Auth::user()->name}}">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text">
                                </div>
                                <div class="col-6">
                                    <p>Country *</p>

                                    <select id="s_country">
                                                <option value="1">Select a country</option>
                                                <option value="2">bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                </div>
                                <div class="col-6">
                                    <p>city *</p>
                                    <input type="text">
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text">
                                </div>
                                <!-- <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <input type="text">
                                </div> -->
                                <div class="col-12">
                                    <input id="toggle1" type="checkbox">
                                    <label for="toggle1">Pure CSS Accordion</label>
                                    <div class="create-account">
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <span>Account password</span>
                                        <input type="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input id="toggle2" type="checkbox">
                                    <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                    <div class="row" id="open2">
                                    <div class="col-sm-12 col-12">
                                    <p> Name *</p>
                                    <input type="text" value="{{Auth::user()->name}}">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text">
                                </div>
                                <div class="col-6">
                                    <p>Country *</p>

                                    <select id="s_country">
                                                <option value="1">Select a country</option>
                                                <option value="2">bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                </div>
                                <div class="col-6">
                                    <p>city *</p>
                                    <input type="text">
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text">
                                </div>
                                <!-- <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <input type="text">
                                </div> -->
                                <div class="col-12">
                                    <input id="toggle1" type="checkbox">
                                    <label for="toggle1">Pure CSS Accordion</label>
                                    <div class="create-account">
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <span>Account password</span>
                                        <input type="password">
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                        @foreach(cart_items() as $cart_item)
                        <li>{{$cart_item->product->product_name}}* {{$cart_item->product->product_quentity }} <span class="pull-right">${{$cart_item->product->product_price *  $cart_item->product->product_quentity}}</span></li>
                        @endforeach

                            <li>Your Product Name <span class="pull-right">$100.00</span></li>
                            <li>Pure Nature Honey <span class="pull-right">$141.00</span></li>
                            <li>Subtotal <span class="pull-right"><strong>${{session('cart_sub_total')}}</strong></span></li>
                            <li>Discount <span class="pull-right">{{session('discount_amount')}}</span></li>
                            <li>Total<span class="pull-right">${{session('cart_sub_total') - session('discount_amount')}}</span></li>
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input name="payment_option" type="radio">
                                <label for="bank">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input name="payment_option" type="radio">
                                <label for="paypal">Paypal</label>
                            </li>
                            <li>
                                <input name="payment_option" type="radio">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input name="payment_option" type="radio">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button>Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
