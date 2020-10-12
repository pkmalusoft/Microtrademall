@extends('layouts.user')

@section('content')
     {{--  --}}
    <div class="authRightBlock">
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('success_message') !!}

                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif

        <div class="panel panel-default">

            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <h4 class="mt-5 mb-5">General Information</h4>
                </div> 
            </div>
            
            
            <div class="panel-body panel-body-with-table">
                <form action="{{URL::to('admin/terms')}}" method="post">
                    @csrf 
                    <div class="row mx-0" id="termsList">   

                        <div class="form-group  col-md-12 mx-0">
                            <label for="terms" class="">Terms & Conditions</label>
                            <div class="">
                                <textarea class="form-control jsEditor"  name="terms" type="textarea">{{$terms->terms ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group  col-md-12 mx-0">
                            <label for="About Us" class="">About Us</label>
                            <div class="">
                                <textarea class="form-control jsEditor"  name="about" type="textarea">{{$terms->about ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
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
        selector: '.jsEditor'
      });                                            
    
</script>
@endsection
