<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Datatables;
use DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(2);
        // return view('items.index')   ;
        return view('items.index')->with('products',$products);
    }

    public function getItems(){

        $data = DB::table('products')->select('*');
        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "<a href = '#addModal' data-toggle='modal'>
                    <button id='Add' class='btn btn-success' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-plus-sign'></i> Add</button>
                </a>
                <a href = '#subtractModal' data-toggle='modal' >
                    <button id='Subtract'class='btn btn-danger' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-minus-sign'></i> Subtract</button>
                </a>

                <a href = '#removeModal' data-toggle='modal' >
                    <button id='Remove' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Remove Item</button>
                </a>
                <a href = '#editModal' data-toggle='modal' >
                    <button id='Edit' class='btn btn-info' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-edit'></i>Edit</button>
                </a>

                ";


            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => 'required',
            'quantityInStock' => 'required',
            'wholeSalePrice' => 'required',
            'retailPrice' => 'required'
        ]);

        //Create new Item
        $item = new Product;
        $item->description = $request->input('description');
        //$item->quantityInStock = $request->input('quantityInStock');
        $item->price = $request->input('wholeSalePrice');
        //$item->retailPrice = $request->input('retailPrice');
        $item->save();
        return response($request->all());
        // return "success";
        // return redirect('/items')->with('success','Success adding item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //    $item = Product::find($id);
        // $item = DB::select("SELECT * from products where product_id=$id");
        $item = Product::where('description','LIKE','%'.$id.'%')
            ->orderBy('description','asc')
            //->paginate(2);
            ->get();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     return "updated successfully";
    // }

    public function addQuantity(Request $request){
        //update purchase set price='$newUnitCost', quantity='$newPurchase' WHERE item_id='$item_id' and price='$oldUnitCost' and quantity='$oldPurchase'"
        //$name = $request->input('user.name'); 
        //dd=(json_decode($request->getContent(), true));
        //$data = $request->json()->all();
        return "pending query...";
        // $item = DB::select("UPDATE product set _='$request->input('inputValue')'");
    }

    public function subtractQuantity(Request $request){
        // $item = DB::select("");        
        return "pending query...";        
    }
    public function returnItem(Request $request){
        $this->validate($request,[
            'customerName' => 'required',
            'itemName' => 'required',
            'quantity' => 'required',
            'totalPrice' => 'required',
            'reason' => 'required',
            'status' => 'required'
        ]);
        // $item = DB::select("");

        return "pending query for return item...";        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DB::select("DELETE from products where product_id=$id"); 
        //"Delete from items where name='$item_name'"       
        //$item = Product::find(6);
        //return \Response::json($item);
        return "success!";
    }
}
