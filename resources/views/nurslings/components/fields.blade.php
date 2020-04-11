<div class="form-group">
    <label>Владелец</label>
    <input class="form-control" placeholder="Введите ФИО владельца" name="owner_name" @if(isset($nursling)) value="{{ $nursling->owner_name }}" @endif>
</div>
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<div class="form-group">
    <label>Категория питомца</label>
    <select class="form-control" name="category_id" @if(isset($nursling)) value="{{ $nursling->category_id }}" @endif>
        <option @if(!isset($nursling->category_id)) selected @endif value={{ null }}>Выберите категорию питомца</option>
        @foreach ($categories as $category)
            <option 
                value="{{ $category->id }}"
                @if(isset($nursling->category_id))
                    @if($nursling->category_id == $category->id)
                        selected
                    @endif
                @endif
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>