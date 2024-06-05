@if (session('success'))
<div class="alert alert-success" role="alert">
    <div class="alert-body"><strong>Success : </strong>{{ session('success') }}</div>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" role="alert">
    <div class="alert-body"><strong>Error : </strong>{{ session('error') }}</div>
</div>
@endif