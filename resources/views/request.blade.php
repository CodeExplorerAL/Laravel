{{-- 23. 驗證 --}}
<form action="/process" method="POST">
    @csrf
    <input name="message" value="{{ old('message') }}"><br>
    <input type="submit" value="送出">
</form>

<!-- 錯誤訊息顯示 -->
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
