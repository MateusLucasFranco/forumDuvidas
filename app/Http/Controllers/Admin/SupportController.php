<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 6),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];
        
        return view('admin.supports.index', compact('supports', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Support $support)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index')->with('message', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }
        
        return view('admin.supports.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupport $request, Support $support, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request),
        );

        if(!$support) {
            return back();
        }

        return redirect()->route('supports.index')->with('message', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index')->with('message', 'Deletado com sucesso!');
    }
}
