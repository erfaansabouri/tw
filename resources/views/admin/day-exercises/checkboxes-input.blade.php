<div class="form-group">
    <label class="col-form-label">چک باکس ها<span class="text-danger">*</span></label>
    @foreach(json_decode($dayExercise->exercise->question) as $key => $li_item)
        <input autocomplete="off" type="text" name="li_items[]" class="form-control"
               placeholder="چک باکس ها."
               value="{{ $li_item->li }}"/>
        <br>
    @endforeach

    <small class="form-text text-muted">چک باکس ها.</small>
</div>
