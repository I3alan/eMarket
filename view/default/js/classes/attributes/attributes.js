/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
 |    GNU GENERAL PUBLIC LICENSE v.3.0    |
 |  https://github.com/musicman3/eMarket  |
 =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */
/**
 * Атрибуты
 *
 * @package Attributes
 * @author eMarket
 * 
 */
class Attributes {
    /**
     * Конструктор
     *
     * @param lang {Json} (Языковые переменные)
     */
    constructor(lang) {
        this.modal(lang);
        this.click(lang);
    }

    /**
     * Инициализация для модалов
     *
     *@param lang {Array} (Языковые переменные)
     */
    modal(lang) {

        // Если открыли модал списка в группе атрибутов
        $('#attribute').on('show.bs.modal', function (event) {

            if (sessionStorage.getItem('value_attribute_flag') === null) {
                Attributes.clearAttributes();
            }
            var group_id = sessionStorage.getItem('group_attribute_id');

            if (sessionStorage.getItem('attributes') !== null) {
                var jsdata = new JsData();
                var parse_attributes = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));

                Attributes.add(lang, parse_attributes);
            }
            // Загружаем удаление атрибута
            Attributes.deleteValue(lang);

        });

        // Если закрыли модал списка в группе атрибутов
        $('#attribute').on('hidden.bs.modal', function (event) {
            $('.attribute').empty();
            if (sessionStorage.getItem('value_attribute_flag') === '0') {
                Attributes.clearAttributes();
            }
        });

        // Если закрыли модал значения атрибута
        $('#add_attribute').on('hidden.bs.modal', function (event) {
            $('.input-add-attribute').val('');
            // Загружаем удаление атрибута
            Attributes.deleteValue(lang);
        });
    }

    /**
     * Инициализация для кликов
     *
     *@param lang {Array} (Языковые переменные)
     */
    click(lang) {
         // Если открыли модал списка значений группы атрибута
        $(document).on('click', '.values-attribute', function () {
            var jsdata = new JsData();
            var group_id = $(this).closest('tr').attr('id').split('_')[1];
            var parse_attributes = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
            sessionStorage.setItem('attribute_id', group_id);

            $('#values_attribute').modal('show');
            $('#title_values_attribute').html('Значение группы атрибутов: ' + jsdata.selectUid(group_id, parse_attributes)[0]['value']);
        });
        
        // Добавляем атрибут
        $(document).on('click', '.add-attribute', function () {
            sessionStorage.setItem('attribute_action', 'add');
            $('#values_attribute').modal('show');
        });

        // Редактируем атрибут
        $(document).on('click', '.edit-attribute', function () {
            var id = $(this).closest('tr').attr('id').split('_')[1];
            var group_id = sessionStorage.getItem('group_attribute_id');
            var jsdata = new JsData();
            var parse_attributes = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
            var group_string = jsdata.selectUid(id, parse_attributes);

            sessionStorage.setItem('attribute_action', 'edit');
            sessionStorage.setItem('edit_attribute_id', id);

            $('#add_attribute').modal('show');

            for (var x = 0; x < group_string.length - 1; x++) {
                $('input[name="' + group_string[x]['name'] + '"]').val(group_string[x]['value']);
            }

        });

        // Сохраняем атрибут
        $('#save_attribute_button').click(function () {
            $('#add_attribute').modal('hide');

            var attributes_bank = $('#attribute_add_form').serializeArray();
            var group_id = sessionStorage.getItem('group_attribute_id');
            var jsdata = new JsData();
            var parse_attributes = $.parseJSON(sessionStorage.getItem('attributes'));

            //Если атрибут добавляется
            if (sessionStorage.getItem('attribute_action') === 'add') {

                var parse_attributes_add = jsdata.add(attributes_bank, parse_attributes, group_id);

                sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_add));
                sessionStorage.setItem('value_attribute_flag', '0');
                var parse_attributes_view = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
                Attributes.add(lang, parse_attributes_view);
            }

            //Если атрибут редактируется
            if (sessionStorage.getItem('attribute_action') === 'edit') {

                var id = sessionStorage.getItem('edit_attribute_id');

                var parse_attributes_edit = jsdata.editUid(id, parse_attributes, attributes_bank);
                sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_edit));
                var parse_attributes_view = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
                Attributes.add(lang, parse_attributes_view);
            }

            $('.input-add-attribute').val('');
        });
    }

    /**
     * Отображение атрибутов
     *
     * @param id {String} (id строки)
     * @param value {String} (значение строки)
     * @param lang {Array} (Языковые переменные)
     */
    static addValue(id, value, lang) {
        $('.attribute').prepend(
                '<tr class="attributes-class" id="attributes_' + id + '">' +
                '<td class="sortyes-attributes sortleft-m"><div><span class="glyphicon glyphicon-move"> </span></div></td>' +
                '<td class="sortleft-m"><button type="button" class="values-attribute btn btn-primary btn-xs"><span class="glyphicon glyphicon-cog"></span></button></td>' +
                '<td>' + value + '</td>' +
                '<td class="al-text-w">' +
                '<div class="b-right"><button type="button" class="delete-attribute btn btn-primary btn-xs" data-placement="left" data-toggle="confirmation" data-singleton="true" data-popout="true" data-btn-ok-label="' + lang[0] + '" data-btn-cancel-label="' + lang[1] + '" title="' + lang[2] + '"><span class="glyphicon glyphicon-trash"> </span></button></div>' +
                '<div class="b-left"><button type="button" class="edit-attribute btn btn-primary btn-xs" title="' + lang[3] + '"><span class="glyphicon glyphicon-edit"> </span></button></div>' +
                '</td>' +
                '</tr>'
                );
    }

    /**
     * Удаление атрибутов
     * 
     * @param lang {Array} (Языковые переменные)
     *
     */
    static deleteValue(lang) {
        $('.delete-attribute').confirmation({
            onConfirm: function (event) {
                $(this).closest('tr').remove();

                var jsdata = new JsData();
                var group_id = sessionStorage.getItem('group_attribute_id');
                var parse_attributes = $.parseJSON(sessionStorage.getItem('attributes'));

                var parse_attributes_delete = jsdata.deleteUid($(this).closest('tr').attr('id').split('_')[1], parse_attributes);
                sessionStorage.setItem('attributes', JSON.stringify(parse_attributes_delete));

                var parse_attributes_add = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
                Attributes.add(lang, parse_attributes_add);
                // Загружаем удаление атрибута
                Attributes.deleteValue(lang);
            }});
    }

    /**
     * Сортировка атрибутов
     * 
     * @param lang {Array} (Языковые переменные)
     *
     */
    static sort(lang) {
        var sortedIDs = $(".attribute").sortable("toArray").reverse();

        var group_id = sessionStorage.getItem('group_attribute_id');
        var jsdata = new JsData();
        var parse_attributes = $.parseJSON(sessionStorage.getItem('attributes'));
        var parse_attributes_sort = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));
        var sort = jsdata.sortToListUid(sortedIDs, parse_attributes_sort);

        var sorted = jsdata.replaceUids(sort, parse_attributes);

        sessionStorage.setItem('attributes', JSON.stringify(sorted));
        var parse_attributes_add = jsdata.selectParentUids(group_id, $.parseJSON(sessionStorage.getItem('attributes')));

        Attributes.add(lang, parse_attributes_add);
        Attributes.deleteValue(lang);
    }

    /**
     * Добавление атрибутов
     * 
     * @param lang {Array} (Языковые переменные)
     * @param parse {Array} (Данные по атрибутам)
     *
     */
    static add(lang, parse) {

        var jsdata = new JsData();
        var parse_attributes_sort = jsdata.sort(parse);

        $('.attribute').empty();
        parse.forEach((string, index) => {
            var sort_id = string.length - 1;
            Attributes.addValue(parse_attributes_sort[index][sort_id].uid, parse_attributes_sort[index][0].value, lang);
        });
    }

    /**
     * Очистка атрибутов
     *
     */
    static clearAttributes() {
        ['attribute_action',
            'edit_attribute_id',
            'edit_value_attribute_id',
            'value_attribute_action',
            'value_attribute_action_id',
            'value_attribute_flag'
        ].forEach((item) => sessionStorage.removeItem(item));
    }
}