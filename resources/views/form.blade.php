<!-- resources/views/form.blade.php -->
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算表單</title>
</head>

<body>
    {{-- 9.表單設計 (與 web.php & FormController.php & answer.blade.php 搭配) --}}
    {{-- <form method="post" action="{{ route('form.submit') }}"> --}}

    {{-- 10.建立 Model (與 web.php & FormController.php & answer.blade.php & MyModel.php 搭配) --}}
    <form method="post" action="{{ route('form.submit2') }}">


        @csrf
        <p><label>Number A: </label><input name="a" required></p>
        <p><label>Number B: </label><input name="b" required></p>
        <input type="submit" value="計算">
    </form>
</body>

</html>
