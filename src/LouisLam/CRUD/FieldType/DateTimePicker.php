<?php
/**
 * Created by PhpStorm.
 * User: Louis Lam
 * Date: 8/13/2015
 * Time: 9:33 PM
 */

namespace LouisLam\CRUD\FieldType;


use LouisLam\Util;
use RedBeanPHP\R;

class DateTimePicker extends TextField
{
    /**
     * Email constructor.
     */
    public function __construct()
    {

    }

    public function render($echo = false)
    {

        $name = $this->field->getName();
        $this->field->getCRUD()->addBodyEndHTML(<<< HTML
            <script type="text/javascript">
                $(function () {
                    var format = 'YYYY-MM-DD hh:mm A';
                    
                    $('#field-$name').daterangepicker({
                        singleDatePicker: true,
                        autoApply: true,
                        timePicker: true,
                        timePickerIncrement: 30,
                        autoUpdateInput: false,
                        locale: {
                            format: format
                        }
                    });
                    
                   $('#field-$name').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format(format));
                  });

                  $('#field-$name').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });
                  
                });
            </script>
HTML
);
        return parent::render($echo);
    }


    public function beforeRenderValue($valueFromDatabase)
    {
        if (empty($valueFromDatabase) || strtotime($valueFromDatabase) <= 0) {
            return "";
        }

        return date("Y-m-d h:i A", strtotime($valueFromDatabase));
    }

    public function beforeStoreValue($valueFromUser)
    {
        return R::isoDateTime(strtotime($valueFromUser));
    }



}