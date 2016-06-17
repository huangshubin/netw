@extends('layouts.admin')
@section('title','Message')
@section('styles')
    #msg-container tr td:nth-child(1){
    width:2%;
    }
    #msg-container tr td:nth-child(2){
    width:15%;
    }
    #msg-container tr td:nth-child(3){
    width:15%;
    }
    .table > tbody > tr > td {
    vertical-align: middle;
    }
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Buy a Dog</div>
                    <div class="panel-body">

                        <form action="{{url('pay')}}" t method="post" class="form-horizontal text-center">
                            {!! csrf_field() !!}
                            <div class="form-group">
                            <div class="col-sm-12">
                                <div class="thumbnail" style="display: inline-block">
                                    <img src='{{asset('img/dog.jpg')}}'  class="img-rounded" alt="product">
                                    <h3 >Nice Dog <span class="badge" style="font-size: 120%">$42</span></h3>
                                </div>

                                <input type="hidden" name="product_id" value="1">

                                <input type="hidden" name="product_name" value="Nice Dog">
                                <input type="hidden" name="product_price" value="42">
                            </div>

                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg" style="font-size:120%;width: 100%">Pay</button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection