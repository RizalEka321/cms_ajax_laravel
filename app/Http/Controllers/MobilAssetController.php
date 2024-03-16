<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Mobil_asset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class MobilAssetController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mobil = Mobil::with('mobil_asset')->find($id);
        return view('mobil.gambar', compact('mobil', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function get_mobil_asset($id)
    {
        $data = Mobil_asset::select('id', 'mobil_id', 'foto')->with('mobil')->where('mobil_id', $id)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="btn-group">
                                <a type="button" id="btn-del-foto" data-id="' . $row->id . '" class="btn-hapus"><i class="fa-solid fa-trash-can"></i> DELETE</a>
                            </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'mobil_id' => 'required',
            'foto'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/mobil' . '/' . Str::title($request->merk), $image->hashName());
        // Berikan izin 755 pada folder tujuan (public/mobil/nama_merk_mobil)
        $folderPath = public_path('storage/mobil/' . Str::title($request->merk));
        $process = new Process(['chmod', '-R', '755', $folderPath]);
        $process->run();

        //create post
        Mobil_asset::create([
            'mobil_id'     => $request->mobil_id,
            'foto'     => $image->hashName(),
        ]);
        activity()->causedBy(Auth::user())->log('Menambah gambar mobil ' . $request->merk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil_asset  $mobil_asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobil_asset $id)
    {
        // Hapus file asset
        Storage::delete('public/mobil' . '/' . $id->mobil->merk . '/' . $id->foto);
        //delete asset
        $id->delete();
        activity()->causedBy(Auth::user())->log('Menghapus gambar ' . $id->mobil->merk);
    }
}
