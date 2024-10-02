<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0"> <!-- Menghilangkan padding dari modal body -->
                <div class="row d-flex justify-content-center align-items-center h-100 mx-0"> <!-- Menghilangkan margin kanan dan kiri -->
                    <div class="col col-lg-12 px-0"> <!-- Menghilangkan padding dari kolom -->
                        <div class="card border-0 shadow-lg" style ="margin-bottom: 0;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white p-4"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="{{ asset('img/logo/user.png') }}"
                                        alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 80px;">
                                    <h5 class="mb-0" style="text-transform: uppercase;"> {{ Session::get('user')['full_name'] }}</h5>
                                    <p class="mb-1">{{ Session::get('user')['username'] }}</p>
                                    <br>
                                    <p class="text-muted mb-0"><i class="fas fa-phone"></i> {{ Session::get('user')['phone'] }}</p>
                                    <p class="text-muted mb-0">
                                        <i class="fab fa-whatsapp"></i> 
                                        <a href="https://web.whatsapp.com/send?phone={{ Session::get('user')['wa_number'] }}" target="_blank">
                                            {{ Session::get('user')['wa_number'] }}
                                        </a>
                                    </p>
                                   
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4"  style ="margin-bottom: 0;">
                                        <h6 class="mb-3">Information</h6>
                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <h6>Email</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['email'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <h6>NIK</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['nik'] }}</p>
                                            </div>
                                           
                                        </div>
                                        {{-- <div class="row mb-4">
                                            <div class="col-6">
                                                <h6>Phone</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['phone'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <h6>Whatsapps</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['wa_number'] }}</p>
                                            </div>
                                        </div> --}}

                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <h6>Entity</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['entity'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <h6>Division</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['division'] }}</p>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <h6>Department</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['department'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <h6>Position</h6>
                                                <p class="text-muted mb-0">{{ Session::get('user')['position'] }}</p>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
