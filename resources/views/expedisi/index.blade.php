@extends('layout.app')
@section('title', 'Expedisi')
@section('content')
    <div class="details">
        <div class="content">
            <div class="container">
                <div class="card_header py-1 mb-2">
                    <h4 class="judul"><i class="fa-solid fa-address-book"></i> Expedisi</h4>
                    <hr>
                </div>
                <form id="form_expedisi" action="{{ url('/expedisi/update/?q=') . $expedisi->id }}">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="judul">Judul :</label>
                                <input id="judul" type="judul" name="judul" value="{{ $expedisi->judul }}"
                                    class="form-control @error('judul') is-invalid @enderror" placeholder="Email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi :</label>
                                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ $expedisi->deskripsi }}">
                                <trix-editor input="deskripsi" id="trix_deskripsi" class="form-control"
                                    placeholder="Deskripsi"></trix-editor>
                                <span class="error-message text-danger" id="error-deskripsi"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btn-add" data-id="{{ $expedisi->id }}" type="submit" class="btn-tambah"><i
                                class="nav-icon fas fa-save"></i>&nbsp;&nbsp; UPDATE</button>
                    </div>
                </form>
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

        $(function() {
            $('#form_expedisi').submit(function(event) {
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
                        console.log(data.errors);
                        if (data.errors) {
                            Swal.fire("Error", "Datanya ada yang kurang", "error");
                        } else {
                            Swal.fire(
                                'Sukses',
                                'Data berhasil disimpan',
                                'success'
                            );
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

        // Fungsi update data
        // $(document).on('click', '#btn-add', function(event) {
        //     event.preventDefault()
        //     var id = $(this).data('id');

        //     var data = {
        //         id: id,
        //         email: $('#email').val(),
        //         no_hp: $('#no_hp').val(),
        //         fb: $('#fb').val(),
        //         ig: $('#ig').val(),
        //     }
        //     $.ajax({
        //         url: 'update/' + id,
        //         type: 'PUT',
        //         data: data,
        //         success: function(response) {
        //             Swal.fire(
        //                 'Sukses',
        //                 'Expedisi berhasil di update',
        //                 'success'
        //             );
        //         },
        //         error: function(error) {
        //             console.error('Error updating status:', error);
        //         }
        //     });
        // });
    </script>
@endsection
