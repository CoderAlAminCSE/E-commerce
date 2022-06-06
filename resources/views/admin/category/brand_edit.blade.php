@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Brand Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Brand Update
        </h6>
        
        <div class="table-wrapper">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
            <form method="post" action="{{route('update.brand',$editData->id)}}" enctype="multipart/form-data">
              @csrf
              <div class="modal-body pd-20">
                  <div class="mb-3">
                    <input type="text" class="form-control" value="{{$editData->brand_name}}" placeholder="Brand" name="brand_name">
                  </div>
              </div>
              <div class="modal-body pd-20">
                <div class="mb-3">
                    <img src="{{url('upload/brands/'.$editData->brand_logo)}}" alt="" style="height: 80px;height:80px">
                </div>
            </div>
              <div class="modal-body pd-20">
                <div class="mb-3">
                  <input type="file" class="form-control" value="{{$editData->brand_logo}}" placeholder="Brand Logo" name="brand_logo">
                </div>
            </div>

            <div class="modal-body pd-20">
                <div class="mb-3">
                  <input type="hidden" class="form-control" value="{{$editData->brand_logo}}" name="old_logo">
                </div>
            </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
              </div>
          </form>
        </div><!-- table-wrapper -->
      </div><!-- card -->
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->


@endsection