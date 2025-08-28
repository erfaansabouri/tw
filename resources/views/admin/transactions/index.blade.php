@extends('admin.master')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">تراکنش ها</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.transactions.index') }}" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input name="search" type="text" class="form-control"
                                                           placeholder="جستجو..." value="{{ request()->search }}"/>
                                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">اعمال فیلتر</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{ $transactions->withQueryString()->links("pagination::bootstrap-4") }}

                        <table
                            class="table table-bordered table-striped table-responsive-md table-responsive-lg table-responsive-sm">
                            <caption>اشتراک ها</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">شناسه</th>
                                <th class="iransans-web">کاربر</th>
                                <th class="iransans-web">اشتراک</th>
                                <th class="iransans-web">قیمت کل</th>
                                <th class="iransans-web">وضعیت</th>
                                <th class="iransans-web">کد تراکنش</th>
                                <th class="iransans-web">کد پیگیری</th>
                                <th class="iransans-web">کد سفارش</th>
                                <th class="iransans-web">تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="iransans-web">{{ $transaction->id }}</td>
                                    <td class="iransans-web">
                                        {{ $transaction->user->name }}
                                        <br>
                                        <span class="badge badge-secondary">{{ $transaction->user->phone }}</span>
                                    </td>
                                    <td class="iransans-web">{{ @$transaction->plan->title ?? '-' }}</td>
                                    <td class="iransans-web">{{ $transaction->total_price }}</td>
                                    <td class="iransans-web">
                                        @if($transaction->verified_at)
                                            <span class="badge badge-success">تایید شده در تاریخ {{ verta($transaction->verified_at)->formatJalaliDatetime() }}</span>
                                        @else
                                            <span class="badge badge-danger">تایید نشده</span>
                                        @endif
                                    </td>
                                    <td class="iransans-web">{{ $transaction->transaction_id }}</td>
                                    <td class="iransans-web">{{ $transaction->reference_id }}</td>
                                    <td class="iransans-web">{{ $transaction->order_id }}</td>
                                    <td class="iransans-web">{{ verta($transaction->created_at) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{ $transactions->withQueryString()->links("pagination::bootstrap-4") }}

                    <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection

