<?php

namespace App\Http\Controllers;

use App\Actions\CalculateExpression;
use App\Actions\GetHistoryByUserId;
use App\Http\Requests\CalculatorRequest;
use App\Models\Calculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use InvalidArgumentException;
use PDOException;

class CalculatorController extends Controller
{
    public function __construct(
        protected CalculateExpression $calculateExpression,
        protected GetHistoryByUserId $getHistoryByUserId,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia('Dashboard/Calculator', [
            'history' => $this->getHistoryByUserId->handle(auth()->user()->id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalculatorRequest $request)
    {
        try {
            $result = $this->calculateExpression->handle($request->expression);
            if (isset($result)) {
                Calculator::create([
                    'user_id' => auth()->user()->id,
                    'expression' => $request->expression,
                    'result' => $result,
                ]);
            }

            return Redirect::back()->with(['result' => $result]);
        } catch (InvalidArgumentException $e) {

            return Redirect::back()->withErrors(['expression' => $e->getMessage()]);
        } catch (PDOException $e) {

            return Redirect::back()->withErrors(['expression' => 'Value is not supported']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Calculator $calculator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calculator $calculator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calculator $calculator)
    {
        //
    }
}
