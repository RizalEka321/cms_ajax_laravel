<?php

namespace App\Http\Controllers;

use App\Models\Expedisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ExpedisiController extends Controller
{
    public function index($slug)
    {
        $expedisi = Expedisi::where('slug', $slug)->select('id', 'judul', 'deskripsi')->first();
        // @dd($expedisi);
        return view('expedisi.index', compact('expedisi'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|min:2|max:100',
            'deskripsi' => 'required',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.min:2' => 'Judul harus lebih dari 2 karakter.',
            'judul.unique' => 'Judul ini sudah digunakan.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $expedisi = Expedisi::find($id);

            $expedisi->judul = Str::title($request->judul);
            $expedisi->deskripsi = $request->deskripsi;

            $expedisi->save();

            echo json_encode(['status' => TRUE]);
        }
    }
}
