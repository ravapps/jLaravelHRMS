<?php

namespace App\Http\Controllers;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;

class SitemanagementController extends Controller
{
  public function index()
  {

    return view('site_management.index');


  }
  public function create()
  {
      return view('site_management.create');
  }


}
