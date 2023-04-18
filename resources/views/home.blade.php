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
                      <div class="fs-6 fw-semibold text-primary">{{$total_users}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Users</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-info text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">{{$total_customers}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Customers</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
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
                    <div class="bg-success text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-info">{{$sub_stages_count}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">SubStages</div>
                    </div>
                  </div>
                </div>
              </div>


    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header bg-info text-center text-white"><b>Timing Plans</b></div>
            <div class="card-body">
              <div class="row">
                <div class="table-responsive">
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                          <th>Timing Plan#</th>
                          <th>Customer </th>
                          <th>Part Number</th>
                          <th>Current Stage </th>
                          <th>Current Sub Stage</th>
                          <th>Status</th>
                          <th>Progress</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($timing_plan_lists as $timing_plan)
                        <tr class="align-middle">
                            <td >{{$timing_plan->apqp_timing_plan_number}}</td>
                            <td >{{$timing_plan->customer->name}}</td>
                            <td >{{$timing_plan->part_number->name}}</td>
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
                            <td><a href="{{route('apqp_timing_plan.show',$timing_plan->id)}}" target="_blank" class="btn btn-success btn-sm text-white">Details</a></td>
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
            <div class="card-header text-center bg-info text-white"><b>Timing Plans - Pending Activities </b></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-6">
                            <div class="border-start border-start-4 border-start-info px-3 mb-3"><small class="text-medium-emphasis">Active Timing Plans</small>
                              <div class="fs-5 fw-semibold">1</div>
                            </div>
                          </div>
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-primary px-3 mb-3"><small class="text-medium-emphasis">Total Activities</small>
                            <div class="fs-5 fw-semibold">{{$total_activities}}</div>
                          </div>
                        </div>
                        <!-- /.col-->

                        <!-- /.col-->

                      </div>
                      <!-- /.row-->
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="border-start border-start-4 border-start-danger px-3 mb-3"><small class="text-medium-emphasis">Pending Activities</small>
                              <div class="fs-5 fw-semibold">{{$pending_activities}}</div>
                            </div>
                          </div>
                      <!-- /.col-->
                      <div class="col-6">
                        <div class="border-start border-start-4 border-start-success px-3 mb-3"><small class="text-medium-emphasis">Completed Activities</small>
                          <div class="fs-5 fw-semibold">{{$completed_activities}}</div>
                        </div>
                      </div>
                      <!-- /.col-->

                    </div>
                    <!-- /.row-->
                </div>
              {{-- <div class="row">
                <div class="table-responsive">
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th>Timing Plan#</th>
                            <th>Part Number</th>
                            <th>Customer</th>
                            <th>Stage </th>
                            <th>Sub Stage</th>
                            <th>Responsibility</th>
                            <th>Plan Start Date</th>
                            <th>Plan End Date</th>
                            <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($activity_list as $activity)
                        <tr class="align-middle">
                            <td >{{$activity->plan->apqp_timing_plan_number}}</td>
                            <td >{{$activity->plan->part_number->name}}</td>
                            <td >{{$activity->plan->customer->name}}</td>
                            <td >{{$activity->stage->name}}</td>
                            <td >{{$activity->sub_stage->name}}</td>
                            <td >Mr.{{$activity->user->name}}</td>
                            <td >{{$activity->plan_start_date}}</td>
                            <td >{{$activity->plan_end_date}}</td>
                            <td >{{$activity->plan->status->name}}</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Pending Activities Found!</td>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
              </div> --}}
            </div>
          </div>
        </div>
    </div>
@if(auth()->user()->id==1)
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
    @endif

@endsection
