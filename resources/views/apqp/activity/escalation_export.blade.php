<table>
    <thead>
        <tr>
            <td>Timing Plan Number</td>
            <td>Part Number</td>
            <td>Part Description</td>
            <td>Customer</td>
            <td>Stage</td>
            <td>Activity</td>
            <td>Plan Start Date</td>
            <td>Plan Actual Date</td>
        </tr>
    </thead>
    <tbody>
        @forelse ($activities as $activity)
        <tr>
            <td>{{$activity->plan->apqp_timing_plan_number}}</td>
            <td>{{$activity->plan->part_number->name}}</td>
            <td>{{$activity->plan->part_number->description}}</td>
            <td>{{$activity->plan->customer->name}}</td>
            <td>{{$activity->stage->name}}</td>
            <td>{{$activity->sub_stage->name}}</td>
            <td>{{$activity->plan_start_date}}</td>
            <td>{{$activity->plan_end_date}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">No Activities Found!</td>
        </tr>
        @endforelse
    </tbody>
</table>
