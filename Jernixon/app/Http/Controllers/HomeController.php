<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Datatables;
use DB;

//class SalesAssistantController extends Controller
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:SAGuard');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function items()
    {
        // $products = Product::paginate(2);
        return view('salesAssistantViews.items.index')   ;
        // return view('items.index')->with('products',$products);
    }
    public function return(){
        return view('salesAssistantViews.return');
    }
    public function sales(){
        return view('salesAssistantViews.sales');
    }
    public function stockAdjustment(){
        return view('salesAssistantViews.stockAdjustment');
    }
    public function getDataPoints(){

    }
    public function getItemsForDashboard(){

        //  $data = DB::select("SELECT products.description, products.price as retail_price, purchases.price as wholesale_price, status FROM `products` join `purchases` using(product_id) where status='SALABLE' OR status='DAMAGED-SALABLE'");
        //  while ( $rows = mysqli_fetch_assoc($data)  ) {
        //     $description = $rows['description'];
 
        //     $data1 = DB::select("SELECT products.price as retail_price FROM `products` join `purchases` using(product_id) where description="" AND status='SALABLE'");
        //     $data2 = DB::select("SELECT COUNT(product_id) FROM `products` join `purchases` using(product_id) where description="" AND status='SALABLE'");
        //     $data2 = DB::select("SELECT COUNT(product_id) FROM `products` join `purchases` using(product_id) where description="" AND status='DAMAGED-SALABLE'");
        //  }

        $data = DB::table('products')->select('*');
       // return $data;

        return Datatables::of($data)
             ->addColumn('action',function($data){
                 return "
                 <button class='btn btn-info' onclick='addItemToCart(this)'><i class='glyphicon glyphicon-plus'></i></button></a>";
                    
        
             })
            ->make(true);

    }
    // public function getItemsForItems(){

    //     $data = DB::table('products')->select('*');
    //     return Datatables::of($data)
    //         ->addColumn('action',function($data){
    //             return "<a href = '#addModal' data-toggle='modal'>
    //                 <button id='Add' class='btn btn-success' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-plus-sign'></i> Add</button>
    //             </a>
    //             <a href = '#subtractModal' data-toggle='modal' >
    //                 <button id='Subtract'class='btn btn-danger' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-minus-sign'></i> Subtract</button>
    //             </a>

    //             <a href = '#removeModal' data-toggle='modal' >
    //                 <button id='Remove' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Remove Item</button>
    //             </a>
    //             <a href = '#editModal' data-toggle='modal' >
    //                 <button id='Edit' class='btn btn-info' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-edit'></i>Edit</button>
    //             </a>
                
    //             ";
    
            
    //             })
    //         ->make(true);
    // }
     public function getItemsForItems(){

        $data = DB::table('products')
                    ->join('salable_items', 'products.product_id', '=', 'salable_items.product_id')
                    ->select('status','products.product_id','description', 'retail_price', 'quantity', 'reorder_level');
                    return Datatables::of($data)            
            ->make(true);
    }

    
     public function getItemsForSales(){
        $data = DB::table('salable_items')
                    ->join('products', 'products.product_id' , '=' , 'salable_items.product_id')
                    ->select('products.product_id', 'description', 'retail_price' , 'quantity')
                    ->where('status' , '=' , 'available')->get();

        return Datatables::of($data)
             ->addColumn('action',function($data){
                 return "<button class='btn btn-info' id='$data->product_id' ng-click='addButton(\$event)' onclick='addItemToCart(this)'><i class='glyphicon glyphicon-plus'></i></button>";
             })
            ->make(true);

    }
    
    public function createSales(Request $request){
        $this->validate($request,[
            'customerName' => 'required',
            'receiptNumber' => 'required',
            'quantity' => 'required',
        ]);

        $arrayCount = count($request->productIds);
        $mytime = date('Y-m-d H:i:s');
        $successful = true;
        
        $data = DB::table('sales')
                    ->select('or_number')
                    ->where('or_number' , '=' , $request->receiptNumber)
                    ->get();
        
        if($data->isEmpty()){
            for($i = 0;$i<$arrayCount;$i++){
                $insert = DB::table('sales')->insert(
                    ['or_number' => $request->receiptNumber, 'product_id' => $request->productIds[$i], 'customer_name' => $request->customerName, 'price' => $request->retailPrices[$i],'quantity' => $request->quantity[$i],'created_at' => $mytime,]
                );
                DB::table('salable_items')
                    ->where('product_id', $request->productIds[$i])
                    ->decrement('quantity', $request->quantity[$i]);
            }
            return "successful";
        }else{
            return "unsuccessful";
        }
    }


}
