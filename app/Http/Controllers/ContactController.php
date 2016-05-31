<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\Contact;

class ContactController extends Controller
{

	public function index(Request $request)
	{
		return view('contact');
	}

	public function post(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'phone_number' => 'required|numeric|min:5',
			'message' => 'required|min:10',
		]);

		if ($validator->fails()) {
			return redirect('contact')
				->withErrors($validator)->withInput();
		}

		$input=$request->all();
		$contact=new Contact($input);
		$contact->save();

		return view('contact');

	}
}
