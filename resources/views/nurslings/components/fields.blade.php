<label>Информация о владельце</label>
<hr>
<div class="form-group">
    <label>Владелец</label>
    <input class="form-control" placeholder="Введите ФИО владельца" name="owner_name" required autofocus @if(isset($nursling)) value="{{ $nursling->owner_name }}" @endif>
</div>
<div class="form-group">
    <label>Адрес</label>
    <input class="form-control" placeholder="Введите адрес" name="address" required autofocus @if(isset($nursling)) value="{{ $nursling->address }}" @endif>
</div>
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<hr>
<label>Информация о питомце</label>
<hr>
<div class="form-group">
    <label>Категория питомца</label>
    <select class="form-control" name="category_id" required @if(isset($nursling)) value="{{ $nursling->category_id }}" @endif>
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
<div class="form-group">
    <label>Порода / Окрас</label>
    <input class="form-control" placeholder="Введите породу или окрас питомца" name="breed" required autofocus @if(isset($nursling)) value="{{ $nursling->breed }}" @endif>
</div>
<div class="form-group">
    <label>Кличка</label>
    <input class="form-control" placeholder="Введите кличку питомца" name="nickname" required autofocus @if(isset($nursling)) value="{{ $nursling->nickname }}" @endif>
</div>