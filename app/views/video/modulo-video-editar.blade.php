@if(count($item->videos) == 2)
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
@elseif(count($item->videos) == 1)
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
@elseif(count($item->videos) == 0)
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
    <div class="form-group marginBottom2">
        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
    </div>
@endif