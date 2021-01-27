/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
 |    GNU GENERAL PUBLIC LICENSE v.3.0    |
 |  https://github.com/musicman3/eMarket  |
 =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */
/**
 * Attribute group
 *
 * @package Group Attributes
 * @author eMarket
 * 
 */
class GroupAttributes {
    /**
     * Constructor
     *
     * @param lang {Json} (lang)
     */
    constructor(lang) {
        this.modal(lang);
        this.click(lang);
    }

    /**
     * Init for modal
     *
     *@param lang {Array} (lang)
     */
    modal(lang) {

        $('#index').on('show.bs.modal', function (event) {

            var jsdata = new JsData();
            var data_id = 'false';
            if (sessionStorage.getItem('attributes') === null) {
                sessionStorage.setItem('attributes', '[]');
            }
            var parse_attributes = jsdata.selectParentUids(data_id, JSON.parse(sessionStorage.getItem('attributes')));

            GroupAttributes.add(lang, parse_attributes);
            GroupAttributes.deleteValue(lang);
        });

        $('#index, #index_product').on('hidden.bs.modal', function (event) {
            $('.group-attributes').empty();
            GroupAttributes.clearAttributes();
            $('.product-attribute').empty();
        });

    }

    /**
     * Init for clicks
     *
     *@param lang {Array} (lang)
     */
    click(lang) {
        $(document).on('click', '.values-group-attribute', function () {
            var jsdata = new JsData();
            var data_id = $(this).closest('tr').attr('id').split('_')[1];
            var parse_attributes = jsdata.selectParentUids('false', JSON.parse(sessionStorage.getItem('attributes')));
            sessionStorage.setItem('level_1', data_id);

            $('#attribute').modal('show');
            var level_length = parse_attributes[0].length;

            for (var x = 0; x < level_length; x++) {
                if (parse_attributes[0][x]['name'] === 'group_attributes_' + lang[4]) {
                    var language = x;
                }
            }

            $('#title_attribute').html(jsdata.selectUid(data_id, parse_attributes)[language]['value']);

        });

        $(document).on('click', '.add-group-attributes', function () {
            $('.input-add-group-attributes').val('');
            $('#add_group_attributes').modal('show');
            sessionStorage.setItem('action', 'add');
        });

        $(document).on('click', '.edit-group-attribute', function () {
            $('#add_group_attributes').modal('show');
            var processing = new AttributesProcessing();
            processing.clickEdit($(this).closest('tr').attr('id').split('_')[1], 'false', 'level_1');
        });

        $(document).on('click', '#save_group_attributes_button', function () {
            $('#add_group_attributes').modal('hide');

            var attributes_bank = $('#group_attributes_add_form').serializeArray();
            var data_id = 'false';
            var jsdata = new JsData();
            var parse_attributes = JSON.parse(sessionStorage.getItem('attributes'));

            if (sessionStorage.getItem('action') === 'add') {
                var parse_attributes_add = jsdata.add(attributes_bank, parse_attributes, data_id);

                sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_add));
                var parse_attributes_view = jsdata.selectParentUids(data_id, JSON.parse(sessionStorage.getItem('attributes')));
                GroupAttributes.add(lang, parse_attributes_view);
            }

            if (sessionStorage.getItem('action') === 'edit') {
                var id = sessionStorage.getItem('level_1');
                var parse_attributes_edit = jsdata.editUid(id, parse_attributes, attributes_bank);
                sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_edit));
                var parse_attributes_view = jsdata.selectParentUids(data_id, JSON.parse(sessionStorage.getItem('attributes')));
                GroupAttributes.add(lang, parse_attributes_view);
            }

            $('.input-add-group-attributes').val('');
            GroupAttributes.deleteValue(lang);
        });
    }

    /**
     * Add value
     *
     * @param id {String} (string id)
     * @param value {String} (string value)
     * @param lang {Array} (lang)
     */
    static addValue(id, value, lang) {
        $('.group-attributes').prepend(
                '<tr class="groupattributes align-middle" id="groupattributes_' + id + '">' +
                '<td class="sortyes-group sortleft-m"><div><span class="bi-arrows-move"> </span></div></td>' +
                '<td class="sortleft-m"><button type="button" class="values-group-attribute btn btn-primary btn-sm"><span class="bi-gear"></span></button></td>' +
                '<td>' + value + '</td>' +
                '<td>' +
                '<div class="gap-2 d-flex justify-content-end"><button type="button" class="edit-group-attribute btn btn-primary btn-sm" title="' + lang[3] + '"><span class="bi-pencil-square"> </span></button>' +
                '<button type="button" class="delete-group-attribute btn btn-primary btn-sm"><span class="bi-trash"> </span></button></div>' +
                '</td>' +
                '</tr>'
                );
    }

    /**
     * Delete
     * 
     * @param lang {Array} (lang)
     *
     */
    static deleteValue(lang) {
        var buttons = document.querySelectorAll('.delete-group-attribute');
        buttons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                var elem = e.currentTarget;
                new bootstrap.Modal(document.querySelector('#confirm')).show();
                confirmation.onclick = function () {
                    bootstrap.Modal.getInstance(document.querySelector('#confirm')).hide();
                    elem.closest('tr').remove();

                    var jsdata = new JsData();
                    var data_id = 'false';
                    var parse_attributes = JSON.parse(sessionStorage.getItem('attributes'));

                    var parse_attributes_delete = jsdata.deleteUid(elem.closest('tr').id.split('_')[1], parse_attributes);
                    sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_delete));

                    var parse_attributes_add = jsdata.selectParentUids(data_id, JSON.parse(sessionStorage.getItem('attributes')));
                    GroupAttributes.add(lang, parse_attributes_add);
                    GroupAttributes.deleteValue(lang);
                };
            });
        });
    }

    /**
     * Sorting
     * 
     * @param lang {Array} (lang)
     *
     */
    sort(lang) {
        var sortedIDs = $(".group-attributes").sortable("toArray").reverse();
        var processing = new AttributesProcessing();
        var parse_attributes_add = processing.sorted(sortedIDs, 'false');

        GroupAttributes.add(lang, parse_attributes_add);
        GroupAttributes.deleteValue(lang);
    }

    /**
     * Add
     * 
     * @param lang {Array} (lang)
     * @param parse {Array} (attributes data)
     *
     */
    static add(lang, parse) {

        var jsdata = new JsData();
        var parse_attributes_sort = jsdata.sort(parse);

        $('.group-attributes').empty();
        parse.forEach((string, index) => {
            var sort_id = string.length - 1;
            string.forEach((item, i) => {
                if (item.name === 'group_attributes_' + lang[4]) {
                    GroupAttributes.addValue(parse_attributes_sort[index][sort_id].uid, parse_attributes_sort[index][i].value, lang);
                }
            });
        });
    }

    /**
     * Clear Attributes
     *
     */
    static clearAttributes() {
        ['attributes',
            'level_1',
            'level_2',
            'level_3',
            'action'
        ].forEach((item) => sessionStorage.removeItem(item));
    }
}