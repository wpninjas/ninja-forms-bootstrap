<?php

final class NF_Bootstrap_FieldClasses
{
    private $form_controls = array(
        'textbox',
        'firstname',
        'lastname',
        'date',
        'number',
        'email',
        'phone',
        'address',
        'city',
        'zip',
        'creditcardcvc',
        'creditcardexpiration',
        'creditcardfullname',
        'creditcardnumber',
        'creditcardzip',
        'spam',
        'quantity',
        'listselect',
        'textarea'
    );

    private $buttons = array(
        'button',
        'submit'
    );

    public function __construct()
    {
        foreach( $this->form_controls as $field_type ) {
            add_filter('ninja_forms_localize_field_settings_' . $field_type, array( $this, 'form_controls' ) );
        }
        foreach( $this->buttons as $field_type ) {
            add_filter('ninja_forms_localize_field_settings_' . $field_type, array( $this, 'buttons' ) );
        }
    }

    public function form_controls( $field_settings )
    {
        $field_settings[ 'element_class' ] .= ' form-control';
        return $field_settings;
    }

    public function buttons( $field_settings )
    {
        $field_settings[ 'element_class' ] = 'btn btn-default';
        return $field_settings;
    }
}