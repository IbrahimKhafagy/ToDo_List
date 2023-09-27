@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<style>
    .pen body {
        padding-top:50px;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(50%, 50%, 50%);
        transform: translate3d(25%, 0, 0);
    }

    .modal.right .modal-dialog {
        position:fixed;
        top:100%;
        height: 100%;
        right:5%;
        margin:0;
    }
    </style>

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">ToDo List</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card" id="card">
            <div class="card-header pb-0">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary " data-effect="effect-fall" data-toggle="modal"
                            href="#modaldemo8">Add Task</a>
                        <i>
                            <button type="button" class="btn btn-success">
                                Completed <span
                                    class="badge badge-light">{{App\Models\Task::where('completed','=',true)->count()}}</span>
                            </button>
                            <button type="button" class="btn btn-danger">
                                Tasks <span class="badge badge-light">{{App\Models\Task::where('completed','=',false)->count()}}</span>
                            </button>
                        </i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive border-top userlist-table">
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class="wd-lg-2p" style="text-align: center; vertical-align: middle;">
                                    <span>name</span></th>
                                <th class="wd-lg-20p" style="text-align: center; vertical-align: middle;">
                                    <span>Date</span></th>
                                <th class="wd-lg-20p" style="text-align: center; vertical-align: middle;">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todo as $t)
                            <tr>
                                <td>
                                    <input class="checkbox"  type="checkbox" data-task-id="{{$t->id}}" data-completed="{{$t->completed}}" {{$t->completed ? 'checked' : ''}} >
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <span @if ($t->completed == 1)
                                        style="text-decoration: line-through;color:green"
                                    @endif >{{$t->title}}</span>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if($t->completed)
                                        <span class="badge badge-success">
                                            <span @if ($t->completed == 1)
                                                style="text-decoration: line-through;color:green"
                                            @endif >{{$t->date}}</span></span>
                                    @else
                                        <span class="badge badge-danger">{{$t->date}}</span>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <a value='{{ $t->id }}' class="modal-effect btn btn-sm btn-info sidebar-right edit_btn" data-effect="effect-scale" data-id="{{$t->id}}"
                                        data-section_name="#" data-description="#" data-toggle="modal"
                                        href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
</div>
<!-- row closed  -->
</div>
<!-- Container closed -->
</div>

<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Task</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="formvalidate" id="form1" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Wraite Task Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="notes" name="notes"
                            placeholder="Wraite Task Notes"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" placeholder="Due Date">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="btn-submit" class="btn btn-success">create</button>
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button> --}}
                        <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">
                            close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade editmodal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="model-body" id="editform">

            </div>

        </div>
    </div>
</div>

</div>
<!-- Container closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>




<script type="text/javascript">
    $(document).ready(function() {
       $("#form1").submit(function(e) {
           e.preventDefault();

           let formData = new FormData(this);
           $.ajax({
               url: '{{ route('create.task') }}',
               type: 'POST',
               dataType: "json",
               data: formData,
               contentType: false,
               processData: false,
               success: function(data) {
                   $('#closeModal').trigger('click');
                   Swal.fire('Good job!', 'You clicked the button!','success');
                   location.reload();
                   if ($.isEmptyObject(data.error)) {
                       console.log(response);
                                }
                           },
                error: function(data) {
                    $('#closeModal').trigger('click');
                    Swal.fire('error!', 'try again!','error');

                    var errorText = '';
                    if (data.responseJSON.hasOwnProperty('errors')) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            errorText += value + '\n';
                        });
                    } else {
                        errorText = 'An error occurred.';
                    }
                    swal("Error!", errorText, "error");
                }
            });

        });

    });
</script>



<script>
        $(document).ready(function() {
            $(document).on('click', '.edit_btn', function(e) {
                e.preventDefault();
                var task_id = $(this).attr('value');
                // alert(task_id);
                $('#editmodal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-task/" + task_id,
                    success: function(response) {

                        $("body #editform").html(response.html);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });



</script>


<script>
    const checkboxes = document.querySelectorAll('.checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskId = this.dataset.task_Id;
            const completed = this.checked ? false : true;
            var task_id = $(this).attr('value');
            $.ajax({
               type: "post"
               url:'/update-task-completed' + task_id,
               success: function(response) {
// alert('ff');
                }

            });
    });
</script>


<script>
    $(document).ajaxComplete(function() {
        $('#update_task').on('click', function(e) {
        e.preventDefault();

        var task_id = $(this).attr('value');
        // alert(task_id);
        var formData = new FormData($('#form2')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "/update-task/" + task_id,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#closeModal2').trigger('click');
                Swal.fire('Good job!', 'You clicked the button!','success');
                location.reload();

        },
            error: function(reject) {}
        });
    });
    });
</script>

<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    })
</script>


@endsection
