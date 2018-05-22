<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Salable_item;
use App\Physical_count_item;
use App\Physical_count;
use Datatables;
use DB;
use Hash;
use App\Notifications\ReorderNotification;
use App\Notifications\StockAdjustmentNotification;
use App\Admin;


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
        // return view('salesAssistantViews.returns');
        $physicalCount = Physical_count::all();
        if($physicalCount[0]["status"] === "inactive"){
            return view('salesAssistantViews.returns')->with('physicalCount',$physicalCount);
        }else{
            // return view('salesAssistantViews.physicalCount')->with('physicalCount',$physicalCount);
            return redirect('salesAssistant/physicalCount')->with('physicalCount',$physicalCount);
        }
    }

    public function searchItem($itemName){
        // $item = Product::where([['description','LIKE','%'.$itemName.'%'],['status', '=', 'available'],])
        //     ->orderBy('description','asc')
        //     ->limit(5)
        //     ->get();
        // return $item;
        $items = DB::table('products')
        ->join('salable_items', 'products.product_id' , '=' , 'salable_items.product_id')        
        ->select('salable_items.created_at', 'products.description', 'products.product_id', 'reorder_level', 'status','salable_items.quantity','salable_items.retail_price')
        ->where([['description','LIKE','%'.$itemName.'%'],['status', '=', 'available'],])
        ->orderBy('description','asc')  
        ->limit(5)              
        ->get();
        return $items; 
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
    public function createReturnsFilter(Request $request){
        $data = DB::table('returns')
        ->select('or_number', 'created_at')
        ->where('returns.created_at','>',$request->dateFrom)
        ->where('returns.created_at','<',$request->dateTo)
        ->orderBy('created_at', 'desc')
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
    public function createStockAdjustmentFilter(Request $request){
        $data = DB::table('stock_adjustments')
        ->join('products', 'products.product_id', '=', 'stock_adjustments.product_id')
        ->select('employee_name', 'description', 'quantity', 'stock_adjustments.status', 'stock_adjustments.created_at')
        ->where('stock_adjustments.created_at','>',$request->dateFrom)
        ->where('stock_adjustments.created_at','<',$request->dateTo);
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
           if($request->status[$i] == "damaged"){
                $insertStockAdjustments = DB::table('stock_adjustments')->insertGetId(
                    ['employee_name' => $request->authName, 'product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'status' => "damaged", 'created_at' => $request->Date]
                );

                $data = DB::table('stock_adjustments')
                    ->select('stock_adjustments_id')
                    ->latest()
                    ->first();

                $insertDamagedItems = DB::table('damaged_items')->insert(
                    ['stock_adjustments_id' => $data->stock_adjustments_id, 'product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'created_at' => $request->Date]);
                    
                    DB::table('salable_items')
                        ->where('product_id', $request->productId[$i])
                        ->decrement('quantity', $request->quantity[$i]);
            }else{
                $insertStockAdjustments = DB::table('stock_adjustments')->insertGetId(
                    ['employee_name' => $request->authName, 'product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'status' => "lost", 'created_at' => $request->Date]
                );

                $data = DB::table('stock_adjustments')
                    ->select('stock_adjustments_id')
                    ->latest()
                    ->first();

                $insertLostItems = DB::table('lost_items')->insert(
                    ['stock_adjustments_id' => $data->stock_adjustments_id, 'product_id' => $request->productId[$i], 'quantity' => $request->quantity[$i], 'created_at' => $request->Date]);
                    DB::table('salable_items')
                        ->where('product_id', $request->productId[$i])
                        ->decrement('quantity', $request->quantity[$i]);
            }
            $admin = Admin::all();
            foreach($admin as $admins){
                $admins->notify(new StockAdjustmentNotification($request->itemName[$i],$request->quantity[$i],$request->status[$i],$request->authName));
            }
        }
        return $request->all();
    }

    public function physicalCount(){
        $physicalCount = Physical_count::all();
        if($physicalCount[0]["status"] === "inactive"){
            //return view('salesAssistantViews.sales')->with('physicalCount',$physicalCount);
            return redirect('salesAssistant/sales');
        }else{
            return view('salesAssistantViews.physicalCount')->with('physicalCount',$physicalCount);
        }
    }
    public function getPhysicalCount(){
        $data = DB::table('physical_count_items')
            ->join('products', 'products.product_id' , '=' , 'physical_count_items.product_id')
            ->join('salable_items', 'products.product_id' , '=' , 'salable_items.product_id')
            ->select('physical_count_items.product_id', 'description', 'salable_items.quantity as quantity' , 'physical_count_items.quantity as counted_quantity')
            ->where([['status' , '=' , 'available']]);//,['salable_items.quantity', '>', 0]

        return Datatables::of($data)
            ->addColumn('action',function($data){
                // return "<button class='btn btn-info' id='$data->product_id' ng-click='addButton(\$event)' onclick='addItemToCart(this)'>Add</button>";
                return "<input type='number' class='form-control' value='0' name='quantity[]' min='0'>
            <input type='hidden' value='$data->product_id' class='form-control' name='productId[]'>";
            })
            ->make(true);
    }
    public function submitPhysicalCount(Request $request){

        $arrayCount = count($request->productId);
        for($i = 0;$i<$arrayCount;$i++){
            DB::table('physical_count_items')
                ->where('product_id', $request->productId[$i])
                ->update(['quantity' => $request->quantity[$i]]);
        }
        // return $request->all();
        DB::table('physical_counts')
            ->where('status', 'active')
            ->update(['status' => 'inactive','date' => date('Y-m-d H:i:s')]);
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
        // return view('salesAssistantViews.sales');
        $physicalCount = Physical_count::all();
        if($physicalCount[0]["status"] === "inactive"){
            return view('salesAssistantViews.sales')->with('physicalCount',$physicalCount);
        }else{
            // return view('salesAssistantViews.physicalCount')->with('physicalCount',$physicalCount);
            return redirect('salesAssistant/physicalCount')->with('physicalCount',$physicalCount);
        }
    }
    public function stockAdjustment(){
        // return view('salesAssistantViews.stockAdjustment');
        $physicalCount = Physical_count::all();
        if($physicalCount[0]["status"] === "inactive"){
            return view('salesAssistantViews.stockAdjustment')->with('physicalCount',$physicalCount);
        }else{
            // return view('salesAssistantViews.physicalCount')->with('physicalCount',$physicalCount);
            return redirect('salesAssistant/physicalCount')->with('physicalCount',$physicalCount);
        }
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

                $da= DB::table('products')->join('salable_items','products.product_id','=','salable_items.product_id')->select('description','quantity')->where([['status','=','available'],['products.product_id','=', $request->productIds[$i]],])->whereColumn('quantity','<=','reorder_level')->first();
                
                if(!empty($da)){
                    $admin = Admin::all();
                    foreach($admin as $admins){
                        $admins->notify(new ReorderNotification($da));
                    };   

                    $sales = User::all();
                    foreach($sales as $salesassistant){
                        $salesassistant->notify(new ReorderNotification($da));
                    };  

                }
            }
                
            return "successful";
        }else{
            return "unsuccessful";
        }
    }
    public function changePassword(Request $request){
        $this->validate($request,[
            'Current_Password' => 'required',
            'Email' => 'required',
            'New_Password' => 'required',
            'Confirm_Password' => 'required',
        ]);
        // return $request->all();
        $employee = User::find($request->adminId);
        // $password = Hash::make($request->New_Password);
        if($request->Email===$employee->email && $request->New_Password===$request->Confirm_Password && Hash::check($request->Current_Password, $employee->password)){
            $employee->password = $request->New_Password;
            $employee->save();
            return "successful";
        }else{
            return "unsuccessful";
        }


    }
    public function validateDateRange(Request $request){
        $this->validate($request,[
            'dateFrom' => 'required',
            'dateTo' => 'required',
        ]);

        if($request->dateFrom > $request->dateTo){
            return response()->json([
                'errors' => ['The date range must be correct.']
            ],422);
        }

        return $request->all();

    }
    public function getNotification(){
        $data = [];
        $products = DB::table('products')
            ->select('product_id','reorder_level')
            ->where('status', '=', 'available')
            ->get();

        $arrayCount = count($products);

        for($i = 0;$i<$arrayCount;$i++){

            $sales = DB::table('salable_items')
                ->join('products', 'products.product_id' , '=' , 'salable_items.product_id')
                ->select('products.product_id as product_id', 'description', 'salable_items.quantity as quantity')
                ->where('products.product_id' , '=' , $products[$i]->product_id)
                ->where('salable_items.quantity', '<', $products[$i]->reorder_level)
                // ->where('salable_items.created_at','>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
                // ->where('salable_items.created_at','<=', DB::raw('NOW()'))
                ->first();
                // ->get();

            // $arrayCount1 = count($sales);
            // for($i = 0;$i<$arrayCount1;$i++){
            if($sales){
                array_push($data, ["reorder", $sales->product_id, $sales->description, $sales->quantity, 'date'=>date('Y-m-d H:i:s')]);
            }
            // }

        }
        $stockAdjustment = DB::table('stock_adjustments')
            ->join('products', 'products.product_id' , '=' , 'stock_adjustments.product_id')
            ->select('products.product_id as product_id', 'description', 'stock_adjustments.quantity as quantity', 'stock_adjustments.created_at as date', 'stock_adjustments.status as status', 'stock_adjustments.employee_name as name','notif_status')
			->where('notif_status','=','not_yet_read')
            ->where('stock_adjustments.created_at','>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
            ->where('stock_adjustments.created_at','<=', DB::raw('NOW()'))
            ->get();

        $arrayCount2 = count($stockAdjustment);
        for($i = 0;$i<$arrayCount2;$i++){
            array_push($data, ["stock_adjustment", $stockAdjustment[$i]->product_id, $stockAdjustment[$i]->description, $stockAdjustment[$i]->quantity, 'date'=>$stockAdjustment[$i]->date,  $stockAdjustment[$i]->status, $stockAdjustment[$i]->name, $stockAdjustment[$i]->notif_status]);
        }


        foreach ($data as $key => $row){
            $date[$key] = $row['date'];
            // $edition[$key] = $row['edition'];
        }
        array_multisort($date, SORT_DESC, $data);
        return $data;
    }


}
