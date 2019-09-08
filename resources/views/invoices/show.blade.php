@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <div class="panel-title text-center" style="font-weight: bold; font-size: 3rem;">Three Brothers Computer Lab</div>
                    <p align="center" style="font-weight: bold">Satrakanara Bazar, Dist- Barpeta, Assam</p>
                    <p align="center" style="font-weight: bold">Pin- 781308</p>
                    <p style="font-weight: bold; font-size: 1.5rem" >Imran Hossain</p>
                    <p>Mobile: +91-70025-25399</p>
                <div class="pull-right three-button" id="three-button">
                    <a href="{{route('invoices.index')}}" class="btn btn-default back">Back</a>
                    <a href="{{route('invoices.edit', $invoice)}}" class="btn btn-primary edit">Edit</a>
                    <button onClick="window.print()" class="btn btn-info print">Print</button>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <thead style="background-color: #d3d3d3" class="highlighted">
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Grand Total</th>
                    </thead>
                </tr>
                <tr>
                    <td>{{$invoice->invoice_no}}</td>
                    <td>{{$invoice->invoice_date}}</td>
                    <td>₹{{$invoice->grand_total}}</td>
                </tr>
                <tr>
                    <thead style="background-color: #d3d3d3" class="highlighted">
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Contact No</th>
                    </thead>
                </tr>
                <tr>
                    <td>{{$invoice->client}}</td>
                    <td>{{$invoice->client_address}}</td>
                    <td>{{$invoice->contact_no}}</td>
                </tr>
            </table>
        </div>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr style="background-color: #d3d3d3" class="highlighteddescription">
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->products as $product)
                    <tr>
                        <td class="table-name">{{$product->name}}</td>
                        <td class="table-price">₹{{$product->price}}</td>
                        <td class="table-qty">{{$product->qty}}</td>
                        <td class="table-total">₹{{$product->total}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="table-empty" colspan="2"></td>
                    <td class="table-label">Sub Total</td>
                    <td class="table-amount">₹{{$invoice->sub_total}}</td>
                </tr>
                <tr>
                    <td class="table-empty" colspan="2"></td>
                    <td class="table-label">Discount</td>
                    <td class="table-amount">₹{{$invoice->discount}}</td>
                </tr>
                <tr style="background-color: #d3d3d3" class="highlighted">
                    <td class="table-empty" colspan="2"></td>
                    <td class="table-label" style="font-weight: bold;">Grand Total</td>
                    <td class="table-amount" style="font-weight: bold">₹{{$invoice->grand_total}}</td>
                </tr>
            </tfoot>
        </table>
        <div class="panel-footer">
            <div class="row">
                    <span class="pull-right"><p style="font-weight: bold; margin-right:90px; margin-top: 50px"><i>Signature of Proprietor</i></p></span>
            </div>
            
        </div>
    </div>
@endsection