@extends('layouts.admin')

@section('title', 'Basic Tables - Condoflow Admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Basic Table</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>VatNo.</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" />
                                    <span class="ps-2">Henry Klein</span>
                                </td>
                                <td>02312</td>
                                <td>05 Dec 2017</td>
                                <td><label class="badge badge-success">Completed</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image" />
                                    <span class="ps-2">Estella Bryan</span>
                                </td>
                                <td>02312</td>
                                <td>05 Dec 2017</td>
                                <td><label class="badge badge-warning">In progress</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image" />
                                    <span class="ps-2">Lucy Abbott</span>
                                </td>
                                <td>02312</td>
                                <td>05 Dec 2017</td>
                                <td><label class="badge badge-danger">Fixed</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" />
                                    <span class="ps-2">Peter Gill</span>
                                </td>
                                <td>02312</td>
                                <td>05 Dec 2017</td>
                                <td><label class="badge badge-success">Completed</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/faces/face5.jpg') }}" alt="image" />
                                    <span class="ps-2">Sallie Reyes</span>
                                </td>
                                <td>02312</td>
                                <td>05 Dec 2017</td>
                                <td><label class="badge badge-warning">In progress</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
