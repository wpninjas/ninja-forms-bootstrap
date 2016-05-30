<?php

final class NF_Bootstrap_FieldClasses
{
    public function __construct()
    {
        foreach( NF_Bootstrap::config( 'FormControlFields' ) as $field_type ) {
            add_filter('ninja_forms_localize_field_settings_' . $field_type, array( $this, 'form_controls' ) );
        }
        foreach( NF_Bootstrap::config( 'ButtonFields' ) as $field_type ) {
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