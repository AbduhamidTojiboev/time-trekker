<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Http\Requests\Employee\ImportEmployeeRequest;
use App\Imports\Csv\ImportEmployee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function __construct(protected EmployeeRepositoryContract $employeeRepositoryContract)
    {

    }
    public function index(Request $request): Factory|View
    {
        $data = $this->employeeRepositoryContract->paginate($request);
        return view('employee.index', compact('data'));
    }

    public function showImport(): Factory|View
    {
        return view('employee.import');
    }

    public function import(ImportEmployeeRequest $request, ImportEmployee $importEmployee): RedirectResponse
    {
        $data = $request->validated();
        $importEmployee->importFile($data['file']);

        return redirect()->back()->with('status', 'The employees were successfully imported.');
    }

}
