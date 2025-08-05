@extends('layout.lobby.main')

@section('content')
    {{-- Custom CSS --}}
    <style>
        .module-card {
            border-radius: 45px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .module-card:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .module-card-body {
            color: #2E308A;
            height: 110px;
            width: 100%;
            border-radius: 45px;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .module-img-container {
            width: 70px;
            height: 70px;
            overflow: hidden;
            margin-bottom: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .module-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            filter: brightness(1);
            transition: transform 0.3s ease;
        }

        .module-img:hover {
            transform: scale(1.1);
        }
    </style>

    {{-- Main Section --}}
    <section class="content">
        <div class="container-fluid">
            <div class="content" style="padding: 80px 150px 0 150px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 row d-flex justify-content-center">

                        @php
                            $modules = $data['module'];
                        @endphp

                        @foreach($modules as $module)
                            @if(strpos($module['platform'], 'web') !== false)
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    @php
                                        $datapassing = [
                                            'user' => $data['user'],
                                            'module' => $module
                                        ];
                                        $datapassingJson = json_encode($datapassing);
                                    @endphp

                                    @if(config('app.env') == 'production')
                                        <a href="{{ $module['url'] }}" class="card-link"
                                           onclick="openWithSession(event, '{{ $module['url'] }}', '{{ $datapassingJson }}')"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{ $module['module'] }}">
                                    @elseif(config('app.env') == 'development')
                                        <a href="{{ $module['url'] }}" class="card-link"
                                           onclick="openWithSessionDev(event, '{{ $module['local_url'] }}', '{{ $module['url'] }}', '{{ $datapassingJson }}')"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{ $module['module'] }}">
                                    @endif

                                        <div class="card module-card">
                                            <div class="card-body module-card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-12 d-flex flex-column align-items-center">
                                                        <div class="module-img-container">
                                                            <img src="{{ $module['image_module'] }}" class="module-img" alt="{{ $module['module'] }}">
                                                        </div>
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

    {{-- Bootstrap JS + Tooltip Init --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
