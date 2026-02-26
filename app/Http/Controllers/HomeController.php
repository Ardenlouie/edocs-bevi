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
        $forms = Edoc::where('type_id', 1)->count();
        $contract = Edoc::where('type_id', 2)->count();
        $sop = Edoc::where('type_id', 3)->count();
        $policy = Edoc::where('type_id', 4)->count();
        $work_instructions = Edoc::where('type_id', 5)->count();
        $others = Edoc::where('type_id', 6)->count();

        $search = $request->input('search');

        $active_edocs = Edoc::orderBy('created_at', 'DESC')
            ->where('status', 'active')
            ->where(function ($query) {
                $query->where('confidential', 0);
            })
            
            ->when(!empty($search), function($query) use($search) {
                $query->where(function($q) use($search) {
                    $q->where('control_number', 'like', "%$search%")
                    ->orWhere('remarks', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%")
                    ->orWhereHas('department', function($d) use($search) {
                            $d->where('name', 'like', "%$search%");
                        })
                    ->orWhereHas('user', function($u) use($search) {
                            $u->where('name', 'like', "%$search%");
                        });
                });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('pages.bigi.partials', compact('active_edocs'))->render();
        }

        return view('home', compact('active_edocs'))->with([
            'forms' => $forms,
            'contract' => $contract,
            'sop' => $sop,
            'policy' => $policy,
            'work_instructions' => $work_instructions,
            'others' => $others,
            'search' => $search,
            
        ]);
    }
}
