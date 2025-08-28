<div class="form-group">
    <label class="col-form-label">عنوان<span class="text-danger">*</span></label>
    <input autocomplete="off" type="text" name="title" class="form-control"
           placeholder="عنوان را وارد کنید."
           value="@if(isset($dayExercise)){{ json_decode($dayExercise->exercise->question)->title }}@else{{ old('title') }}@endif"/>
    <small class="form-text text-muted">عنوان را وارد کنید.</small>
</div>
