@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Coupon Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Coupon Update
        </h6>
        
        <div class="table-wrapper">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
            <form method="post" action="{{route('update.coupon',$editData->id)}}">
              @csrf
              <div class="modal-body pd-20">
                  <div class="mb-3">
                    <input type="text" class="form-control" value="{{$editData->coupon}}" placeholder="Coupon Code" name="coupon">
                  </div>
              </div>
              <div class="modal-body pd-20">
                <div class="mb-3">
                  <input type="text" class="form-control" value="{{$editData->discount}}" placeholder="Discount" name="discount">
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