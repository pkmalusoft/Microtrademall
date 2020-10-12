
<div class="form-group mx-0 {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="control-label">Title</label>
    <div class="">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($service)->title) }}" minlength="1" maxlength="255" required="true" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group mx-0 {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="">Description</label>
    <div class="">
        <textarea class="form-control" name="description" cols="50" rows="5" id="description" minlength="1" maxlength="1000">{{ old('description', optional($service)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="col-md-6   d-flex align-items-center justify-content-between">
    <div class="col-md-2 form-group mx-0">
        @if(optional($service)->icon)
            <img src="{{asset('media/'.$service->icon)}}" width="50" height="50px" class="img-circle img-responsive" style="max-height: 50px;object-fit: cover;object-position: top;">
        @else
        <i class="fa fa-question fa-4x"></i>
        @endif
    </div>
    <div class="col-md-10 form-group mx-0">
        <label>{{ __('Icon') }}</label>
        <div class="custom-file-upload">
            <input type="file" id="file" name="icon"/>
        </div>
    </div>
</div>
