<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicineType;
use App\Medicine;

class MedicineTypesController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('prodavacAuth');
	}

	public function index() {
		empty(session('medTypeOrder')) ? session(['medTypeOrder' => 'id']) : null;
		empty(session('medTypeSort')) ? session(['medTypeSort' => 'ASC']) : null;

		$medicineTypes = MedicineType::orderBy(session('medTypeOrder'), session('medTypeSort'))->paginate(6);
		$medicines = Medicine::all();
		return view('medicineTypes.index', compact('medicineTypes', 'medicines'));
	}

	public function create() {
		return view('medicineTypes.create');
	}

	public function show(MedicineType $medicineType) {

	}

	public function store(Request $request) {
		$data = request()->validate(['naziv' => 'required']);
		$medicineTypes = MedicineType::namesLowerCase();
		if($medicineTypes->contains(strtolower($data['naziv']))) {
			return redirect()->back()
				->withErrors(['naziv' => 'Tip lijeka sa datim nazivom već postoji.'])
				->with(['stariNaziv' => $data['naziv']]);
		}
		MedicineType::create($data);
		return redirect('/medicineTypes')->with(['message' => 'Uspješno Dodat Tip Lijeka.']);
	}

	public function edit(MedicineType $medicineType) {
		return view('medicineTypes.edit', compact('medicineType'));
	}

	public function update(Request $request, MedicineType $medicineType) {
		$data = request()->validate([
			'naziv'            => 'required',
			'originalni_naziv' => 'required'
		]);
		$medicineTypes = MedicineType::namesLowerCase();
		$malaSlovaNaziv = strtolower($data['naziv']);
		$malaSlovaOriginal = strtolower($data['originalni_naziv']);
		if($medicineTypes->contains($malaSlovaNaziv) && $malaSlovaNaziv != $malaSlovaOriginal) {
			return redirect()->back()
				->withErrors(['naziv' => 'Tip lijeka sa datim nazivom već postoji.'])
				->with(['stariNaziv' => $data['naziv']]);
		}
		unset($data['originalni_naziv']);
		$medicineType->update($data);
		return redirect('/medicineTypes')->with(['message' => 'Uspješno Izmijenjen Tip Lijek.']);
	}

	public function destroy(MedicineType $medicineType) {
		$medicineType->delete();
		return back()->with(['message' => 'Uspješno Izbrisan Tip Lijeka.']);
	}

	public function sort($parametar) {
		session(['medTypeOrder' => $parametar]);
		session('medTypeSort') == 'ASC' ? session(['medTypeSort' => 'DESC']) : session(['medTypeSort' => 'ASC']);
		return redirect('/medicineTypes');
	}
}
