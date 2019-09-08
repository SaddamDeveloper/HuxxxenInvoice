<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use App\InvoiceProduct;
use App\Invoice;
use DB;
class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function create(){
        $sql = DB::table('invoices')->select(DB::raw('max(substring(invoice_no, 12, 10)) as max_val'))->get();
        foreach($sql as $row_data){
            $postfix =  $row_data->max_val;
        }
        $invoice_no = 'TBCL';
        $count = DB::table('invoices')->select(DB::raw('max(substring(invoice_no, 5, 5)) as max_val'))->get()->count();
        $month = date('m');
        $year = date('y');
        if($count == 0){
            $invoice_no = $invoice_no.'/'.$month.'/'.$year.'/00001';
        }
        else{
            $postfix = $postfix + 1;
            $addVal=str_pad($postfix, 5, '0', STR_PAD_LEFT);
            $invoice_no =$invoice_no.'/'.$month.'/'.$year.'/'.$addVal;
        }

        return view('invoices.create', compact('invoice_no'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'invoice_no'    =>  'required|unique:invoices',
            'client'    =>  'required|max:255',
            'client_address'    =>  'required|max:255',
            'invoice_date'  =>  'required|date_format:Y-m-d',
            'discount'  =>  'required|numeric|min:0',
            'products.*.name'   =>  'required|max:255',
            'products.*.price'  => 'required|numeric|min:1',
            'products.*.qty'    =>  'required|integer|min:1'
        ]);

        $products = collect($request->products)->transform(function($product){
            $product['total'] = $product['qty'] * $product['price'];
            return new InvoiceProduct($product);
        });

        if($products->isEmpty()){
            return response()
                ->json([
                    'products_empty'    =>  ['One or more products is required.']
                ], 422);
        }

        $data = $request->except('products');
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $invoice = Invoice::create($data);

        $invoice->products()->saveMany($products);

        return response()->json(['created'   =>  true,'id'    =>  $invoice->id]);
    }

    public function edit($id){
        $invoice = Invoice::with('products')->findOrFail($id);
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, $id){

        $invoice = Invoice::findOrFail($id);
        $this->validate($request, [
            'invoice_no'    =>  'required|unique:invoices,invoice_no,'.$id.',id',
            'client'    =>  'required|max:255',
            'client_address'    =>  'required|max:255',
            'invoice_date'  =>  'required|date_format:Y-m-d',
            'discount'  =>  'required|numeric|min:0',
            'products.*.name'   =>  'required|max:255',
            'products.*.price'  => 'required|numeric|min:1',
            'products.*.qty'    =>  'required|integer|min:1'
        ]);

        $products = collect($request->products)->transform(function($product){
            $product['total'] = $product['qty'] * $product['price'];
            return new InvoiceProduct($product);
        });

        if($products->isEmpty()){
            return response()
                ->json([
                    'products_empty'    =>  ['One or more products is required.']
                ], 422);
        }

        $data = $request->except('products');
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $invoice->update($data);

        //Remove old product and attach new one
        InvoiceProduct::where('invoice_id', $invoice->id)->delete();


        //Update it with new
        $invoice->products()->saveMany($products);

        return response()
            ->json([
                'updated'   =>  true,
                'id'    =>  $invoice->id
            ]);
    }

    public function show($id){
            $invoice = Invoice::with('products')->findOrFail($id);
            return view('invoices.show', compact('invoice'));
    }

    public function destroy($id){
        $invoice = Invoice::findOrFail($id);

        InvoiceProduct::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();
        return redirect()
            ->route('invoices.index');
    }
}
