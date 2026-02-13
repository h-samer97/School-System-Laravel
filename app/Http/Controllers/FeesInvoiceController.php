<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeesInvoicesRequest;
use App\Models\FeesInvoice;
use App\Repository\IFeesInvoices;
use Illuminate\Http\Request;

class FeesInvoiceController extends Controller
{

protected IFeesInvoices $f_invoices;

    public function __construct(IFeesInvoices $f_invoices) {
        $this->f_invoices = $f_invoices;
    }
   
    public function index()
    {
        return $this->f_invoices->index();
    }

   
    public function create()
    {
        //
    }

    
    public function store(StoreFeesInvoicesRequest $request)
    {
        return $this->f_invoices->store($request);
    }

   
    public function show($id)
    {
        $this->f_invoices->show($id);
    }

    
    public function edit(FeesInvoice $feesInvoice)
    {
        //
    }

    
    public function update(Request $request, FeesInvoice $feesInvoice)
    {
        //
    }

    public function destroy(FeesInvoice $feesInvoice)
    {
        //
    }
}
