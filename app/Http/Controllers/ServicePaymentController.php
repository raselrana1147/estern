<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ServicePaymentController extends Controller
{
    public function index()
    {
        return view('admin.service_payment.index');
    }

    public function getData()
    {
        $service_payment = DB::table('service_payment')
                                ->select(
                                    'service_payment.id as id',
                                    'service_payment.service_id as service_id',
                                    'users.name as customer_name',
                                    'users.phone as customer_phone',
                                    'service_payment.payment_type as payment_type',
                                    'service_payment.payable_amount as payable_amount',
                                    'service_payment.mobile as mobile',
                                    'service_payment.transaction_id as transaction_id',
                                    'service_payment.payment_date as payment_date',
                                    'service_payment.payment_status as payment_status'
                                )
                                ->join('users','service_payment.customer_id','=','users.id')
                                ->get();

        return DataTables::of($service_payment)
            ->addIndexColumn()
            ->addColumn('status',function ($service_payment){
                if($service_payment->payment_status == 0)
                {
                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="payment_status_toggle" data-value="'.$service_payment->id.'" id="status_change" value="'.$service_payment->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="status_change"  class="payment_status_toggle" data-value="'.$service_payment->id.'"  value="'.$service_payment->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($service_payment) {
                $return = "<div class=\"btn-group\">";
                if (!empty($service_payment->id) && $service_payment->payment_status == 1)
                {
                    $return .= "
                                  <a href=\"/payment/invoice/$service_payment->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Payment Invoice\">
                                     <i class=\"fas fa-file-invoice\"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','status'
            ])
            ->make(true);
    }

    public function status_change($id)
    {
        $payment_service = DB::table('service_payment')->where('service_payment.id',$id)->first();

        if ($payment_service->payment_status == 0)
        {
            DB::table('service_payment')->where('service_payment.id',$id)->update(['payment_status' => 1]);

            return response()->json([
                'message' => 'Payment done successful',
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
            DB::table('service_payment')->where('service_payment.id',$id)->update(['payment_status' => 0]);

            return response()->json([
                'message' => 'Payment not receive yet',
                'status_code' => 200
            ],Response::HTTP_OK);
        }
    }

    public function invoice($id)
    {
        $payment_service = DB::table('service_payment')
                            ->select(
                                'service_payment.id as id',
                                'service_payment.service_id as service_id',
                                'service_payment.payment_date as payment_date',
                                'users.name as customer_name',
                                'users.phone as customer_phone',
                                'users.email as customer_email',
                                'customer_services.amount as amount',
                                'quotes.problem_details as problem_details',
                                'pick_up.pick_up_cost as pick_up_cost',
                                'drop_up.drop_up_cost as drop_up_cost',
                                'cupons.id as coupon_id',
                                'cupons.coupon_amount as coupon_amount'
                            )
                            ->leftJoin('users','service_payment.customer_id','=','users.id')
                            ->leftJoin('customer_services','service_payment.service_id','=','customer_services.service_id')
                            ->leftJoin('quotes','customer_services.quote_id','=','quotes.id')
                            ->leftJoin('cupons','quotes.coupon_code','=','cupons.coupon_code')
                            ->leftJoin('user_coupons','cupons.coupon_code','=','user_coupons.coupon_id')
                            ->leftJoin('pick_up','service_payment.service_id','=','pick_up.service_id')
                            ->leftJoin('drop_up','service_payment.service_id','=','drop_up.service_id')
                            ->where('service_payment.id',$id)
                            ->first();

        return view('admin.service_payment.payment_invoice',compact('payment_service'));
    }
}
