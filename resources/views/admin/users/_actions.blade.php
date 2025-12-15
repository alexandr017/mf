<a href="{{route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
<form action="{{ route('admin.users.destroy',$user->id) }}" method="post" class="inline">
    {{ method_field('DELETE') }}
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
</form>

