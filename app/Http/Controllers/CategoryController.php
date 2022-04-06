<?php
namespace App\Http\Controllers;
use App\Catgeory;
use App\Http\Requests\CatgeoryRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {

        return view('admin.category.create');
    }

    public function getData()
    {
        $category = Catgeory::latest()->get();
       

        return DataTables::of($category)
            ->addIndexColumn()
            ->editColumn('action', function ($category) {
                $return = "<div class=\"btn-group\">";
                if (!empty($category->name))
                {
                    $return .= "<a href=\"/category/edit/$category->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$category->id\" rel1=\"category/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \">
                                        <i class='fa fa-trash'></i>
                                    </a>
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

    public function store(CatgeoryRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                

                $category = new Catgeory();

                $category->name = $request->name;
                $category->slug = Str::slug($request->name);

                $category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Category Added Successful',
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
        $category = Catgeory::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(CatgeoryRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //update category

                $category = Catgeory::findOrFail($id);

                $category->name = $request->name;
                $category->slug = Str::slug($request->name);

                $category->save();

                DB::commit();

                return response()->json([
                    'message' => 'Category Updated Successful',
                    'status_code' => 200
                ], 200);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],500);
            }
        }
    }

    public function destroy($id)
    {
        $category = Catgeory::findorFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
