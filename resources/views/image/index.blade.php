<!DOCTYPE html>
<form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <button type="submit">Upload</button>
</form>
