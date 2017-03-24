
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
                    <table id="product_list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>产品编号</th>
                            <th>价格</th>
                            <th>产品示例图片</th>
                            {{--<th>产品地址</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productList as $product)
                            <tr>
                                <td><a href="{{ $product['product_url'] }}" target="_blank">{{ $product['product_title'] }}</a></td>
                                <td>{{ $product['product_no'] }}</td>
                                <td>{{ $product['product_price'] }}</td>
                                <td><img src="{{ $product['product_pic_url'] }}"></td>
{{--                                <td>{{ $product['product_url'] }}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                        <div>
                            <div class="box-footer">
                                {{--{{ $students->render() }}--}}
                                {{ $paginator->render() }}
                            </div>
                        </div>
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
