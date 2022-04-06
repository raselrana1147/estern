<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index()
    {
        return view('admin.member.index');
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function getData()
    {
        $member = DB::table('users')
                    ->select(
                        'users.*',
                        'user_role.role_name as role_name'
                    )
                    ->join('user_role','users.user_role_id','=','user_role.id')
                    ->where('users.user_role_id','=', 4)
                    ->orderBy('users.id','desc')
                    ->get();

        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('active',function ($member){
                if($member->is_active == 0)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="active_toggle" data-value="'.$member->id.'" id="active_change_'.$member->id.'" value="'.$member->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="active_change_'.$member->id.'" data-value="'.$member->id.'" class="active_toggle"  value="'.$member->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($member) {
                $return = "<div class=\"btn-group\">";
                if (!empty($member->id))
                {
                    $return .= "
                                  <a href=\"/member/edit/$member->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$member->id\" rel1=\"member/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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
        $member = DB::table('users')
                    ->select(
                        'users.*',
                        'user_role.role_name as role_name'
                    )
                    ->join('user_role','users.user_role_id','=','user_role.id')
                    ->where('users.id', $id)
                    ->first();

        if ($member->is_active == 0)
        {
            DB::table('users')->where('users.id',$id)->update(['is_active' => 1]);

            return response()->json([
                'message' => $member->role_name.' role is active',
                'status_code' => 200
            ],200);
        }else{
            DB::table('users')->where('users.id',$id)->update(['is_active' => 0]);

            return response()->json([
                'message' => $member->role_name.' role is remove',
                'status_code' => 200
            ],200);
        }
    }

    public function edit($id)
    {
        $member = User::where('user_role_id',4)->findOrFail($id);

        return view('admin.member.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update member role

                $member = User::findOrFail($id);

                $member->user_role_id = $request->user_role_id;

                $member->save();

                DB::commit();

                return response()->json([
                    'message' => 'User role is updated successful',
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
        $member = User::findOrFail($id);

        $member->delete();

        return response()->json([
            'message' => 'Member is destroy',
            'status_code' => 200
        ],200);
    }
}
