@if($errors->any())
<div class="alert alert-danger text-center">
    <p>Đã có lỗi xảy ra, vui lòng kiểm tra lại</p>
</div>
@endif

@if (session('error'))
    <div class="alert alert-warning text-center" role="alert">
        {{session('error')}}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{session('success')}}
    </div>
@endif