@extends('layout.app')
@section('title', 'Kontak')
@section('content')
    <div class="details">
        <div class="content">
            <div class="container">
                <div class="card_header py-1 mb-2">
                    <h4 class="judul"><i class="fa-solid fa-address-book"></i> DATA KONTAK</h4>
                    <hr>
                </div>
                <form>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input id="email" type="email" name="email" value="{{ $kontak->email }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                <div class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="no_hp">No HP atau Whatsapp :</label>
                                <input id="no_hp" type="no_hp" name="no_hp" value="{{ $kontak->no_hp }}"
                                    class="form-control @error('no_hp') is-invalid @enderror" placeholder="No HP">
                                <div class="text-danger">
                                    @error('no_hp')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="ig">Instagram (link) :</label>
                                <input id="ig" type="ig" name="ig" value="{{ $kontak->ig }}"
                                    class="form-control @error('ig') is-invalid @enderror" placeholder="Instagram">
                                <div class="text-danger">
                                    @error('ig')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="fb">Facebook (link) :</label>
                                <input id="fb" type="fb" name="fb" value="{{ $kontak->fb }}"
                                    class="form-control @error('fb') is-invalid @enderror" placeholder="Facebook">
                                <div class="text-danger">
                                    @error('fb')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btn-add" data-id="{{ $kontak->id }}" type="submit" class="btn-tambah"><i
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

        // Fungsi update data
        $(document).on('click', '#btn-add', function(event) {
            event.preventDefault()
            var id = $(this).data('id');

            var data = {
                id: id,
                email: $('#email').val(),
                no_hp: $('#no_hp').val(),
                fb: $('#fb').val(),
                ig: $('#ig').val(),
            }
            $.ajax({
                url: 'update/' + id,
                type: 'PUT',
                data: data,
                success: function(response) {
                    Swal.fire(
                        'Sukses',
                        'Kontak berhasil di update',
                        'success'
                    );
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        });
    </script>
@endsection
