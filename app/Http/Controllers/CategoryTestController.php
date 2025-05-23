<?php

namespace App\Http\Controllers;
use App\Models\CategoryTest;
use Illuminate\Http\Request;

class CategoryTestController extends Controller
{
   public function index(Request $request) 
   { 
    $query = CategoryTest::query(); 
    if ($request->has('search')) {
         $query->where('title', 'like', '%' . $request->search . '%'); 
        } 
        if ($request->has('bidang') && $request->bidang != '') { 
            $query->where('bidang', $request->bidang); 
        } 
        $tests = $query->get(); 
        $bidangs = CategoryTest::select('bidang')->distinct()->pluck('bidang'); 
        
        return view('test.category-test', compact('tests', 'bidangs')); 
    } 
    
    public function show($id) 
    { 
        $test = CategoryTest::findOrFail($id); 
        
        return view('test.detail-test', compact('test')); }
}
