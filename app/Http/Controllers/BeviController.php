<?php

namespace App\Http\Controllers;

use App\Models\Bevi;
use Illuminate\Http\Request;
use App\Http\Requests\BeviAddRequest;
use App\Http\Requests\EdocUpdateRequest;
use App\Models\Edoc;
use App\Models\Company;
use App\Models\Department;
use App\Models\Type;
use App\Helpers\FileSavingHelper;
use Carbon\Carbon;
use Auth;

class BeviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.bevi.index')->with([
        ]);
    }

    public function admin()
    {
        return view('pages.bevi.admin')->with([
        ]);
    }

    public function it()
    {
        return view('pages.bevi.it')->with([
        ]);
    }

     public function local()
    {
        return view('pages.bevi.local')->with([
        ]);
    }

     public function global()
    {
        return view('pages.bevi.global')->with([
        ]);
    }

     public function marketing()
    {
        return view('pages.bevi.marketing')->with([
        ]);
    }

     public function finance()
    {
        return view('pages.bevi.finance')->with([
        ]);
    }

     public function scm()
    {
        return view('pages.bevi.scm')->with([
        ]);
    }

     public function npd()
    {
        return view('pages.bevi.npd')->with([
        ]);
    }

     public function ecom()
    {
        return view('pages.bevi.ecom')->with([
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BeviAddRequest $request)
    {
        $user_id = Auth::user()->id;

        $edocs = new Edoc([
            'control_number' => $request->control_number,
            'reference_number' => $request->reference_number,
            'type_id' => $request->type_id,
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'user_id' => $user_id,
            'revision_number' => $request->revision_number,
            'date_effectivity' => $request->date_effectivity,
            'remarks' => $request->remarks,
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $edocs->save();

        if(!empty($request->file_name)) {
            $request->validate([
                'file_name' => 'required|mimes:pdf|max:10240',
            ]);

            $path = NULL;
            $nameWithExtension = $request->file_name->getClientOriginalName();

            $path = FileSavingHelper::saveFile($request->file_name, $edocs->id, 'edocs');

            $edocs->update([
                'path' => $path,
                'file_name' => $nameWithExtension,
            ]);

        }

        // logs
        activity('created')
            ->performedOn($edocs)
            ->log(':causer.name has created edoc :subject.control_number');

        return redirect()->route('home')->with([
            'message_success' => 'Edocs '.$edocs->control_number.' has been successfully created.'
        ]);
    }

    public function revise(BeviAddRequest $request)
    {
        $user_id = Auth::user()->id;

        $last_edoc = Edoc::withTrashed()->where('control_number', $request->control_number)->where('status', 'active')->first();  
        if(!empty($last_edoc)) {

            $last_edoc->update([
                'status' => 'inactive',
            ]);
        
        }

        $revise_edocs = new Edoc([
            'control_number' => $request->control_number,
            'reference_number' => $request->reference_number,
            'type_id' => $request->type_id,
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'user_id' => $user_id,
            'revision_number' => $request->revision_number,
            'date_effectivity' => $request->date_effectivity,
            'remarks' => $request->remarks,
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $revise_edocs->save();


        if(!empty($request->file_name)) {
            $request->validate([
                'file_name' => 'required|mimes:pdf|max:10240',
            ]);

            $path = NULL;
            $nameWithExtension = $request->file_name->getClientOriginalName();

            $path = FileSavingHelper::saveFile($request->file_name, $revise_edocs->id, 'edocs');

            $revise_edocs->update([
                'path' => $path,
                'file_name' => $nameWithExtension,
            ]);
        }
        

        

        // logs
        activity('created')
            ->performedOn($revise_edocs)
            ->log(':causer.name has revise edoc :subject.control_number');

        return redirect()->route('home')->with([
            'message_success' => 'Edocs '.$revise_edocs->control_number.' has been successfully created.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bevi $bevi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edoc = Edoc::findOrFail(decrypt($id));
        $effectivityDate = Carbon::parse($edoc->date_effectivity)->format('Y-m-d');

        $companies = Company::all();
        $companies_arr = [];
        foreach($companies as $company) {
            $companies_arr[$company->id] = $company->name;

        }

        $status_arr = [
            'active' => 'Active ',
            'inactive' => 'Inactive',
            'approval' => 'For Approval',
        ];



        return view('pages.bevi.edit')->with([
            'edoc' => $edoc,
            'companies' => $companies_arr,
            'effectivityDate' => $effectivityDate,
            'status_arr' => $status_arr,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdocUpdateRequest $request, $id)
    {
        $edoc = Edoc::findOrFail(decrypt($id));

        $changes_arr['old'] = $edoc->getOriginal();

        $edoc->update([
            'company_id' => $request->company_id,
            'date_effectivity' => $request->date_effectivity,
            'remarks' => $request->remarks,
            'title' => $request->title,
            'status' => $request->status,
            'reference_number' => $request->reference_number,
            'validity_date' => $request->validity_date,

        ]);

        $changes_arr['changes'] = $edoc->getChanges();


        if(!empty($request->file_name)) {
            $request->validate([
                'file_name' => 'required|mimes:pdf|max:5120',
            ]);

            $path = NULL;
            $nameWithExtension = $request->file_name->getClientOriginalName();

            $path = FileSavingHelper::saveFile($request->file_name, $edoc->id, 'edocs');

            $edoc->update([
                'path' => $path,
                'file_name' => $nameWithExtension,
            ]);
        }

        

        // logs
        activity('updated')
            ->performedOn($edoc)
            ->withProperties($changes_arr)
            ->log(':causer.name has updated edoc :subject.control_number');

        return back()->with([
            'message_success' => 'Edocs '.$edoc->control_number.' has been successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bevi $bevi)
    {
        //
    }
}
