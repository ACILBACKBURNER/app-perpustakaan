<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return 'BookController@index';
    }

    public function create()
    {
        return 'BookController@create';
    }

    public function store(Request $request)
    {
        return 'BookController@store';
    }

    public function show(string $id)
    {
        return "BookController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "BookController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "BookController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "BookController@destroy, id: {$id}";
    }
}