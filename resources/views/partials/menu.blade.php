<ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <li class="nav-item"><a class="nav-link" href="/">
        <svg class="nav-icon">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
        </svg> Dashboard
        </a>
      </li>
    
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-settings')}}"></use>
      </svg> Masters</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route('customer.index')}}"><span class="nav-icon"></span> Customer</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('part_number.index')}}"><span class="nav-icon"></span> Part Numbers</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('stage.index')}}"><span class="nav-icon"></span> Stages</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('sub_stage.index')}}"><span class="nav-icon"></span> Sub Stages</a></li>  
        {{-- <li class="nav-item"><a class="nav-link" href="{{route('test_mail')}}"><span class="nav-icon"></span> Test Mail</a></li>   --}}
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-chart-line')}}"></use>
      </svg> APQP</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route('apqp_timing_plan.index')}}"><span class="nav-icon"></span> Timing Plan</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('plan_scheduler')}}"><span class="nav-icon"></span> Timing Plan Scheduler</a></li>  
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-task')}}"></use>
      </svg> My Tasks </a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{route('activity.index')}}"><span class="nav-icon"></span>Task List</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('enquiry_register/create?id=1')}}"><span class="nav-icon"></span>Enquiry Register</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('product_information_data/create?id=1')}}"><span class="nav-icon"></span>Product Information Data</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('mfr/create?id=1')}}"><span class="nav-icon"></span>Manufacturing Feasibility Review</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('risk_analysis/create?id=1')}}"><span class="nav-icon"></span>Risk Analysis</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('customer_requiements/create?id=1')}}"><span class="nav-icon"></span>Customer Specific Requirements</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('special_characteristics/create?id=1')}}"><span class="nav-icon"></span>Special Characteristic</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('gauge_equipment/create?id=1')}}"><span class="nav-icon"></span>Gauge Testing Equipment</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('process_flow_diagram/create?id=1')}}"><span class="nav-icon"></span>Process Flow Diagram</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{url('process_failure_analysis/create?id=1')}}"><span class="nav-icon"></span>Process Failure Analysis</a></li>  
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-people')}}"></use>
      </svg> User Management</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href=""><span class="nav-icon"></span>Users</a></li>  
      </ul>
    </li>
    
    <li class="nav-item mt-auto"><a class="nav-link nav-link-danger" href="#" target="_top">
      
    </a></li>
    <li class="nav-item "><a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-power-standby')}}"></use>
      </svg> Logout</a></li>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

  </ul>