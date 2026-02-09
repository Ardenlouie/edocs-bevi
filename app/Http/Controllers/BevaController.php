<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bevi;
use App\Http\Requests\BeviAddRequest;
use App\Models\Edoc;
use App\Helpers\FileSavingHelper;


class BevaController extends Controller
{
    public function index()
    {

        return view('pages.beva.index')->with([


        ]);
    }

     public function store(Request $request)
    {
        $edocs = new Edoc([
            'control_number' => $request->control_number,
            'reference_number' => $request->reference_number,
            'type_id' => $request->type_id,
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'revision_number' => $request->revision_number,
            'file_name' => $request->file_name,
            'date_effectivity' => $request->date_effectivity,
            'validity_date' => $request->validity_date,
            'status' => $request->status,
        ]);
        $edocs->save();

        if(!empty($request->file_name)) {
            $request->validate([
            'file_name' => 'required|mimes:pdf|max:10240',
            ]);

            $path = NULL;

            $path = FileSavingHelper::saveFile($request->file_name, $edocs->id, 'edocs');

            $edocs->update([
                'path' => $path,
            ]);

        }
        

        // logs
        activity('created')
            ->performedOn($edocs)
            ->log(':causer.name has created edocs :subject.name');

        return redirect()->route('beva.index')->with([
            'message_success' => 'Edocs '.$edocs->control_number.' has been successfully created.'
        ]);
    }
}
