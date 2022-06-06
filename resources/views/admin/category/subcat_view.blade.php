@extends('admin.admin_master')

@section('main_content')
    
<div class="sl-mainpanel">

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Sub Category Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Sub Category List
            <a  href="#" style="float:right" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#AddNewCategory">Add New</a>
        </h6>
        
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">SL</th>
                <th class="wd-15p">Sub Category name</th>
                <th class="wd-15p">Category name</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subcat as $key => $value)
              <tr>
                <td>{{$key +1}}</td>
                <td>{{$value->subcategory_name}}</td>
                <td>{{$value->category_name}}</td>
                <td>
                    <a href="{{route('subcategory.edit',$value->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{route('subcategory.delete',$value->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Sub Category</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @if ($errors->any())
              @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">{{$error}}</div>
              @endforeach
          @endif
              <form method="post" action="{{route('store.subcategory')}}">
                @csrf
                <div class="modal-body pd-20">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sub Category Name" name="subcategory_name">
                    </div>

                    <div class="mb-3">
                        <label for="">Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $value)
                                <option value="{{$value->id}}">{{$value->category_name}}</option>
                            @endforeach
                        </select>
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