@extends('layouts.main')

@section('content')
    <div id="invoice">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="clearfix">
                    <span class="panel-title">
                        Edit Invoice
                        <a href="{{route('invoices.index')}}" class="btn btn-default pull-right">Back</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('invoices.form')
        </div>
        <div class="panel-footer">
            <a href="{{route('invoices.index')}}" class="btn btn-default">Cancel</a>
            <button class="btn btn-success" @click="update" :disabled="isProcessing">UPDATE</button>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/js/vue.min.js')}}"></script>
        <script src="{{asset('public/js/vue-resource.min.js')}}"></script>
        <script type="text/javascript">
            Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
            window._form = {!! $invoice->toJson() !!};
        </script>
        <script src="{{asset('public/invoice/app.js')}}"></script>

    @endpush
@endsection