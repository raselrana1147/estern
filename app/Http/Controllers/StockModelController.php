<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockModelRequest;
use App\StockBrand;
use App\StockModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockModelController extends Controller
{
    public function index()
    {
        return view('admin.stock_inventory.model.index');
    }

    public function create()
    {
        $stock_brand = StockBrand::get();

        return view('admin.stock_inventory.model.create', compact('stock_brand'));
    }

    public function getData()
    {
        $stock_model = DB::table('stock_models')
                        ->select(
                            'stock_models.*',
                            'stock_brands.stock_brand_name as brand_name'
                        )
                        ->join('stock_brands','stock_models.stock_brand_id','=','stock_brands.id')
                        ->orderBy('stock_models.id','desc')
                        ->get();

        return DataTables::of($stock_model)
            ->addIndexColumn()
            ->editColumn('action', function ($stock_model) {
                $return = "<div class=\"btn-group\">";
                if (!empty($stock_model->id))
                {
                    $return .= "
                                  <a href=\"/stock_model/edit/$stock_model->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$stock_model->id\" rel1=\"stock_model/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action'
            ])
            ->make(true);
    }

    public function store(StockModelRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock model

                $stock_model = new StockModel();

                $stock_model->stock_brand_id = $request->stock_brand_id;
                $stock_model->model_name = $request->model_name;

                $stock_model->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Model Added Successful',
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
        $stock_model = StockModel::findOrFail($id);

        $stock_brand = StockBrand::get();

        return view('admin.stock_inventory.model.edit', compact('stock_brand','stock_model'));
    }

    public function update(StockModelRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update stock model

                $stock_model = StockModel::findOrFail($id);

                $stock_model->stock_brand_id = $request->stock_brand_id;
                $stock_model->model_name = $request->model_name;

                $stock_model->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Model Updated Successful',
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
        $stock_model = StockModel::findOrFail($id);
        $stock_model->delete();

        return response()->json([
            'message' => 'Stock Model Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
