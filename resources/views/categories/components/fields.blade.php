<div class="form-group">
    <label>Название категории</label>
    <input class="form-control" placeholder="Например: Собака" name="name" required autofocus @if(isset($category)) value="{{ $category->name }}" @endif>
</div>