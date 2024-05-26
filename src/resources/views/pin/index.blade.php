@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">List PIN</h4>
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{route('pin.create')}}">Create PIN</a>

                    </div>
                </div>
                <div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>PIN</th>
                                    <th>Capacity</th>
                                    <th>Submitted</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pins as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->pin}}</td>
                                    <td>{{$item->capacity}}</td>
                                    <td>{{$item->voting()->count()}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('pin.report', ['pin' => $item->pin])}}" type="button" rel="tooltip" class="btn btn-info">
                                            <i class="material-icons">bar_chart</i>
                                        </a>
                                        {{-- <button type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </button> --}}
                                        <a href="{{route('pin.destroy', ['pin' => $item->id])}}" class="btn btn-danger deleteButton">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.deleteButton').click(function(event) {
                event.preventDefault();

                var url = $(this).attr('href');

                swal({
                    title: 'Are you sure?',
                    text: 'Once deleted you will not be able to recover this PIN!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger",
                    buttonsStyling: false
                }).then(function() {
                console.log(url);
                    $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: "{{csrf_token()}}",
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                console.log(response);
                                swal({
                                    title: 'Deleted!',
                                    text: 'PIN has been deleted.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success",
                                    buttonsStyling: false
                                })
                                .then(
                                    function() {
                                        location.reload();
                                    }
                                ).catch(swal.noop)
                            }
                        });

                }, function(dismiss) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (dismiss === 'cancel') {
                        swal({
                            title: 'Cancelled',
                            text: 'Your PIN is safe :)',
                            type: 'error',
                            confirmButtonClass: "btn btn-info",
                            buttonsStyling: false
                        }).catch(swal.noop)
                    }
                })

            });
        });
    </script>
@endsection
