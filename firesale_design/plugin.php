<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_design extends Plugin
{

    public function form()
    {

        // Load required items
        $this->load->model('firesale_design/design_m');

        // Attributes
        $type = $this->attribute('type');
        $id   = (int)$this->attribute('id');

        // Check attributes
        if( $type and $id ) {

            $theme   = $this->settings->get('default_theme');
            $layouts = $this->template->get_theme_layouts($theme);
            $views   = $this->design_m->get_theme_views($theme);

            // Build data
            $data          = new stdClass;
            $data->type    = $type;
            $data->id      = $id;
            $data->layouts = array();
            $data->views   = array();
            $data->design  = $this->design_m->get_design($type, $id);

            // Format layout names
            foreach( $layouts as $layout ) {
                $data->layouts[$layout] = $this->design_m->format_name($layout);
            }

            // Format view names
            foreach( $views as $view ) {
                $data->views[$view] = $this->design_m->format_name($view);
            }

            // Build form
            return $this->parser->parse('firesale_design/form', $data, true);
        }

        return false;
    }

}
