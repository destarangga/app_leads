<?php

namespace App\Http\Controllers;
use App\Models\Lead;

class AdminController extends Controller
{
    public function reportLeads()
    {
        $leads = Lead::with(['salesman'])->get();
        return response()->json($leads);
    }
}
