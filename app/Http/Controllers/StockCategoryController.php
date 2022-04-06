<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCategoryRequest;
use App\StockCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockCategoryController extends Controller
{
    public function index()
    {
        return view('admin.stock_inventory.category.index');
    }

    public function create()
    {
        return view('admin.stock_inventory.category.create');
    }

    public function getData()
    {
        $stock_category = StockCategory::latest()->get();

        return DataTables::of($stock_category)
            ->addIndexColumn()
            ->editColumn('action', function ($stock_category) {
                $return = "<div class=\"btn-group\">";
                if (!empty($stock_category->id))
                {
                    $return .= "
                                  <a href=\"/stock_category/edit/$stock_category->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$stock_category->id\" rel1=\"stock_category/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(StockCategoryRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock category

                $stock_category = new StockCategory();

                $stock_category->stock_category_name = $request->stock_category_name;

                $stock_category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Category Added Successful',
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
        $stock_category = StockCategory::findOrFail($id);

        return view('admin.stock_inventory.category.edit', compact('stock_category'));
    }

    public function update(StockCategoryRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create stock category

                $stock_category = StockCategory::findOrFail($id);

                $stock_category->stock_category_name = $request->stock_category_name;

                $stock_category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stock Category Updated Successful',
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
        $stock_category = StockCategory::findOrFail($id);
        $stock_category->delete();

        return response()->json([
            'message' => 'Stock Category Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
