@extends('layouts.index')
@section('styles')
    <style>
        img {
            border-radius: 10%;
            border: solid red 4px;
            padding: 5px;
            max-width: 100%;
            max-height: 175px;
        }
        .card{
            background-color: rgba(255, 255, 255, 0.95);
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="card card-testimonial" style="min-height: 20vh">
                {{-- <div class="icon">
                    <i class="material-icons">format_quote</i>
                </div> --}}
                <div class="card-header" style="padding-top:5vh">
                    <h2 class="card-title text-bold ">{{ $pin->name }}</h2>
                </div>
                <div class="card-body">
                    <h3 class="card-description text-bold text-black">
                        GBI Daan Mogot memilih yang terbaik!
                        Tentukan pilihanmu sekarang!
                    </h3>
                </div>
                <div class="card-footer">
                    {{-- <h4 class="card-title">Alec Thompson</h4>
                    <h6 class="card-category">@alecthompson</h6>
                    <div class="card-avatar">
                      <a href="#pablo">
                        <img class="img" src="../assets/img/faces/card-profile1-square.jpg">
                      </a>
                    </div> --}}
                </div>
            </div>
        </div>
        @foreach ($option as $key => $item)
            <div class="col-md-4 cards d-flex">
                <div class="card card-pricing card-raised">
                    <div class="card-body">
                        <h4 class="card-category text-bold">{{ $item['name'] }}</h4>
                        <div class="photo">
                            <img src="{{ asset('images/'.$item['image']) }}" />
                        </div>
                        <form class="myForm" action="{{ route('voting.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pin" value="{{ $pin->id }}">
                            <input type="hidden" name="option" value="{{ $key }}">
                            <button class="btn btn-rose btn-round text-bold">pilih</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        $('.myForm').on('submit', function(event) {
            // Mencegah form dari pengiriman
            event.preventDefault();

            // Buat key untuk penyimpanan di localStorage
            var storageKey = 'formSubmitted';
            var storageKeyPIN = 'formSubmittedPIN';

            // get pin value
            var pin = $(this).find('input[name="pin"]').val();

            // Periksa apakah key sudah ada di localStorage
            if (localStorage.getItem(storageKey) && localStorage.getItem(storageKeyPIN) == pin){
                // Jika key sudah ada, jangan lanjutkan pengiriman form
                swal('Anda telah memilih !!!');
            } else {
                // Simpan data ke localStorage dengan key tertentu
                localStorage.setItem(storageKey, true);
                localStorage.setItem(storageKeyPIN, pin);

                // Lanjutkan pengiriman form
                this.submit();
            }
        });
    </script>
@endsection
