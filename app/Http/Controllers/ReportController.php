<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\AvailableStatus;
use App\Floors;
use App\PaymentHistories;
use App\PaymentStatus;
use App\Towers;
use App\UnitTypes;
use App\Views;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
	use Authorizable;
	public function __construct()
	{
			$this->middleware(['auth']);
	}


	public function unit()
	{
		$client =DB::table('clients')->get();
		$options = [
				'tipe_units' => UnitTypes::where('status', 1)->get(), 
				'lantais'=> Floors::where('status', 1)->get(),
				'towers' => Towers::where('status', 1)->get(),
				'views' => Views::where('status', 1)->get(),
				'available_statuss' => AvailableStatus::where('status', 1)->get(),
				'payment_statuss' => PaymentStatus::where('status', 1)->get(),
				'clients' => $client,
		];
		return view('layouts.report.unit', $options);
	}

	public function dataunit(Request $request)
	{
		$units = DB::table('unit')->select([
			'unit.id',
			'unit.unit_number as unit_number', 
			'unit.unit_name as unit_name', 
			'unit.large as unit_large', 
			'unit.price as unit_price',
			'unit_types.id as unit_type_id', 
			'unit_types.name as unit_type_name', 
			'floors.id as floor_id', 
			'floors.name as floor_name', 
			'towers.id as tower_id', 
			'towers.name as tower_name', 
			'views.id as view_id',
			'views.name as view_name',
			'clients.id as client_id',
			'clients.name as client_name', 
			'available_status.id as available_status_id',
			'available_status.name as available_status_name', 
			'users.id as user_id',
			'users.name as user_name'
		])
		->join('views','unit.view_id', '=', 'views.id')
		->join('unit_types','unit.unit_type_id', '=', 'unit_types.id')
		->join('floors','unit.floor_id', '=', 'floors.id')
		->join('towers','unit.tower_id', '=', 'towers.id')
		->leftJoin('orders','unit.id', '=', 'orders.unit_id')
		->leftJoin('users','orders.user_id', '=', 'users.id')
		->leftJoin('clients','orders.client_id', '=', 'clients.id')
		->leftJoin('available_status','unit.available_status_id', '=', 'available_status.id');
		$units->get();
		

		$datatables = DataTables::of($units)
		->filter(function ($query) use ($request)
		{
				if($request->get('unit_type') != null){
						$query->where('unit_type_id', '=', $request->get('unit_type'));
				}
				if($request->get('floor') != null){
						$query->where('floor_id', '=', $request->get('floor'));
				}
				if($request->get('tower') != null){
						$query->where('tower_id', '=', $request->get('tower'));
				}
				if($request->get('view') != null){
						$query->where('view_id', '=', $request->get('view'));
				}
				if($request->get('client') != null){
						$query->where('client_id', '=', $request->get('client'));
				}
				if($request->get('available_status') != null){
						if($request->get('available_status') == 99){
								$query->whereNull('unit.available_status_id');
						}else{
								$query->where('unit.available_status_id', '=', $request->get('available_status'));
						}
				}
				if($request->get('payment_status') != null){
					$orderId = $this->getOrderByStatus($request->get('payment_status'));
					$query->whereIn('orders.id', $orderId);
				}

				if($request->get('date_range') != null){
					$date = array_map('trim',explode("-", $request->get("date_range")));
					$startDate =  Carbon::parse($date[0])->startOfDay();
					$endDate = Carbon::parse($date[1])->endOfDay();
					$query->whereBetween('orders.created_at', [$startDate, $endDate]);
				}
		});
		$datatables->editColumn('available_status_name', function($unit){
				return $unit->available_status_name == "" ? "Tersedia" : $unit->available_status_name; 
		})
		->editColumn('unit_price', '{{number_format($unit_price, "0", ", ", ".")}}');

		return $datatables->make(true);
	}

	public function order()
	{
		$options = [
			'payment_statuss' => PaymentStatus::where('status', 1)->select(['id', 'name'])->get()
		];
		return view('layouts.report.order', $options);
	}

	public function dataorder(Request $request)
	{
		$orders = DB::table('orders')
				->select([
						'orders.id as id', 'orders.order_number', 'clients.name as client_name', 'users.name as user_name', 'unit.id as unit_id', 'unit.unit_name as unit_name', 
						'unit.large as large', 'unit.price as price', 'unit_types.name as unit_type', 'floors.name as floor', 'available_status.name as status',
						DB::raw('(SELECT COUNT(id) FROM payment_histories WHERE payment_histories.order_id = orders.id and valid_transaction=0) As pending_payment')
				
				])
				->leftJoin('clients', 'orders.client_id', '=', 'clients.id')
				->leftJoin('users', 'orders.user_id', '=', 'users.id')
				->leftJoin('unit', 'orders.unit_id', '=', 'unit.id')
				->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
				->join('floors', 'unit.floor_id', '=', 'floors.id')
				->leftJoin('available_status', 'unit.available_status_id', '=', 'available_status.id');
				
		$orders->get();

		return DataTables::of($orders)->addColumn('action', function($order)
		{
				return '<a href="'.route('units.show',['unit' => $order->unit_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> History</a>';
		})
		->filter(function($query) use ($request){
			if($request->get('payment_status') != null){
				$orderId = $this->getOrderByStatus($request->get('payment_status'));
				$query->whereIn('orders.id', $orderId);
			}
		})
		->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
		->editColumn('pending_payment', function($order){
				// return $order->pending_payment > 0 ? "<span>".$order->pending_payment."</span>":"";
				return $order->pending_payment > 0 ? '<span class="label label-danger">'.$order->pending_payment.'</span>' : '<span class="label label-success">'.$order->pending_payment.'</span>';
		})
		->rawColumns(['action', 'pending_payment'])
		->make(true);
	}

	public function getOrderByStatus($status = '')
	{
		$arr_data = [];
		switch ($status) {
			case 2:
				$arr_data = PaymentStatus::RESERVED;
				break;
			case 3:
				$arr_data = PaymentStatus::BOOKING;
				break;
			case 4:
				$arr_data = PaymentStatus::DP;
				break;
			case 5:
				$arr_data = PaymentStatus::CASH_BERTAHAP;
				break;
			default:
				break;
		}
	
		$having = [];
		foreach($arr_data as $id){
			array_push($having, "SUM(payment_status_id = $id)");
		}
		array_push($having, "NOT SUM(payment_status_id NOT IN (".join(",", $arr_data)."))");
		
		$having = join(" AND ", $having);
		$orderId = DB::table('payment_histories')->select('order_id')
			->groupBy(['order_id'])
			->havingRaw($having)
			->get()->pluck('order_id')->toArray();
		
		return $orderId;
	}
		
	public function transaction()
	{
			return view('layouts.report.transaction');
	}

	public function datatransaction()
	{
			$paymentHistory = DB::table('payment_histories')
			->select([
				'orders.order_number as order_number',
				'payment_status.name as payment_status_name',
				'u1.name as user_name',
				'u2.name as user_verified_by',
				'payment_histories.payment_number as payment_number',
				'payment_histories.nominal as nominal',
				'payment_histories.payment_method as payment_method',
				'payment_histories.payment_date as payment_date',
				'payment_histories.status as status',
				'payment_histories.refundable_status as refundable_status',
				'payment_histories.valid_transaction as valid_transaction',
			])
			->join('orders', 'payment_histories.order_id', '=', 'orders.id')
			->leftJoin('payment_status', 'payment_histories.payment_status_id', '=', 'payment_status.id')
			->leftJoin('users as u1', 'payment_histories.user_id', '=', 'u1.id')
			->leftJoin('users as u2', 'payment_histories.verified_by', '=', 'u2.id')->get();
			// dd($paymentHistory);

			
			// $paymentHistory->get();

			return DataTables::of($paymentHistory)
			->editColumn('nominal', '{{number_format($nominal, "0", ",", ".")}}')
			->editColumn('payment_method', function($ph)
			{
				return PaymentHistories::PAYMENT_METHOD[$ph->payment_method];
			})
			->editColumn('status', function($ph)
			{
				return PaymentHistories::STATUS[$ph->status];
			})
			->editColumn('refundable_status', function($ph)
			{
				return PaymentHistories::REFUNDABLE_STATUS[$ph->refundable_status];
			})
			->editColumn('valid_transaction', function($ph)
			{
				return PaymentHistories::VALID_TRANSACTION[$ph->valid_transaction];
			})
			->make(true);
	}
}
