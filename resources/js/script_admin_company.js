class ScriptAdminCompany {

    options = {
        company_id : 0,
        company_address : '',
        coordinate_latitude : 55.755864,
        coordinate_longitude : 37.617698,
        data_table_butt_delete : false,
        map_allow_edit : false,
        data_workers : [],
        data_workers_for_input : []
    }

    constructor(options = {}) {
        for(let key in options) {
            this.options[key] = options[key];
        }
    }

    /*
    *Datatable
    */
    dataTable = function() {

        let self = this;
        let columns = [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'phone'},
        ];

        if(this.options.data_table_butt_delete) {
            jQuery.each(this.options.data_workers, function (index) {
                self.options.data_workers_for_input.push(Number(self.options.data_workers[index].id));
            });

            this.changeValInputWorkers();

            columns.push({data: 'action', orderable: false});
            jQuery('#workers').on('click', {self: self}, this.btnEventDelete);
            jQuery.each(this.options.data_workers, function (index) {
                self.options.data_workers[index].action = self.getHtmlButAction(self.options.data_workers[index].id);
            });
        }

        this.dTable = jQuery('#workers').DataTable({
            //ajax: '/api/admin/workers?company_id=' + this.options.company_id + '&update_company=true',
            data: this.options.data_workers,
            columns: columns
        });

        jQuery('#add_worker_but').on('click', this.btnEventAddWorker.bind(this));
    }

    getHtmlButAction = function (id) {

        return '<button data-rowid="'+ id +'" class="btn btn-sm btn-danger btn-delete">Удалить</button>';
    }


    changeValInputWorkers = function() {

        document.querySelector('#workers_in_company').value = this.options.data_workers_for_input;
    }

    btnEventAddWorker = function () {

        let input = document.querySelector('#workers_input');
        let value_input = input.value;
        let list_options = input.list.options;

        for(let i = 0; list_options.length > i; i++) {
            if(list_options[i].value == value_input) {

                if(this.options.data_workers_for_input.includes(Number(list_options[i].dataset.id))) {
                    return false;
                }
                let worker = {};
                worker.id = list_options[i].dataset.id;
                worker.name = list_options[i].value;
                worker.email = list_options[i].dataset.email;
                worker.phone = list_options[i].dataset.phone;
                if(this.options.data_table_butt_delete) {
                    worker.action = this.getHtmlButAction(worker.id);
                }
                this.options.data_workers_for_input.push(Number(worker.id));
                this.changeValInputWorkers();
                this.dTable.row.add(worker).draw();
                break;
            }
        }
    }

    btnEventDelete = function (ev) {

        if(ev.target.classList.contains('btn-delete')) {
            let worker_id = Number(ev.target.dataset.rowid);
            let index = ev.data.self.options.data_workers_for_input.indexOf(worker_id);
            ev.data.self.options.data_workers_for_input.splice(index, 1);
            ev.data.self.changeValInputWorkers();
            ev.data.self.dTable.row( $(ev.target).parents('tr') ).remove().draw();
        }
    }

    /*
    *input logo img
     */
    logoImg = function () {

        jQuery("#company_logo_input").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#company_logo_img').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    /*
    *Yandex Map
    */
    yaMapCompany = function () {

        let self = this;
        let latitude = document.querySelector('#latitude_inp');
        let longitude = document.querySelector('#longitude_inp');
        let inputAddress = document.querySelector('#company_address');
        let inputSearch = new ymaps.control.SearchControl({
            options: {
                size: 'large',
                provider: 'yandex#search'
            }
        });
        inputSearch.events.add('resultselect', function () { self.eventSelectAddressInSearch(inputSearch.getResponseMetaData()); });
        let tupeSelecror = new ymaps.control.TypeSelector();
        let zoomControl = new ymaps.control.ZoomControl();
        let buttonControl = new ymaps.control.Button({
            data: {
                content: 'сохранить адрес'
            },
            options: {
                maxWidth: 150
            }
        });
        buttonControl.events.add('click', function () { self.changeAddressInInput(inputAddress, latitude, longitude); });
        let myPlacemark = new ymaps.Placemark([this.options.coordinate_latitude, this.options.coordinate_longitude], {}, {
            draggable: true
        });
        myPlacemark.events.add('dragend', function (ev) {
            let thisPlacemark = ev.get('target');
            let coords = thisPlacemark.geometry.getCoordinates();
            self.changeCoordinates(coords);
        });

        let controls = [tupeSelecror, zoomControl];

        if(this.options.map_allow_edit) {
            controls.push(inputSearch);
            controls.push(buttonControl);
        }

        let myMap = new ymaps.Map("YMapsID", {
            center: [this.options.coordinate_latitude, this.options.coordinate_longitude],
            zoom: 13,
            controls: controls
        });
        myMap.geoObjects.add(myPlacemark);
    }

    eventSelectAddressInSearch = function(searchMetData) {

        this.options.company_address = searchMetData.SearchResponse.SourceMetaDataList.GeocoderResponseMetaData.request;
        let coordinates = {};
        coordinates[0] = searchMetData.SearchResponse.Point.coordinates[1];
        coordinates[1] = searchMetData.SearchResponse.Point.coordinates[0];
        this.changeCoordinates(coordinates);
    }

    changeCoordinates = function(coordinates) {

        this.options.coordinate_latitude = Number(coordinates[0].toFixed(8));
        this.options.coordinate_longitude = Number(coordinates[1].toFixed(8));
    }

    changeAddressInInput = function(inputAddress, latitude, longitude) {

        inputAddress.value = this.options.company_address;
        latitude.value = this.options.coordinate_latitude;
        longitude.value = this.options.coordinate_longitude;
    }

}
