@extends('layouts.app')

@section('content')
    <div class="row pb-3">
            <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">1</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Users</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">4</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Customers</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-info text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-info">4</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Stages</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-info text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-info">4</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">SubStages</div>
                    </div>
                  </div>
                </div>
              </div>


    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header text-center"><b>Timing Plans</b></div>
            <div class="card-body">
              <div class="row">
                <div class="table-responsive">
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                          <th>Timing Plan#</th>
                          <th>Stage </th>
                          <th>Sub Stage</th>
                          <th>Status</th>
                          <th>Progress</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($timing_plan_lists as $timing_plan)
                        <tr class="align-middle">
                            <td >{{$timing_plan->apqp_timing_plan_number}}</td>
                            <td >{{$timing_plan->stage->name}}</td>
                            <td >{{$timing_plan->sub_stage->name}}</td>
                            <td >{{$timing_plan->status->name}}</td>
                            <td>
                              <div class="clearfix">
                                <div class="float-start">
                                  <div class="fw-semibold">{{$percentage}}%</div>
                                </div>
                              </div>
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Timing Plans Found!</td>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header">User Activity Log</div>
            <div class="card-body">
              <div class="row">
                <div class="table-responsive">
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                          <th class="text-center">
                            <svg class="icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                            </svg>
                          </th>
                          <th>User</th>
                          <th>Email </th>
                          <th>Regitered At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user_lists as $user_list)
                        <tr class="align-middle">
                          <td class="text-center">
                            <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/default.png" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                          </td>
                          <td>
                            <div>{{$user_list->name}}</div>
                            <div class="small text-medium-emphasis"> Registered: {{$user_list->created_at}}</div>
                          </td>

                          <td>
                            <div> {{$user_list->email}} </div>
                          </td>

                          <td>
                            <div class="fw-semibold">{{$user_list->updated_at->diffForHumans()}}</div>
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
    </div>

@endsection
