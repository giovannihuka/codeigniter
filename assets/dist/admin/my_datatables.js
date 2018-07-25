$(document).ready(function() {

    $('#tbl-member').DataTable(
    {
     //    autoWidth: false,
        // fixedHeader: [
        //     {
        //     header: false,
        //     footer: false
        //     }
        // ],
    	// columnDefs:[
    	// 	{ targets:0, width:60 },
     //        { targets:1, width:90 },
     //        { targets:2, width:90 },
     //        { targets:3, width:90 },
     //        { targets:4, width:70 },
     //        { targets:5, width:70 },
     //        { targets:6, width:70 },
     //        { targets:7, width:70 },
     //        { targets:8, width:70 },
     //        { targets:9, width:70 }
    	// ],
    	dom:'<B>rtip',
        // dom: '<B><"top"lf>rt<"bottom"ip><"clear">',
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: 'waves-effect waves-light btn mrm'
                }
            },
        // },
    	buttons: [
            {
                extend: 'csv',
                text: 'Export to CSV',
                filename: function(){
                var currdate = new Date();
                var fname = currdate.getFullYear() + 
                            ('0'+currdate.getMonth()+1).slice(-2) +
                            ('0'+currdate.getDate()).slice(-2) + '_' +
                            ('0'+currdate.getHours()).slice(-2) +
                            ('0'+currdate.getMinutes()).slice(-2);

                return 'member_' + fname;
                }
            } 
        ]}
    });
    $('#tbl-mo-newyear-poc-list').DataTable(
    {
        columnDefs:[
            { targets:0, width:80 },
            { targets:1, width:250 },
            { targets:2, width:60 },
            { targets:3, width:30 },
            { targets:4, width:60 },
            { targets:5, width:30 }
        ],
        dom:'Blfrtip',
        buttons: [
            'copy', 
            // 'csv',
            {
                extend: 'csv',
                text: 'Export to CSV',
                filename: function(){
                var d = new Date();
                var n = d.getTime();
                var dt = moment(d).format('YYYYMMDD_hhmmss');
                return 'Yearly-report_' + dt;
                }
            }, 
            'print'
        ],
        lengthMenu: [[10,50,100],[10,50,100]],
        pageLength: 100
    });
    $('#tbl-weekly-list').DataTable(
    {
        lengthMenu: [[10,50,100],[10,50,100]],
        pageLength: 100,
        columnDefs:[
            { targets:0, width:80 },
            { targets:1, width:250 },
            { targets:2, width:60 },
            { targets:3, width:30 },
            { targets:4, width:60 },
        ],
        dom:'Blfrtip',
        buttons: [
            'copy', 
            // 'csv',
            {
                extend: 'csv',
                text: 'Export to CSV',
                filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'Weekly-report_' + n;
                }
            }, 
            'print'
        ],
        footerCallback: function ( row, data, start, end, display) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            var numFormat = $.fn.dataTable.render.number( '\,', '.', 0, 'Rp.' ).display;
            // $( api.column(4).footer() ).html(
            //     numFormat(pageTotal) +' ( '+ numFormat(total) +' total)'
            // );
            $( api.column(3).footer() ).html('Total: ' + numFormat(pageTotal));
            $( api.column(2).footer() ).html('Grand Total: ' + numFormat(total));

        }
    });
    $('#tbl-year-poc-list').DataTable(
    {
        columnDefs:[
            { targets:0, width:80 },
            { targets:1, width:250 },
            { targets:2, width:60 },
            { targets:3, width:30 },
            { targets:4, width:200 },
            { targets:5, width:50 },
        ],
        dom:'<B>lfrtip',
        buttons: [
            'copy', 
            // 'csv',
            {
                extend: 'csv',
                text: 'Export to CSV',
                filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'Yearly-report_' + n;
                }
            }, 
            'print'
        ],
        lengthMenu: [[10,50,100],[10,50,100]],
        pageLength: 100
    });
    $('#tbl-store-list').DataTable(
    {
        dom: 'lfrtip',
        columnDefs:
        [
            {
                targets: 2,
                render: function (data,type,row)
                { return data == '1' ? 'Active':'Inactive' }
            }
        ],
        lengthMenu: [[10,50,100],[10,50,100]],
        pageLength: 10
    });
});