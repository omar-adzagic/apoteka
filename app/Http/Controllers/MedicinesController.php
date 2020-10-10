<?php

namespace App\Http\Controllers;

use DB;
use App\Medicine;
use App\MedicineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class MedicinesController extends Controller
{
	protected $tip_lijeka = false;
	public function __construct() {
		// session(['tip_lijeka' => false]);
		$this->middleware('auth');
		$this->middleware('prodavacAuth')->except(['index', 'sort']);
	}

	public function index() {
		// session()->forget(['medOrder', 'tip_lijeka']);
		// session(['tip_lijeka' => false]);

		empty(session('medOrder')) ? session(['medOrder' => 'id']) : null;
		empty(session('medSort')) ? session(['medSort' => 'ASC']) : null;

		$search = request('search');
		if(! empty($search)) {
			$medicines = Medicine::search($search);
			// dd($medicines);
			return view('medicines.index', compact('medicines', 'search'));
		}
		$medicines = Medicine::sortMedicineType();

		return view('medicines.index', compact('medicines'));
	}

	public function show(Medicine $medicine) {
		return view('medicines.show', compact('medicine'));
	}

	public function create() {
		$medicineTypes = MedicineType::orderBy('name', 'ASC')->get();
		return view('medicines.create', compact('medicineTypes'));
	}

	public function store(Request $request) {
		$data = request()->validate([
			'name' => ['required', 'min:2'],
			'price' => ['required', 'numeric', 'gt:0'],
			'medicine_type_id' => ['required', 'integer', 'gte:0'],
		]);

		$data['kolicina'] = 0;

		// $medicines = Medicine::all()->pluck('name');
		// $medicines->transform(function($item, $key) {
		// 	return strtolower($item);
		// });

		$medicines = Medicine::medicinesNazivi();
		if($medicines->contains(strtolower($data['name']))) {
			return redirect()
				->back()
				->withErrors(['name' => 'Lijek sa datim nazivom već postoji.', ])
				->with([
					'oldName' => $data['name'],
					'oldPrice' => $data['price'],
					'oldTypeId' => $data['medicine_type_id'],
					'oldTypeName' => MedicineType::find($data['medicine_type_id'])->name,
				]);
		}

		Medicine::create($data);
		return redirect('/medicines')->with(['message' => 'Uspješno Dodat Lijek.']);
	}

	public function edit(Medicine $medicine) {
		$medicineTypes = MedicineType::all();
		return view('medicines.edit', compact('medicine', 'medicineTypes'));
	}

	public function update(Request $request, Medicine $medicine) {
		$data = request()->validate([
			'name' => ['required', 'min:2'],
			'original_name' => ['required'],
			'price' => ['required', 'numeric', 'gt:0'],
			'medicine_type_id' => ['required', 'integer', 'gte:0'],
		]);

		$medicines = Medicine::medicinesNazivi();

		$mala_slova_naziv = Str::lower($data['name']);
		$mala_slova_original = Str::lower($data['original_name']);
		if($medicines->contains($mala_slova_naziv) && $mala_slova_naziv != $mala_slova_original) {
			return redirect()
				->back()
				->withErrors(['name' => 'Lijek sa datim nazivom već postoji.'])
				->with(['oldName' => $data['name']])
				->with(['oldPrice' => $data['price']]);
		}

		unset($data['original_name']);

		$medicine->update($data);
		return redirect('/medicines')->with(['message' => 'Uspješno Izmijenjen Lijek.']);
	}

	public function destroy(Medicine $medicine) {
		$medicine->delete();
		return back()->with(['message' => 'Uspješno Izbrisan Lijek.']);
	}

	public function sort($parametar) {
		session(['medOrder' => $parametar]);
		session('medSort') == 'ASC' ? session(['medSort' => 'DESC']) : session(['medSort' => 'ASC']);
		return redirect('/medicines');
	}

}
