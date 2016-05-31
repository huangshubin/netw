@extends('layouts.public')
@section('title','Thank You')

@section('styles')
    html,body{height:100%;}
@endsection

@section('content')

<div class="container valign-container">
    <div class="valign">
        @include('errors.errors')
        <div class="jumbotron  text-center valign-content">

                @if(count($errors)>0)</h1>
                    <h1>Sorry but some information you enter wrong, please re-submit the information</h1>
                @else
                    <h1>Thank You!</h1>
                    <h2>we will send you message as soon as possible</h2>
                @endif

        </div>

    </div>

</div>

@endsection