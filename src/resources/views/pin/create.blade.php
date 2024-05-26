@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('pin.store')}}" method="post">
                @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">key</i>
                    </div>
                    <h4 class="card-title">Create Pin</h4>
                </div>
                <div class="card-body ">
                    <form method="#" action="#">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating">Event name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="capacity" class="bmd-label-floating">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity">
                        </div>
                        <div class="form-group">
                            <label for="capacity" class="bmd-label-floating">PIN</label>
                            <input type="text" class="form-control" id="pin" name="pin" readonly> <button type='button' class="btn" onclick="randomPIN()">generate</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer ">
                    <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
            return result;
    }
    var rString = randomString(6, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    document.getElementById('pin').value = rString;
    function randomPIN() {
        let rString = randomString(6, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        document.getElementById('pin').value = rString;
    }
</script>
@endsection
