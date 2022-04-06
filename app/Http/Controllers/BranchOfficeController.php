<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BranchOffice;
use App\Http\Requests\BranchOfficeRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class BranchOfficeController extends Controller
{
    

    public function index()
    {
        return view('admin.branch_office.index');
    }

    public function create()
    {

        return view('admin.branch_office.create');
    }

    public function getData()
    {
        $branch_office = BranchOffice::latest()->get();
       

        return DataTables::of($branch_office)
            ->addIndexColumn()
            ->editColumn('action', function ($branch_office) {
                $return = "<div class=\"btn-group\">";
                if (!empty($branch_office->phone))
                {
                    $return .= "<a href=\"/branch_office/edit/$branch_office->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$branch_office->id\" rel1=\"branch_office/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \">
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

    public function store(BranchOfficeRequest $request)
    {
         

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                $branch_office = new BranchOffice();

                $branch_office->phone = $request->phone;
                $branch_office->fblink = $request->fblink;
                $branch_office->address = $request->address;
                $branch_office->save();

                DB::commit();

                return response()->json([
                    'message' => 'Brand Office Added Successful',
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
        $branch_office = BranchOffice::findOrFail($id);

        return view('admin.branch_office.edit', compact('branch_office'));
    }

    public function update(BranchOfficeRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //update branch office

                $branch_office = BranchOffice::findOrFail($id);

                $branch_office->phone = $request->phone;
                $branch_office->fblink = $request->fblink;
                $branch_office->address = $request->address;
            
                $branch_office->save();

                DB::commit();

                return response()->json([
                    'message' => 'Branch office Updated Successful',
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
        $branch_office = BranchOffice::findorFail($id);
        $branch_office->delete();

        return response()->json([
            'message' => 'Dranch office Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
