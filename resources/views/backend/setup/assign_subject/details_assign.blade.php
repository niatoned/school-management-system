@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
	    <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Assignment Details</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="">
                    @csrf
					  <div class="row">
						<div class="col-12">
                            <div class="add_item">

                                @foreach($editData as $edit)
                                <div class="delete_whole_extra_items_add" id="delete_whole_extra_items_add">
                                    <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
								                    <h5>Subject<span class="text-danger"></span></h5>
                                                    <div class="controls ">
							                            <input type="text" disabled value="{{ $edit['school_subject']['name'] }}" class="form-control" >
                                                    </div>
							                    </div>
                                            </div>
                                            <div class="col-md-2">
					                            <div class="form-group">
						                            <h5>Full mark<span class="text-danger"></span></h5>
						                            <div class="controls ">
							                            <input type="text" disabled value="{{$edit->full_mark}}"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
					                            <div class="form-group">
						                            <h5>Pass mark<span class="text-danger"></span></h5>
						                            <div class="controls ">
							                            <input type="text" disabled value="{{$edit->pass_mark}}"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
					                            <div class="form-group">
						                            <h5>Subjective mark<span class="text-danger"></span></h5>
						                            <div class="controls ">
							                            <input type="text" disabled value="{{$edit->subjective_mark}}"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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

@endsection
