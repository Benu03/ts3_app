
@extends('layouts.lobby.main')

@section('content')
    @include('main.lobby.custom_css')



    <section class="content">
        <div class="container-fluid ">
                       
            <div class="content" style="padding:100px 150px 0 150px;">
             
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center pb-2">
                        <img src="{{ asset('img/logo/puninarlogo.png') }}" alt="PUNINAR SYSTEM" style="width: 300px; height: auto;">
                    </div>
                    
                  
                </div>
            </div>
        </div>
    </section>
@endsection

