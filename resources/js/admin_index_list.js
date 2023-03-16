class AdminIndexList {

    options = {
        data_items : {},
        columns : [],
        data_table_columns : [],
        default_columns : {
            id: {data: 'id'},
            logo_url : {
                data: "logo_url",
                render: function(data, type, full, meta) {
                    if (data != '' && data != null) {
                        return (
                            "<img src=" + data + " loading='lazy' width='30' class='img-thumbnail' />"
                        );
                    } else {
                        return (
                            "<img src='/storage/company_images/blank_s.jpg' width='30' class='img-thumbnail' />"
                        );
                    }
                },
                orderable: false
            },
            name : {data: 'name'},
            email : {data: 'email'},
            address : {data: 'address'},
            action : {data: 'action', orderable: false},
            //for workers
            phone : {data: 'phone'},
            company : {data: 'company'}
        }
    };

    constructor(options = {}) {

        let self = this;

        for(let key in options) {
            this.options[key] = options[key];
        }

        this.options.columns.forEach(function (el) {
            this.options.data_table_columns.push(this.options.default_columns[el]);
        }, this);

        if(this.options.columns.includes('action')) {
            jQuery.each(self.options.data_items, function (index) {
                self.options.data_items[index].action = '<div class="text-nowrap"><a href="/admin/' + self.options.route + '/' + self.options.data_items[index].id + '" class="btn btn-sm btn-secondary btn-act-tab">Просмотр</a> <a href="/admin/' + self.options.route + '/' + self.options.data_items[index].id + '/edit" class="btn btn-sm btn-secondary btn-act-tab">Редактировать</a> <button data-rowid="' + self.options.data_items[index].id + '" class="btn btn-sm btn-danger btn-delete btn-act-tab">Удалить</button></div>';
            });
        }
    }

    dataTable = function () {

        let self = this;
        let table_dom = $('#' + this.options.route);

        this.dTable = table_dom.DataTable({
            data: this.options.data_items,
            columns: this.options.data_table_columns
        });

        if(this.options.columns.includes('action')) {

            let item_delete_id = false;

            table_dom.on('click', function (ev) {

                if(ev.target.classList.contains('btn-delete')) {
                    $('.popup-fade').fadeIn();
                    item_delete_id = ev.target.dataset.rowid;
                }
            });

            $('#popup-delete').click(function () {

                $(this).parents('.popup-fade').fadeOut();
                self.deleteCompanyRequest(item_delete_id);
            });

            $('#popup-close').click(function() {

                $(this).parents('.popup-fade').fadeOut();
                return false;
            });

            $(document).keydown(function(e) {

                if (e.keyCode === 27) {
                    //e.stopPropagation();
                    $('.popup-fade').fadeOut();
                }
            });
        }
    }

    deleteCompanyRequest = function (item_delete_id) {

        let self = this;

        $.ajax({
            url: '/admin/' + this.options.route + '/' + item_delete_id,
            method: 'POST',
            data: {
                '_method' : 'delete',
                '_token' : this.options.csrf,
            },
            success: function (response, status, xrh) {
                if(xrh.readyState === 4 && xrh.status === 200) {
                    self.dTable.row( $('[data-rowid=' + item_delete_id + ']').parents('tr') ).remove().draw();
                }
            }
        });
    }
}
