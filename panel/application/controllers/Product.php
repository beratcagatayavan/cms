<?php

class Product extends CI_Controller {

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";

        $this->load->model("product_model");

    }

    public function index()
    {
        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi */

        $items =  $this->product_model->get_all();

        /** View'e Gönderilecek Değişkenlerin Set Edilmesi */

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {
        $viewData = new stdClass();

        /** View'e Gönderilecek Değişkenlerin Set Edilmesi */

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save()
    {
        $this->load->library("form_validation");

        // Kurallar yazılır..
        $this->form_validation->set_rules("title", "Ürün Adı", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  =>  "<b>{field}</b> Boş Bırakılamaz"
            )
        );

        // Form Validation Çalıştırılır
        $validate = $this->form_validation->run();

        if ($validate){

            $insert = $this->product_model->add(
                array(
                    "title"         =>  $this->input->post("title"),
                    "description"   =>  $this->input->post("description"),
                    "url"           =>  convertToSEO($this->input->post("title")),
                    "rank"          =>  0,
                    "isActive"      =>  1,
                    "createdAt"     =>  date("Y-m-d H:i:s")
                )
            );

            if ($insert){

                redirect(base_url("product"));

            } else {

                redirect(base_url("product"));

            }

        } else {

            $viewData = new stdClass();

            /** View'e Gönderilecek Değişkenlerin Set Edilmesi */

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

        // Başarılı ise
            // Kayıt İşlemi Başlar
        // Başarısız ise
            // Hata Ekranda Gösterilir
    }

    public function update_form($id)
    {
        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi */

        $item = $this->product_model->get(
            array(
                "id"        =>  $id
            )
        );

        /** View'e Gönderilecek Değişkenlerin Set Edilmesi */

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $this->load->library("form_validation");

        // Kurallar yazılır..
        $this->form_validation->set_rules("title", "Ürün Adı", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  =>  "<b>{field}</b> Boş Bırakılamaz"
            )
        );

        // Form Validation Çalıştırılır
        $validate = $this->form_validation->run();

        if ($validate){

            $update = $this->product_model->update(
                array(
                    "id"            =>  $id
                ),
                array(
                    "title"         =>  $this->input->post("title"),
                    "description"   =>  $this->input->post("description"),
                    "url"           =>  convertToSEO($this->input->post("title")),
                )
            );

            if ($update){

                redirect(base_url("product"));

            } else {

                redirect(base_url("product"));

            }

        } else {

            /** Tablodan Verilerin Getirilmesi */

            $item = $this->product_model->get(
                array(
                    "id"        =>  $id
                )
            );

            $viewData = new stdClass();

            /** View'e Gönderilecek Değişkenlerin Set Edilmesi */

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

        // Başarılı ise
        // Kayıt İşlemi Başlar
        // Başarısız ise
        // Hata Ekranda Gösterilir
    }

    public function delete($id)
    {
        $delete = $this->product_model->delete(
            array(
                "id"    =>  $id
            )
        );

        if ($delete){

            redirect(base_url("product"));

        } else {

            redirect(base_url("product"));

        }

    }

    public function isActiveSetter($id){

        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_model->update(
                array(
                    "id"            =>  $id
                ),
                array(
                    "isActive"      =>  $isActive
                )
            );
        }
    }

}