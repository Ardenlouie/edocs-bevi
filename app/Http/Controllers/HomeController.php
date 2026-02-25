<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\Edoc;
use App\Http\Traits\SettingTrait;

class HomeController extends Controller
{
    use SettingTrait;

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
    public function index(Request $request)
    {
        $search = trim($request->get('search'));

        $forms = Edoc::where('type_id', 1)->count();
        $contract = Edoc::where('type_id', 2)->count();
        $sop = Edoc::where('type_id', 3)->count();
        $policy = Edoc::where('type_id', 4)->count();
        $work_instructions = Edoc::where('type_id', 5)->count();
        $others = Edoc::where('type_id', 6)->count();

        $active_edocs = Edoc::orderBy('created_at', 'DESC')
            ->when(!empty($search), function($query) use($search) {
                $query->where('control_number', 'like', '%'.$search.'%')
                    ->orWhere('remarks', 'like', '%'.$search.'%')
                    ->orWhere('title', 'like', '%'.$search.'%');
            })
            ->paginate($this->getDataPerPage())
            ->appends(request()->query());

        return view('home')->with([
            'forms' => $forms,
            'contract' => $contract,
            'sop' => $sop,
            'policy' => $policy,
            'work_instructions' => $work_instructions,
            'others' => $others,
            'active_edocs' => $active_edocs,
            'search' => $search,
            
        ]);
    }
}
