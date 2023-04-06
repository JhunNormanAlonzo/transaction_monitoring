<div>
    <script>
        var minDate, maxDate;

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[{{ $target }}] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });






            var table = $("#table").DataTable({
                dom: "Blfrtip",
                fixedColumns: true,
                buttons: [
                    {
                        extend: 'pdf',
                        title: "{{ $title }}",
                        text: '<i class="bi bi-filetype-pdf"></i>',
                        className: 'btn btn-primary mb-3',
                        download: 'download',
                        orientation: "{{$orientation}}",
                        pageSize : "{{$pageSize}}",
                        exportOptions: {
                            columns: [{{ $columns }}]
                        },

                        customize: function (doc) {
                            doc.pageMargins = [10,10,10,10];
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 9;
                            doc.content[0].text = doc.content[0].text.trim();
                            // Create a footer
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Printed by : {{auth()->user()->name}} on {{\Carbon\Carbon::now()->tz('Asia/Manila')->isoFormat('LLLL')}}',
                                        {
                                            // This is the right column
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                        }
                                    ],
                                    margin: [10, 0]
                                }
                            });
                            // Styling the table: create style object
                            var objLayout = {};
                            // Horizontal line thickness
                            objLayout['hLineWidth'] = function(i) { return .5; };
                            // Vertical line thickness
                            objLayout['vLineWidth'] = function(i) { return .5; };
                            // Horizontal line color
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            // Vertical line color
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            // Left padding of the cell
                            objLayout['paddingLeft'] = function(i) { return 4; };
                            // Right padding of the cell
                            objLayout['paddingRight'] = function(i) { return 4; };
                            // Inject the object in the document
                            doc.content[1].layout = objLayout;

                            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    }
                ]
            }).columns.adjust();


            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>
</div>
