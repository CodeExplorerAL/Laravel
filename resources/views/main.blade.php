{{-- 12-1.條件判斷 --}}

{{-- <body>
    @if ($n == 1)
        Hello, 1
    @elseif ($n == 0)
        Hello, 0
    @else
        Others
    @endif
</body> --}}



{{-- 12-2.For 迴圈 --}}
{{-- <h3>數字列表 (最大值: {{ $n }})</h3>
<ul>
    @for ($i = 0; $i < $n; $i++)
        <li>{{ $i }}</li>
    @endfor
</ul> --}}



{{-- 12-3.ForEach 迴圈 --}}
{{-- <h3>水果清單</h3>
<div>
    @foreach ($arr as $el)
    <p>{{ $loop->index }} : {{ $el }}</p>
    @endforeach
</div> --}}


{{-- 12-4.PHP 區段 --}}
{{-- <h3>計數器範例</h3> --}}

{{-- 多行 --}}
{{-- @php
    $multiLineCounter = 1;
    $multiLineCounter = 2;
    $multiLineCounter = 3;
    // 你可以在這裡添加更多代碼，例如增加計數器的值
@endphp
<p>多行計數器的值是：{{ $multiLineCounter }}</p> --}}

{{-- 單行 --}}
{{-- @php($singleLineCounter = 1)
<p>單行計數器的值是：{{ $singleLineCounter }}</p> --}}


{{-- 12-5.表單 --}}
<!-- POST 請求 -->
<form action="{{ route('main') }}" method="POST">
    @csrf
    <input type="text" name="example" placeholder="輸入一些內容" required>
    <button type="submit">提交 POST</button>
</form>

<h1>更新表單範例</h1>

<!-- PUT 請求 -->
<form action="{{ route('main') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="example" placeholder="輸入一些內容" required>
    <button type="submit">提交 PUT</button>
</form>
