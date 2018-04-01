<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Salable_item;
use App\Physical_count_item;
use App\Physical_count;
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
        return view('salesAssistantViews.sales');
    }

    public function items()
    {
        // $products = Product::paginate(2);
        return view('salesAssistantViews.items.index')   ;
        // return view('items.index')->with('products',$products);
    }
    public function return(){
        // return view('salesAssistantViews.return');
        return view('salesAssistantViews.returns');
    }
    
    public function searchItem($itemName){
        $item = Product::where([['description','LIKE','%'.$itemName.'%'],['status', '=', 'available'],])
                    ->orderBy('description','asc')
                    ->limit(5)
                    ->get();
        return $item;
    }
    public function getORNumber($ORNumber){
        $data = DB::table('sales')
                    ->select('or_number')
                    ->distinct()
                    ->where('or_number','LIKE','%'.$ORNumber.'%')
                    ->limit(5)
                    ->get();
        return $data;
    }
    public function getORNumberItems(Request $request){
        
        $data = DB::table('sales')
                        ->join('products', 'products.product_id', '=', 'sales.product_id')
                        ->select('sales.product_id','description', 'customer_name', 'quantity', 'price', 'sales.created_at')
                        ->where('or_number', '=', $request->ORNumber)
                        ->get();
        return $data;
        
    }
    public function gerReturnedItems($ORNumber){
		$data = DB::table('returns')
					->join('products', 'products.product_id', '=', 'returns.product_id')
					->select('returns.product_id','description', 'customer_name', 'quantity', 'price', 'quantity', 'returns.created_at')
					->where('or_number', '=', $ORNumber)
					->get();
        return $data;
        
    }
    public function createReturnItem(Request $request){
		$this->validate($request,[
            'officialReceiptNumber' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'customerName' => 'required',
            'quantity' => 'required',
        ]);
		
		$arrayCount = count($request->productId);
		for($i = 0;$i<$arrayCount;$i++){
			$insertReturns = DB::table('returns')->insert(
				['or_number' => $request->officialReceiptNumber, 'product_id' => $request->productId[$i], 'customer_name' => $request->customerName, 'price' => $request->price[$i],'quantity' => $request->quantity[$i]]
			);
			
			DB::table('salable_items')
				->where('product_id', $request->productId[$i])
				->decrement('quantity', $request->quantity[$i]);
			
			$insertDamagedItems = DB::table('damaged_items')->insert(
				['product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'created_at' => date('Y-m-d H:i:s')]
			);
			// DB::table('damaged_items')
				// ->where('product_id', $request->productId[$i])
				// ->increment(['quantity' => $request->quantity[$i]]);
		}

        return $request->all();
        
    }
    public function getReturns(){
        $data = DB::table('returns')
                    ->select('or_number', 'created_at')
                    ->distinct();
        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "
                <a href = '#viewReturn' data-toggle='modal' >
                    <button onclick='getItems(this)' class='btn btn-info' ><i class='glyphicon glyphicon-th-list'></i> View</button>
                </a>

                ";


            })
            ->make(true);
    }

    public function getStockAdjustment(){
        $data = DB::table('stock_adjustments')
					->join('products', 'products.product_id', '=', 'stock_adjustments.product_id')
					->select('employee_name', 'description', 'quantity', 'stock_adjustments.status', 'stock_adjustments.created_at');
        return Datatables::of($data)
            ->make(true);
    }
    public function createStockAdjustment(Request $request){
		$this->validate($request,[
            // 'productId' => 'required',
            'status' => 'required',
            'quantity' => 'required',
            'Date' => 'required'
        ]);
		
		$arrayCount = count($request->productId);
		for($i = 0;$i<$arrayCount;$i++){
			$insertReturns = DB::table('stock_adjustments')->insert(
				['employee_name' => $request->authName, 'product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'status' => $request->status[$i], 'created_at' => $request->Date]
			);
			
			if($request->status == "damaged"){
				$insertDamagedItems = DB::table('damaged_items')->insert(
					['product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'created_at' => $request->Date]
				);
			}else{
				$insertDamagedItems = DB::table('lost_items')->insert(
					['product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'created_at' => $request->Date]
				);
			}
		}
        return $request->all();
    }

    public function physicalCount(){
        $physicalCount = Physical_count::all();
       
        return view('salesAssistantViews.physicalCount')->with('physicalCount',$physicalCount);
    }
    public function getPhysicalCount(){
        $data = DB::table('physical_count_items')
                    ->join('products', 'products.product_id' , '=' , 'physical_count_items.product_id')
                    ->join('salable_items', 'products.product_id' , '=' , 'salable_items.product_id')
					->select('physical_count_items.product_id', 'description', 'salable_items.quantity as quantity' , 'physical_count_items.quantity as counted_quantity')
                    ->where([['status' , '=' , 'available']]);//,['salable_items.quantity', '>', 0]

        return Datatables::of($data)
        ->make(true);
    }
    public function startPhysicalCount(){
        DB::table('physical_counts')
            ->update(['status' => 'active','date' => date('Y-m-d H:i:s')]);
        // $data = DB::table('physical_count')
        //             ->select('status')
        //             ->get();
        return "success";
    }
    public function stopPhysicalCount(){
        DB::table('physical_counts')
            ->update(['status' => 'inactive','date' => date('Y-m-d H:i:s')]);
        // $data = DB::table('physical_count')
        //             ->select('status')
        //             ->get();
        return "success";
    }


    public function sales(){
        return view('salesAssistantViews.sales');
    }
    public function stockAdjustment(){
        // return view('salesAssistantViews.stockAdjustment');
        return view('salesAssistantViews.stockAdjustment');
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
        ->select('products.product_id', 'description', 'wholesale_price' , 'retail_price' , 'quantity')
        ->where([['status' , '=' , 'available'],['quantity', '>', 0]]);

        return Datatables::of($data)
        ->addColumn('action',function($data){
            return "<button class='btn btn-info' id='$data->product_id' ng-click='addButton(\$event)' onclick='addItemToCart(this)'>Add</button>";
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
