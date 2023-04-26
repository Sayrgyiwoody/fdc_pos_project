@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{$o->id}}</td>
                            <td class="align-middle"><a href="{{route('user#orderInfo',$o->order_code)}}" class="btn btn-light text-primary">{{$o->order_code}}</a></td>
                            <td class="align-middle">{{$o->created_at->format('F-j-Y')}}</td>
                            <td class="align-middle">{{$o->total_price}} Ks</td>
                            <td class="align-middle">
                            @if ($o->status == 0)
                            <span class="text-info"><i class="fa-solid fa-hourglass-start"></i> Pending</span>
                            @elseif ($o->status == 1)
                            <span class="text-success"><i class="fa-solid fa-thumbs-up"></i> accepted</span>
                            @elseif ($o->status == 2)
                            <span class="text-danger"><i class="fa-solid fa-file-circle-xmark"></i> rejected</span>
                            @endif
                            </td>
                            <input type="hidden" class="order_code" value="{{$o->order_code}}">
                            <td><button class="btn btn-secondary text-danger delete-order" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')

<script>
    // $(document).ready(function() {
    // console.log('hello');
        $('.delete-order').click(function() {
            $parentNode = $(this).parents('tr');
            $order_code = $parentNode.find('.order_code').val();
            Swal.fire({
            title: 'Are you sure?',
            text: "This Order will be removed from order list!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'get',
                    url : '/user/order/delete',
                    data : {'order_code' : $order_code},
                    dataType : 'json',
                    success : function() {
                        Swal.fire(
                        'Deleted!',
                        'Your Order has been deleted.',
                        'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/user/order/listPage';
                            }
                        });
                    }

                });

            }
            })
        })
    // })
</script>



@endsection
