<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changepasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-modal">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 18px !important; font-weight: 600;"> <i class="nav-icon fas fa-key"></i> Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            Username
                        </label>
                        <input type="text" class="form-control" name="username" id="username" readonly="" value=" {{ Session::get('user')['username'] }}">
                       
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            Old Password<font color="red">*</font>
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-old" style="cursor: pointer;" onclick="togglePassword('old_password', 'toggle-password-old')">
                                    <img id="eyeIcon" src="{{ config('static.url_portal_ts3_main') }}img/logo/eye-close.png" alt="Show Password">
                                </span>
                            </div>
                        </div>
                        <div id="validationOldPassword" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            New Password<font color="red">*</font>
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" style="cursor: pointer;" onclick="togglePassword('password', 'toggle-password')">
                                    <img id="eyeIcon" src="{{ config('static.url_portal_ts3_main') }}img/logo/eye-close.png" alt="Show Password">
                                </span>
                            </div>
                        </div>
                        <div id="validationPassword" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="text-dark text-lg" style="font-weight: 400;font-size:14px !important;">
                            Confirm Password<font color="red">*</font>
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-conf" style="cursor: pointer;" onclick="togglePassword('confirm_password', 'toggle-password-conf')">
                                    <img id="eyeIcon" src="{{ config('static.url_portal_ts3_main') }}img/logo/eye-close.png" alt="Show Password">
                                </span>
                            </div>
                        </div>
                        <div id="validationConfPassword" class="text-danger"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #FFFFFF !important;color:#464F60 !important; border: 1px solid #464F60;" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn" id="updatePasswordBtn" style="background-color: #2bc24e;color: white;">
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