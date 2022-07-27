@extends('header')

@section('head')


@endsection
@section('body')
    @foreach($bydb as $ro)
        <p>{{$ro->id}}|||{{$ro->name}}||||||||||||{{$ro->created_at}}</p>
    @endforeach

    <button type="button" onclick="location.href='{{url('/sgenre')}}'">トップに戻る</button>
@endsection
