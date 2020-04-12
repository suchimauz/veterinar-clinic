<div class="form-group">
    <label for="exampleInputEmail1">Причина обращения</label>
    <input class="form-control" placeholder="Введите причину обращения" name="complaint" autofocus required @if(isset($treatment)) value="{{ $treatment->complaint }}" @endif>
</div>
<div class="form-group">
    <label>Питомец</label>
    <select class="combobox input-large form-control" name="nursling_id" required @if(isset($treatment)) value="{{ $treatment->nursling_id }}" @endif>
        <option @if(!isset($treatment->nursling_id)) selected @endif value={{ null }}>Выберите питомца</option>
        @foreach ($nurslings as $nursling)
            <option 
                @if(isset($treatment->nursling_id))
                    @if($nursling->id == $treatment->nursling_id) selected @endif
                @endif
                value="{{ $nursling->id }}"
            >Питомец: {{ $nursling->nickname }} - {{ $nursling->category_name }}, Порода / Окрас: {{ $nursling->breed }}, Владелец: {{ $nursling->owner_name }}</option>
        @endforeach
    </select>
</div>