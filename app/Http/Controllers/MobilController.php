<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Mobil_asset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mobil.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_mobil(Request $request)
    {
        $data = Mobil::select('id', 'merk', 'tahun', 'status', 'unggulan', 'jenis')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<form>
                        <div class="btn-group">';

                if ($row->unggulan == 'Ya') {
                    $actionBtn .= '<input id="unggulan-' . $row->id . '" type="text" name="unggulan" value="Tidak" hidden>
                            <button id="btn-unggulan" data-id="' . $row->id . '" class="btn-unggulan"><i class="fa-solid fa-star" style="color: #ffc800;"></i></button>';
                } else {
                    $actionBtn .= '<input id="unggulan-' . $row->id . '" type="text" name="unggulan" value="Ya" hidden>
                            <button id="btn-unggulan" data-id="' . $row->id . '" class="btn-unggulan"><i class="fa-solid fa-star" style="color: #ffffff;"></i></button>';
                }

                $actionBtn .= '<div class="btn-group"><a href="javascript:void(0)" type="button" id="btn-edit" class="btn-edit" onClick="edit_data(' . "'" . $row->id . "'" . ')"><i class="fa-solid fa-pen-to-square"></i></a><a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus" onClick="delete_data(' . "'" . $row->id . "'" . ')"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </form>';
                return $actionBtn;
            })
            ->addColumn('statusbtn', function ($row) {
                $statusBtn = '<label class="switch">
                    <input id="btn-status" data-id="' . $row->id . '" class="input_slider" type="checkbox" ' . ($row->status ==  'Tersedia' ? 'checked' : '') . '>
                    <span class="slider round"></span>
                </label>';
                return $statusBtn;
            })
            ->rawColumns(['action', 'statusbtn'])
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
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|min:2|max:100|unique:' . Mobil::class,
            'warna' => 'required|string',
            'nopol' => 'required|string|unique:' . Mobil::class,
            'tahun' => 'required|numeric',
            'penumpang' => 'required|numeric',
            'bbm' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto'     => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'merk.required' => 'Merk wajib diisi.',
            'merk.unique' => 'Merk ini sudah digunakan.',
            'nopol.required' => 'Plat Nomor wajib diisi.',
            'nopol.unique' => 'Plat Nomor ini sudah digunakan.',
            'warna.required' => 'Warna wajib diisi.',
            'warna.required' => 'Warna wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'penumpang.required' => 'Penumpang wajib diisi.',
            'bbm.required' => 'Bahan bakar wajib diisi.',
            'jenis.required' => 'Jenis wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            // Generate ID produk berdasarkan inisial nama produk
            $inisial = strtoupper(substr($request->merk, 0, 2)); // Ambil dua karakter pertama dan jadikan huruf kapital
            $count = Mobil::where('id', 'LIKE', $inisial . '%')->count(); // Hitung jumlah produk dengan inisial yang sama
            $count++; // Tambahkan 1 untuk mendapatkan angka unik
            $id_mobil = $inisial . str_pad($count, 4, '0', STR_PAD_LEFT); // ID produk lengkap

            $nopol = $request->nopol;

            // Ubah semua huruf menjadi huruf besar (uppercase) dan format nomor polisi
            if (Str::length($nopol) === 8) {
                // Format "DK 1234 KK"
                $formatted_nopol = Str::upper(substr($nopol, 0, 2) . ' ' . substr($nopol, 2, 4) . ' ' . substr($nopol, 6, 2));
            } elseif (Str::length($nopol) === 7) {
                // Format "P 1234 RK"
                $formatted_nopol = Str::upper(substr($nopol, 0, 1) . ' ' . substr($nopol, 1, 4) . ' ' . substr($nopol, 5, 2) . ' ' . substr($nopol, 7, 2));
            } else {
                // Jika format nomor polisi tidak sesuai dengan yang diharapkan, mungkin Anda ingin menangani kasus ini sesuai kebutuhan aplikasi Anda.
                // Misalnya, Anda dapat memberikan pesan kesalahan atau mengambil tindakan lain.
                // Di sini, saya hanya menganggap bahwa format tidak sesuai dan menggunakan variabel $formatted_nopol dengan nilai asli.
                $formatted_nopol = $nopol;
            }

            $foto = $request->foto;
            $file_name = time() . '.' . $foto->extension();
            $path = 'mobil/' . Str::title($request->merk);
            $foto->move(public_path($path), $file_name);


            Mobil::create([
                'id' => $id_mobil,
                'merk' => Str::title($request->merk),
                'slug' => Str::slug($request->merk),
                'nopol' => $formatted_nopol,
                'warna' => $request->warna,
                'tahun' => $request->tahun,
                'penumpang' => $request->penumpang,
                'bbm' => $request->bbm,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'status' => 'Tersedia',
                'unggulan' => 'Tidak',
                'foto' => "$path/$file_name"
            ]);

            echo json_encode(['status' => TRUE]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('q');
        $mobil = Mobil::find($id);

        echo json_encode(['status' => TRUE, 'isi' => $mobil]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|min:2|max:100',
            'warna' => 'required|string',
            'nopol' => 'required|string',
            'tahun' => 'required|numeric',
            'penumpang' => 'required|numeric',
            'bbm' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto'     => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'merk.required' => 'Merk wajib diisi.',
            'merk.min:2' => 'Merk harus lebih dari 2 karakter.',
            'merk.unique' => 'Merk ini sudah digunakan.',
            'nopol.required' => 'Plat Nomor wajib diisi.',
            'nopol.unique' => 'Plat Nomor ini sudah digunakan.',
            'warna.required' => 'Warna wajib diisi.',
            'warna.required' => 'Warna wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'penumpang.required' => 'Penumpang wajib diisi.',
            'bbm.required' => 'Bahan bakar wajib diisi.',
            'jenis.required' => 'Jenis wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $id = $request->query('q');
            $mobil = Mobil::find($id);

            $nopol = $request->nopol;

            // Ubah semua huruf menjadi huruf besar (uppercase) dan format nomor polisi
            if (Str::length($nopol) === 8) {
                // Format "DK 1234 KK"
                $formatted_nopol = Str::upper(substr($nopol, 0, 2) . ' ' . substr($nopol, 2, 4) . ' ' . substr($nopol, 6, 2));
            } elseif (Str::length($nopol) === 7) {
                // Format "P 1234 RK"
                $formatted_nopol = Str::upper(substr($nopol, 0, 1) . ' ' . substr($nopol, 1, 4) . ' ' . substr($nopol, 5, 2) . ' ' . substr($nopol, 7, 2));
            } else {
                // Jika format nomor polisi tidak sesuai dengan yang diharapkan, mungkin Anda ingin menangani kasus ini sesuai kebutuhan aplikasi Anda.
                // Misalnya, Anda dapat memberikan pesan kesalahan atau mengambil tindakan lain.
                // Di sini, saya hanya menganggap bahwa format tidak sesuai dan menggunakan variabel $formatted_nopol dengan nilai asli.
                $formatted_nopol = $nopol;
            }

            $mobil->merk = Str::title($request->merk);
            $mobil->slug = Str::slug($request->merk);
            $mobil->nopol = $formatted_nopol;
            $mobil->warna = $request->warna;
            $mobil->tahun = $request->tahun;
            $mobil->penumpang = $request->penumpang;
            $mobil->bbm = $request->bbm;
            $mobil->jenis = $request->jenis;
            $mobil->deskripsi = $request->deskripsi;
            $mobil->harga = $request->harga;

            if ($request->hasFile('foto')) {
                if ($mobil->foto) {
                    if (file_exists(public_path($mobil->foto))) {
                        unlink(public_path($mobil->foto));
                    }
                }

                $foto = $request->file('foto');
                $file_name = time() . '.' . $foto->extension();
                $path = 'mobil/' . Str::title($request->merk);
                $foto->move(public_path($path), $file_name);
            }

            $mobil->save();


            echo json_encode(['status' => TRUE]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function status_update(Request $request, Mobil $id)
    {
        $request->validate(
            [
                'status' => 'required'
            ],
        );

        $id->update([
            'status' => $request->status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function unggulan_update(Request $request, Mobil $id)
    {
        $request->validate(
            [
                'unggulan' => 'required'
            ],
        );

        $id->update([
            'unggulan' => $request->unggulan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $mobil = Mobil::find($id);
        $mobil->delete();

        echo json_encode(['status' => TRUE]);
    }
}
