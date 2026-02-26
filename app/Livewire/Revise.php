<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use App\Models\Type;
use App\Models\Department;
use App\Models\Edoc;
use App\Models\Company;
use App\Helpers\FileSavingHelper;

class Revise extends Component
{
    use WithFileUploads;

    public $pdf, $now, $previewImage, $edocs, $department_id=1, $type_id=1, $company_id=1, 
    $control_number, $edoc_file, $company_name, $revision_number="000", $edoc_id, $confidential=true, $department_prefix, $title;

    protected $listeners = [
        'setReviseEdocs' => 'setReviseEdocs'
    ];

    public function setReviseEdocs($data)
    {   

        $edoc_id = $data['id'];
        $this->type_id = $data['type'];
        $this->department_id = $data['department'];

        $this->edoc_id = Edoc::where('id', $edoc_id)->first();

        $type = Type::where('id', $this->type_id)->first();
        $department = Department::where('id', $this->department_id)->first();

        $type_name = $type->prefix;
        $department_name = $department->prefix;
        $this->department_prefix = $department->prefix;

        
        $edoc = Edoc::withTrashed()->where('id', $edoc_id)->first();  
        if(!empty($edoc)) {

            $number = $edoc->revision_number + 1;

            $this->revision_number = str_pad($number, 3, '0', STR_PAD_LEFT);
        }

        

    }

    public function mount()
    {

    }

    public function render()
    {
        $company = Company::where('id', $this->company_id)->first();

        if($company->name == 'BEVI'){
            $this->company_name = 'bevi';
        } elseif($company->name == 'BEVA'){
            $this->company_name = 'beva';
        } elseif($company->name == 'BIGI'){
            $this->company_name = 'bigi';
        }

        
        $companies = Company::all();
        $companies_arr = [];
        foreach($companies as $company) {
            $companies_arr[$company->id] = $company->name;

        }

        $types = Type::all();
        $types_arr = [];
        foreach($types as $type) {
            $types_arr[$type->id] = $type->description;
        }

        $departments = Department::all();
        $departments_arr = [];
        foreach($departments as $department) {
            $departments_arr[$department->id] = $department->name;
        }

        if(!empty($this->edoc_id)) {
            $this->control_number = $this->edoc_id->control_number;
        }


        return view('livewire.revise')->with([
            'companies' => $companies_arr,
            'types' => $types_arr,
            'departments' => $departments_arr,
        ]);
    }
}
