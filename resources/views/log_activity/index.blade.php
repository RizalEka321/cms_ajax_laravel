@extends('layout.app')
@section('title', 'Data Log Aktifitas')
@section('content')
    {{-- Data Tabel Mobil --}}
    <div id="datane" class="details">
        <div class="content">
            <div class="container">
                <div class="card_header pt-1">
                    <h4 class="judul"> <i class="fa-solid fa-users-gear"></i> LOG AKTIFITAS</h4>
                    <hr>
                </div>
                <table id="table" class="table table-bordered log" style="width:100%">
                    <thead>
                        <tr>
                            {{-- <th width="15%">Aksi</th> --}}
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Aktifitas</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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

        // Fungsi index
        $(function() {
            var table = $('.log').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                responsive: true,
                ajax: '/log-activity/list',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'user',
                        name: 'user',
                    },
                ]
            });
        });
    </script>
@endsection
