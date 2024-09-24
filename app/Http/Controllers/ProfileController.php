<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $data = [ 
            'nama' => 'Muhammad Iqbal Anandra', 
            'kelas' => 'B', 
            'npm' => '2217051901' 
            ]; 
        return view('profile', $data);
    }
}
