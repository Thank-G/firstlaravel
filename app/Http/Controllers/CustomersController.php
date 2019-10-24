<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Company;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
   public function index()
   {
       $companies = Company::all();
       $activeCustomers = Customer::active()->get();
       $inactiveCustomers = Customer::inactive()->get();
       
       return view('customers.index', compact('activeCustomers','inactiveCustomers', 'companies'));
    }
    
    public function create()
    {
        $companies = Company::all();

       return view('customers.create', compact('companies'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]);

        Customer::create($data);
 
        return redirect('/customers/all');
       
    }

}