<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Order;
use App\Medicine;
use App\MedicineOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('seller-auth');
	}

	public function index() {
		empty(session('ordOrder')) ? session(['ordOrder' => 'id']) : null;
		empty(session('ordSort')) ? session(['ordSort' => 'ASC']) : null;
		$orders = Order::orderBy(session('ordOrder'), session('ordSort'))
            ->paginate(6);
		return view('orders.index', compact('orders'));
	}

	public function create() {
		$medicines = Medicine::orderBy('name', 'ASC')->get();
		$medicineNumber = session('medicineNumber');
		return view('orders.create', compact('medicines', 'medicineNumber'));
	}

	public function show(Order $order) {
		return view('orders.show', compact('order'));
	}

	public function store(Request $request) {
		// $medicineNumber = $request->input('medicineNumber');
		// $request->request->remove('medicineNumber');

		// dd($request->all(0));

		$i = 0;
		$a = 0;
		$arr = [];
		$validationArr = [];
		foreach(request()->all() as $key => $value) {
			if(substr($key, 0, 3) != 'med' && substr($key, 0, 3) != 'kol') { continue; }
			$arr[$i][$key] = $value;
			$a += 0.5;
			$i = (int)floor($a);
			$validationArr[$key] = 'required|numeric|integer|gt:0';
		}

		// dd($validationArr);

		$validator = Validator::make($request->all(), $validationArr);
		if($validator->fails()) {
			return redirect('orders/create')
				->withErrors($validator)
				->withInput();
				// ->with(['medicines' => Medicine::all()]);
		}

		session()->forget('medicineNumber');

		$sledeciId = Order::sledeciId();

		foreach($arr as $requestNiz) {
			$medicine_id = reset($requestNiz);
			$quantity = end($requestNiz);

			$order = new Order();
			$order->id = $sledeciId;

			$order->medicines()->attach([$medicine_id => ['quantity' => $quantity]]);

			$medicine = Medicine::find($medicine_id);
			$medicine->quantity += $quantity;
			$medicine->save();
		}
		$order->manager = auth()->user()->name . ' ' . auth()->user()->surname;
		$order->save();

		return redirect('/orders')->with(['message' => 'Uspješno Napravljeno Trebovanje.']);
	}

	public function edit(Order $order) {

	}

	public function update(Request $request, Order $order) {

	}

	public function destroy(Order $order) {
		// $nizZaDetatch = $order->medicines->pluck('pivot')->pluck('medicine_id');
		$order->medicines()->detach();
		$order->delete();
		return back()->with(['message' => 'Uspješno Izbrisano Trebovanje.']);
	}

	public function medicineNumber(Request $request) { //$brLjek = null,
		$data = request()->validate([
			'medicineNumber' => ['required', 'numeric', 'integer','gte:1']
		]);

		session(['medicineNumber' => $data['medicineNumber']]);
		return $this->create();
	}

	public function sort($parametar) {
		session(['ordOrder' => $parametar]);
		session('ordSort') == 'ASC' ? session(['ordSort' => 'DESC']) : session(['ordSort' => 'ASC']);
		return redirect('/orders');
	}
}
