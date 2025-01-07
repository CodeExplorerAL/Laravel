{{-- 23-1. 表單驗證 --}}
{{-- <form action="/process" method="POST">
    @csrf
    <input name="message" value="{{ old('message') }}"><br>
    <input type="submit" value="送出">
</form> --}}

{{-- 23-2. 密碼驗證 --}}
<form action="/register" method="POST">
    @csrf
    Password: <input name="password" value="{{ old('password') }}"><br>
    Type Again: <input name="password_confirmation" value="{{ old('password_confirmation') }}"><br>
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
