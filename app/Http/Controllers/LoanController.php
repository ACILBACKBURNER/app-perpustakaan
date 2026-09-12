<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return 'LoanController@index';
    }

    public function create()
    {
        return 'LoanController@create';
    }

    public function store(Request $request)
    {
        return 'LoanController@store';
    }

    public function show(string $id)
    {
        return "LoanController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "LoanController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "LoanController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "LoanController@destroy, id: {$id}";
    }

    public function kembalikan(string $id)
    {
        return "LoanController@kembalikan, id: {$id}";
    }
}