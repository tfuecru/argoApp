@extends('app.base')

@section('title', 'Argo Artist Paginate List')

@section('content')
<div>
  <form>
    <select name="rowsPerPage" id="">
      @foreach($rpps as $index => $value)
        <option value="{{$index}}" @if($rpp == $index) selected @endif>{{$index}}</option>
      @endforeach
    </select>
    <button type="submit">view</button>
  </form>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">idargo</th>
          <th scope="col">idoltro</th>
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
                  {{ $artist->idargo }}
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
  <nav>
    <ul class="pagination">
      <?php
        $rowsPerPage = $rpp;
        $totalPages = $pages;
        $currentPage = request()->has('page') ? request('page') : 1;


        function generatePaginationLink($page, $rowsPerPage) {
            return 'https://tfuecru2003.ieszaidinvergeles.es/DWES/argoApp/public/paginateartist2?rowsPerPage=' . $rowsPerPage . '&page=' . $page;
        }

        for ($i = 1; $i <= min($totalPages, 2); $i++) {
            echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="' . generatePaginationLink($i, $rowsPerPage) . '">' . $i . '</a></li>';
        }

        if ($currentPage > 1) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $start = max($currentPage - 1, 3);
            $end = min($currentPage + 1, $totalPages);
            for ($i = $start; $i <= $end; $i++) {
                echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="' . generatePaginationLink($i, $rowsPerPage) . '">' . $i . '</a></li>';
            }
            if ($end != $totalPages) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        $start = max($totalPages - 1, 3);
        $end = min($totalPages, max($totalPages - 2, 3));
        for ($i = $start; $i <= $end; $i++) {
            if ($i >= $start && $i <= $end) {
                echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="' . generatePaginationLink($i, $rowsPerPage) . '">' . $i . '</a></li>';
            }
        }
      ?>
    </ul>
  </nav>
</div>
@endsection