@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">All Researches</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.add')}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Researches</h6>
                    {{--add item button--}}
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>{{__('dashboard.id')}}</th>
                                <th class="upper">Title</th>
                                <th class="upper">Tags</th>
                                <th class="upper">Comments</th>
                                <th class="upper">Views</th>

                                <th class="upper">{{__('dashboard.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        @foreach($item->tags as $tag)
                                            <span class="badge badge-primary">{{$tag->tag}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">{{$item->comments()->count()}}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{$item->views}}</span>
                                    </td>
                                    <td>
                                        <a style="padding: 3px;line-height: 1.5" href="{{route('articles.edit',$item)}}" class="btn btn-primary btn-icon d-inline-block">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a style="padding: 3px;line-height: 1.5" href="{{route('articles.show' , $item)}}" class="btn btn-secondary btn-icon d-inline-block">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <form action="{{route('articles.destroy',$item)}}" method="post" class="d-inline-block delete-form">
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
