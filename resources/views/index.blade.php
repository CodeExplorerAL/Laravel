{{-- 15-2.控制器版( web.php & UserController.php & index.blade.php ) --}}
{{-- 15-3.Model版( web.php & UserController.php & index.blade.php & MyModel.php ) --}}

@foreach ($users as $user)
    <p>{{ $user->cname }}</p>
@endforeach
