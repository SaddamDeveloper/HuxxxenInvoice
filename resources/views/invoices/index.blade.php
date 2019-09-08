@extends('layouts.main')

    @section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="clearfix">
                    <span class="panel-title">
                        <strong class="text-info">Huxxxen Invoice 1.0</strong>
                    </span>
                    <a href="{{route('invoices.create')}}" class="btn btn-success pull-right">Create</a>
                </div>
            </div>
            <div class="panel-body">
                @if($invoices->count())
                    <table class="table table-striped">
                        <thead>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Client</th>
                            <th>Contact No</th>
                            <th>Grand Total</th>
                            <th colspan="2">Created At</th>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                           <tr>
                               <td>{{$invoice->invoice_no}}</td>
                               <td>{{$invoice->invoice_date}}</td>
                               <td>{{$invoice->client}}</td>
                               <td>{{$invoice->contact_no}}</td>
                               <td>{{$invoice->grand_total}}</td>
                               <td>{{$invoice->created_at->diffForHumans()}}</td>
                               <td class="form-inline">
                                   <a href="{{route('invoices.edit', $invoice)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                   <a href="{{route('invoices.show', $invoice)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                   <form class="form-inline" action="{{route('invoices.destroy', $invoice)}}" method="post" onsubmit="return confirm('Are you sure?')">
                                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                                       <input type="hidden" name="_method" value="delete">
                                       <input type="submit" value="Del" class="btn btn-danger btn-sm">
                                   </form>
                               </td>
                           </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                <div class="invoice-empty">
                    <p class="invoice-empty-title">
                        No invoices were created.
                        <a href="{{route('invoices.create')}}">Create Now</a>
                    </p>
                </div>
                @endif
            </div>
        </div>
    @endsection