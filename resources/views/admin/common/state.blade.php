<div class="col-md-6">
    <label class="form-label" for="validationCustom04">{{ __('State') }}</label>
    <select class="form-select" id="state-dropdown" name="state_id">
        <option selected="" disabled="" value="">{{ __('Choose') }}</option>
        @foreach(App\Models\State::get() as $state)
        <option value="{{ $state->id }}" {{ (isset($data) && ($data->state_id == $state->id)) ? 'selected' : '' }}>{{ $state->name_en }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ __('Please select a state') }}</div>
</div>