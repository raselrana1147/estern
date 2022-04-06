<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\Quote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class QuoteController extends Controller
{
    public function index()
    {
        return view('admin.quote.index');
    }

    public function getData()
    {
        $quote = Quote::getAllQuoteOrder();

        return DataTables::of($quote)
            ->addIndexColumn()
            ->addColumn('status',function ($quote){
                if($quote->status == 0)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="quote_status_toggle" data-value="'.$quote->id.'" id="quote_status_change" value="'.$quote->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="quote_status_change"  class="quote_status_toggle" data-value="'.$quote->id.'"  value="'.$quote->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($quote) {
                $return = "<div class=\"btn-group\">";
                if (!empty($quote->id) && $quote->status == 1)
                {
                    $return .= "
                                <a href=\"/orderPayment/$quote->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-credit-card\"></i>
                                    </a>
                                    
                                    
                                    <a rel=\"$quote->id\" rel1=\"quote/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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
        $quote = Quote::findOrFail($id);

        if ($quote->status == 0)
        {
            $quote->update(['status' => 1]);

            return response()->json([
                'message' => 'Order is approve',
                'status_code' => 200
            ], 200);
        }else{
            $quote->update(['status' => 0]);

            return response()->json([
                'message' => 'Order approve is Remove',
                'status_code' => 200
            ], 200);
        }
    }

    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);

        if ($quote){
            DB::table('customer_services')->where('customer_services.quote_id',$quote->id)->delete();
        }

        $quote->delete();

        return response()->json([
            'message' => 'Quote destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function orderPayment($id)
    {
        $quote = Quote::findOrFail($id);

        return view('admin.quote.order_payment',compact('quote'));
    }

    public function PaymentData()
    {
        $quote_id = $_GET['id'];

        $service_payment = DB::table('customer_services')
                            ->select(
                                'customer_services.id as id',
                                'customer_services.service_id as service_id',
                                'customer_services.amount as amount',
                                'customer_services.total as total',
                                'customer_services.sub_total as sub_total',
                                'customer_services.status as status',
                                'quotes.phone as phone'
                            )
                            ->join('quotes','customer_services.quote_id','=','quotes.id')
                            ->where('customer_services.quote_id', $quote_id)
                            ->get();

        return DataTables::of($service_payment)
            ->addIndexColumn()
            ->addColumn('status',function ($quote){
                if($quote->status == 0)
                {
                    return '<span class="text-danger">No payment added!</span>';

                }else{
                    return '<span class="text-success">Payment added successful!</span>';
                }

            })
            ->editColumn('action', function ($service_payment) {
                $return = "<div class=\"btn-group\">";
                if (!empty($service_payment->id))
                {
                    $return .= "
                                  <a href=\"/add_payment/$service_payment->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Add\">
                                      <i class=\"fa fa-plus\"></i>
                                    </a>
                                    
                                    <a rel=\"$service_payment->id\" rel1=\"/payment_destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function AddPayment($id)
    {
        $service_payment = DB::table('customer_services')
                                ->select(
                                    'customer_services.*',
                                    'quotes.coupon_code as coupon_code',
                                    'cupons.id as coupon_id',
                                    'cupons.coupon_amount as coupon_amount'
                                )
                                ->leftJoin('quotes','customer_services.quote_id','=','quotes.id')
                                ->leftJoin('cupons','quotes.coupon_code','=','cupons.coupon_code')
                                ->leftJoin('user_coupons','cupons.coupon_code','=','user_coupons.coupon_id')
                                ->where('customer_services.id', $id)
                                ->first();

        return view('admin.quote.add_payment', compact('service_payment'));
    }

    public function get_coupons($coupon_id)
    {
        $coupon = Cupon::findOrFail($coupon_id);

        return response()->json([
            'coupon' => $coupon
        ]);
    }

    public function OrderPaymentStore(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update payment

                $service_id = $request->payment_service_id;

                DB::table('customer_services')->where('customer_services.id', $service_id)->update([
                    'coupon_code' => $request->coupon_code,
                    'amount' => $request->amount,
                    'total' => $request->total,
                    'sub_total' => $request->sub_total,
                    'status' => 1
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Service payment added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function payment_destroy($id)
    {
        DB::table('customer_services')->where('customer_services.id',$id)->delete();

        return \response()->json([
            'message' => 'Payment destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function complain()
    {
        return view('admin.complain.index');
    }

    public function complainData()
    {
        $complain = DB::table('complain')->select('complain.id as id','users.name as name','users.phone as phone','complain.details as details')->join('users','complain.user_id','=','users.id')->orderBy('complain.id','desc')->get();

        return DataTables::of($complain)
            ->addIndexColumn()
            ->make(true);
    }
}
