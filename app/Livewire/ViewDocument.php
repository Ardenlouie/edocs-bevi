<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Edoc;
use App\Models\Department;

class ViewDocument extends Component
{
    public $edoc_id, $edocs, $department_prefix;

    protected $listeners = [
        'setViewEdocs' => 'setViewEdocs'
    ];

    public function mount() 
    {
        $this->reset(['edocs']);

    }

    public function setViewEdocs($data)
    {     

        $this->edoc_id = $data['id'];
        $this->edocs= Edoc::where('id', $this->edoc_id)->first();

        $department = Department::where('id', $this->edocs->department_id)->first();

        $this->department_prefix = $department->prefix;

        // activity('view')
        //     ->performedOn($this->edocs)
        //     ->log(':causer.name has viewed edoc :subject.control_number');

    }

    public function render()
    {
        return view('livewire.view-document');
    }
}
