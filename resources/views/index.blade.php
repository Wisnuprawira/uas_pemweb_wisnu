<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pegawai</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('asset_admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('asset_admin/dist/css/adminlte.min.css')}}">

   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset ('asset_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('asset_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('asset_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts/navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
    <!-- @yield('content') -->
  <div class="content-wrapper">
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Data pegawai</li>
            </ol>
          </div>
        </div>
      </div>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Title</h3> -->
          <button class="form-control btn btn-outline-primary"  data-toggle="modal" data-target="#exampleModal">+ Tambah pegawai</button>
        </div>
        <div class="card-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Nomor Telpon</th>
                      <th>Email</th>
                      <th style="width: 40px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $x = 1;
                    @endphp
                    @foreach($pegawai as $peg)
                    <tr>
                        <td>{{$x}}</td>
                        <td>{{$peg->nama}}</td>
                        <td>
                            {{$peg->nomor_telpon}}
                        </td>
                        <td>{{$peg->email}}</td>
                        <td>
                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#edit{{$peg->id}}">Edit</button>
                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#lihat{{$peg->id}}">Lihat</button>
                            <a href="{{route('hapus.pegawai', $peg->id)}}" class="btn btn-outline-danger">Hapus</a>
                        </td>
                    </tr>
                    @php 
                    $x++;
                    @endphp
                    @endforeach
                </tbody>
                </table>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>

    <!-- modal tambah-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('tambah.pegawai')}}"> 
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nomor Telpon</label>
            <input type="text" class="form-control" name="nomor" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</form>
</div>

@foreach($pegawai as $peg)
<!-- modal edit-->
<!-- Modal -->
<div class="modal fade" id="edit{{$peg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('edit.pegawai', $peg->id)}}"> 
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" value="{{$peg->nama}}" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" value="{{$peg->email}}" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nomor Telpon</label>
            <input type="text" class="form-control" name="nomor" value="{{$peg->nomor_telpon}}" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</form>
</div>
@endforeach

@foreach($pegawai as $peg)
<!-- modal edit-->
<!-- Modal -->
<div class="modal fade" id="lihat{{$peg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('edit.pegawai', $peg->id)}}"> 
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" value="{{$peg->nama}}" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" value="{{$peg->email}}" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nomor Telpon</label>
            <input type="text" class="form-control" name="nomor" value="{{$peg->nomor_telpon}}" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</form>
</div>
@endforeach
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- footer -->
    @include('layouts/footer')  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</div>
</div>
</div>
</section>

<!-- jQuery -->
<script src="{{ asset ('asset_admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('asset_admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset ('asset_admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset ('asset_admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('asset_admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('asset_admin/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
