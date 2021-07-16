@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
	    <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Fee Amount</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('fee.amount.store') }}">
                    @csrf
					  <div class="row">
						<div class="col-12">
                            <div class="add_item">
                                <div class="form-group">
								    <h5>Category<span class="text-danger">*</span></h5>
								    <div class="controls">
									    <select name="category_id" id="select" required class="form-control">
										    <option selected="" disabled="" value="">Select Category</option>
                                            @foreach($fee_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
									    </select>
								    </div>
							    </div>
                                <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
								        <h5>Class<span class="text-danger">*</span></h5>
								        <div class="controls">
									        <select name="class_id[]" id="select" required class="form-control">
										        <option selected="" disabled="" value="">Select Class</option>
										        @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
									        </select>
								        </div>
							        </div>
                                </div>
                                <div class="col-md-5">
					                <div class="form-group">
						                <h5>Fee amount<span class="text-danger">*</span></h5>
						                <div class="controls ">
							                <input type="text" name="amount[]" class="form-control" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-top:25px">
                                    <span class="btn btn-success addeventmore">
                                        <i class="fa fa-plus-circle"></i>
                                    </span>
							    </div>
                            </div>
                            </div>
                        </div>
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Add Fee Amount"/>
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

  <div style="visibility:hidden;">
    <div class="whole_extra_items_add" id="whole_extra_items_add">
        <div class="delete_whole_extra_items_add" id="delete_whole_extra_items_add">
            <div class="form_row">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
							<h5>Class<span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="class_id[]" id="select" required class="form-control">
									<option selected="" disabled="" value="">Select Class</option>
									@foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
								</select>
							</div>
						</div>
                    </div>
                    <div class="col-md-5">
					    <div class="form-group">
						    <h5>Fee amount<span class="text-danger">*</span></h5>
						    <div class="controls ">
							    <input type="text" name="amount[]" class="form-control" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-top:25px">
                        <span class="btn btn-success addeventmore">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="btn btn-danger removeeventmore">
                            <i class="fa fa-minus-circle"></i>
                        </span>
					</div>
                </div>
            </div>
        </div>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_items_add = $('#whole_extra_items_add').html();
            $(this).closest(".add_item").append(whole_extra_items_add);
            counter++;
        });
        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_whole_extra_items_add").remove();
            counter-=1;
        });
    });
  </script>
@endsection
