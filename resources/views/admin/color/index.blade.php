@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h3>Color List
                    <a href="{{ route('color.create') }}" class="btn btn-danger btn-sm text-white float-end">Add
                        Color</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive pt-3 mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Code
                                            </th>
                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($colors as $color)
                                        <tr>
                                            <td>
                                                {{ $color->id }}
                                            </td>
                                            <td>
                                                {{ $color->name }}
                                            </td>

                                            <td>
                                                {{ $color->code }}
                                            </td>
                                            <td>
                                                {{ $color->status == '1' ? 'Hidden' : 'Visible' }}
                                            </td>
                                           
                                            <td>
                                                <a href="{{ url('/admin/color/' . $color->id . '/edit') }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('color.destroy', $color->id) }}" onclick="return confirm('Are you sure delete?')"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {{ $colors->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection