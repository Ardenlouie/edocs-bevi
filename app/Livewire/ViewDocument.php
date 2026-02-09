<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Edoc;

class ViewDocument extends Component
{
    public $edoc_id, $edocs;

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

    }

    public function render()
    {


        $this->edocs= Edoc::where('id', $this->edoc_id)->first();

        return view('livewire.view-document');
    }
}
