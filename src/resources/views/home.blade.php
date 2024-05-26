@extends('layouts.index')

@section('content')
    @if (!empty($warning))
        <div class="alert alert-danger alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
            <span data-notify="message">{{ $warning }}</span>
        </div>
    @endif
        @if (!empty($success))
        <div class="alert alert-success alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
            <span data-notify="message">{{ $success }}</span>
        </div>
    @endif
    <div class="col-md-4 ml-auto mr-auto">
        <div class="card card-profile text-center card-hidden">
            <div class="card-header ">
                <div class="card-avatar">
                </div>
            </div>
            <div class="card-body ">
                <h4 class="card-title">Masukkan PIN</h4>
                <div class="form-group">
                    <label for="exampleInput1" class="bmd-label-floating">Enter PIN</label>
                    <input type="text" class="form-control" id="pin" name="pin">
                </div>
            </div>
            <div class="card-footer justify-content-center">
                <button id="tombol-masuk" class="btn btn-rose btn-round">Masuk</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#tombol-masuk').click(function() {
            var pin = $('#pin').val();
            if (pin == '') {
                swal('Peringatan', 'PIN tidak boleh kosong', 'warning');
            } else {
                window.location.href = '/voting?pin=' + pin;
            }
        });
    </script>
@endsection
