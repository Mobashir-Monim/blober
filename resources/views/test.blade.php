@extends('layouts.app')

@section('content')
    
    @foreach ($collection as $item)
        <div class="row border-bottom">
            {{-- <div class="col-md-6 text-right border-right">{{ App\Tag::find($item['tag_id'])->name }}</div> --}}
            {{-- <div class="col-md-6 text-right border-right">{{ $item['tag_id'] }}</div> --}}
            <div class="col-md-3 border-right text-right h6">{{ $item->id }}<br>DIFF: {{ $item->difficulty }}</div>
            <div class="col-md my-auto">
                @foreach ($item->tags as $tag)
                    <span class="p-1 label-info rounded display-inline">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection