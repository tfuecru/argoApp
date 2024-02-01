@extends('app.base')

@section('title', 'Argo Artist Paginate List')

@section('content')
<div class="d-flex">
  <form>
    <input type="hidden" value="{{$orderBy}}" name="orderBy">
    <input type="hidden" value="{{$orderType}}" name="orderType">
    <input type="hidden" value="{{$q}}" name="q">
    <select name="rowsPerPage" id="">
      @foreach($rpps as $index => $value)
        <option value="{{$index}}" @if($rpp == $index) selected @endif>{{$index}}</option>
      @endforeach
    </select>
    <button type="submit">view</button>
  </form>
  <form class="mx-4">
    <input type="hidden" value="{{$orderBy}}" name="orderBy">
    <input type="hidden" value="{{$orderType}}" name="orderType">
    <input type="hidden" value="{{$rpp}}" name="rowsPerPage">
    <input type="search" name="q" placeholder="search" value="{{ $q }}">
    <button type="submit">Filter</button>
  </form>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">
            # 
            <a href="?rowsPerPage={{$rpp}}&orderBy=id&orderType=desc"><svg class="bi"><use xlink:href="#down"/></svg></a>
            <a href="?rowsPerPage={{$rpp}}&orderBy=id&orderType=asc"><svg class="bi"><use xlink:href="#up"/></svg></a>
          </th>
          <th scope="col">
            name
            <a href="?rowsPerPage={{$rpp}}&orderBy=name&orderType=desc"><svg class="bi"><use xlink:href="#down"/></svg></a>
            <a href="?rowsPerPage={{$rpp}}&orderBy=name&orderType=asc"><svg class="bi"><use xlink:href="#up"/></svg></a>
          </th>
          <th scope="col">
            idargo
            <a href="?rowsPerPage={{$rpp}}&orderBy=idargo&orderType=desc"><svg class="bi"><use xlink:href="#down"/></svg></a>
            <a href="?rowsPerPage={{$rpp}}&orderBy=idargo&orderType=asc"><svg class="bi"><use xlink:href="#up"/></svg></a>
          </th>
          <th scope="col">
            idoltro
            <a href="?rowsPerPage={{$rpp}}&orderBy=idoltro&orderType=desc"><svg class="bi"><use xlink:href="#down"/></svg></a>
            <a href="?rowsPerPage={{$rpp}}&orderBy=idoltro&orderType=asc"><svg class="bi"><use xlink:href="#up"/></svg></a>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($artists as $artist)
            <tr>
                <td>{{ $artist->id }}</td>
                <td>
                  {{ $artist->name }}
                </td>
                <td>
                  {{ $artist->argo->name }}
                </td>
                <td>
                  {{ $artist->idoltro }}
                </td>
                <td>
                  <a class="btn btn-primary" href="{{ url('artist/' . $artist->id) }}">show</a>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
<div>
  {{ $artists->appends(['orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q, 'rowsPerPage' => $rpp])->onEachSide(2)->links() }}
</div>
@endsection