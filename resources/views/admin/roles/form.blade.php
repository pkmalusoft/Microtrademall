<div class="col-md-12 col-lg-12 px-0">
	<div class="col-md-6 col-lg-6  mx-0 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	    <label for="title" class="">Title</label>
	    <div class="">
	        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($role)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
	        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	    </div>
	</div>

	<div class="col-md-6 col-lg-6  mx-0 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	    <label for="title" class="">I want to:</label>
	    <div class="">
	        <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($role)->description) }}" minlength="1" maxlength="255" placeholder="Enter description here...">
	        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
	    </div>
	</div>
</div>

