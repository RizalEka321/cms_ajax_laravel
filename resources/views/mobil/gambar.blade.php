@extends('layout.app')
@section('title', 'Data Mobil')
@section('content')
    {{-- Data Tabel Mobil --}}
    <div id="datane" class="details">
        <div class="content">
            <div class="container">
                <div class="card_header pt-1">
                    <h4 class="judul"><i class="fa-solid fa-car"></i> DATA GAMBAR MOBIL {{ strtoupper($mobil->merk) }}</h4>
                    <hr>
                </div>
                <div class="btn-group mb-2">
                    <a href="{{ route('mobil') }}" type="button" class="btn-hapus"><i
                            class='nav-icon fas fa-arrow-left'></i>&nbsp;&nbsp;
                        KEMBALI</a>
                    <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-square-plus"></i>&nbsp;&nbsp; TAMBAH GAMBAR
                    </button>
                </div>
                <table id="table" class="table table-bordered mobil" style="width:100%">
                    <thead>
                        <tr>
                            <th width="15%">Aksi</th>
                            <th width="5%">No</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_tambah" method="POST" action="{{ route('mobil_foto.create') }}"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="image">Masukkan Gambar</label>
                                <input id="foto_mobil" type="file" name="foto" class="form-control">
                                <input id="mobil_id" type="text" name="mobil_id" value="{{ $mobil->id }}"
                                    class="form-control" hidden>
                                <input id="merk" type="text" name="merk" value="{{ $mobil->merk }}"
                                    class="form-control" hidden>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button id="btn-upload" type="submit" class="btn-tambah"><i
                                    class="fa-solid fa-upload"></i>&nbsp;&nbsp;
                                UPLOAD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // Global Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function reload_table() {
            $('#table').DataTable().ajax.reload();
        }

        // Fungsi index
        $(function() {
            var table = $('.mobil').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                responsive: true,
                ajax: '/car/foto/list/{{ $mobil->id }}',
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('mobil') }}/' + full.mobil.merk +
                                '/' +
                                data + '" alt="Gambar Mobil" height="100" weight="100">';
                        }
                    },
                ]
            });
        });

        // fungsi untuk hilangkan data
        $(document).on('click', '#btn-close', function() {
            $('#gambar').val('');
        });

        // Fungsi tambah gambar
        // $(document).on('click', '#btn-upload', function() {
        //     var data = {
        //         id: '',
        //         mobil_id: $('#mobil_id').val(),
        //         merk: $('#merk').val(),
        //     };

        //     var formData = new FormData();
        //     formData.append('id', data.id);
        //     formData.append('mobil_id', data.mobil_id);
        //     formData.append('merk', data.merk);
        //     formData.append('foto', $('#foto_mobil')[0].files[0]);

        //     $.ajax({
        //         url: 'create', // Pastikan URL rute Anda sudah benar
        //         type: 'POST',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             Swal.fire(
        //                 'Sukses',
        //                 'Gambar berhasil disimpan',
        //                 'success'
        //             );
        //             $('#foto_mobil').val('');
        //             $('#exampleModal').modal('hide');
        //             $('#table').DataTable().ajax.reload();
        //         },
        //         error: function() {
        //             Swal.fire(
        //                 'Gagal!',
        //                 'Terjadi kesalahan saat mengupload gambar',
        //                 'error'
        //             );
        //         }
        //     });

        //     event.preventDefault();
        // });

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
                            // reset_form();
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

        // Fungsi hapus gambar
        $(document).on('click', '#btn-del-foto', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Hapus Gambar',
                text: 'Apakah anda yakin!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete/' + id,
                        type: 'DELETE',
                        success: function() {
                            Swal.fire(
                                'Terhapus!',
                                'Gambar berhasil dihapus',
                                'success'
                            );

                            // Reload data di dalam DataTable setelah penghapusan gambar
                            $('#table').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus gambar',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
