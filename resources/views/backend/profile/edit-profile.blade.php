@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
	    <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit User</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('user.update', $editData->id) }}">
                    @csrf
					  <div class="row">
						<div class="col-12">
                            <div class="form-group">
								<h5>User Role<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="usertype" id="select" required class="form-control">
										<option selected="" disabled="" value="">Select Role</option>
										<option value="admin" selected="{{ ($editData->usertype == 'admin') ? 'true' : 'false'}}">Admin</option>
										<option value="user" selected="{{ ($editData->usertype == 'user') ? 'true' : 'false'}}">User</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<h5>User Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" value="{{ $editData->name }}" class="form-control" required data-validation-required-message="This field is required">
                                </div>
							</div>
							<div class="form-group">
								<h5>User Email<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" value="{{ $editData->email }}" class="form-control" required data-validation-required-message="This field is required">
                                </div>
							</div>
                            <div class="form-group">
								<h5>User Mobile<span class="text-danger"></span></h5>
								<div class="controls">
									<input type="number" name="mobile" value="{{ $editData->mobile }}" class="form-control" required data-validation-required-message="This field is required">
                                </div>
							</div>
                            <div class="form-group">
								<h5>User Address<span class="text-danger"></span></h5>
								<div class="controls">
									<input type="text" name="address" value="{{ $editData->address }}" class="form-control">
                                </div>
							</div>
                             <div class="form-group">
								<h5>User Gender<span class="text-danger"></span></h5>
								<div class="controls">
									<select name="usertype" id="select" class="form-control">
										<option selected="" disabled="" value="">Select gender</option>
										<option value="male" selected="{{ ($editData->usertype == 'male') ? 'true' : 'false'}}">Male</option>
										<option value="female" selected="{{ ($editData->usertype == 'female') ? 'true' : 'false'}}">Female</option>
									</select>
								</div>
							</div>
                            <div class="form-group">
								<h5>User Image<span class="text-danger"></span></h5>
								<div class="controls">
									<input type="file" name="image" id="image" class="form-control">
                                </div>
							</div>
                            <div class="form-group">
								<div class="controls">
									<img id="showImage" src="{{(!empty($user->image)) ? url('upload/user_images/'.$user->image) : url('upload/no_image.jpg') }}">
                                </div>
							</div>
						</div>
					  </div>
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Update"/>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
          </section>
	  </div>
  </div>

  <script type="text/javascript">
  $(document).ready(function(){
      $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
  });
  </script>

@endsection
