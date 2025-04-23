@extends('admin.dashboard.layout')

@section('title', 'Dashboard - Trang chủ')

@section('content')
    <h3 class="fw-bold fs-4 mb-3">Thống kê</h3>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card border-0">
                <div class="card-body py-4">
                    <h5 class="mb-2 fw-bold">Member Process</h5>
                    <p class="mb-2 fw-bold">$72,540</p>
                    <span class="badge text-success1 me-2">+9.0%</span>
                    <span class="fw-bold">Since last month</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0">
                <div class="card-body py-4">
                    <h5 class="mb-2 fw-bold">Member Process 2</h5>
                    <p class="mb-2 fw-bold">$72,540</p>
                    <span class="badge text-success1 me-2">+9.0%</span>
                    <span class="fw-bold">Since last month</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0">
                <div class="card-body py-4">
                    <h5 class="mb-2 fw-bold">Member Process 3</h5>
                    <p class="mb-2 fw-bold">$72,540</p>
                    <span class="badge text-success1 me-2">+9.0%</span>
                    <span class="fw-bold">Since last month</span>
                </div>
            </div>
        </div>
    </div>

    <h3 class="fw-bold fs-4 my-3">Avg. agent</h3>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr class="highlight">
                    <th scope="col">Cột 1</th>
                    <th scope="col">Cột 2</th>
                    <th scope="col">Cột 3</th>
                    <th scope="col">Cột 4</th>
                </tr>
                </thead>
                <tbody>
                <tr><th scope="row">1</th><td>Mark</td><td>Otto</td><td>@mdo</td></tr>
                <tr><th scope="row">2</th><td>Jacob</td><td>Thornton</td><td>@fat</td></tr>
                <tr><th scope="row">3</th><td colspan="2">Larry the Bird</td><td>@twitter</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
