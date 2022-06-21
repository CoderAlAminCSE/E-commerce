@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Coupon Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Coupon List
            <a  href="#" style="float:right" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#AddNewCategory">Add New</a>
        </h6>
        
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">SL</th>
                <th class="">Coupon Coed</th>
                <th class="">Percentage</th>
                <th class="wd-15">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allData as $key => $value)
              <tr>
                <td>{{$key +1}}</td>
                <td>{{$value->coupon}}</td>
                <td>{{$value->discount}} %</td>
                <td>
                    <a href="{{route('coupon.edit',$value->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{route('coupon.delete',$value->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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
        <div id="AddNewCategory" class="modal fade"> 
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Coupon</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
              <form method="post" action="{{route('store.coupon')}}">
                @csrf
                <div class="modal-body pd-20">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Coupon Code" name="coupon">
                    </div>
                </div>

                <div class="modal-body pd-20">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Coupon Discount %" name="discount">
                    </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                </div>
                </form>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->


@endsection