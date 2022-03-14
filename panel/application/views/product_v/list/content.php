<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ürün Listesi
            <a href="<?php echo base_url("product/new_form"); ?>" class="btn btn-outline btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Yeni Ürün Ekle</a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title"><b>Ürün Bulunamadı</b></h5>
                    <p>Ürün Eklemek İçin <b>Yeni Ürün Ekle</b> Butonuna Basınız</p>
                </div>
            <?php } else { ?>
                <table class="table table-hover table-striped">
                <thead>
                    <th>#id</th>
                    <th>Url</th>
                    <th>Ürün Adı</th>
                    <th>Açıklama</th>
                    <th>Durumu</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td>#<?php echo $item->id; ?></td>
                            <td><?php echo $item->url; ?></td>
                            <td><?php echo $item->title; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td>
                                <input
                                    type="checkbox"
                                    data-switchery data-color="#10c469"
                                    <?php echo ($item->isActive) ? "checked" : ""; ?>
                                />
                            </td>
                            <td>
                                <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="<?php echo base_url("product/update_form/$item->id"); ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>