<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeesRequest;
use App\Repository\IFees;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected IFees $fees;

    public function __construct(IFees $fees) {
        $this->fees = $fees;
    }

    public function index() {
       return $this->fees->index();
    }

    public function create() {
       return $this->fees->create();
    }

    public function update($id) {
       return $this->fees->update($id);
    }

    public function destroy($id) {
       return $this->fees->destroy($id);
    }

    public function store(StoreFeesRequest $request) {
       return $this->fees->store($request);
    }
}
