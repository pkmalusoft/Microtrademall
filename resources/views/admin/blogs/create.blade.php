@extends('layouts.user')

@section('content')
     {{--  --}}
    <div class="authRightBlock">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Blog</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('blogs.blog.index') }}" class="btn btn-primary" title="Show All Blog">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
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

            <form method="POST" action="{{ route('blogs.blog.store') }}" accept-charset="UTF-8" id="create_blog_form" name="create_blog_form" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('admin.blogs.form', [
                                        'blog' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
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

