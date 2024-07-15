
@extends('layout.lobby.main')

@section('content')
    @include('main.lobby.custom_css')

    
   
    <section class="content">
        <div class="container-fluid ">
           
            <div class="content" style="padding:100px 100px 0 100px;">
                
             
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center pb-2">
                        <img src="{{ asset('assets/upload/image/2.png') }}" alt="TS3 SYSTEM" style="width: 130px; height: auto;">
                    </div>
                    
                    <div class="col-lg-12 col-md-12 text-center pb-2" style="margin-top: 24px;">
                        <strong style="font-size:20px;font-weight:700;">Aplikasi Modul Anda</strong>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center pb-5">
                        <span style="font-size:14px;font-weight:400;">
                            Selamat datang! Berikut adalah daftar aplikasi yang dapat Anda akses. Jelajahi dan kelola aplikasi yang tersedia di bawah ini.
                        </span>
                    </div>
                    <div class="col-lg-12 col-md-12 row d-flex justify-content-center">
                       
                    @php
                        $modules = $data['module'];
                    @endphp
                    
                    @foreach($modules as $module)
                      @if(strpos($module['platform'], 'web') !== false)
                        <div class="col-lg-3 col-md-3 mb-2">
                            @php
                                $datapassing = [
                                'user' => $data['user'],
                                'module' => $module
                                ];
                                $datapassingJson = json_encode($datapassing);
                            @endphp

                            @if(config('app.env') == 'production')
                            <a href="{{ $module['url'] }}" class="card-link" onclick="openWithSession(event, '{{ $module['url'] }}', '{{ $datapassingJson }}')">
                            @endif
                            @if(config('app.env') == 'development')
                            <a href="{{ $module['url'] }}" class="card-link" onclick="openWithSessionDev(event,'{{ $module['local_url'] }}', '{{ $module['url'] }}', '{{ $datapassingJson }}')">
                            @endif

                                <div class="card" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s, box-shadow 0.2s; background-color: rgba(255, 255, 255, 0.5);">
                                    <div class="card-body" style="color: #2E308A; height: 110px; width: 100%; border-radius: 30px; background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="row align-items-center">
                                            <div class="col-4 col-md-4 text-center text-md-left">
                                                <img src="{{ $module['image_module'] }}" alt="TS3 SYSTEM" style="width: 70px; height: 70px; object-fit: cover; margin-right: 25px;">
                                            </div>
                                            <div class="col-8 col-md-8">
                                                <div class="d-flex flex-column justify-content-center h-100 text-center text-md-left">
                                                    <span style="color: #2E308A; font-weight: 700; font-size: 16px;">{{ $module['module'] }}</span>
                                                    <div style="margin-top: 10px; color: #898ac1; font-weight: 700; font-size: 12px;">
                                                        Role: {{ $module['role'] }}
                                                        
                                                    </div>
                                                 

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>





                            {{-- @if(config('app.env') == 'production')
                            <a href="{{ $module['url'] }}" class="card-link" target="_blank" onclick="openWithSession(event, '{{ $module['url'] }}', '{{ $datapassingJson }}')">
                            @endif

                            <div class="card" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s, box-shadow 0.2s; background-color: rgba(255, 255, 255, 0.5);">
                            <div class="card-body" style="color: #2E308A; height: 110px; width: 100%; border-radius: 30px; background-color: rgba(255, 255, 255, 0.5);">
                                <div class="row align-items-center">
                                    <div class="col-4 col-md-4 text-center text-md-left">
                                        @if(config('app.env') == 'development')
                                            <a href="{{ $module['url'] }}" class="card-link" target="_blank" onclick="openWithSession(event, '{{ $module['url'] }}', '{{ $datapassingJson }}')">
                                        @endif
                                        <img src="{{ $module['image_module'] }}" alt="PUNINAR SYSTEM" style="width: 70px; height: 70px; object-fit: cover; margin-right: 25px;">
                                        @if(config('app.env') == 'development')
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-8 col-md-8">
                                        @if(config('app.env') == 'development')
                                            <a href="{{ $module['local_url'] }}" class="card-link" target="_blank" onclick="openWithSession(event, '{{ $module['local_url'] }}', '{{ $datapassingJson }}')">
                                        @endif
                                        <div class="d-flex flex-column justify-content-center h-100 text-center text-md-left">
                                            <span style="color: #2E308A; font-weight: 700; font-size: 16px;">{{ $module['module'] }}</span>
                                            <div style="margin-top: 10px; color: #898ac1; font-weight: 700; font-size: 12px;">
                                                Role: {{ $module['role'] }}
                                            </div>
                                        </div>
                                        @if(config('app.env') == 'development')
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </div>

                            @if(config('app.env') == 'production')
                            </a>
                            @endif --}}




                        </div>
                        
                        @endif
                    @endforeach
                    

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

