<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Receipt;
use App\Medicine;
use App\MedicineType;
use App\MedicineReceipt;
use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
	protected $medicineId;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('seller-auth')->only(['edit', 'update', 'destroy']);
		$this->middleware('nepostojeciLijek')->only(['store', 'storeSingle']);
		$this->middleware('nulaKolicina')->only(['createSingle']);
	}

	public function index() {
		// session()->forget(['recOrder', 'recSort']);
		empty(session('recOrder')) ? session(['recOrder' => 'id']) : null;
		empty(session('recSort')) ? session(['recSort' => 'DESC']) : null;
		$receipts = Receipt::orderBy(session('recOrder'), session('recSort'))->paginate(6);

		return view('receipts.index', compact('receipts'));
	}

	public function show(Receipt $receipt) {
		return view('receipts.show', compact('receipt'));
	}

	public function create() {
		$medicinesNumber = session('medicinesNumber');
		$medicines = Medicine::orderBy('name', 'ASC')->get();
		return view('receipts.create', compact('medicines', 'medicinesNumber'));
	}

	public function createSingle(Medicine $medicine) {
		return view('receipts.createSingle', compact('medicine'));
	}

	public function store(Request $request) {
		// dd($request->all());
		$medicinesNumber = $request['medicinesNumber'];
		$request->request->remove('medicinesNumber');

		$i = 0;
		$a = 0;
		$arr = [];
		$validationArr = [];
		foreach($request->all() as $key => $value) {
			if(substr($key, 0, 3) != 'med' && substr($key, 0, 3) != 'kol') { continue; }
			$arr[$i][$key] = $value;
			$a += 0.5;
			$i = (int)floor($a);
			$validationArr[$key] = ['required', 'numeric', 'integer', 'gt:0'];
		}

		// dd($arr);
		// dd($validationArr);

		$validator = Validator::make($request->all(), $validationArr);
		if($validator->fails()) {
			// session(['medicinesNumber' => $medicinesNumber]);
			return redirect('receipts/create')
				->withErrors($validator)
				->withInput();
		}

		foreach($arr as $requestNiz) {
			$medicine_id = reset($requestNiz);
			$quantity = end($requestNiz);
			$medicine = Medicine::find($medicine_id);

			$validator = Validator::make($requestNiz, [
				array_keys($requestNiz)[1] => ['lte:' . $medicine->quantity]
			]);
			if($validator->fails()) {
				session(['medicinesNumber' => $medicinesNumber]);
				return redirect('receipts/create')
					->withErrors($validator)
					->withInput();
					// ->with(['medicines' => Medicine::all()]);
			}
		}

		session()->forget('medicinesNumber');

		$sledeciId = Receipt::sledeciId();

		$totalPrice = 0;
		foreach($arr as $requestNiz) {
			$medicine_id = reset($requestNiz);
			$quantity = end($requestNiz);

			$medicine = Medicine::find($medicine_id);
			$medicine->quantity -= $quantity;
			$medicine->save();
			$medicinePrice = $quantity * $medicine->price;
			$totalPrice += $medicinePrice;

			$receipt = new Receipt();
			$receipt->id = $sledeciId;
			$receipt->seller = auth()->user()->name . ' ' . auth()->user()->surname;
			$receipt->medicines()->attach([
				$medicine_id => [
					'quantity' => $quantity,
					'value'    => $medicinePrice
				]
			]);
		}
		$receipt->total_price = $totalPrice;
		$receipt->save();
		return redirect('/receipts')->with(['message' => 'Uspješno napravljen račun.']);
	}

	public function storeSingle(Request $request) {
		$request->validate([
			'medicine_id' => ['required', 'numeric', 'integer', 'gt:0']
		]);
		$medicine_id = $request['medicine_id'];
		$medicine = Medicine::find($medicine_id);
		$request->validate([
			'quantity' => ['required', 'numeric', 'integer', 'gte:1', 'lte:' . $medicine->quantity]
		]);

		$quantity = $request['quantity'];

		$medicine->quantity -= $quantity;
		$medicine->save();

		$medicinePrice = $quantity * $medicine->price;

		$receipt = new Receipt();
		$receipt->id = Receipt::sledeciId();
		$receipt->seller = auth()->user()->ime . ' ' . auth()->user()->prezime;
		$receipt->medicines()->attach([
			$medicine_id => [
				'quantity' => $quantity,
				'iznos'    => $medicinePrice
			]
		]);
		$receipt->total_price = $medicinePrice;
		$receipt->save();

		return redirect('/receipts')->with(['message' => 'Uspješno napravljen račun.']);
	}

	public function edit(Receipt $receipt) {

	}

	public function update(Request $request, Receipt $receipt) {
		$data = request()->validate([
			'medicine_id' => ['required', 'integer', 'gte:0'],
			'quantity'    => ['required', 'numeric', 'integer', 'gte:1']
		]);
		$receipt->update($data);

		return redirect('/receipts');
	}

	public function destroy(Receipt $receipt) {
		// $nizZaDetatch = $receipt->medicines->pluck('pivot')->pluck('medicine_id');
		$receipt->medicines()->detach();
		$receipt->delete();
		return back()->with(['message' => 'Uspješno Izbrisan Račun.']);
	}

	public function medicineNumber(Request $request) {
		$data = $request->validate([
			'medicinesNumber' => ['required', 'numeric', 'integer','gte:1']
		]);
		session(['medicinesNumber' => $data['medicinesNumber']]);
		return $this->create();
	}

	public function sort($parametar) {
		session(['recOrder' => $parametar]);
		session('recSort') == 'ASC' ? session(['recSort' => 'DESC']) : session(['recSort' => 'ASC']);
		return redirect('/receipts');
	}

}
