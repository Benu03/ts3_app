<div class="modal" role="dialog" id="updatePassword">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-modal">
            <div class="modal-header gradient-custom">
                <h5 class="modal-title" style="font-size: 18px !important; font-weight: 600;"><i class="nav-icon fas fa-cog"></i> Setting {{ Session::get('user')['username'] }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            Old Password
                        </label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="old_password" name="old_password">
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" style="cursor: pointer;" onclick="togglePassword('old_password', 'toggle-password')">
                                <img id="eyeIcon" src="{{ asset('img/logo/eye-open.png') }}" alt="Show Password">
                            </span>
                        </div>
                        </div>
                        <div id="validationoldPassword" class="text-danger">
                        <input type="hidden" name="username" id="username" value="{{ Session::get('user')['username'] }}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            New Password<font color="red">*</font>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="password" name="password">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" style="cursor: pointer;" onclick="togglePassword('password', 'toggle-password')">
                                    <img id="eyeIcon" src="{{ asset('img/logo/eye-open.png') }}" alt="Show Password">
                                </span>
                            </div>
                        </div>
                        <div id="validationPassword" class="text-danger">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            Confirm Password<font color="red">*</font>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="confirm_password" name="confirm_password">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-conf" style="cursor: pointer;" onclick="togglePassword('confirm_password', 'toggle-password-conf')">
                                    <img id="eyeIcon" src="{{ asset('img/logo/eye-open.png') }}" alt="Show Password">
                                </span>
                            </div>
                        </div>
                        <div id="validationConfPassword" class="text-danger">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #FFFFFF !important;color:#464F60 !important; border: 1px solid #464F60;" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn" id="updatePasswordBtn" style="background-color: #2E308A;color: white;">
                    SAVE CHANGES
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    .rounded-modal {
        border-radius: 20px;
    }
  </style>