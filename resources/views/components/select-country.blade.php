<div class="mb-5">
    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{__("Country")}}</label>
    <select class="select2 "
     name="country_code">
        <option value="">-----</option>
        @foreach (\App\Utils\Country::get_countries() as $row)
            <option value="{{$row->dial_code}}" {{request("country_code")==$row->dial_code ? 'selected' :null}}>{{$row->flag}} - {{$row->name}}</option>
        @endforeach
    </select>
</div>