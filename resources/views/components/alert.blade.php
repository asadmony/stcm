<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @elseif (session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li><i class=""> </i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
</div>
