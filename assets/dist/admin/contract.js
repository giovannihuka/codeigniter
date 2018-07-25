$(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    pageLength: 25,
                    ajax: {"url": "contract/json", "type": "POST"},
                    columns: [
                        {
                            "data": "contract_id",
                            "orderable": false
                        },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        },
						{"data": "company_name"},
						{"data": "db_name"},
						{"data": "server_ip"},
						{"data": "pic_name"},
						{"data": "company_address"},
						{"data": "company_phone1"},
						{"data": "company_phone2"},
						{"data": "pic_phone"},
						{"data": "email_address"},
						{"data": "contract_date"},
						{"data": "start_date"},
						{"data": "terminate_date"},
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });