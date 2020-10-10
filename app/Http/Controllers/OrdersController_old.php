<?php

namespace App\Http\Controllers;

use Validator;
use App\Order;
use App\Medicine;
use Illuminate\Http\Request;

class OrdersController_old extends Controller
{
	protected $brojLjekova;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('prodavacAuth');
	}

	public function index() {
		$orders = Order::all();
		$medicineIdevi = [];
		foreach($orders->pluck('medicine_id') as $json) {
			$medicineIdevi[] = json_decode($json);
		}

		$medicineNazivi = [];
		for($i = 0; $i < count($medicineIdevi); $i++) {
			$medidevi = $medicineIdevi[$i];
			for($j = 0; $j < count($medidevi); $j++) {
				$medicine = Medicine::findOrFail($medidevi[$j]);
				$medicineNazivi[$i][$j] = $medicine->naziv;
			}
		}

		$kolicine = [];
		foreach($orders->pluck('kolicina') as $json) {
			$kolicine[] = json_decode($json);
		}

		for($i = 0; $i < count($orders); $i++) {
			$orders[$i]['medicineNazivi'] = $medicineNazivi[$i];
			$orders[$i]['kolicine'] = $kolicine[$i];
		}

		return view('orders.index', compact('orders'));
	}

	public function create() {
		// dump('create metoda pogodjena, brojLjekova: ' . $this->brojLjekova);
		$medicines = Medicine::all();
		$brojLjekova = $this->brojLjekova;

		return view('orders.create', compact('medicines', 'brojLjekova'));
	}

	public function show(Medicine $medicine) {

	}

	public function store(Request $request) {
		$brLjekova = $request->input('brojLjekova');
		$request->request->remove('brojLjekova');
		$params = request()->all();

		$i = 0;
		$a = 0;
		$arr = [];

		foreach($params as $key => $value) {
			if($key == '_token') { continue; }
			$arr[$i][$key] = $value;
			$a += 0.5;
			$i = (int)floor($a);
		}

		$validationArr = [];
		foreach($params as $key => $val) {
			if($key == '_token') { continue; }
			$validationArr[$key] = 'required|numeric|integer|gt:0';
		}

		$validator = Validator::make($request->all(), $validationArr);

		if($validator->fails()) {
			return redirect('orders/create')
				->withErrors($validator)
				->withInput()
				->with(['medicines' => Medicine::all()])
				->with(['brojLjekova' => $brLjekova]);
		}

		foreach($arr as $lijekZaTreb) {
			foreach($lijekZaTreb as $key => $val) {
				if(substr($key, 0, 3) == 'med') {
					$medicine = Medicine::findOrFail($val);
				} else {
					$medicine->kolicina += $val;
					$medicine->save();
				}
			}
		}

		$simpleArr = [];
		foreach($arr as $array) {
			$simpleArr[] = array_values($array);
		}

		$medicineIdJSON = json_encode(array_column($simpleArr, 0));
		$data['medicine_id'] = $medicineIdJSON;
		$kolicinaJSON = json_encode(array_column($simpleArr, 1));
		$data['kolicina'] = $kolicinaJSON;

		// $data['iznos'] = $data['kolicina'] * $data['cijena'];
		Order::create($data);
		return redirect('/orders');
	}

	public function edit(Order $order) {
		// $medicines = Medicine::all();
		// dd($order);
		// return view('orders.edit', compact('order', 'medicines'));
	}

	public function update(Request $request, Order $order) {
		$data = request()->validate([
			'medicine_id' => ['required', 'integer', 'gte:0'],
			'kolicina'    => ['required', 'numeric', 'integer', 'gte:1'],
			// 'cijena'      => ['required', 'numeric', 'gt:0']
		]);
		// $data['iznos'] = $data['kolicina'] * $data['cijena'];
		$order->update($data);
		return redirect('/orders');
	}

	public function destroy(Order $order) {
		$order->delete();
		return back();
	}

	public function brojLjekova($brLjek = null, Request $request) {
		$data = request()->validate([
			'brojLjekova' => ['required', 'numeric', 'integer','gte:1']
		]);

		if(!empty($request->input('brojLjekova'))) {
			$data = $request->validate([
				'brojLjekova' => ['required', 'integer', 'gte:0']
			]);
		} else {
			$data['brojLjekova'] = $brljek;
		}

		$this->brojLjekova = $data['brojLjekova'];
		return $this->create();
	}
}
