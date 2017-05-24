@extends('cp.master')

@section('title','categories')

@section('page-content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      @include('layouts.errors')
    {!! Form::open(['route' => 'addCategory' ,'class' => 'has-success', 'method' => 'post']) !!}

      <label for="category"><h3 style="color:#14931d"><b>Add new category:</b></h3></label>

      <table class="table">
        <tr>
          <td>{!! Form::text('category' ,null,['class' => 'form-control has-success','id' => 'category']) !!}</td>
          <td>{!! Form::submit('Add', ['class' => 'btn btn-success']) !!}</td>
        </tr>
      </table>

    {!! Form::close() !!}
    </div>
  </div>

  <div class="row" style="margin-top:20px;">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-success text-center success-msg" style="display:none;">the category successfully deleted</div>
      <table class="table">

        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Created at</th>
          <th>Action</th>
        </thead>

        <tbody>
          @foreach($categories as $category)
            <tr>
              <th>{{ $category->id }}</th>
              <td>{{ $category->category }}</td>
              <td>{{ $category->created_at }}</td>
              <td>
                <a href="#" class="btn btn-default edit-category-btn">edit</a>
                <a href="#" class="btn btn-danger delete-category-btn">delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>

  <!-- edit-category-modal -->
  {!! Form::open(['route' => 'editCategory', 'method' => 'post','data-parsley-validate']) !!}
  <div class="modal fade col-md-6 col-md-offset-3" tabindex="-1" role="dialog" id="edit-category-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">edit The category</h4>
        </div>
        <div class="modal-body">

            {!! Form::label('categoryedit','the Category:') !!}
            {!! Form::text('categoryedit',null,['class' => 'form-control', 'required', 'minlength' => '3']) !!} <br/>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-category">save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  {!! Form::close() !!}
  <!-- edit-category-modal end -->

  <!--category-delete-modal -->
  <div class="modal fade col-md-6 col-md-offset-3" tabindex="-1" role="dialog" id="category-delete-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">delete (category)</h4>
        </div>
        <div class="modal-body">
          are you sure you want to delete this category (posts and the comments in this categaory will be deleted too)?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="delete-category">Delete</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--category-delete-modal end -->

  <script type="text/javascript">
    var urlEditCategory = '{{ route('editCategory') }}';
    var deleteCategoryUrl = '{{ route('deleteCategory') }}';
    var catUrl ='{{ route('cp-categories') }}';
    var token = '{{ Session::token() }}';
  </script>
@endsection
