<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Datatables;
use DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth:adminGuard');
    }

    public function dashboard()
    {
        // return view('admin');
        return view('dashboard.dashboard');
    }
    public function sales()
    {
        // return view('admin');
        return view('adminViews.sales');
    }
    public function purchases()
    {
        // return view('admin');
        return view('adminViews.purchases');
    }
    public function returns()
    {
        // return view('admin');
        return view('adminViews.returns');
    }
    public function physicalCount()
    {
        // return view('admin');
        return view('adminViews.physicalCount');
    }
    public function items()
    {
        // $products = Product::paginate(2);
        return view('items.index');
        // return view('items.index')->with('products',$products);
    }
    public function reports()
    {
        return view('reports.index');

    }
    public function employees(){
        $employees = User::all();

        return view('pages.employees')->with('employees',$employees);
    }

    public function stockAdjustment()
    {
        // return view('admin');
        return view('adminViews.stockAdjustment');
    }


    public function getItemsForSales(){
        $data = DB::table('salable_items')
					->join('products', 'products.product_id' , '=' , 'salable_items.product_id')
					->select('products.product_id', 'description', 'wholesale_price' , 'retail_price' , 'quantity')
					->where('status' , '=' , 'available');

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
			}
			return "successful";
		}else{
			return "unsuccessful";
		}
    }
	 
	 
    public function getDataPoints(){

    }

    public function searchItem($itemName){
        $item = Product::where([['description','LIKE','%'.$itemName.'%'],['status', '=', 'available'],])
                    ->orderBy('description','asc')
                    ->limit(5)
                    ->get();
        return $item;
    }

    public function createPurchases(Request $request){
        
        
        $this->validate($request,[
            'Date' => 'required',
            'Official_Receipt_No' => 'required',
            'Supplier' => 'required',
            'price' => 'required',
            // 'product_id' => 'required',
            'quantity' => 'required',
        ]);
        
        $arrayCount = count($request->product_id);
		$successful = true;
		
		$data = DB::table('purchases')
					->select('po_id')
					->where('po_id' , '=' , $request->Official_Receipt_No)
					->get();
		
        if($data->isEmpty()){
            for($i = 0;$i<$arrayCount;$i++){
                $insert = DB::table('purchases')->insert(
                    ['po_id' => $request->Official_Receipt_No, 'product_id' => $request->product_id[$i], 'supplier_name' => $request->Supplier, 'price' => $request->price[$i],'quantity' => $request->quantity[$i],'created_at' => $request->Date]
                );
            }
            return "successful";
        }else{
            return "unsuccessful";
        }
    }

    
    public function getPurchases(){
        $data = DB::table('purchases')
                    ->select('po_id', 'created_at')
                    ->distinct();
        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "
                <a href = '#purchasesModal' data-toggle='modal' >
                    <button onclick='getItems(this)'class='btn btn-info' ><i class='glyphicon glyphicon-th-list'></i> View</button>
                </a>

                ";


            })
            ->make(true);
    }
	
	public function getPurchaseOrder($purchaseOrderId){
		$data = DB::table('purchases')
					->join('products', 'products.product_id' , '=' , 'purchases.product_id')
					->select('description', 'supplier_name', 'quantity', 'price', 'purchases.created_at')
					->where('po_id', '=', $purchaseOrderId)
					->get();
		return $data;
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
                        ->select('description', 'customer_name', 'quantity', 'price', 'sales.created_at')
                        ->where('or_number', '=', $request->ORNumber)
                        ->get();
        return $data;
        
    }

    public function gerReturnedItems($ORNumber){
        return $ORNumber;
        
    }
    
    public function getReports(){
        $data = DB::table('sales')
					->join('products', 'products.product_id', '=', 'sales.product_id')
					->select('or_number', 'description', 'customer_name', 'quantity', 'price', 'sales.created_at');
        return Datatables::of($data)
            ->make(true);
    }
    public function getStockAdjustment(){
        $data = DB::table('stock_adjustments')
					->join('products', 'products.product_id', '=', 'stock_adjustments.product_id')
					->select('employee_name', 'description', 'quantity', 'stock_adjustments.status', 'stock_adjustments.created_at');
        return Datatables::of($data)
            ->make(true);
    }



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
    public function getItemsForItems(){

        $data = DB::table('products')
					->join('salable_items', 'products.product_id', '=', 'salable_items.product_id')
					->select('description', 'wholesale_price', 'retail_price', 'reorder_level', 'created_at');
        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "
                <a href = '#removeModal' data-toggle='modal' >
                    <button id='$data->product_id' class='btn btn-danger formUpdatechangeStatus'><i class='glyphicon glyphicon-remove'></i> Disable</button>
                </a>
                <a href = '#editModal' data-toggle='modal' >
                    <button class='btn btn-info' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-edit'></i> Edit</button>
                </a>
                <a href = '#viewHistory' data-toggle='modal' >
                    <button class='btn btn-info'><i class='glyphicon glyphicon-th-list'></i> History</button>
                </a>

                ";


            })
            ->make(true);
    }
    public function storeNewItem(Request $request){
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
	public function itemsChangeStatus(Request $request, $id){
		$product = Product::find($id);
		$product->status= $request->input('status');
		$product->save();
		return response($request->all());
	}

    // public function getTransactions(){
    //     $data = DB::table('products')->select('*');
    //     return Datatables::of($data)
    //         ->make(true);
    // }
    // public function getItemsAdded(){
    //     $data = DB::table('products')->select('*');
    //     return Datatables::of($data)
    //         ->make(true);
    // }
    // public function getRemovedItems(){
    //     $data = DB::table('products')->select('*');
    //     return Datatables::of($data)
    //         ->make(true);
    // }

    public function addNewEmployee(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            'address' => 'required'
        ]);

        //Create new Item
        $employee = new User;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contactNumber');
        $employee->address = $request->input('address');
        $employee->password = $request->input('password');
        $employee->save();
        // return response($request->all());

        $results = User::latest('created_at')->first();
        return $results;
        // return DB::table('users')->orderBy('created_at', 'desc')->first();
        

        // return redirect('/admin/employees');
        //    return redirect('/items')->with('success','Success adding item');
    }

    public function updateEmployeeAccount(Request $request, $id){
        // $this->validate($request,[
        //     // 'name' => 'required',
        //     // 'email' => 'required',
        //     // 'password' => 'required',
        // ]);

        $employee = User::find($id);
        // $employee->name = $request->input('name');
        // $employee->email = $request->input('email');
        // $employee->password = $request->input('password');
        $employee->status = $request->input('status');
        $employee->save();
        return response($request->all());
    }
    public function destroyEmployeeAccount($id){
        $employee = User::find($id);
        $employee->delete();
        return redirect('/admin/employees');

    }




}
