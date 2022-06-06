@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Brand Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Brand List
            <a  href="#" style="float:right" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#AddNew">Add New</a>
        </h6>
        
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">SL</th>
                <th class="wd-15p"> Name</th>
                <th class="wd-15p"> Logo</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allData as $key => $value)
              <tr>
                <td>{{$key +1}}</td>
                <td>{{$value->brand_name}}</td>
                <td>
                    <img src="{{url('upload/brands/'.$value->brand_logo)}}" alt="" style="height: 80px;height:80px">
                </td>
                <td>
                    <a href="{{route('brand.edit',$value->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{route('brand.delete',$value->id)}}" class=" btn btn-danger" id="delete">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->




  
        <!-- LARGE MODAL -->
        <div id="AddNew" class="modal fade"> 
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Brand</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @if ($errors->any())
              @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">{{$error}}</div>
              @endforeach
          @endif
              <form method="post" action="{{route('store.brand')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-20">
                    <div class="mb-3">
                      <input type="text" class="form-control"  placeholder="Brand Name" name="brand_name">
                    </div>
                    <div class="mb-3">
                        <label for="">Brand Logo</label>
                        <input type="file" class="form-control"  placeholder="Brand Logo" name="brand_logo">
                      </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                </div>
            </form>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->


@endsection