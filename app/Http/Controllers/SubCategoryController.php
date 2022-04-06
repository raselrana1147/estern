<?php

namespace App\Http\Controllers;

use App\Catgeory;
use App\Http\Requests\SubCategoryRequest;
use App\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view('admin.sub_category.index');
    }

    public function create()
    {
        $category = Catgeory::get();

        return view('admin.sub_category.create', compact('category'));
    }

    public function getData()
    {
        $sub_category = SubCategory::getAllSubCategory();

        return DataTables::of($sub_category)
            ->addIndexColumn()
            ->editColumn('action', function ($sub_category) {
                $return = "<div class=\"btn-group\">";
                if (!empty($sub_category->id))
                {
                    $return .= "
                                  <a href=\"/subCategory/edit/$sub_category->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$sub_category->id\" rel1=\"subCategory/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(SubCategoryRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create sub category

                $sub_category = new SubCategory();

                $sub_category->category_id = $request->category_id;
                $sub_category->name = $request->name;
                $sub_category->slug = Str::slug($request->name);

                $sub_category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Sub Category Added Successful',
                    'status_code' => 200
                ],200);
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
        $sub_category = SubCategory::findOrFail($id);

        $category = Catgeory::get();

        return view('admin.sub_category.edit', compact('sub_category','category'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update category

                $sub_category = SubCategory::findOrFail($id);

                $sub_category->category_id = $request->category_id;
                $sub_category->name = $request->name;
                $sub_category->slug = Str::slug($request->name);

                $sub_category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Sub Category Updated Successful',
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
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();

        return response()->json([
            'message' => 'Sub category destroy successful',
            'status_code' => 200
        ],200);
    }
}
