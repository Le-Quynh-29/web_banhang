<?php

namespace App\Http\Controllers;

use App\Repositories\VoucherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VoucherController extends Controller
{
    protected $voucherRepo;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->voucherRepo = $voucherRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(! Gate::allows('pmss--voucher-index'),403);
        $vouchers = $this->voucherRepo->getListVoucher($request, false);
        return view('voucher/index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
