<div class="row">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} col-md-4 mx-0">
        <label for="title" class="">Title</label>
        <div class="">
            <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($plan)->title) }}" minlength="4" maxlength="255" required="true">
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} col-md-4 mx-0">
        <label for="price">Price</label>
        <div>
            <input class="form-control" name="price" type="text" id="price" value="{{ old('price', optional($plan)->price) }}" min="2" max="2147483647" required="true">
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}  col-md-4 mx-0">
        <label for="duration" class="">Duration (days)</label>
        <div>
            <input class="form-control" name="duration" type="text" id="duration" value="{{ old('duration', optional($plan)->duration) }}" min="5" max="2147483647" required="true">
            {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }} col-md-12 mx-0">
        <label for="services" class="">Services (separate with comma)</label>
        <div class="">
            <textarea class="form-control" name="services" cols="50" rows="10" id="services" minlength="1" required="true">{{ old('services', optional($plan)->services) }}</textarea>
            {!! $errors->first('services', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }} col-md-12 mx-0">
        <label for="is_active">Is Active</label>
        <div>
            <div class="checkbox">
                <label for="is_active_1">
                	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($plan)->is_active) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

