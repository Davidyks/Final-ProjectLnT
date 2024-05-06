<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('addCategory');
    }

    public function addCategory1(Request $request){
        $request->validate([
            'Nama' => ['required','string']
        ]);

        Category::create([
            'Nama' => $request->Nama
        ]);

        return redirect('/');
    }
}
