<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Service;
use App\ServiceType;
use App\StockBrand;
use App\StockModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.index');
    }

    public function create()
    {
        $service_type = ServiceType::get();
        $stock_brand = StockBrand::get();

        return view('admin.service.create', compact('service_type','stock_brand'));
    }

    public function getData()
    {
        $service = DB::table('services')
                    ->select(
                        'services.*',
                        'stock_brands.stock_brand_name as stock_brand_name',
                        'service_types.service_type_name as service_type_name'
                    )
                    ->join('stock_brands','services.brand_id', '=','stock_brands.id')
                    ->join('service_types','services.service_type_id','=','service_types.id')
                    ->orderBy('services.id','desc')
                    ->get();

        return DataTables::of($service)
            ->addIndexColumn()
            ->editColumn('action', function ($service) {
                $return = "<div class=\"btn-group\">";
                if (!empty($service->id))
                {
                    $return .= "
                                  <a href=\"/service/edit/$service->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$service->id\" rel1=\"service/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(ServiceRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create service

                $service = new Service();

                $service->brand_id = $request->brand_id;
                // $service->model_id = $request->model_id;
                $service->service_type_id = $request->service_type_id;
                $service->service_name = $request->service_name;
                $service->charge = $request->charge;
                $service->total_duration = $request->total_duration;

                $service->save();

                DB::commit();

                return response()->json([
                    'message' => 'Service Added Successful',
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
        $service = Service::findOrFail($id);

        $service_type = ServiceType::get();

        $stock_brand = StockBrand::get();

        $stock_model = StockModel::get();

        return view('admin.service.edit', compact('service_type','stock_brand','service','stock_model'));
    }

    public function update(ServiceRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create service

                $service = Service::findOrFail($id);

                $service->brand_id = $request->brand_id;
                // $service->model_id = $request->model_id;
                $service->service_type_id = $request->service_type_id;
                $service->service_name = $request->service_name;
                $service->charge = $request->charge;
                $service->total_duration = $request->total_duration;

                $service->save();

                DB::commit();

                return response()->json([
                    'message' => 'Service Updated Successful',
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
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'message' => 'Service Destroy Successful',
            'status_code' => 200
        ]);
    }
}
