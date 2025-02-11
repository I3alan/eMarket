<?php

/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

namespace eMarket\Admin;

use eMarket\Core\{
    Func,
    Lang,
    Messages,
    Pages,
    Pdo,
    Valid
};

/**
 * Vendor Codes
 *
 * @package Admin
 * @author eMarket Team
 * @copyright © 2018 eMarket
 * @license GNU GPL v.3.0
 * 
 */
class VendorCodes {

    public static $sql_data = FALSE;
    public static $json_data = FALSE;

    /**
     * Constructor
     *
     */
    function __construct() {
        $this->add();
        $this->edit();
        $this->delete();
        $this->data();
        $this->modal();
    }

    /**
     * Add
     *
     */
    public function add() {
        if (Valid::inPOST('add')) {

            if (Valid::inPOST('default_vendor_code')) {
                $default_vendor_code = 1;
            } else {
                $default_vendor_code = 0;
            }

            $id_max = Pdo::getValue("SELECT id FROM " . TABLE_VENDOR_CODES . " WHERE language=? ORDER BY id DESC", [lang('#lang_all')[0]]);
            $id = intval($id_max) + 1;

            if ($id > 1 && $default_vendor_code != 0) {
                Pdo::action("UPDATE " . TABLE_VENDOR_CODES . " SET default_vendor_code=?", [0]);
            }

            for ($x = 0; $x < Lang::$count; $x++) {
                Pdo::action("INSERT INTO " . TABLE_VENDOR_CODES . " SET id=?, name=?, language=?, vendor_code=?, default_vendor_code=?", [
                    $id, Valid::inPOST('name_vendor_codes_' . $x), lang('#lang_all')[$x], Valid::inPOST('vendor_code_' . $x), $default_vendor_code
                ]);
            }

            Messages::alert('add', 'success', lang('action_completed_successfully'));
        }
    }

    /**
     * Edit
     *
     */
    public function edit() {
        if (Valid::inPOST('edit')) {

            if (Valid::inPOST('default_vendor_code')) {
                $default_vendor_code = 1;
            } else {
                $default_vendor_code = 0;
            }

            if ($default_vendor_code != 0) {
                Pdo::action("UPDATE " . TABLE_VENDOR_CODES . " SET default_vendor_code=?", [0]);
            }

            for ($x = 0; $x < Lang::$count; $x++) {
                Pdo::action("UPDATE " . TABLE_VENDOR_CODES . " SET name=?, vendor_code=?, default_vendor_code=? WHERE id=? AND language=?", [
                    Valid::inPOST('name_vendor_codes_' . $x), Valid::inPOST('vendor_code_' . $x), $default_vendor_code, Valid::inPOST('edit'),
                    lang('#lang_all')[$x]
                ]);
            }

            Messages::alert('edit', 'success', lang('action_completed_successfully'));
        }
    }

    /**
     * Delete
     *
     */
    public function delete() {
        if (Valid::inPOST('delete')) {
            Pdo::action("DELETE FROM " . TABLE_VENDOR_CODES . " WHERE id=?", [Valid::inPOST('delete')]);

            Messages::alert('delete', 'success', lang('action_completed_successfully'));
        }
    }

    /**
     * Data
     *
     */
    public function data() {
        self::$sql_data = Pdo::getAssoc("SELECT * FROM " . TABLE_VENDOR_CODES . " ORDER BY id DESC", []);
        $lines = Func::filterData(self::$sql_data, 'language', lang('#lang_all')[0]);
        Pages::data($lines);
    }

    /**
     * Modal
     *
     */
    public function modal() {
        self::$json_data = json_encode([]);
        $name = [];
        $code = [];
        for ($i = Pages::$start; $i < Pages::$finish; $i++) {
            if (isset(Pages::$table['lines'][$i]['id']) == TRUE) {

                $modal_id = Pages::$table['lines'][$i]['id'];

                foreach (self::$sql_data as $sql_modal) {
                    if ($sql_modal['id'] == $modal_id) {
                        $name[array_search($sql_modal['language'], lang('#lang_all'))][$modal_id] = $sql_modal['name'];
                        $code[array_search($sql_modal['language'], lang('#lang_all'))][$modal_id] = $sql_modal['vendor_code'];
                    }
                    if ($sql_modal['language'] == lang('#lang_all')[0] && $sql_modal['id'] == $modal_id) {
                        $default[$modal_id] = (int) $sql_modal['default_vendor_code'];
                    }
                }

                ksort($name);
                ksort($code);

                self::$json_data = json_encode([
                    'name' => $name,
                    'code' => $code,
                    'default' => $default
                ]);
            }
        }
    }

}
