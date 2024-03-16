<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kontak = Kontak::find($id);
        return view('kontak.index', compact('kontak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $id)
    {
        $request->validate(
            [
                'email' => 'required|string|min:2|max:100',
                'no_hp' => 'required|numeric',
                'ig' => 'nullable',
                'fb' => 'nullable',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'no_hp.required' => 'No HP wajib diisi.',
            ]
        );

        $id->update([
            'email' => $request->input('email'),
            'no_hp' => $request->no_hp,
            'ig' => $request->ig,
            'fb' => $request->fb,
        ]);
    }
}
