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

class UploadDocument extends Component
{
    use WithFileUploads;

    public $pdf, $now, $previewImage, $edocs, $department_id=1, $type_id=1, $company_id=1, 
    $control_number, $edoc_file, $company_name, $revision_number='000';


    protected $listeners = [
        'setUploadEdocs' => 'setUploadEdocs'
    ];


    public function setUploadEdocs($data)
    {   

        $this->type_id = $data['id'];
        $this->department_id = $data['department'];

        $type = Type::where('id', $this->type_id)->first();
        $department = Department::where('id', $this->department_id)->first();

        $type_name = $type->prefix;
        $department_name = $department->prefix;
        

    }


    private function generateControlNumber() {
        $type = Type::where('id', $this->type_id)->first();
        $department = Department::where('id', $this->department_id)->first();

        $type_name = $type->prefix;
        $department_name = $department->prefix;

        do {
            $control_number = $type_name.'001-'.$department_name;
            // get the most recent sales order
            $edoc = Edoc::withTrashed()->where('type_id', $this->type_id)->where('department_id', $this->department_id)->orderBy('control_number', 'DESC')
                ->first();  
            if(!empty($edoc)) {
                $latest_control_number = $edoc->control_number;
                list($type, $last_number, $department) = explode('-', $latest_control_number);
                // Increment the number based on the date
                $number = ($type_name == "$type-" && $department == $department_name) ? ((int)$last_number + 1) : 1;

                // Format the number with leading zeros
                $formatted_number = str_pad($number, 3, '0', STR_PAD_LEFT);

                // Construct the new control number
                $control_number = $type_name."$formatted_number-$department_name";
            }

        } while(Edoc::withTrashed()->where('type_id', $this->type_id)->where('department_id', $this->department_id)->where('control_number', $control_number)->exists());

        return $control_number;

        
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

        $this->control_number = $this->generateControlNumber();

 
        

        return view('livewire.upload-document')->with([
            'companies' => $companies_arr,
            'types' => $types_arr,
            'departments' => $departments_arr,
        ]);
    }

}
