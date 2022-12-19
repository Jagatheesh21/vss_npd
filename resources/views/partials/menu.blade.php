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
        {{-- <li class="nav-item"><a class="nav-link" href="{{route('part_number.index')}}"><span class="nav-icon"></span> Part Numbers</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('stage.index')}}"><span class="nav-icon"></span> Stages</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('sub_stage.index')}}"><span class="nav-icon"></span> Sub Stages</a></li>  
        <li class="nav-item"><a class="nav-link" href="{{route('test_mail')}}"><span class="nav-icon"></span> Test Mail</a></li>   --}}
      </ul>
    </li>
    
    <li class="nav-item mt-auto"><a class="nav-link nav-link-danger" href="#" target="_top">
      
    </a></li>
    <li class="nav-item "><a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
      <svg class="nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
      </svg> Logout</a></li>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

  </ul>