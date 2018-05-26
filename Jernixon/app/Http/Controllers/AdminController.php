<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Admin;
use App\Salable_item;
use App\Physical_count_item;
use App\Physical_count;
use Datatables;
use DB;
use Hash;
use App\Notifications\ReorderNotification;
use App\Notifications\StockAdjustmentNotification;
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

        $item = DB::table('products')->join('salable_items','products.product_id','=','salable_items.product_id')->select('description','quantity')->where('status','=','available')->whereColumn('quantity','<=','reorder_level')->get();
        return view('dashboard.dashboard')->with('item',$item);
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
        $physicalCount = Physical_count::all();

        return view('adminViews.physicalCount')->with('physicalCount',$physicalCount);
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

    public function createFastMovingItems(Request $request){
		
		// $data = DB::table('sales')
            // ->join('products', 'products.product_id', '=', 'sales.product_id')
            // ->selectRaw('description, SUM(quantity)')
            // ->where('sales.created_at','>',$request->dateFrom)
            // ->where('sales.created_at','<',$request->dateTo)
			// ->groupBy('sales.product_id')
			// ->orderBy('sales.quantity','desc')
			// ->limit(10)
			// ->get();
			
		$data = DB::select( DB::raw("SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) WHERE sales.created_at > '$request->dateFrom' AND sales.created_at < '$request->dateTo' group by product_id order by quantity desc limit 10"));
		
         return $data;   
         // return Datatables::of($data)
            // ->make(true);
    }
    public function createSlowMovingItems(Request $request){
        $data = DB::select( DB::raw("SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) WHERE sales.created_at > '$request->dateFrom' AND sales.created_at < '$request->dateTo' group by product_id order by quantity asc limit 10"));
		
        return $data;
       
    }
    public function getItemsForSales(){
        $data = DB::table('salable_items')
            ->join('products', 'products.product_id' , '=' , 'salable_items.product_id')
            ->select('products.product_id', 'description', 'wholesale_price' , 'retail_price' , 'quantity')
            ->where([['status' , '=' , 'available'],['quantity', '>', 0]]);

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "<button class='btn btn-info' id='$data->product_id' ng-click='addButton(\$event)' onclick='addItemToCart(this)'><i class = 'fa fa-plus'></i>Add</button>";
            })
            ->make(true);

    }
    public function getDamagedForSales(){
        $data = DB::table('damaged_salable_items')
            ->join('products', 'products.product_id' , '=' , 'damaged_salable_items.product_id')
            ->join('salable_items', 'salable_items.product_id' , '=' , 'damaged_salable_items.product_id')
            ->select('products.product_id', 'description', 'wholesale_price' , 'damaged_selling_price' , 'damaged_salable_items.quantity')
            ->where([['status' , '=' , 'available'],['damaged_salable_items.quantity', '>', 0]]);

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return "<button class='btn btn-info' id='".$data->product_id."_damaged' data-status='damaged' ng-click='addButton(\$event)' onclick='addItemToCart(this)'><i class = 'fa fa-plus'></i>Add</button>";
            })
            ->make(true);

    }

    public function createSales(Request $request){
        $this->validate($request,[
            'customerName' => 'required',
            'receiptNumber' => 'required',
            'quantity' => 'required',
            'Date' => 'required',
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
                    ['or_number' => $request->receiptNumber, 'product_id' => $request->productIds[$i], 'customer_name' => $request->customerName, 'price' => $request->retailPrices[$i],'quantity' => $request->quantity[$i],'created_at' => $request->Date]
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

    public function createPurchases(Request $request){


        $this->validate($request,[
            'Date' => 'required',
            'Official_Receipt_Number' => 'required',
            'Supplier' => 'required',
            'price' => 'required',
            // 'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $arrayCount = count($request->product_id);
        $successful = true;

        $data = DB::table('purchases')
            ->select('po_id')
            ->where('po_id' , '=' , $request->Official_Receipt_Number)
            ->get();

        if($data->isEmpty()){
            for($i = 0;$i<$arrayCount;$i++){
                $insertPurchases = DB::table('purchases')->insert(
                    ['po_id' => $request->Official_Receipt_Number, 'product_id' => $request->product_id[$i], 'supplier_name' => $request->Supplier, 'price' => $request->price[$i],'quantity' => $request->quantity[$i],'created_at' => $request->Date]
                );

                $prod_id = DB::table('salable_items')
                    ->select('product_id')
                    ->where('product_id' , '=' , $request->product_id[$i])
                    ->get();

                if($prod_id->isEmpty()){
                    $insertSalableItems = DB::table('salable_items')->insert(
                        ['product_id' => $request->product_id[$i], 'wholesale_price' => $request->price[$i], 'retail_price' => $request->price[$i], 'quantity' => $request->quantity[$i]]
                    );
                }else{
                    $price = DB::table('purchases')
                        ->select('price')
                        ->where([['product_id' , '=' , $request->product_id[$i]], ['po_id' , '=',  $request->Official_Receipt_Number]])
                        ->latest()
                        ->first();

                    $newPrice = $price->price;

                    DB::table('salable_items')
                        ->where('product_id', $request->product_id[$i])
                        ->increment('quantity', $request->quantity[$i]);

                    DB::table('salable_items')
                        ->where('product_id', $request->product_id[$i])
                        ->update(['wholesale_price' => $newPrice, 'retail_price' => $newPrice]);
                }

            }
            return "successful";
        }else{
            return "unsuccessful";
        }
    }
public function createPurchasesFilter(Request $request){
    $data = DB::table('purchases')
            ->select('po_id', 'created_at')
            ->where('created_at','>',$request->dateFrom)
            ->where('created_at','<',$request->dateTo)
            ->orderBy('created_at', 'desc')
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

    public function getPurchases(){
        $data = DB::table('purchases')
            ->select('po_id', 'created_at')
            ->orderBy('created_at', 'desc')
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
    public function getORNumber($ORNumber){
        $data = DB::table('sales')
            ->select('or_number')
            ->distinct()
            ->where('or_number','LIKE','%'.$ORNumber.'%')
            ->where('created_at','>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))
            ->where('created_at','<=', DB::raw('NOW()'))
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

    public function gerReturnedItems(Request $request){

        $data = DB::table('returns')
            ->join('products', 'products.product_id', '=', 'returns.product_id')
            ->select('returns.product_id','description', 'customer_name', 'quantity', 'price', 'quantity', 'returns.created_at')
            ->where('or_number', '=',$request->ORNumber)
            ->where('returns.created_at', '=',$request->Date)
            ->get();
        return $data;

    }
    public function createReturnItem(Request $request){
        $this->validate($request,[
            'officialReceiptNumber' => 'required',
            'price' => 'required',
            'exchangeQuantity' => 'required',
            'customerName' => 'required',
            'Date' => 'required'
        ]);

        $arrayCount = count($request->productId);
        for($i = 0;$i<$arrayCount;$i++){
            $insertReturns = DB::table('returns')->insert(
                ['or_number' => $request->officialReceiptNumber, 'product_id' => $request->productId[$i], 'customer_name' => $request->customerName, 'price' => $request->price[$i],'quantity' => $request->exchangeQuantity[$i]]
            );

            DB::table('salable_items')
                ->where('product_id', $request->productId[$i])
                ->decrement('quantity', $request->exchangeQuantity[$i]);

            $insertDamagedItems = DB::table('damaged_items')->insert(
                ['product_id' => $request->productId[$i], 'quantity' => $request->exchangeQuantity[$i], 'created_at' => date('Y-m-d H:i:s')]
            );
            // DB::table('damaged_items')
            // ->where('product_id', $request->productId[$i])
            // ->increment(['quantity' => $request->quantity[$i]]);
        }

        return $request->all();

    }
    public function createRefund(Request $request){
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

    public function getReports(){
        $data = DB::table('sales')
            ->join('products', 'products.product_id', '=', 'sales.product_id')
            ->select('or_number', 'description', 'customer_name', 'quantity', 'price', 'sales.created_at');
        return Datatables::of($data)
            ->make(true);
    }
    public function getDamagedItems(){
		$data = DB::table('damaged_items')
            ->join('products', 'products.product_id', '=', 'damaged_items.product_id')
            ->select('description', 'quantity', 'damaged_items.created_at');
        return Datatables::of($data)
            ->make(true);
    }
    public function getLostItems(){
		$data = DB::table('lost_items')
            ->join('products', 'products.product_id', '=', 'lost_items.product_id')
            ->select('description', 'quantity', 'lost_items.created_at');
        return Datatables::of($data)
            ->make(true);
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
    public function createReportSoldItems(Request $request){
  
        $data = DB::table('sales')
            ->join('products', 'products.product_id', '=', 'sales.product_id')
            ->select('or_number', 'description', 'customer_name', 'quantity', 'price', 'sales.created_at')
            ->where('sales.created_at','>',$request->dateFrom)
            ->where('sales.created_at','<',$request->dateTo);
            // ->whereBetween('quantity',[$request->dateFrom, $request->dateTo]);
            
        return Datatables::of($data)
            ->make(true);
    }
    public function createReportDamagedItems(Request $request){
        $data = DB::table('damaged_items')
        ->join('products', 'products.product_id', '=', 'damaged_items.product_id')
        ->select('description', 'quantity', 'damaged_items.created_at')
        ->where('damaged_items.created_at','>',$request->dateFrom)
        ->where('damaged_items.created_at','<',$request->dateTo);
    return Datatables::of($data)
        ->make(true);
    }
    public function createReportLostItems(Request $request){
        $data = DB::table('lost_items')
        ->join('products', 'products.product_id', '=', 'lost_items.product_id')
        ->select('description', 'quantity', 'lost_items.created_at')
        ->where('lost_items.created_at','>',$request->dateFrom)
        ->where('lost_items.created_at','<',$request->dateTo);
    return Datatables::of($data)
        ->make(true);
    }

    public function getStockAdjustment(){
        $data = DB::table('stock_adjustments')
            ->join('products', 'products.product_id', '=', 'stock_adjustments.product_id')
            ->select('employee_name', 'description', 'quantity', 'stock_adjustments.status', 'stock_adjustments.created_at')
            ->latest();
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

    public function getItemsForItems(){

        $data = DB::table('products')
            ->join('salable_items', 'products.product_id', '=', 'salable_items.product_id')
            ->select('status','products.product_id','description', 'wholesale_price', 'retail_price', 'quantity', 'reorder_level', 'products.created_at', 'products.updated_at');
        // ->where('status','=','available');
        // $string = "";
        // if(true){

        // }
        return Datatables::of($data)
            ->addColumn('action',function($data){
                $buttons = "<a href = '#editModal' data-toggle='modal' >
                        <button class='btn btn-info' onclick='insertDataToModal(this)'><i class='glyphicon glyphicon-edit'></i> Edit</button>
                    </a>
                    <a href = '#viewHistory' data-toggle='modal' >
                        <button onclick='viewItemHistory(this)' class='btn btn-info'><i class='fa fa-history'></i> History</button>
                    </a>";
                if($data->status === "available"){
                    return $buttons."<button id='$data->product_id' onclick='checkItemQuantity(this)' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i>Disable</button>";
                }else{
                    return $buttons."<button id='$data->product_id' onclick='checkItemQuantity(this)' class='btn btn-success'><i class='glyphicon glyphicon-ok'></i>Enable</button>";
                }
                // return "    
                //     <button id='$data->product_id' class='btn btn-danger formUpdatechangeStatus'><i class='glyphicon glyphicon-remove'></i>$data->status</button>
                // ";



            })
            ->make(true);
    }
    public function storeNewItem(Request $request){
        $this->validate($request,[
            'description' => 'required',
            'reorderLevel' => 'required',
            // 'wholeSalePrice' => 'required',
            // 'retailPrice' => 'required'
        ]);


        //Create new Item Products Table
        $item = new Product;
        $item->description = $request->input('description');
        //$item->quantityInStock = $request->input('quantityInStock');
        $item->reorder_level = $request->input('reorderLevel');
        //$item->retailPrice = $request->input('retailPrice');
        $item->save();

        $prod_id = DB::table('products')
            ->select('product_id')
            ->orderBy('product_id', 'desc')
            ->first();

        //Create new Item Salable_items Table
        $item_salable = new Salable_item;
        $item_salable->product_id = $prod_id->product_id;
        //$item->quantityInStock = $request->input('quantityInStock');
        $item_salable->quantity = 0;
        $item_salable->wholesale_price = 0.00;
        $item_salable->retail_price = 0.00;
        //$item->retailPrice = $request->input('retailPrice');
        $item_salable->save();
        // return response($request->all());

        $insert = DB::table('physical_count_items')
            ->insertGetId(['product_id' => $prod_id->product_id, 'quantity' => 0]);
        //Create new Item Salable_items Table
        // $physical_count = new Physical_count_item;
        // $physical_count->product_id = $prod_id->product_id;
        //$item->quantityInStock = $request->input('quantityInStock');
        // $physical_count->quantity = 0;
        //$item->retailPrice = $request->input('retailPrice');
        // $physical_count->save();
        return response($request->all());
        // return "success";
        // return redirect('/items')->with('success','Success adding item');
    }
    public function editItem(Request $request){
        $this->validate($request,[
            'description' => 'required',
            'reOrder_Level' => 'required',
            'retailPrice' => 'required'
        ]);
        DB::table('products')
            ->where('product_id', $request->productId)
            ->update(['description' => $request->description,'reorder_level' => $request->reOrder_Level,'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('salable_items')
            ->where('product_id', $request->productId)
            ->update(['retail_price' => $request->retailPrice,'updated_at' => date('Y-m-d H:i:s')]);
        return "successful";

    }
    public function updateItemStatus(Request $request){
        if($request->status == "available"){
            DB::table('products')
                ->where('product_id', $request->itemId)
                ->update(['status' => 'unavailable']);
        }else{
            DB::table('products')
                ->where('product_id', $request->itemId)
                ->update(['status' => 'available']);
        }
        return $request->all();
    }
    public function viewItemHistory($id){
        $data = [];
        $sales = DB::table('sales')
            ->join('products', 'products.product_id' , '=' , 'sales.product_id')
            ->select('products.product_id as product_id', 'description', 'sales.quantity as quantity', 'customer_name', 'sales.created_at as date', 'price')
            ->where('sales.product_id', '=', $id)
            ->get();

        $arrayCount1 = count($sales);
        for($i = 0;$i<$arrayCount1;$i++){
            // array_push($data, [$sales[$i]->customer_name]);
            array_push($data, ["Deducted", "bought", $sales[$i]->description, $sales[$i]->quantity, $sales[$i]->customer_name, $sales[$i]->price, 'date'=>$sales[$i]->date]);
        }

        $purchases = DB::table('purchases')
            ->join('products', 'products.product_id' , '=' , 'purchases.product_id')
            ->select('products.product_id as product_id', 'description', 'purchases.quantity as quantity', 'supplier_name', 'purchases.created_at as date', 'price')
            ->where('purchases.product_id', '=', $id)
            ->get();

        $arrayCount2 = count($purchases);
        for($i = 0;$i<$arrayCount2;$i++){
            array_push($data, ["Added", "purchased", $purchases[$i]->description, $purchases[$i]->quantity, $purchases[$i]->supplier_name, $purchases[$i]->price, 'date'=>$purchases[$i]->date]);
        }

        $damaged_items = DB::table('damaged_items')
            ->join('products', 'products.product_id' , '=' , 'damaged_items.product_id')
            ->join('stock_adjustments', 'stock_adjustments.stock_adjustments_id' , '=' , 'damaged_items.stock_adjustments_id')
            ->select('products.product_id as product_id', 'employee_name', 'description', 'damaged_items.quantity as quantity', 'damaged_items.created_at as date')
            ->where('damaged_items.product_id', '=', $id)
            ->get();

        $arrayCount3 = count($damaged_items);
        for($i = 0;$i<$arrayCount3;$i++){
            array_push($data, ["Deducted", "Damaged", $damaged_items[$i]->description, $damaged_items[$i]->quantity, $damaged_items[$i]->employee_name, "", 'date'=>$damaged_items[$i]->date]);
        }

        $lost_items = DB::table('lost_items')
            ->join('products', 'products.product_id' , '=' , 'lost_items.product_id')
            ->join('stock_adjustments', 'stock_adjustments.stock_adjustments_id' , '=' , 'lost_items.stock_adjustments_id')
            ->select('products.product_id as product_id', 'employee_name', 'description', 'lost_items.quantity as quantity', 'lost_items.created_at as date')
            ->where('lost_items.product_id', '=', $id)
            ->get();

        $arrayCount4 = count($lost_items);
        for($i = 0;$i<$arrayCount4;$i++){
            array_push($data, ["Deducted", "Lost", $lost_items[$i]->description, $lost_items[$i]->quantity, $lost_items[$i]->employee_name, "", 'date'=>$lost_items[$i]->date]);                
        }

        foreach ($data as $key => $row){
            $date[$key] = $row['date'];
            // $edition[$key] = $row['edition'];
        }

        if(empty($data)){
            return $data;
        }
        array_multisort($date, SORT_DESC, $data);
        return $data;
        // return rsort($data);
        // $data = $sales + $purchases +  $damaged_items + $lost_items;
        // $data = {"sales":"$sales"};
        //return [$sales,$purchases,$damaged_items,$lost_items];
    }

    function date_compare($a,$b){
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t1 - $t2;
    }

    public function compare_date($a,$b){
        return strnatcmp($a['date'],$b['date']);
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
    public function addNewAdmin(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
        ]);

        //Create new Item
        $employee = new Admin;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password');
        $employee->save();
        // return response($request->all());

        $results = Admin::latest('created_at')->first();
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
    public function employeeResetPassword(Request $request){
        $employee = User::find($request->employeeId);
        // $employee->password = $request->input('password');
        $pieces = explode(" ",$employee->name);
        $resetPassword = $pieces[0]."@jernixon";
        $employee->password = $resetPassword;
        $employee->save();
        return response($resetPassword);


    }
    public function changePassword(Request $request){
        $this->validate($request,[
            'Current_Password' => 'required',
            'Email' => 'required',
            'New_Password' => 'required',
            'Confirm_Password' => 'required',
        ]);
        $employee = Admin::find($request->adminId);
        // $password = Hash::make($request->New_Password);
        if($request->Email===$employee->email ){
            if($request->New_Password===$request->Confirm_Password ){
                if( Hash::check($request->Current_Password, $employee->password) ){
                    $employee->password = $request->New_Password;
                    $employee->save();
                    return "successful";
                }else{
                    return response()->json([
                        'errors' => ['Current password does not match.']
                    ],422);
                }
            }else{
                return response()->json([
                    'errors' => ['New password and confirm password does not match.']
                ],422);
            }
        }else{
            return response()->json([
                'errors' => ['Email does not match.']
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
    public function notificationMarkAsRead(Request $request){
        // return $request->all();
        // return $request->notifications;
    }
    public function reorderitems(){
    }



}
