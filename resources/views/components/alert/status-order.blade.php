<div>

    @if ($order->order_status_id==1)
    <button type="button" class="btn btn-outline-danger" disabled>Failed</button>
    @elseif ($order->order_status_id==2)
        <button type="button" class="btn btn-outline-primary" disabled>Shipping</button>
    @elseif ($order->order_status_id==3)
        <button type="button" class="btn btn-outline-success" disabled>Success</button>
    @elseif ($order->order_status_id==4)
        <button type="button" class="btn btn-outline-danger" disabled>Canceled</button>
    @elseif ($order->order_status_id==5)
        <a href="{{route('user.payment.view',$order->id)}}" class="btn btn-primary">Pay Now</a>
    @endif
    {{-- <button type="button" class="btn btn-outline-primary">Primary</button>
    <button type="button" class="btn btn-outline-secondary">Secondary</button>
    <button type="button" class="btn btn-outline-success">Success</button>
    <button type="button" class="btn btn-outline-danger">Danger</button>
    <button type="button" class="btn btn-outline-warning">Warning</button>
    <button type="button" class="btn btn-outline-info">Info</button>
    <button type="button" class="btn btn-outline-light">Light</button>
    <button type="button" class="btn btn-outline-dark">Dark</button>

    <button type="button" class="btn btn-outline-link">Link</button> --}}
</div>