<?php

namespace App\Http\Controllers;

use App\Models\ProcessingFees;
use App\Repository\IProcessingFees;
use Illuminate\Http\Request;

class ProcessingFeesController extends Controller
{

    protected IProcessingFees $processingFees;

    public function __construct(IProcessingFees $processingFees) {
        $this->processingFees = $processingFees;
    }
   
    public function index()
    {
        return $this->processingFees->index();
    }

    public function store(Request $request)
    {
        return $this->processingFees->store($request);
    }

    
    public function show($id)
    {
        return $this->processingFees->show($id);
    }

    
    public function edit($id)
    {
        return $this->processingFees->edit($id);
    }

    public function update(Request $request)
    {
        return $this->processingFees->update($request);
    }

    public function destroy($id)
    {
        return $this->processingFees->destroy($id);
    }
}
