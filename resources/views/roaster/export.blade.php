<table>
  <thead>
    <tr>
      <td colspan="5">Report from {{$fromdate}} to {{$todate}}</td>
    </tr>
    <tr>
      <td colspan="5">{{$empname}}</td>
    </tr>
    <tr>
      <td width="20px">From Date</td>
      <td width="20px">To Date</td>
      <td width="20px">Shift Start Time</td>
      <td width="20px">Shift End Time</td>
      <td width="100px">Employee</td>
    </tr>
  </thead>
  <tbody>

    @foreach($get_data as $item)
    @php $classname = "white"; @endphp
    @if($item->desid == App\Employee::supervisor_desig_id())  @php $classname = "blue"; @endphp @endif
    @if($item->desid == App\Employee::worker_desig_id())  @php $classname = "green"; @endphp @endif
    @if($item->worker_id == "floater")  @php $classname = "#ffa500"; @endphp @endif

    <tr>
      <td bgcolor="{{$classname}}">{{$item->from_date}}</td>
      <td bgcolor="{{$classname}}">{{$item->to_date}}</td>
      <td bgcolor="{{$classname}}">{{$item->start_time}}</td>
      <td bgcolor="{{$classname}}">{{$item->end_time}}</td>
      <td bgcolor="{{$classname}}">{{$item->empname}}</td>
    </tr>
    @endforeach
    <tr>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="100px"> </td>
    </tr>
    <tr>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="20px"> </td>
      <td width="100px"> </td>
    </tr>
    <tr>
      <td width="20px" bgcolor="blue"> </td>
      <td colspan="4"> is for Supervisor</td>
    </tr>
    <tr>
      <td width="20px" bgcolor="green"> </td>
      <td colspan="4"> is for Worker</td>
    </tr>
    <tr>
      <td width="20px" bgcolor="#ffa500"> </td>
      <td colspan="4" > is for Floater</td>
    </tr>
  </tbody>
</table>
