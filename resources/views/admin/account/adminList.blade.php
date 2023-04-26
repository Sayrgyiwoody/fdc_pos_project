@extends('admin.layouts.master')

@section('title','Admin Account List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- Header --}}
        @section('header')
        <form class="form-header" action="{{route('admin#adminAccountList')}}" method="get">
            <input class="au-input au-input--xl" type="text" name="searchKey" value="{{request('searchKey')}}" placeholder="Search for admin name..." />
            <button class="au-btn--submit" type="submit" >
                <i class="zmdi zmdi-search"></i>
            </button>
        </form>
        @endsection
        {{-- End Header --}}
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin Account List</h2>
                            </div>

                        </div>
                        <div class="table-data__tool-right">
                            <button type="button" class="btn btn-primary">
                                <i class="fa-solid fa-user-shield me-2"></i> <span class="badge text-primary text-bg-light">{{count($accounts)}}</span>
                            </button>
                        </div>
                    </div>
                    {{-- For alert message --}}
                    @if (session('deleteAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-trash me-2"></i>{{session('deleteAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('adminRoleChangeAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-file-shield me-2 "></i>{{session('adminRoleChangeAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (count($accounts) != null)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-hover table-striped mb-0 text-center">
                            <thead class="text-white " style="background-color: #262626;">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($accounts as $account)
                            <tr>
                                <td class="">
                                    <div class="mx-auto" style="width: 75px; height: 75px; overflow: hidden;">
                                        @if ($account->image==null && $account->gender=='male')
                                    <img class="w-100 h-100 img-thumbnail rounded" style="object-fit: cover; object-position:center;" src="{{asset('images/default_user.png')}}"  />
                                    @endif
                                    @if ($account->image==null && $account->gender=='female')
                                    <img class="w-100 h-100 img-thumbnail rounded" style="object-fit: cover; object-position:center;" src="{{asset('images/default_female_user.png')}}"  />
                                    @endif
                                    @if ($account->image)
                                    <img class="w-100 h-100 rounded" style="object-fit: cover; object-position:center;" src="{{asset('storage/profileImages/'.$account->image)}}"/>
                                    @endif
                                    </div>
                                </td>
                                <td class="align-middle">{{$account->name}}</td>
                                <td class="align-middle">{{$account->email}}</td>
                                <td class="align-middle">{{$account->gender}}</td>
                                <td class="align-middle">{{$account->phone}}</td>
                                <td class="align-middle">{{$account->address}}</td>
                                <td class="align-middle">
                                    <div class="table-data-feature">
                                        @if ($account->id != Auth::user()->id)
                                        <a href="{{route('admin#changeUserRole',$account->id)}}">
                                            <button class="btn btn-white rounded-0 me-2 shadow_2">
                                                <i class="fa-solid fa-person-circle-minus" style="color: #262626"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" class="account-id" value="{{$account->id}}">
                                        <button class="btn btn-white rounded-0 me-3 delete-account shadow_2">
                                            <i class="zmdi zmdi-delete" style="color: #262626"></i>
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-white  shadow_2">
                                            <i class="fa-solid fa-user-shield fs-4"></i>
                                            <span class="badge text-bg-secondary">me</span>
                                          </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-secondary text-center">There's no account to show!<i class="fa-solid fa-face-frown-open ms-2"></i></h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-2">
                    {{$accounts->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection


@section('scriptSource')

<script>
    $('.delete-account').click(function() {
            $parentNode = $(this).parents('tr');
            $account_id = $parentNode.find('.account-id').val();
            Swal.fire({
            title: 'Are you sure?',
            text: "This account will be deleted forever!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'get',
                    url : '/admin/account/delete',
                    data : {'account_id' : $account_id},
                    dataType : 'json',
                    success : function() {
                        Swal.fire(
                        'Deleted!',
                        'Account has been deleted.',
                        'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/account/admin/list';
                            }
                        });
                    }

                });

            }
            })
        })
</script>

@endsection
