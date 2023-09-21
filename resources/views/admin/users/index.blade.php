@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('dashboard.all_users')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.add')}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('dashboard.all_users')}}</h6>
                    {{--add item button--}}
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>{{__('dashboard.id')}}</th>
                                <th class="upper">{{__('dashboard.name')}}</th>
                                <th class="upper">{{__('dashboard.email')}}</th>
                                <th class="upper">{{__('dashboard.type' )}}</th>
                                <th class="upper">Number of Researches</th>
                                <th class="upper">{{__('dashboard.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$types[$item->type]}}</td>
                                    <td>
                                        {{-- badge --}}
                                        <span class="badge badge-success">
                                            {{$item->articles->count()}}
                                        </span>
                                    </td>
                                    <td>
                                        <a style="padding: 3px;line-height: 1.5" href="{{route('admin.users.edit',$item->id)}}" class="btn btn-primary btn-icon d-inline-block">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <form action="{{route('admin.users.destroy',$item->id)}}" method="post" class="d-inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon d-inline-block">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
