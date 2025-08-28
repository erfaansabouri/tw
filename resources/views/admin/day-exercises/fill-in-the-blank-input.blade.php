<div class="form-group">
    <label class="col-form-label">عبارت جای خالی دار<span class="text-danger">*</span></label>
    <input autocomplete="off" type="text" name="phrase" class="form-control"
           placeholder="عبارت جای خالی دار."
           value="@if(isset($dayExercise)){{ json_decode($dayExercise->exercise->question)->phrase }}@else{{ old('phrase') }}@endif"/>
    <small class="form-text text-muted">راهنمایی: جا های خالی را با توکن [_] مشخص کنید تا به صورت اتوماتیک در اپلیکیشن جای خالی قرار داده شود.</small>
</div>
