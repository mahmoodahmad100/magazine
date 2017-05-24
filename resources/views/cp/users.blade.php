@extends('cp.master')

@section('title','users')

@section('page-content')


  <div class="row" style="margin-top:20px;">
    <div class="col-md-12">
      <table class="table">

        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Created at</th>
          <th>Action</th>
        </thead>

        <tbody>
          @foreach($users as $user)
            <tr class="{{ $user->id == 1 ? 'bg-info' : '' }}">
              <th>{{ $user->id }}</th>
              <td>{{ $user->username }}</td>
              <td>{{ $user->created_at }}</td>
              <td>
                @if(Auth::user()->id != $user->id && $user->id != 1)
                  <a data-isadmin="{{ $user->admin }}" href="#" class="btn btn-primary admin-btn">{{ $user->admin == 0 ? 'Admin' : 'Admin (yes)' }}</a>
                  <a data-isban="{{ $user->ban }}" href="#" class="btn btn-danger ban-btn">{{ $user->ban == 0 ? 'Ban' : 'Banned (yes)' }}</a>
                @elseif ($user->id == 1)
                  {{ Auth::user()->id == 1 ? 'you' :$user->username}}{{ ' is the CEO of that website' }}
                @else
                {{ 'you can not make action for yourself' }}
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
    <div class="text-center">
      {{ $users->links() }}
    </div>
  </div>
  <script type="text/javascript">
    var makeAdminUrl = '{{ route('makeAdmin') }}';
    var makeBanUrl = '{{ route('makeBan') }}';
    var token = '{{ Session::token() }}';
  </script>
@endsection
