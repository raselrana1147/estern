<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Stock;
use App\StockBrand;
use App\StockCategory;
use App\StockModel;
use App\BranchOffice;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\StockImport;

class StockController extends Controller
{
    public function index()
    {
        return view('admin.stock_inventory.stock.index');
    }

    public function create()
    {
        $stock_category = StockCategory::get();
        $stock_brand = StockBrand::get();
        $branch_offices = BranchOffice::get();

        return view('admin.stock_inventory.stock.create', compact('stock_category','stock_brand','branch_offices'));
    }

    public function get_model()
    {
        if (isset($_POST['stock_brand_id']))
        {
            $brand_id = $_POST['stock_brand_id'];

            $option = '';

            $query = DB::table('stock_models')
                ->select(
                    'stock_models.id as id',
                    'stock_models.model_name as model_name'
                )
                ->join('stock_brands','stock_models.stock_brand_id','=','stock_brands.id')
                ->where('stock_models.stock_brand_id',$brand_id)
                ->get();
            //dd($query);

            $option .= "<option value=''>Select Stock Model</option>";

            foreach ($query as $value) {

                $id = $value->id;

                $model_name = $value->model_name;

                $option .= " <option value=" . $id . ">" . $model_name . "</option>";

                //$show = array("id"=>$id, "subject_name"=>$subject_name);
            }

            echo $option;
        }
    }

    public function getData()
    {
        $stock = DB::table('stocks')
                    ->select(
                        'stocks.*',
                        'stock_categories.stock_category_name as stock_category_name',
                        'stock_brands.stock_brand_name as stock_brand_name',
                        'stock_models.model_name as model_name',
                        'branch_offices.address as branch_address',
                    )
                    ->leftJoin('stock_categories','stocks.stock_category_id','=','stock_categories.id')
                    ->leftJoin('stock_brands','stocks.stock_brand_id','=','stock_brands.id')
                    ->leftJoin('stock_models','stocks.stock_model_id','=','stock_models.id')
                    ->leftJoin('branch_offices','stocks.branch_office_id','=','branch_offices.id')
                    ->orderBy('stocks.id','desc')
                    ->get();
        //dd($stock);

        return DataTables::of($stock)
            ->addIndexColumn()
            ->editColumn('available', function ($stock) {
                if ($stock->available=="0") {
                    return "<span class='badge badge-success'>Available</span>";
                }else{
                    return "<span class='badge badge-danger'>Unavailable</span>";
                }
                
            })
            ->editColumn('action', function ($stock) {
                $return = "<div class=\"btn-group\">";
                if (!empty($stock->id))
                {
                    $return .= "
                                  <a href=\"/stock/edit/$stock->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$stock->id\" rel1=\"stock/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns(['available',
                'action'
            ])
            ->make(true);
    }

    public function store(Request $request)
    {


        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock
            if ($request->hasFile('upload_csv'))
            {
                 $upload_csv=$request->file('upload_csv');
                 $filePath=$upload_csv->getRealPath();
                 $file=fopen($filePath, 'r');
                 $header=fgetcsv($file);
                while (($count=fgetcsv($file,5000,",")) !==false) 
                {
                   
                    Stock::create([
                        'stock_category_id'=>$count[0],
                        'stock_brand_id'   =>$count[1],
                        'branch_office_id' =>$count[2],
                        'stock_model_id'   =>$count[3],
                        'quality'          =>$count[4],
                        'available'        =>$count[5],
                        'color'            =>$count[6],
                        'variation'        =>$count[7],
                        'quantity'         =>$count[8],
                        'purchase_price'   =>$count[9],
                        'retail_price'     =>$count[10],
                        'whole_sale_price' =>$count[11]
                    ]);

                }
                
            }else{

                 $this->validate($request,[
                    'stock_category_id' => 'required',
                    'stock_brand_id' => 'required',
                    'stock_model_id' => 'required',
                    'branch_office_id' => 'required',
                    'quality' => 'required',
                    'color' => 'required',
                    'variation' => 'required',
                    'quantity' => 'required',
                    'purchase_price' => 'required|numeric',
                    'retail_price' => 'required|numeric',
                    'whole_sale_price' => 'required|numeric',
                ]);


                $stock = new Stock();
                $stock->stock_category_id = $request->stock_category_id;
                $stock->stock_brand_id    = $request->stock_brand_id;
                $stock->stock_model_id    = $request->stock_model_id;
                $stock->quality           = $request->quality;
                $stock->color             = $request->color;
                $stock->variation         = $request->variation;
                $stock->quantity          = $request->quantity;
                $stock->purchase_price    = $request->purchase_price;
                $stock->retail_price      = $request->retail_price;
                $stock->whole_sale_price  = $request->whole_sale_price;
                $stock->available         = $request->available;
                $stock->branch_office_id  = $request->branch_office_id;
                $stock->save();
            }

              

                DB::commit();

                return response()->json([
                    'message' => 'Stock Added Successful',
                    'status_code' => 200
                ], 200);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);

        $stock_category = StockCategory::get();

        $stock_brand = StockBrand::get();

        $stock_model = StockModel::get();

        $branch_offices = BranchOffice::get();

        return view('admin.stock_inventory.stock.edit', compact('stock_category','stock_brand','stock','stock_model','branch_offices'));
    }

    public function update(StockRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock

                $stock = Stock::findOrFail($id);

                $stock->stock_category_id = $request->stock_category_id;
                $stock->stock_brand_id = $request->stock_brand_id;
                $stock->stock_model_id = $request->stock_model_id;
                $stock->quality = $request->quality;
                $stock->color = $request->color;
                $stock->variation = $request->variation;
                $stock->quantity = $request->quantity;
                $stock->purchase_price = $request->purchase_price;
                $stock->retail_price = $request->retail_price;
                $stock->whole_sale_price = $request->whole_sale_price;
                $stock->available = $request->available;
                $stock->branch_office_id = $request->branch_office_id;

                $stock->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Updated Successful',
                    'status_code' => 200
                ], 200);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return response()->json([
            'message' => 'Stock Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
