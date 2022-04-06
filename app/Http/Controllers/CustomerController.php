<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Product;
use App\Brand;
use App\Catgeory;
use App\SubCategory;
use Validator;
use Hash;
use Auth;
use Session;
use App\Customer;


class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.index');
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function getData()
    {
        $customer = DB::table('users')
            ->select(
                'users.*',
                'user_role.role_name as role_name'
            )
            ->join('user_role','users.user_role_id','=','user_role.id')
            ->where('users.user_role_id','=', 3)
            ->orderBy('users.id','desc')
            ->get();

        return DataTables::of($customer)
            ->addIndexColumn()
            ->addColumn('active',function ($customer){
                if($customer->is_active == 0)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="active_toggle" data-value="'.$customer->id.'" id="active_change_'.$customer->id.'" value="'.$customer->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="active_change_'.$customer->id.'" data-value="'.$customer->id.'" class="active_toggle"  value="'.$customer->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($customer) {
                $return = "<div class=\"btn-group\">";
                if (!empty($customer->id))
                {
                    $return .= "
                                  <a href=\"/customers/edit/$customer->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$customer->id\" rel1=\"customers/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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
        $customer = DB::table('users')
                    ->select(
                        'users.*',
                        'user_role.role_name as role_name'
                    )
                    ->join('user_role','users.user_role_id','=','user_role.id')
                    ->where('users.id', $id)
                    ->first();

        if ($customer->is_active == 0)
        {
            DB::table('users')->where('users.id',$id)->update(['is_active' => 1]);

            return response()->json([
                'message' => $customer->role_name.' role is active',
                'status_code' => 200
            ],200);
        }else{
            DB::table('users')->where('users.id',$id)->update(['is_active' => 0]);

            return response()->json([
                'message' =>  $customer->role_name.' role is remove',
                'status_code' => 200
            ],200);
        }
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.customer.edit',compact('customer'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update member role

                $customer = User::findOrFail($id);

                $customer->user_role_id = $request->user_role_id;

                $customer->save();

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
        $customer = User::findOrFail($id);

        $customer->delete();

        return response()->json([
            'message' => 'Customer is destroy',
            'status_code' => 200
        ],200);
    }

    public function login(){

            
         if (Session::get('CustomerSession') !="") {
               return redirect(route('ecommerce'));
           }  


        $category = Catgeory::latest()->get();
        $feature_product = Product::where('feature',1)->latest()->inRandomOrder()->limit(3)->get();



        $sale_product = Product::where('new_arrival',1)->inRandomOrder()->limit(3)->get();
        $brand = Brand::latest()->get();
        $sub_category = SubCategory::latest()->get();

        $top_product = Product::where('view_count','>=', 100)->latest()->inRandomOrder()->limit(3)->get();

      return view('auth.customer_login',compact('feature_product','top_product','sale_product','brand','category','sub_category'));     


            
    }


    public function register(Request $request){

           $validator = \Validator::make($request->all(), [
               'name'      => 'required',
               'email'     => 'required|email|unique:customers',
               'phone'     => 'required|unique:customers',
               'password'  => 'required|min:4',
               'password_confirmation' =>  'required|min:4|same:password',
           ],[
                'name.required'=>'Please enter your name',
                'email.required'=>'Please enter your email',
                'phone.required'=>'Please enter your phone',
                'password.required'=>'Please enter your password',
                'password_confirmation.required'=>'Please enter your confirm password'
             ]);

        if ($validator->passes()) {

            $customer=new Customer();
            $customer->name    =$request->name;
            $customer->email   =$request->email;
            $customer->phone   =$request->phone;
            $customer->password= md5($request->password);
            $customer->user_role_id=3;
            $customer->save();

            $msg = ['success' => 'Account created successfully'];
            return json_encode($msg);
        }
        $msg = ['error' => $validator->errors()->all()];
        return json_encode($msg);
    }



    public function login_submit(Request $request){

           $validator = \Validator::make($request->all(), [
               'username'     => 'required',
               'password'     => 'required',
           ],[
                'username.required'=>'Please enter email or phone',
                'password.required'=>'Please enter password',
             ]);

        if ($validator->passes()) {

                $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
                $customer = Customer::where(['email' => $request->username,'password' => md5($request->password)])->first();
                if (!is_null($customer)) {
                    if ($customer->is_active==1) {
                         Session::put('CustomerSession', $customer);
                          $msg = ['success' => 'Successfully Logged in'];
                         // echo $customer;
                           return json_encode($msg);

                    }else{
                      $msg = ['error' => 'Account is not active','type'=>"errors"];
                      return json_encode($msg);     
                    }

                }else{
                    $msg = ['error' => 'Credential is not match','type'=>"errors"];
                    return json_encode($msg);
                }
                $msg = ['success' => 'User successfully'];
                return json_encode($msg);
        }
       $msg = ['error' => $validator->errors()->all()];
        return json_encode($msg);
  }

    public function logout(){
        
         Session::forget('CustomerSession');

         return redirect(route('ecommerce'));
    }

}
