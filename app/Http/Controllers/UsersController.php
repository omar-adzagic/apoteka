<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('seller-auth');
	}

	public function index() {
		empty(session('userOrder')) ? session(['userOrder' => 'id']) : null;
		empty(session('userSort')) ? session(['userSort' => 'ASC']) : null;

		$users = User::orderBy(session('userOrder'),session('userSort'))->paginate(6);
		return view('users.index', compact('users'));
	}

	public function create() {
		$roles = Role::all();
		return view('users.create', compact('roles'));
	}

	public function show(User $user) {

	}

	public function store(Request $request) {
		$data = request()->validate([
			'role_id' => ['required'],
			'name' => ['required'],
			'surname' => ['required'],
			'email' => ['required', 'email'],
			'password' => ['required', 'min:6' ,'confirmed'],
		]);
		$data['password'] = Hash::make($data['password'], ['rounds' => 12]);

		User::create($data);
		session()->flash('message', 'User is successfully stored.');
		return redirect('/users');
	}

	public function edit(User $user) {
		$roles = Role::all();
		return view('users.edit', compact('user', 'roles'));
	}

	public function update(Request $request, User $user) {
		$data = $request->validate([
			'role_id' => ['required'],
			'name' => ['required', 'min:2'],
			'surname' => ['required', 'min:2'],
			'email' => ['required', 'email']
		]);

		if(!empty($request['password'])) {
			$data['password'] = $request['password'];
			$request->validate([
				'password' => ['required', 'min:6' , 'confirmed']
			]);
			$data['password'] = Hash::make($data['password'], ['rounds' => 12]);
		}

		$user->update($data);
		session()->flash('message', 'User is updated successfully.');
		return redirect('/users');
	}

	public function destroy(User $user) {
		$user->delete();
		session()->flash('message', 'User is deleted successfully.');
		return redirect('/users');
	}

	public function sort($parametar) {
		session(['userOrder' => $parametar]);
		session('userSort') == 'ASC' ? session(['userSort' => 'DESC']) : session(['userSort' => 'ASC']);
		return redirect('/users');
	}
}
