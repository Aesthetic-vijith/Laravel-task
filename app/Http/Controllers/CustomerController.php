<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function check_email(Request $request)
    {
        $email_exists = Customer::where('email', $request->email)->exists();
        return response()->json(['exists' => $email_exists]);
    }

    public function check_phone(Request $request)
    {
        $phone_exists = Customer::where('phone', $request->phone)->exists();
        return response()->json(['exists' => $phone_exists]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15|unique:customers,phone',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
        ];

        $messages = [
            'email.unique' => 'The email has already been taken.',
            'phone.unique' => 'The phone number has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);

        return back()->with('success', 'Customer added successfully');
    }
}
