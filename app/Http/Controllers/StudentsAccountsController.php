<?php

namespace App\Http\Controllers;

use App\Models\StudentsAccounts;
use App\Repository\IStudentsAccounts;
use Illuminate\Http\Request;

class StudentsAccountsController extends Controller
{

    protected IStudentsAccounts $studentsAccounts;

    public function __construct(IStudentsAccounts $studentsAccounts) {
        $this->studentsAccounts = $studentsAccounts;
    }
   
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(StudentsAccounts $studentsAccounts)
    {
        //
    }

    
    public function edit(StudentsAccounts $studentsAccounts)
    {
        //
    }

    
    public function update(Request $request, StudentsAccounts $studentsAccounts)
    {
        //
    }

   
    public function destroy(StudentsAccounts $studentsAccounts)
    {
        //
    }
}
