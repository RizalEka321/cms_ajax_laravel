@extends('layout.app')
@section('title', 'Data Mobil')
@section('content')
    {{-- Data Tabel Mobil --}}
    <div id="datane" class="details">
        <div class="content">
            <div class="container">
                <div class="card_header pt-1">
                    <h4 class="judul"><i class="fa-solid fa-car"></i> DATA MOBIL</h4>
                    <hr>
                </div>
                <a type="button" class="btn-tambah mb-2" id="btn-add"><i class="fa-solid fa-square-plus"></i>&nbsp;&nbsp;
                    TAMBAH DATA MOBIL</a>
                <table id="tabel_mobil" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="15%">Aksi</th>
                            <th width="10%">Status</th>
                            <th width="5%">No</th>
                            <th width="32%">Merk</th>
                            <th width="25%">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Form Tambah Data --}}
    <div id="tambah_data" class="details hidden">
        <div class="content">
            <div class="card border-0">
                <div class="card_header mx-3 pt-1">
                    <h4 class="judul"><i class="fa-solid fa-car"></i> TAMBAH DATA MOBIL</h4>
                    <hr>
                </div>
                <form id="form_tambah" action="{{ url('/car/create') }}" method="POST" enctype="multipart/form-data"
                    class="was-validated" role="form">
                    <div class="card-body">
                        <div class="row gx-5 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="merk">Merk :</label>
                                    <input id="merk" type="text" name="merk" value="{{ old('merk') }}"
                                        class="form-control" placeholder="Nama" required autofocus>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis">Jenis :</label>
                                    <select id="jenis" name="jenis" class="form-control" required autofocus>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Matic">Matic</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nopol">Plat Nomer :</label>
                                    <input id="nopol" type="text" name="nopol" value="{{ old('nopol') }}"
                                        class="form-control" placeholder="Plat" required autofocus>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="bbm">Bahan Bakar :</label>
                                    <select id="bbm" name="bbm" class="form-control" required autofocus>
                                        <option value="">-- Pilih Bahan Bakar --</option>
                                        <option value="Pertalite">Pertalite</option>
                                        <option value="Pertamax">Pertamax</option>
                                        <option value="Solar">Solar</option>
                                        <option value="Dexlite">Dexlite</option>
                                        <option value="Pertamina Dex">Pertamina Dex</option>
                                        <option value="Pertamax Racing">Pertamax Racing</option>
                                        <option value="Pertamax Turbo">Pertamax Turbo</option>
                                    </select>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tahun">Tahun :</label>
                                    <input id="tahun" type="number" name="tahun" value="{{ old('tahun') }}"
                                        class="form-control" max="9999" placeholder="Tahun" required autofocus>
                                    <span class="error-message text-danger" id="error-tahun"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="warna">Warna :</label>
                                    <input id="warna" type="text" name="warna" value="{{ old('warna') }}"
                                        class="form-control" placeholder="Warna" required autofocus>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penumpang">Jumlah Penumpang :</label>
                                    <input id="penumpang" type="number" name="penumpang" value="{{ old('penumpang') }}"
                                        class="form-control" placeholder="Jumlah Penumpang" required autofocus>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="harga">Harga:</label>
                                    <input id="harga" type="number" name="harga" value="{{ old('harga') }}"
                                        class="form-control" placeholder="Harga" required autofocus>
                                    <div class="valid-feedback"><i>*valid</i> </div>
                                    <div class="invalid-feedback"><i>*required</i> </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi :</label>
                                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                                <trix-editor input="deskripsi" id="trix_deskripsi" class="form-control"
                                    placeholder="Deskripsi" required autofocus></trix-editor>
                                <div class="valid-feedback"><i>*valid</i> </div>
                                <div class="invalid-feedback"><i>*required</i> </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div id="input_foto" class="form-group">
                                <label for="foto">Gambar :</label>
                                <input id="foto" type="file" name="foto" class="form-control" required
                                    autofocus>
                                <div class="valid-feedback"><i>*valid</i> </div>
                                <div class="invalid-feedback"><i>*required</i> </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a type="button" id="btn-close" class="btn-hapus"><i
                                    class='nav-icon fas fa-arrow-left'></i>&nbsp;&nbsp; KEMBALI</a>
                            <button type="submit" id="btn-simpan" class="btn-tambah"><i
                                    class="nav-icon fas fa-save"></i>&nbsp;&nbsp; TAMBAH</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // Button
        $('#btn-add').click(function() {
            $('#tambah_data').removeClass('hidden');
            $('#datane').addClass('hidden');
            $('.judul').html(
                '<h4 class="judul"><i class="fa-solid fa-car"></i>TAMBAH DATA MOBIL</h4>');

        });
        $('#btn-close').click(function() {
            $('#datane').removeClass('hidden');
            $('#tambah_data').addClass('hidden');
            $('.judul').html(
                '<h4 class="judul"><i class="fa-solid fa-car"></i> DATA MOBIL</h4>');
            reset_form();
        });

        // Global Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function reload_table() {
            $('#tabel_mobil').DataTable().ajax.reload();
        }

        function reset_form() {
            $('#form-add').attr('action', "{{ url('/car/create') }}");
            $('#form_tambah')[0].reset();
        }

        // Fungsi index
        $(function() {
            var table = $('#tabel_mobil').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: "{{ url('/car/list') }}",
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'statusbtn',
                        name: 'statusbtn',
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'merk',
                        name: 'merk'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',
                    }
                ]
            });
        });

        // Fungsi Tambah
        $(function() {
            $('#form_tambah').submit(function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                var url = $(this).attr('action');
                var formData = new FormData($(this)[0]);

                // showLoading();
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.error-message').empty();
                        if (data.errors) {
                            // $.each(data.errors, function(key, value) {
                            //     Swal.fire('Upss..!', value, 'error');
                            // });
                            Swal.fire("Error", "Datanya ada yang kurang", "error");
                        } else {
                            reset_form();
                            $('#datane').removeClass('hidden');
                            $('#tambah_data').addClass('hidden');
                            Swal.fire(
                                'Sukses',
                                'Data berhasil disimpan',
                                'success'
                            );
                            reload_table();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                    },
                    complete: function() {
                        // hideLoading();
                    }
                });
            });
        });

        // Fungsi Edit dan Update
        function edit_data(id) {
            $('#form_tambah')[0].reset();
            $('#form_tambah').attr('action', '/car/update?q=' + id);
            $.ajax({
                url: "{{ url('/car/edit') }}",
                type: "POST",
                data: {
                    q: id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        var isi = data.isi;
                        $('#merk').val(isi.merk);
                        $('#warna').val(isi.warna);
                        $('#nopol').val(isi.nopol);
                        $('#tahun').val(isi.tahun);
                        $('#penumpang').val(isi.penumpang);
                        $('#bbm').val(isi.bbm);
                        $('#jenis').val(isi.jenis);
                        $('#harga').val(isi.harga);
                        // $('#foto').val(isi.foto);
                        var editor = document.getElementById('trix_deskripsi');
                        editor.editor.loadHTML(isi.deskripsi);


                        // $('#input_foto').addClass('hidden');
                        $('#tambah_data').removeClass('hidden');
                        $('#datane').addClass('hidden');
                        $('.judul').html(
                            '<h4 class="judul"><i class="fa-solid fa-car"></i> EDIT DATA MOBIL</h4>');
                        $('#btn-simpan').html(
                            '<i class="nav-icon fas fa-save"></i>&nbsp;&nbsp; SIMPAN');
                    } else {
                        Swal.fire("SALAH BOS", "Tulisen kang bener", "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire('Upss..!', 'Terjadi kesalahan jaringan error message: ' + errorThrown,
                        'error');
                }
            });
        };

        // Fungsi Hapus
        function delete_data(id) {
            Swal.fire({
                title: 'Hapus Mobil',
                text: "Apakah anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/car/delete') }}",
                        type: "POST",
                        data: {
                            q: id
                        },
                        dataType: "JSON",
                    });
                    Swal.fire(
                        'Hapus!',
                        'Akun berhasil Dihapus',
                        'success'
                    )
                    reload_table();
                }
            })
        };

        // Fungsi memasukkan mobil ke unggulan
        $(document).on('click', '.btn-unggulan', function(event) {
            event.preventDefault()
            var id = $(this).data('id');
            var unggulanInput = $('#unggulan-' + id);
            var newUnggulanValue = (unggulanInput.val() === 'Ya') ? 'Tidak' : 'Ya';

            if (newUnggulanValue == 'Tidak') {
                var unggulan = 'Ya'
            } else {
                var unggulan = 'Tidak'
            }

            var data = {
                id: id,
                unggulan: unggulan
            }
            //fetch detail post with ajax
            $.ajax({
                url: '/car/update/unggulan/' + id,
                type: 'PUT',
                data: data,
                success: function(response) {
                    // Handle the success response here
                    if (data.unggulan == 'Tidak') {
                        Swal.fire(
                            'Dikeluarkan',
                            'dari daftar mobil unggulan',
                            'error'
                        );
                    } else {
                        Swal.fire(
                            'Dimasukkan',
                            'ke daftar mobil unggulan',
                            'success'
                        );
                    }
                    reload_table();
                },
                error: function(error) {
                    console.error('Gagal menyimpan data', error);
                    Swal.fire(
                        'Error',
                        'Terjadi kesalahan saat menyimpan data',
                        'error'
                    );
                }
            });
        });

        // Fungsi ubah status tersedia dan tidak tersedia
        $(document).on('change', '#btn-status', function() {
            var id = $(this).data('id');
            var newStatus = $(this).prop('checked') ? 1 : 0;

            if (newStatus == 1) {
                status = 'Tersedia'
            } else {
                status = 'Tidak Tersedia'
            }
            var data = {
                id: id,
                status: status
            }

            $.ajax({
                url: '/car/update/status/' + id,
                type: 'PUT',
                data: data,
                success: function(response) {
                    if (data.status == 'Tidak Tersedia') {
                        Swal.fire(
                            'Ubah status',
                            'Tidak tersedia',
                            'error'
                        );
                    } else {
                        Swal.fire(
                            'Ubah status',
                            'Tersedia',
                            'success'
                        );
                    }
                    reload_table();
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        });
    </script>
@endsection
