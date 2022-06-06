@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Sub Category Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Sub Category Update</h6>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        @endif
        <form method="post" action="{{route('update.subcategory',$editData->id)}}">
            @csrf
            <div class="modal-body pd-20">
                <div class="mb-3">
                    <label for="">SubCategory Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sub Category Name" value="{{$editData->subcategory_name}}" name="subcategory_name">
                </div>

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <select name="category_id" class="form-control">
                        @foreach ($category as $value)
                            <option value="{{$value->id}}" @php
                                if($value->id == $editData->category_id){echo "selected";}
                            @endphp>{{$value->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info pd-x-20">Submit</button>
            </div>
        </form>
      </div><!-- card -->
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
@endsection