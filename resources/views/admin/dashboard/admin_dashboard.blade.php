@extends('osfrportal::layout')
@section('content')
<div class="container-fluid">
    @can('admin-menu-show')
        <div class="row">
            <div class="col-sm-2">
                @livewire('osfrportal::liveusers-count')
            </div>
        </div>
        <div class="row">
            @include('osfrportal::admin.extsystems.graphs')
        </div>
    @endcan
<div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Activity</h5>
    </div>
    <div class="card-body">
      <ul class="p-0 m-0">
        <li class="d-flex mb-4 pb-2">
          <div class="avatar avatar-sm flex-shrink-0 me-3">
            <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-cube"></i></span>
          </div>
          <div class="d-flex flex-column w-100">
            <div class="d-flex justify-content-between mb-1">
              <span>Total Sales</span>
              <span class="text-muted">$2,459</span>
            </div>
            <div class="progress" style="height:6px;">
              <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </li>
        <li class="d-flex mb-4 pb-2">
          <div class="avatar avatar-sm flex-shrink-0 me-3">
            <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-dollar"></i></span>
          </div>
          <div class="d-flex flex-column w-100">
            <div class="d-flex justify-content-between mb-1">
              <span>Income</span>
              <span class="text-muted">$8,478</span>
            </div>
            <div class="progress" style="height:6px;">
              <div class="progress-bar bg-success" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </li>
        <li class="d-flex mb-4 pb-2">
          <div class="avatar avatar-sm flex-shrink-0 me-3">
            <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-trending-up"></i></span>
          </div>
          <div class="d-flex flex-column w-100">
            <div class="d-flex justify-content-between mb-1">
              <span>Budget</span>
              <span class="text-muted">$12,490</span>
            </div>
            <div class="progress" style="height:6px;">
              <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </li>
        <li class="d-flex mb-2">
          <div class="avatar avatar-sm flex-shrink-0 me-3">
            <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-check"></i></span>
          </div>
          <div class="d-flex flex-column w-100">
            <div class="d-flex justify-content-between mb-1">
              <span>Tasks</span>
              <span class="text-muted">$184</span>
            </div>
            <div class="progress" style="height:6px;">
              <div class="progress-bar bg-danger" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection
