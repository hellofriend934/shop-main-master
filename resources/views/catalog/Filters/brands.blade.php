<!-- Filter item -->
<div>
    <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{$filter->title()}}</h5>
    @foreach($filter->values() as $id => $label)
    <div class="form-checkbox">
        <input type="checkbox" name="{{$filter->name($id)}}" value="{{$id}}" id="{{$filter->id($id)}}" @checked($filter->requestValue($id))>
        <label for="{{$filter->id($id)}}" class="form-checkbox-label">{{$label}}</label>
    </div>
    @endforeach
</div>



