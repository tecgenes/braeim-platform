<!-- Default Toast -->
@if(Session::has('alert'))
<div class="fixed-top m-5 toast fade show" role="alert" aria-live="assertive"
     data-bs-autohide="false" aria-atomic="true">
    <div class="toast-header">
        <img src="{{asset('images/logo-sm.png')}}" class="rounded me-2"
             alt="..." height="20">
        <span class="fw-semibold me-auto">Braeim</span>
        <small>Just now</small>
        <button type="button" class="btn-close"
                data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ Session::get('alert') }}
    </div>
</div>
@endif
