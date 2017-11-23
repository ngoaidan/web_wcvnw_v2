@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
@endsection

@section('main')

<div class="box-header with-border">
    <h3>Sản phẩm order</h3>
</div>

<div class="box-body table-responsive">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên sản phẩm</th>
                <th>SL đặt</th>
                <th>SL thực tế</th>
                <th>Đơn vị</th>
                <th>Thành tiền</th>
                <th>Trang trại</th>
                <th>Ngày giao hàng</th>
            </tr>
        </thead>
    </table>

</div>
<!-- /.box-body -->

@endsection

@section('script')
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/datatables/dataTables.editor.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "/api/admin/product-trading/items",
        table: "#example",
        fields: [ {
                label: "Mã đơn hàng:",
                name: "product_name"
            }, {
                label: "Tên sản phẩm:",
                name: "farmer_name"
            }, {
                label: "SL đặt:",
                name: "capacity"
            }, {
                label: "SL thực tế:",
                name: "unit_quantity"
            }, {
                label: "Đơn vị:",
                name: "unit"
            },{
                label: "Thành tiền:",
                name: "price_farmer"
            },{
                label: "Trang trại:",
                name: "price"
            }, {
                label: "Ngày giao hàng:",
                name: "delivery_date",
                type: "date",
                dateFormat: $.datepicker.ISO_8601
            }
        ]
    } );
 
    // Activate an inline edit on click of a table cell
    $('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
    } );

    $('#example').on( 'change', 'input.editor-active', function () {
        editor
            .edit( $(this).closest('tr'), false )
            .set( 'status', $(this).prop( 'checked' ) ? 1 : 0 )
            .submit();
    } );
 
    $('#example').DataTable( {
        "paging": false,
        dom: "Bfrtip",
        ajax: "/api/admin/product-trading/items",
        order: [[ 1, 'asc' ]],
        columns: [
            { data: "product_name" },
            { data: "farmer_name" },
            { data: "capacity" },
            { data: "unit_quantity" },
            { data: "unit_quantity" },
            { data: "unit" },
            { data: "price", render: $.fn.dataTable.render.number( ',', '.', 0, 'VND ' ) },
            { data: "delivery_date" }
        ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            
        ],
        rowCallback: function ( row, data ) {
            // Set the checked state of the checkbox in the table
            $('input.editor-active', row).prop( 'checked', data.status == 1 );
        }
    } );

} );
</script>
@endsection