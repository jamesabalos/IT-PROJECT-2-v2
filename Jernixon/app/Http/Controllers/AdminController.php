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
                 return "<button class='btn btn-info' id='$data->product_id' ng-click='addButton(\$event)' onclick='addItemToCart(this)'><i class='glyphicon glyphicon-plus'></i></button>";
                    
        
             })
            ->make(true);

    }

    public function createSales(Request $request){
        // $data = DB::table('products')->select('*');
         //return $data;
         return response($request->all());
         
            
     }

    public function getDataPoints(){

    }

    public function searchItem($itemName){
    //    $item = Product::find($id);
        // $item = DB::select("SELECT * from products where product_id=$id");
        $item = Product::where('description','LIKE','%'.$itemName.'%')
                    ->orderBy('description','asc')
                    //->paginate(2);
                    ->limit(5)
                    ->get();
        return $item;
    }

    public function getPurchases(){
        $data = DB::table('products')->select('*');
        return Datatables::of($data)
            ->make(true);
    }
    public function createPurchase(Request $request){
       // $data = DB::table('products')->select('*');
        //return $data;
        return response($request->all());
        
           
    }
    
    public function getReturns(){
        $data = DB::table('products')->select('*');
        return Datatables::of($data)
        ->make(true);
    }
    public function createReturnItem(Request $request){
        // $data = DB::table('products')->select('*');
        //return $data;
        return response($request->all());
        
            
    }
    public function getReports(){
        $data = DB::table('products')->select('*');
        return Datatables::of($data)
            ->make(true);
    }
    public function getStockAdjustment(){
        $data = DB::table('products')->select('*');
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

        $data = DB::table('products')->select('*');
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

    public function createStockAdjustment(Request $request){
        // $data = DB::table('products')->select('*');
         //return $data;
         return response($request->all());
         
            
     }




}
