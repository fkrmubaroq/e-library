var table = null;
var ColorTr = true;
function Draw(param = '') {
    table = $('#tableposting').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 50,
        "pagingType": "simple",
        "language": {
            "search": "",
            "info": "_START_ - _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "paginate": {
                "previous": `<i class="fas fa-chevron-left"></i>`,
                "next": `<i class="fas fa-chevron-right"></i>`
            }
        },

        "ajax": {
            "url": `${BaseUrl}/posting/get_dt${ObjToGet(param)}`,
        },
        "fnServerParams": function (aoData) {
            const limit = aoData.length;
            const offset = aoData.start;
            if (offset <= 0)
                aoData.page = 1;
            else
                aoData.page = offset / limit + 1;


        },
        "createdRow": function (row, data, dataIndex) {
            $(row).addClass(['my-2', 'ml-0', 'margin-right-5', 'margin-top-5']);
            $(row).attr('data-id', data['id']);
            if (ColorTr == true)
                $(row).addClass('bg-white');

            // lebar card untuk mobile dan browser
            if (IsMobile())
                $(row).css('width', '100%')
            else
                $(row).css('min-width', '23%')
        },

        // posisi fitur datatable
        // "dom": "<'d-flex justify-content-between'l<'d-flex'<'#fitur.text-size-2'><'#table_search'f>>><t><'d-flex justify-content-between'ip>",
        "dom": "<'d-flex justify-content-start'<'#table_search'f>><t><'d-flex justify-content-end'p>",

        'drawCallback': function (settings) {
            var api = this.api();
            var $table = $(api.table().node());

            if ($table.hasClass('cards')) {

                // Create an array of labels containing all table headers
                var labels = [];
                $('thead th', $table).each(function () {
                    const RemoveLabel = [''];
                    const value = $(this).text();
                    if (RemoveLabel.indexOf(value) != -1)
                        labels.push(value);

                });

                // Add data-label attribute to each cell
                $('tbody tr', $table).each(function () {
                    $(this).find('td').each(function (column) {
                        $(this).attr('data-label', labels[column]);
                    });
                });

                var max = 0;
                $('tbody tr', $table).each(function () {
                    max = Math.max($(this).height(), max);
                }).height(max);

            } else {
                // Remove data-label attribute from each cell
                $('tbody td', $table).each(function () {
                    $(this).removeAttr('data-label');
                });

                $('tbody tr', $table).each(function () {
                    $(this).height('auto');
                });
            }
        },
        "columns": [

            {
                "data": "id",
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css({
                        'background': '#fff',
                        // 'border': '1px solid #ebe9f1',
                        'box-shadow': 'rgba(100, 100, 111, 0.2) 0px 7px 29px 0px',
                    });
                    $(td).addClass(['pl-0', 'border-radius', 'no-border'])

                },
                "render": function (data, type, row, meta) {
                    let Wrapper = '';
                    const Image = `
                    <img src='${BaseUrl + '/assets/uploads/files/partner/' + row['logo']}' class='img-fluid' style='transform:scale(0.85); height:200.1px; object-fit:cover;'>
                    `;
                    let desc = row['desc_pekerjaan'];
                    let sallary = `Rp ${Rupiah(row['range_gaji_awal'])} - ${Rupiah(row['range_gaji_akhir'])} `
                    if (desc.length > 200)
                        desc = desc.substr(0, 200) + '...';

                    Wrapper = `
                    <div class="card no-border" >
                    ${Image}
                        <div class="card-body">
                            <a href='#' class='text-dark' style='text-decoration:none;'>
                                <h5 class="card-title fweight-700">${row['judul_lowongan']}</h5>
                            </a>
                            
                            <p class="card-text text-justify text-muted">${desc}</p>
                        </div>
                        
                            <div class="card-footer d-flex justify-content-between no-border bg-white">
                                <div class='d-flex align-items-center '>
                                    <div class='fweight-600'>${sallary}</div>
                                </div>
                                <small class="d-flex align-items-center text-muted">
                                    <i class="far fa-clock"></i> &nbsp;  ${row['created_at'] ?? 'hari ini'}
                                </small>                           
                            </div>
                    </div>
                    `;
                    return Wrapper
                }
            },

        ],

    });

    $('#table_search input').attr({
        'placeholder': 'Search',
        'style': 'height:40px; width:100%; border-color:#ddd',
        'class': 'form-control ml-0 padding-x-3 padding-y-4',

    });
    $('#table_search').addClass(['w-100', 'd-flex']);
    $('#table_search div').addClass('w-100');
    $('.dataTables_filter label').addClass(['w-100', 'padding-right-5', 'mb-0']);
    $('#table_search').append(`
    <div class='d-flex align-items-center margin-right-2'>
        <i class="fas fa-search icon-primary text-muted"></i>
    </div>
    `);
    $('.dataTables_wrapper').removeClass('container-fluid');


}

Draw();