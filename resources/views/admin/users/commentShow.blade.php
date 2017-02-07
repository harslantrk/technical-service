@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Yorumlar</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li><a href="/admin/users"><i class="fa fa-dashboard active"></i> Üyeler</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box-primary box">
                <div class="box-body">
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <?php
                        $tarih = "";
                        $tarih_2 = "";
                        $positive = 0;
                        $negative = 0;
                        ?>
                        @foreach($comments as $comment)

                            <?php
                               $positive += $comment->positive_comment;
                               $negative += $comment->negative_comment;
                            $tarih_2 = \Carbon\Carbon::parse($comment->created_at)->format('d / m / Y');
                            ?>
                            @if($tarih_2 != $tarih)
                                <li class="time-label">
                        <span class="bg-red">
                          {{\Carbon\Carbon::parse($comment->created_at)->format('d / m / Y')}}
                        </span>
                                </li>
                            @endif
                            <li>
                                <i class="fa fa-comments bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($comment->created_at)->format('H:i:s')}}</span>
                                    <h3 class="timeline-header"><a href="#">{{$comment->user->name}}</a> {{$comment->product->name}}</h3>
                                    <div class="timeline-body">
                                        {{$comment->comment}}
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="/admin/product/show/{{$comment->product_id}}" class="btn btn-primary btn-flat btn-xs">Yorumu Üründe Gör...</a>
                                    </div>
                                </div>
                            </li>
                        <?php
                        $tarih = \Carbon\Carbon::parse($comment->created_at)->format('d / m / Y');
                        ?>
                    @endforeach
                    <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
            </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Yorum Beğenileri</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script>
        $(function () {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
                <?php
                echo '{
                    value: '.$positive.',
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Olumlu"
                },{
                    value: '.$negative.',
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "Olumsuz"
                }';
                ?>
            ];
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: "#fff",
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: "easeOutBounce",
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //String - A legend template
                legendTemplate: "<ul class=\"<%name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%segments[i].fillColor%>\"></span><%if(segments[i].label){%><%segments[i].label%><%}%></li><%}%></ul>"
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);
        });
    </script>
@endsection
