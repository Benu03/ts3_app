@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/client/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $clientdata->id ?>">
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Client Name</label>
	<div class="col-sm-7">
		<input type="text" name="client_name" class="form-control" placeholder="]Client Name" value="<?php echo $clientdata->client_name ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Legal Name</label>
	<div class="col-sm-9">
		<input type="text" name="legal_name" class="form-control" placeholder="Legal Name" value="<?php echo $clientdata->legal_name ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Address</label>
	<div class="col-sm-9">
		<textarea name="address" id="address" class="form-control" id="address" placeholder="Address"><?php echo $clientdata->address ?></textarea>

	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Contact</label>
	<div class="col-sm-9">
		<input type="text" name="contact" class="form-control" placeholder="Contact" value="<?php echo $clientdata->contact ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Email</label>
	<div class="col-sm-9">
		<input type="text" name="email_client" class="form-control" placeholder="Email" value="<?php echo $clientdata->email_client ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Logo</label>
	<div class="col-sm-9">
		<input type="file" name="img_client" class="form-control" placeholder="Logo" value="{{ old('img_client') }}">
	</div>
</div>



<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Client Type</label>
	<div class="col-sm-7">
	
		<select name="client_type" class="form-control">
			<option hidden>Option</option>
			  <option value="<?php echo $clientdata->client_type ?>" <?php if($clientdata->client_type=='B2B') { echo 'selected'; } ?>>B2B</option>
			  <option value="<?php echo $clientdata->client_type ?>" <?php if($clientdata->client_type=='B2C') { echo 'selected'; } ?>>B2C</option>
			
		  </select>

	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Product</label>
	<div class="col-sm-9">

		<select name="mst_product_id[]" id="mst_product_id" class="form-control select2" multiple="multiple">
		
			<?php foreach($product as $rg) { ?>
			  <option value="<?php echo $rg->id ?>" 
				<?php     
				$str = $clientdata->mst_product_id;
				$delimiter = ',';
				$product_id = explode($delimiter, $str);
				foreach ($product_id as $rgg) {
						if($rgg==$rg->id) { echo 'selected'; } 
				}
				?>			
				><?php echo $rg->product_name ?></option>
			<?php } ?>
		  </select>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/client') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

