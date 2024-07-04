@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/user/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id_user" value="<?php echo $user->id_user ?>">
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama lengkap</label>
	<div class="col-sm-9">
		<input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="<?php echo $user->nama ?>" required readonly>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Email</label>
	<div class="col-sm-9">
		<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Username</label>
	<div class="col-sm-9">
		<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user->username ?>" required readonly>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Password</label>
	<div class="col-sm-9">
		<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $user->password ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Role Akses</label>
	<div class="col-sm-9">
	
		<select name="role" class="form-control" id="role">
			<option hidden>Option</option>
			<?php foreach($roledata as $roles) { ?>
			  <option value="<?php echo $roles->id ?>" <?php if($user->id_role==$roles->id) { echo 'selected'; } ?>><?php echo $roles->role_title ?></option>
			<?php } ?>
		  </select>

	</div>
</div>

<div class="form-group row" id="div_customer">
	<label class="col-sm-3 control-label text-right">Client Entity</label>
	<div class="col-sm-9">
		<select name="customer" class="form-control select2">

			<?php foreach($customerdata as $cus) { ?>
			  <option value="<?php echo $cus->id ?>" <?php if($usercustomer->mst_client_id==$cus->id) { echo 'selected'; } ?>><?php echo $cus->client_name.'-'.$cus->client_type ?></option>
			<?php } ?>
		  </select>

	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Phone</label>
	<div class="col-sm-3">
		<input type="text" name="phone" class="form-control" placeholder="Nama lengkap" value="<?php echo $user->phone ?>" onkeypress="return isNumber(event)" required >	
	</div>

</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">WhatsApp</label>
	<div class="col-sm-3">
		<input type="text" name="wa" class="form-control" placeholder="Nama lengkap" value="<?php echo $user->wa_number ?>"  onkeypress="return isNumber(event)" required >	
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Active</label>
	<div class="col-sm-4">

			<input type="checkbox" class="icheckbox_flat-blue " name="active"  <?php if($user->is_active== '1') { echo 'checked'; } ?>  value>
			
	</div> 

</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Confirm</label>
	<div class="col-sm-4">

			<input type="checkbox" class="icheckbox_flat-blue " name="confirm"  <?php if($user->is_confirm== 'true') { echo 'checked'; } ?>>
			
	</div> 

</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Upload foto profil</label>
	<div class="col-sm-9">
		<input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/user') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>


<script>
	




						var select = document.getElementById('role');
						var datarole = select.options[select.selectedIndex].value;
								console.log(datarole);
								if (datarole == "3" || datarole == "5" || data == "6" ) {
									$('#div_customer').show();
									} 
									else {
									$('#div_customer').hide();
									}


  					$('document').ready(function () {
						



					   			$("#role").change(function () {
										var data = $(this).val();
										
											if (data == "3" || data == "5" || data == "6" ) {
											$('#div_customer').show();
											} 
											else {
											$('#div_customer').hide();
											}
								});
					   });

</script>
