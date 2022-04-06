<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceTypeRequest;
use App\ServiceType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ServiceTypeController extends Controller
{
    public function index()
    {
        return view('admin.service_type.index');
    }

    public function create()
    {
        return view('admin.service_type.create');
    }

    public function getData()
    {
        $service_type = ServiceType::latest()->get();

        return DataTables::of($service_type)
            ->addIndexColumn()
            ->editColumn('action', function ($service_type) {
                $return = "<div class=\"btn-group\">";
                if (!empty($service_type->id))
                {
                    $return .= "
                                  <a href=\"/service_type/edit/$service_type->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$service_type->id\" rel1=\"service_type/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(ServiceTypeRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create service type

                $service_type = new ServiceType();

                $service_type->service_type_name = $request->service_type_name;

                $service_type->save();

                DB::commit();

                return response()->json([
                    'message' => 'Service Type Added Successful',
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
        $service_type = ServiceType::findOrFail($id);

        return view('admin.service_type.edit', compact('service_type'));
    }

    public function update(ServiceTypeRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update service type

                $service_type = ServiceType::findOrFail($id);

                $service_type->service_type_name = $request->service_type_name;

                $service_type->save();

                DB::commit();

                return response()->json([
                    'message' => 'Service Type Updated Successful',
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
        $service_type = ServiceType::findOrFail($id);
        $service_type->delete();

        return response()->json([
            'message' => 'Service Type Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
