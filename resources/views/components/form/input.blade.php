<div class="form-group">
    <label for=""><strong>{{$name}}</strong></label>
    <input type="{{$type}}" name="{{$id}}" id="{{$id}}" class="form-control"
     placeholder="{{$placeholder}}" value="{{(old($id)) ? old($id) : $value}}">
</div>