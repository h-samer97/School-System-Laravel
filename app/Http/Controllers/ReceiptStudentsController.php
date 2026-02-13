<?php

namespace App\Http\Controllers;

use App\Models\ReceiptStudents;
use App\Repository\IReceiptStudents;
use Illuminate\Http\Request;

class ReceiptStudentsController extends Controller
{
    protected IReceiptStudents $rs;

    public function __construct(IReceiptStudents $rs) {
        $this->rs = $rs;
    }
    public function index()
    {
        return $this->rs->index();
    }

    public function store(Request $request)
    {
        return $this->rs->store($request);
    }

    public function show(int $id)
    {
        return $this->rs->show($id);
    }

    public function edit(int $id)
    {
        return $this->rs->edit($id);
    }
    public function update(Request $request)
    {
        return $this->rs->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->rs->destroy($request);
    }
}
