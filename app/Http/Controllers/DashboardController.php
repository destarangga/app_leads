<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Lead;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); 

        $totalLeads = Lead::count();
        $takenLeads = Lead::where('taken_by_salesman', true)->count();
        $untakenLeads = Lead::where('taken_by_salesman', false)->count();

        return view('dashboard', compact('user', 'totalLeads', 'takenLeads', 'untakenLeads'));
    }

}
