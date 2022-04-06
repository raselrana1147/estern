<?php

namespace App\Http\Controllers;

use App\StockBrand;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockBrandController extends Controller
{
    public function index()
    {
        return view('admin.stock_inventory.brand.index');
    }

    public function create()
    {
        return view('admin.stock_inventory.brand.create');
    }

    public function getData()
    {
        $stock_brand = StockBrand::latest()->get();

        return DataTables::of($stock_brand)
            ->addIndexColumn()
            ->editColumn('action', function ($stock_brand) {
                $return = "<div class=\"btn-group\">";
                if (!empty($stock_brand->id))
                {
                    $return .= "
                                  <a href=\"/stock_brand/edit/$stock_brand->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$stock_brand->id\" rel1=\"stock_brand/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock brand

                $stock_brand = new StockBrand();

                $stock_brand->stock_brand_name = $request->stock_brand_name;

                $stock_brand->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Brand Added Successful',
                    'status_code' => 200
                ]);
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
        $stock_brand = StockBrand::findOrFail($id);

        return view('admin.stock_inventory.brand.edit', compact('stock_brand'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock brand

                $stock_brand = StockBrand::findOrFail($id);

                $stock_brand->stock_brand_name = $request->stock_brand_name;

                $stock_brand->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Brand Updated Successful',
                    'status_code' => 200
                ]);
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
        $stock_brand = StockBrand::findOrFail($id);
        $stock_brand->delete();

        return response()->json([
            'message' => 'Stock Brand Deleted Successful',
            'status_code' => 200
        ]);
    }
}
