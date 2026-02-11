<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\Edoc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $forms = Edoc::where('type_id', 1)->count();
        $contract = Edoc::where('type_id', 2)->count();
        $sop = Edoc::where('type_id', 3)->count();
        $policy = Edoc::where('type_id', 4)->count();
        $work_instructions = Edoc::where('type_id', 5)->count();
        $others = Edoc::where('type_id', 6)->count();
        $active_edocs = Edoc::orderBy('created_at', 'desc')->get()->take(10);

        return view('home')->with([
            'forms' => $forms,
            'contract' => $contract,
            'sop' => $sop,
            'policy' => $policy,
            'work_instructions' => $work_instructions,
            'others' => $others,
            'active_edocs' => $active_edocs,
            
        ]);
    }
}
