<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Models\Company;
use App\Models\Worker;
use App\Services\PortrayPhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    public function index() {

        $workers_arr = Worker::with('companies')->get([
            'id',
            'name',
            'email',
            'phone'
        ])->toArray();

        $workers = collect($workers_arr)->map(function ($item) {

            $item['company'] = $item['companies'] ? $item['companies'][0]['name'] : '';
            return $item;
        });

        $workers_json = $workers->toJson();
        return view('admin/workers/index', compact('workers_json'));
    }

    public function show($id) {

        $worker = Worker::findOrFail($id);
        $companies = $worker->companies()->get(['companies.id', 'logo_url', 'companies.name', 'companies.email', 'address']);
        return view('admin/workers/show', compact('worker', 'companies'));
    }

    public function edit($id) {

        $worker = Worker::findOrFail($id);
        $companies = $worker->companies()->get(['companies.id', 'logo_url', 'companies.name', 'companies.email', 'address']);
        $method = 'PUT';
        return view('admin/workers/edit', compact('worker', 'companies', 'method'));
    }

    public function update(WorkerRequest $request, $id) {

        $worker = Worker::find($id);
        $worker->update($request->all());
        return redirect('/admin/workers');
    }

    public function create() {

        return view('admin/workers/create');
    }

    public function store(WorkerRequest $request) {

        Worker::create($request->all());
        return redirect('/admin/workers');
    }

    public function destroy($id) {

        $worker = Worker::find($id);

        if($worker) {
            $worker->delete();
            return 'worker ' . $id . ' has been deleted';
        }
    }
}
