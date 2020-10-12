@extends('layouts.user')

@section('content')

    {{--  --}}
    <div class="authRightBlock">
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($blog->title) ? $blog->title : 'Blog' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('blogs.blog.index') }}" class="btn btn-primary" title="Show All Blog">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('blogs.blog.create') }}" class="btn btn-success" title="Create New Blog">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('blogs.blog.update', $blog->id) }}" id="edit_blog_form" name="edit_blog_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.blogs.form', [
                                        'blog' => $blog,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
 tinymce.init({
    selector: '.jsEditor',
     plugins: "link",
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  });                                            

</script>
    
@endsection