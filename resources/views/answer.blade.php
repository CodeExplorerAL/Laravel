<!-- resources/views/answer.blade.php -->
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算結果</title>
</head>

<body>
    <h1>計算結果</h1>
    <p>Number A: {{ $a }}</p>
    <p>Number B: {{ $b }}</p>
    <p>總和: {{ $answer }}</p>


    {{-- 9.表單設計 (與 web.php & FormController.php & form.blade.php 搭配) --}}
    {{-- <a href="{{ route('form') }}">回到表單</a> --}}

    {{-- 10.建立 Model (與 web.php & FormController.php & form.blade.php & MyModel.php 搭配) --}}
    <a href="{{ route('form2') }}">回到表單</a>
</body>

</html>
