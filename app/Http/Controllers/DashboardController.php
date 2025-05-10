<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\NewLead;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); 

        $totalLeads = NewLead::count();

        return view('dashboard', compact('user', 'totalLeads'));
    }

}
