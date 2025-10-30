<?php

namespace App\Http\Controllers;

use App\Models\Calculator;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calculator');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $value1 = $request->value1;
        $value2 = $request->value2;

        $results = 0;
        switch ($request->simbol) {
            case '*':
                $results = $value1 * $value2;
                break;
            case '/':
                $results = $value2 != 0 ? $value1 / $value2 : 0;
                break;
            case '+':
                $results = $value1 + $value2;
                break;
            case '-':
                $results = $value1 - $value2;
                break;

            default:
                # code...
                break;
        }
        Calculator::create([
            "value1" => $value1,
            "simbol" => $request->simbol,
            "value2" => $value2,
            "results" => $results
        ]);

        return view('calculator', compact('results'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
