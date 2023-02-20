<?php

namespace App\Http\Controllers;

use App\DataTables\ActivitiesDataTable;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(ActivitiesDataTable $dataTable)
    {
        return $dataTable->render('activities.index');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Activity::query()->create($this->activityRepo($data));

        session()->flash('success', 'Activities created successfully');

        return back();

    }

    public function edit(Activity $note)
    {
        return ['note' => $note];
    }

    public function update(Request $request, Activity $note)
    {

    }

    public function delete(Activity $note)
    {
        return $note;
    }

    public function activityRepo($data)
    {
        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => 'pending',
            'user_id' => auth()->user()->id,
        ];
    }
}
