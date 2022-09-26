<div class="col-md-6">
    <label class="form-label" for="validationCustom04">{{ __('Country') }}</label>
    <select class="form-select" id="country-dropdown" name="country_id">
        <option selected="" disabled="" value="">{{ __('Choose') }}</option>
        @foreach(App\Models\Country::get() as $country)
        <option value="{{ $country->id }}" {{ (isset($data) && ($data->country_id == $country->id)) ? 'selected' : '' }}>{{ $country->name_en }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ __('Please select a country') }}</div>
</div>