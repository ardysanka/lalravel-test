@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">History</h3>
                </div>
                <form action="{{ route('home') }}" method="get">
                    <div class="card-body">
                        @if (isset($search))

                            <x-form.label value="Result for {{$search}}" /> 
                        @endif
                        <x-form.input name="Search" id="search" placeholder="Search" />
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                        <table class="table">
                            <tbody>
                                @foreach($order as $data)
                                <tr>
                                    <th scope="row" style="width: 70%">
                                        <table style="width: 100%">
                                            <tr>
                                                <td>{{ $data->order_number }}</td>
                                                <td>{{ $data->total }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if (str_replace('App\Models\\','',$data->orderable_type)=="PrepaidBalance")
                                                         {{$data->orderable->mobile_number}} for {{$data->orderable->value}}
                                                    @else 
                                                         {{$data->orderable->product}} That's Cost {{$data->orderable->total}}
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th><x-alert.status-order order="{{$data->id}}" /></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @php
                                    $currentPage = $order->currentPage();
                                        $path = $order->path();
                                        $lastPage = $order->lastPage();
                                        $previousPage = $currentPage - 1;
                                        $nextPage = $currentPage + 1;
                                    @endphp

                                    @if ($currentPage > 1 )
                                        <li class="page-item"><a class="page-link" href="{{$path."?page=".$previousPage}}">Previous</a></li>
                                    @endif

                                    @for ($i = 1; $i <= $lastPage; $i++)
                                        <li class="page-item"><a class="page-link active" href="{{$path."?page=".$i}}">{{$i}}</a></li>
                                    @endfor

                                    @if ($currentPage < $lastPage )
                                        <li class="page-item"><a class="page-link" href="{{$path."?page=".$nextPage}}">Next</a></li>
                                    @endif
                                </ul>
                              </nav>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection