<!-- report-post-modal -->
{!! Form::open(['route' => 'postReport' , 'method' => 'post', 'data-parsley-validate']) !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="report-post-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">report (post)</h4>
      </div>
      <div class="modal-body">

          {!! Form::label('report-post-body','The reason (Min:3 characters - Max:20 characters):') !!}
          {!! Form::text('report-post-body',null,['class' => 'form-control', 'id' => 'report-post-body', 'required', 'minlength' => '3', 'maxlength' => '20']) !!} <br/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-report-post">Report</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!-- report-post-modal end -->

<!-- report-post-delete-modal -->
{!! Form::open(['route' => 'postReport' , 'method' => 'post']) !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="report-post-delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">delete report (post)</h4>
      </div>
      <div class="modal-body">
        are you sure you want to delete this report?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-report-post">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!-- report-post-delete-modal end -->

<!--edit-post-modal -->
{!! Form::open() !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="edit-post-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">edit (post)</h4>
      </div>
      <div class="modal-body">

          {!! Form::label('edit-post-title','edit the title:') !!}
          {!! Form::text('edit-post-title',null,['class' => 'form-control', 'id' => 'edit-post-title']) !!} <br/>

          {!! Form::label('edit-post-body','edit the post:') !!}
          {!! Form::textarea('edit-post-body',null,['class' => 'form-control', 'rows' =>'15' , 'id' => 'edit-post-body']) !!} <br/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit-post">edit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!--edit-post-modal end -->

<!--post-delete-modal -->
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="post-delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">delete (post)</h4>
      </div>
      <div class="modal-body">
        are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-post">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--post-delete-modal end -->

<!-- report-comment-modal -->
{!! Form::open(['data-parsley-validate']) !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="report-comment-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">report (comment)</h4>
      </div>
      <div class="modal-body">

          {!! Form::label('report-comment-body','The reason (Min:3 characters - Max:20 characters):') !!}
          {!! Form::text('report-comment-body',null,['class' => 'form-control', 'id' => 'report-comment-body', 'required', 'minlength' => '3', 'maxlength' => '20']) !!} <br/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-report-comment">Report</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!-- report-comment-modal end -->

<!-- report-comment-delete-modal -->
{!! Form::open() !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="report-comment-delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">delete report (comment)</h4>
      </div>
      <div class="modal-body">
        are you sure you want to delete this report?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-report-comment">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!-- report-comment-delete-modal end -->

<!--edit-comment-modal -->
{!! Form::open() !!}
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="edit-comment-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">edit (comment)</h4>
      </div>
      <div class="modal-body">

          {!! Form::label('edit-comment-body','edit the comment:') !!}
          {!! Form::textarea('edit-comment-body',null,['class' => 'form-control', 'rows' =>'2' , 'id' => 'edit-comment-body']) !!} <br/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit-comment">edit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}
<!--edit-comment-modal end -->

<!--comment-delete-modal -->
<div class="modal fade col-md-12" tabindex="-1" role="dialog" id="comment-delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">delete (comment)</h4>
      </div>
      <div class="modal-body">
        are you sure you want to delete this comment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-comment">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--comment-delete-modal end -->
