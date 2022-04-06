<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExecutiveController extends Controller
{
    public function index()
    {
        return view('admin.executive.index');
    }

    public function create()
    {
        return view('admin.executive.create');
    }

    public function getData()
    {
        $executive = DB::table('users')
                        ->select(
                            'users.*',
                            'user_role.role_name as role_name'
                        )
                        ->join('user_role','users.user_role_id','=','user_role.id')
                        ->where('users.user_role_id', '=',2)
                        ->orderBy('users.id','desc')
                        ->get();

        return DataTables::of($executive)
            ->addIndexColumn()
            ->addColumn('active',function ($executive){
                if($executive->is_active == 0)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" id="active_change" class="active_toggle" data-value="'.$executive->id.'" value="'.$executive->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="active_change" class="active_toggle" data-value="'.$executive->id.'"  value="'.$executive->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($executive) {
                $return = "<div class=\"btn-group\">";
                if (!empty($executive->id))
                {
                    $return .= "
                                  <a href=\"/executive/edit/$executive->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$executive->id\" rel1=\"executive/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','active'
            ])
            ->make(true);
    }

    public function active_change($id)
    {
        $executive = DB::table('users')
                    ->select(
                        'users.*',
                        'user_role.role_name as role_name'
                    )
                    ->join('user_role','users.user_role_id','=','user_role.id')
                    ->where('users.id', $id)
                    ->first();

        if ($executive->is_active == 0)
        {
            DB::table('users')->where('users.id',$id)->update(['is_active' => 1]);

            return response()->json([
                'message' => $executive->role_name.' role is active',
                'status_code' => 200
            ], 200);
        }else{
            DB::table('users')->where('users.id',$id)->update(['is_active' => 0]);

            return response()->json([
                'message' => $executive->role_name.' role is remove',
                'status_code' => 200
            ], 200);
        }
    }

    public function edit($id)
    {
        $executive = User::where('user_role_id', 2)->findOrFail($id);

        return view('admin.executive.edit', compact('executive'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update executive role

                $executive = User::findOrFail($id);

                $executive->user_role_id = $request->user_role_id;

                $executive->save();

                DB::commit();

                return response()->json([
                    'message' => 'User role is update',
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
        $executive = User::findOrFail($id);

        $executive->delete();


        return response()->json([
            'message' => 'Executive destroy successful',
            'status_code' => 200
        ], 200);
    }
}
