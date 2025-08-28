<main>
    <section class="paymentSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if($request->Status == 'OK')
                        <div class="succesflPay paymentBox">
                            <h2>پرداخت موفق</h2>
                            <p>
                                شماره پیگیری: {{ @$request->Authority }}
                                <br>
                                شماره سفارش: {{ @$request->orderId }}
                            </p>
                            <a href="{{ route('transaction.sub-success') }}"><button>بازگشت به اپلیکیشن</button></a>
                        </div>
                    @else
                        <div class="failedPay paymentBox">
                            <h2>پرداخت  ناموفق</h2>
                            <p>
                                <br>
                                شماره پیگیری: {{ @$request->Authority }}
                                <br>
                                شماره سفارش: {{ @$request->orderId }}
                                <br>
                            </p>
                            <a href="{{ route('transaction.sub-failed') }}"><button>بازگشت به اپلیکیشن</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="ftrTopSec"></section>
</main>
