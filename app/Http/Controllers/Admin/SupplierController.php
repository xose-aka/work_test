<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $suppliers = Supplier::query()->paginate(8);
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * @param StoreSupplierRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function store(StoreSupplierRequest $request)
    {
        $callback = Supplier::query()->create($request->validated());

        if (is_null($callback))
            return back()->with(['error' => 'Something went wrong!']);

        return redirect()->route('admin.supplier.index')->with(['success' => 'Saved!']);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $supplier = Supplier::query()->findOrFail($id);
        return view('admin.supplier.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::query()->findOrFail($id);
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->file('file')->getErrorMessage());
        $request->validate([
            'title' => 'required',
            'slug'  => 'required'
        ]);

        $supplier = Supplier::query()->findOrFail($id);

        $callback = $supplier->update([
            'title' => $request->input('title'),
            'slug'  => $request->input('slug')
        ]);

        if ($callback) {
            if ($request->hasFile('file')) {
                $supplierService = SupplierService::getInstance();

                $supplierService->supplierCatalogStore($request->file('file'), $id);
            }
        }

        return redirect()->route('admin.supplier.index')->with(['success' => 'Successfully updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
