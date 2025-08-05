
@extends('layout.lobby.main')

@section('content')
    @include('main.lobby.custom_css')

    
   
    <section class="content">
        <div class="container-fluid ">
          
            <div class="content" style="padding:80px 150px 0 150px;">
                
                
                {{-- <div id="bannerSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="15000" style="margin-bottom: 20px;">
                    <div class="carousel-inner">
                        @foreach($data['banners'] as $index => $banner)
                            <div class="carousel-item @if($index == 0) active @endif">
                                <img src="{{ $banner['image_url'] }}" class="d-block w-100" style="border-radius: 20px;" alt="{{ $banner['alt_text'] }}">
                            </div>
                        @endforeach
                    </div>
                    
                  
                </div> --}}

                <div class="row">
              
                    <div class="col-lg-12 col-md-12 row d-flex justify-content-center">
                       
                    @php
                        $modules = $data['module'];
                    @endphp

@foreach($modules as $module)
@if(strpos($module['platform'], 'web') !== false)
    <div class="col-lg-2 col-md-2 mb-2">
        @php
            $datapassing = [
                'user' => $data['user'],
                'module' => $module
            ];
            $datapassingJson = json_encode($datapassing);
        @endphp

        @if(config('app.env') == 'production')
            <a href="{{ $module['url'] }}" class="card-link" 
               onclick="openWithSession(event, '{{ $module['url'] }}', '{{ $datapassingJson }}')">
        @elseif(config('app.env') == 'development')
            <a href="{{ $module['url'] }}" class="card-link" 
               onclick="openWithSessionDev(event, '{{ $module['local_url'] }}', '{{ $module['url'] }}', '{{ $datapassingJson }}')">
        @endif

            <div class="card" style="border-radius: 45px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s, box-shadow 0.2s; background-color: rgba(255, 255, 255, 0.149);">
                <div class="card-body" style="color: #2E308A; height: 110px; width: 100%; border-radius: 45px; background-color: rgba(255, 255, 255, 0.173); display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <div class="row align-items-center">
                        <div class="col-12 d-flex flex-column align-items-center">
                            <div style="width: 70px; height: 70px; overflow: hidden;  margin-bottom: 5px; display: flex; justify-content: center; align-items: center;">
                                <img src="{{ $module['image_module'] }}" 
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); filter: brightness(1)">
                            </div>
                            <span style="color: #009568; font-weight: 700; font-size: 14px; text-align: center;">{{ $module['module'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif
@endforeach


               
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Inisialisasi Carousel Secara Manual -->
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myCarousel = document.getElementById('bannerSlider');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 8000, 
                ride: 'carousel'
            });
        });
    </script> --}}

@endsection


