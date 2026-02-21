<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\ILibrary;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    protected ILibrary $library;

    public function __construct(ILibrary $library)
    {
        $this->library = $library;
    }

    public function index()
    {
      return $this->library->index();
    }

    public function create()
    {
        return $this->library->create();
    }

    public function store(Request $request)
    {
        return $this->library->store($request);
    }

    public function edit($id)
    {
        return $this->library->edit($id);
    }


    public function update(Request $request)
    {
        return $this->library->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->library->destroy($request);
    }

    public function downloadAttachment($filename)
    {
        return $this->library->download($filename);
    }
}