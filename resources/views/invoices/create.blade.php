@extends('layouts.main')

@section('content')
    <div id="invoice">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="clearfix">
                    <span class="panel-title">
                        Create Invoice
                        <a href="{{route('invoices.index')}}" class="btn btn-default pull-right">Back</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('invoices.form')
        </div>
        <div class="panel-footer">
            <div class="pull-right mb-10">
                <a href="{{route('invoices.index')}}" class="btn btn-default">Cancel</a>&nbsp;
                <button class="btn btn-success pull-right" @click="create" :disabled="isProcessing">CREATE</button>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/js/vue.min.js')}}"></script>
        <script src="{{asset('public/js/vue-resource.min.js')}}"></script>
        <script type="text/javascript">
            Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
            window._form = {
                invoice_no: `{{$invoice_no}}`,
                client: '',
                client_address: '',
                contact_no: '',
                invoice_date: new Date().toISOString().slice(0,10),
                discount: 0,
                products: [{
                    name: '',
                    price: 0,
                    qty: 1
                }]
            };
        </script>
        <script src="{{asset('public/invoice/app.js')}}"></script>

    @endpush
@endsection