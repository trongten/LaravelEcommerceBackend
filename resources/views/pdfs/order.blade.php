<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
                font-family: 'Be Vietnam Pro', sans-serif;
            }
        .td{
            border: 1px solid black;
        }
        .td{
            border-left: 3px solid black;

            border-right: 3px solid black;
        }
        .th{
            text-align: center;
            border: 3px solid black;
            font-weight:220px;
        }
        #text{
            margin-left: 20px;
        }
        .money{
            text-align:right;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center; font-size:large; font-weight: 2px;">TÊN CỬA HÀNG</td><td style="width: 20%;" ></td><td style="text-align: center; font-size: larger;">HÓA ĐƠN BÁN HÀNG</td>
        </tr>

        <tr>
            <td style="font-weight: 2px;">Địa chỉ: xxx,xxxx,xxxxx</td><td></td><td style="text-align: center; ">Dụng cụ học tập</td>
        </tr>
        <tr>
            <td style="height: 20px;"></td>
        </tr>
        <tr>
            <td colspan="3">Tên khách hàng:{{$user->name}}</td>
        </tr>

        <tr>
            <td colspan="3">Địa chỉ: xxx,xxxx,xxxxx</td>
        </tr>
        <!-- talbe -->
        <tr>
            <td colspan="3">
                <table style="width: 100%;border-collapse: collapse;">
                    <thead>
                        <td class="th" >TT</td>
                        <td class="th" >TÊN HÀNG</td>
                        <td class="th" >SỐ LƯỢNG</td>
                        <td class="th" >ĐƠN GIÁ</td>
                        <td class="th" >THÀNH TIỀN</td>
                    </thead>
        
                    <tbody>
                        
                        @foreach ($order->details as $index=>$item)
                        <tr>
                            <td class="td">{{$index+1}}</td>
                            <td class="td">{{$item->product->name}}</td>
                            <td style="text-align: center;" class="td">{{$item->count}}</td>
                            <td class="money td">{{number_format($item->product->price)}}đ</td>
                            <td class="money td">{{number_format($item->count * $item->product->price)}}đ</td>
                        </tr>
                        @if(($index+1)%20 == 0)
                            <tr style="page-break-after: always; ">
                                <td class="td"></td>
                                <td class="td"></td>
                                <td class="td"></td>
                                <td class="money td"></td>
                                <td class="money td"></td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
        
                    <tfoot>
                        <td class="th" colspan="2">TỔNG CỘNG</td>
                        <td class="th" ></td>
                        <td class="th" ></td>
                        <td class="th money" >{{number_format($order->price)}}đ</td>
                    </tfoot>
        
                </table>
            </td>
        </tr>
        <!-- talbe -->

        <tr>
            <td colspan="3">Thành tiền (viết bằng chữ): {{$priceString}}</td>
        </tr>
        <tr>
            <td style="height: 20px;"></td>
        </tr>
        <tr>
            <td style="text-align: center">KHÁCH HÀNG</td>
            <td></td>
            <td>Ngày {{$order->created_at->format('d')}}
                tháng {{$order->created_at->format('m')}}
                năm 20{{$order->created_at->format('y')}}
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center;">NGƯỜI BÁN HÀNG</td>
        </tr>

    </table>
</body>
</html>