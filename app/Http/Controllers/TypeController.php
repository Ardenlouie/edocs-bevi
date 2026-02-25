<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Traits\SettingTrait;

use App\Http\Requests\TypeAddRequest;
use App\Http\Requests\TypeUpdateRequest;

class TypeController extends Controller
{
    use SettingTrait;

    public function index(Request $request)
    {
        $search = trim($request->get('search'));

        $types = Type::orderBy('created_at', 'DESC')
            ->when(!empty($search), function($query) use($search) {
                $query->where('prefix', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->paginate($this->getDataPerPage())
            ->appends(request()->query());

        return view('pages.types.index')->with([
            'search' => $search,
            'types' => $types
        ]);
    }

    public function create() {
        return view('pages.types.create');
    }

    public function store(TypeAddRequest $request) {

        $type = new Type([
            'prefix' => $request->prefix,
            'description' => $request->description,
            'record_year' => $request->record_year,
            'sequence' => $request->sequence,
        ]);
        $type->save();

        // logs
        activity('created')
            ->performedOn($type)
            ->log(':causer.name has created type :subject.description');

        return redirect()->route('type.index')->with([
            'message_success' => __('Type successfully created.')
        ]);
    }

    public function edit($id) {
        $type = Type::findOrFail(decrypt($id));

        return view('pages.types.edit')->with([
            'type' => $type
        ]);
    }

    public function update(TypeUpdateRequest $request, $id) {
        $type = Type::findOrFail(decrypt($id));

        $changes_arr['old'] = $type->getOriginal();

        $type->update([
            'prefix' => $request->prefix,
            'description' => $request->description,
            'record_year' => $request->record_year,
            'sequence' => $request->sequence,
        ]);
        $type->save();

        $changes_arr['changes'] = $type->getChanges();

        // logs
        activity('updated')
            ->performedOn($type)
            ->withProperties($changes_arr)
            ->log(':causer.name has updated type :subject.description');

        return back()->with([
            'message_success' => __('Type successfully updated.')
        ]);
    }

}
