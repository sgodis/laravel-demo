
@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>产品编号</th>
                            <th>价格</th>
                            <th>产品示例图片</th>
                            <th>产品地址</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>title</td>
                                <td>product_no</td>
                                <td>price</td>
                                <td>main_pic</td>
                                <td>url</td>
                            </tr>
                        </tbody>
                        <tfoot>
                        {{--<tr>--}}
                            {{--<th>Rendering engine</th>--}}
                            {{--<th>Browser</th>--}}
                            {{--<th>Platform(s)</th>--}}
                            {{--<th>Engine version</th>--}}
                            {{--<th>CSS grade</th>--}}
                        {{--</tr>--}}
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
