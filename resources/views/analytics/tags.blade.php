@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tag Analytics</div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead class="thead-light">
                            <tr>
                                @foreach ($headers as $head)
                                    <th class="border px-3 py-1" scope="col"><strong>{{ $head }}</strong></th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vals as $valRow)
                                <tr>
                                    @foreach ($valRow as $val)
                                        <td class="border px-3 py-1">{{ $val }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection