<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Worker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Image\ImageContract;

class CompanyController extends Controller
{
    public function index() {

        $companies = Company::all(['id', 'logo_url', 'name', 'email', 'address'])->toJson();
        return view('admin/companies/index', compact('companies'));
    }

    public function show($id) {

        $company = Company::findOrFail($id);
        $workers_in_company = $company->workers()->get(['workers.id', 'name', 'email', 'phone'])->toJson();
        $coordinate = $company->coordinates()->first();
        return view('admin/companies/show', compact('company', 'coordinate', 'workers_in_company'));
    }

    public function edit($id) {

        $company = Company::findOrFail($id);
        $workers_in_company = $company->workers()->get(['workers.id', 'name', 'email', 'phone'])->toJson();
        $workers = Worker::all();
        $coordinate = $company->coordinates()->first();
        $method = 'PUT';
        return view('admin/companies/edit', compact('company', 'workers', 'coordinate', 'workers_in_company', 'method'));
    }

    public function update(CompanyRequest $request, $id) {

        $company = Company::find($id);
        $input = $request->all();

        if($request->has('logo_url')) {
            $path = $this->storeImage($request);
            $input['logo_url'] = $path;
        }
        $company->update($input);
        $this->syncWorkers($company, $request->workers_in_company);
        if($request->has('latitude') && $request->has('longitude')) {
            $company->coordinates()->update($request->only(['latitude', 'longitude']));
        }
        return redirect('/admin/companies');
    }

    public function destroy($id) {

        $company = Company::find($id);
        if($company) {
            $company->delete();
            return 'company ' . $id . ' has been deleted';
        }
    }

    public function store(CompanyRequest $request) {

        $input = $request->all();

        if($request->has('logo_url')) {
            $path = $this->storeImage($request);
            $input['logo_url'] = $path;
        }
        $company = Company::create($input);
        $this->syncWorkers($company, $request->workers_in_company);

        if($request->has('latitude') && $request->has('longitude')) {
            $company->coordinates()->create($request->only(['latitude', 'longitude']));
        }
        return redirect('/admin/companies');
    }

    protected function storeImage($request) {

        $url = $request->file('logo_url')->store('company_images', 'public');
        $path_origin = Storage::disk('public')->path($url);
        $pattern = '/(\.[0-9a-z]{1,5})$/i';
        $repl = '_l' . '$1';
        $new_url = preg_replace($pattern, $repl, $url);
        $new_path = Storage::disk('public')->path($new_url);
        $imageManager = App::make(ImageContract::class);
        $imageManager->make($path_origin)->resize(200, 200)->save($new_path);
        return $new_url;
    }

    public function create(Company $company) {

        $workers = Worker::all();
        $coordinate = null;
        $workers_in_company = null;
        $method = 'POST';
        return view('admin/companies/edit', compact('company', 'workers', 'coordinate', 'workers_in_company', 'method'));
    }

    public function syncWorkers(Company $company, $workers_in_company) {

        $workers = [];

        if($workers_in_company && is_string($workers_in_company)) {
            $workers = explode(',', $workers_in_company);
        }
        $company->workers()->sync($workers);
    }
}
